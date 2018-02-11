<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;
use yii\mutex\FileMutex;
use yii\base\ErrorException;

/**
 * Monitor is the model to control monitoring system
 *
 */
class Monitor extends Model
{
    /**
     * @var array $items - monitoring items
     * @var array $groups - monitoring groups of items
     * @var array $updateTimes - update times (min and max)
     */
    public $items=[];
    public $groups=[];
    public $updateTimes=[];

    /**
     * get Database name
     * @param $dbName
     * @return mixed
     */
    private function getDb($dbName)
    {
        return \Yii::$app->$dbName;
    }

    /**
     * Update monitoring items
     * @return string
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function update()
    {
        $mutex=new FileMutex();
        if (!$mutex->acquire('monitor/update')) {
            return 'another process is running';
        }

        foreach (MonitorItems::find()->orderBy('time')->all() as $item) {
            $dbQueries = DbQueries::findOne(['monitor_items_id'=>$item->getAttribute('id')]);
            if($dbQueries) {
                try {
                    $value = null;
                    if ($item->activity)
                    {
                        // запрашиваем даннные из БД, только в определенное время
                        $item->setAttribute('value',
                            $this->getDb($dbQueries->db_name)->createCommand($dbQueries->db_query)->queryScalar());
                        $item->setAttribute('db_error', null);
                        $item->setAttribute('time', new Expression('current_timestamp'));
                    } else {
                        $item->setAttribute('value', null);
                        $item->setAttribute('db_error', null);
                        $item->setAttribute('time', null);
                    }
                } catch (\yii\db\Exception $e) {
                    // Error in users SQL-query
                    $item->setAttribute('value', null);
                    $item->setAttribute('db_error', substr($e->getMessage(),0,4000));
                    $item->setAttribute('time', new Expression('current_timestamp'));
                }
                $item->update();
            }
        }
        $this->setData();
        $this->logAlerts();
        $this->sendAlerts();
        return 'all update';
    }

    /**
     * Put monitoring data to attributes
     */
    public function setData()
    {
        $this->items=$this->getItems();
        $this->checkItemsStatus($this->items);
        $this->groups=$this->getGroups();
        $this->checkGroupsStatus($this->items);
        $this->updateTimes=$this->findUpdateTime();
    }

    /**
     * Get monitoring items
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getItems()
    {
        return MonitorItems::find()->orderBy('item_name')->all();
    }

    /**
     * Get monitoring groups
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getGroups()
    {
        return MonitorGroups::find()->all();
    }

    /**
     * Check groups status. Use items statuses
     * @param $items
     */
    private function checkGroupsStatus($items) {
        foreach ( $items as $item ) {
            foreach ( ['warning','alert'] as $status ) {
                if ($item['status'] == $status) {
                    foreach ($this->groups as $group) {
                        if ($group['id'] == $item['monitor_groups_id']) {
                            $group->count[$status]++;
                            $group->status = ($group->status!='alert') ? $status : $group->status;
                        }
                    }
                }
            }
        }
    }

    /**
     * Check items for status (success,warning,alert)
     * @param $monitorItems
     */
    private function checkItemsStatus($monitorItems)
    {
        foreach ($monitorItems as $monitorItem) {
            $monitorItem->status='success';
            if (
                ( $monitorItem['warning_operator'] == '>' and $monitorItem['value'] > $monitorItem['warning_value'] )
                or ( $monitorItem['warning_operator'] == '<' and $monitorItem['value'] < $monitorItem['warning_value'] )
                or ( $monitorItem['warning_operator'] == '=' and $monitorItem['value'] == $monitorItem['warning_value'] )
                or ( $monitorItem['warning_operator'] == '!=' and $monitorItem['value'] != $monitorItem['warning_value'] )
            ) {
                $monitorItem->status='warning';
                $monitorItem->condition=$monitorItem['warning_operator'].$monitorItem['warning_value'];
            }

            if (
                ( $monitorItem['alert_operator'] == '>' and $monitorItem['value'] > $monitorItem['alert_value'] )
                or ( $monitorItem['alert_operator'] == '<' and $monitorItem['value'] < $monitorItem['alert_value'] )
                or ( $monitorItem['alert_operator'] == '=' and $monitorItem['value'] == $monitorItem['alert_value'] )
                or ( $monitorItem['alert_operator'] == '!=' and $monitorItem['value'] != $monitorItem['alert_value'] )
            ) {
                $monitorItem->status='alert';
                $monitorItem->condition=$monitorItem['alert_operator'].$monitorItem['alert_value'];
            }

            if ( !is_null($monitorItem['db_error']) )
            {
                $monitorItem->status='alert';
                $monitorItem->condition=$monitorItem['db_error'];
            }

            if (is_null($monitorItem['time'])) {
                $monitorItem->status='inactive';
                $monitorItem->condition=Yii::t('translation', 'inactive');
            }
        }
    }

    /**
     * Find update times (max and min)
     * @param $monitorItems
     * @return array
     */
    public function findUpdateTime()
    {
        $times=[];
        $updateTime=['min'=>null,'max'=>null,'lastUpdateMinutes'=>null];
        foreach (MonitorItems::find()->where('time is not null')->all() as $item) {
            $times[]=$item['time'];
        }
        if(count($times)>0) {
            $updateTime['min'] = min($times);
            $updateTime['max'] = max($times);
            $updateTime['lastUpdateMinutes'] = floor((time() - strtotime($updateTime['max'])) / 60); // minutes after last update
        }
        return $updateTime;
    }

    /**
     * Log of alert events
     * @throws \Exception
     * @throws \Throwable
     */
    private function logAlerts() {
        foreach ($this->items as $item) {
            /* log alert 1 time in hour about 1 event */
            if (
                (
                    $item->status=='alert'
                    and AlertLog::find()
                        ->where(['monitor_items_id'=>$item->id,'status'=>$item->status])
                        ->andWhere('current_timestamp < `time` + interval 1 hour')
                        ->count()==0
                ) or (
                    $item->status=='warning'
                    and AlertLog::find()
                        ->where(['monitor_items_id'=>$item->ID])
                        ->andWhere('current_timestamp < `time` + interval 1 hour')
                        ->count()==0
                )
            ) {
                $alertLog = new AlertLog();
                $alertLog->monitor_items_id=$item->id;
                $alertLog->status=$item->status;
                $alertLog->time=new Expression('current_timestamp');
                $alertLog->item_value=$item->getAttribute('value');
                $alertLog->insert();
            };
        }
    }

    /**
     * Send emails by alert events
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    private function sendAlerts() {
        $send=[];
        foreach (AlertLog::find()
                     ->where(['email_send'=>null])
                     ->andWhere('current_timestamp < `time` + interval 2 hour')
                     ->all() as $log)
        {
            foreach (AlertEmails::find()->all() as $email) {
                if ( ($log->status=='alert' or $log->status=='warning')
                    and (is_null($email->monitor_items_id)
                        or $email->monitor_items_id==$log->monitor_items_id)
                    and (is_null($email->monitor_groups_id)
                        or $email->monitor_groups_id==$log->monitorItem->monitorGroup->id) )
                {
                    if (!isset($send[$email->email])) {
                        $send[$email->email]=[];
                    }
                    $send[$email->email]['body'][]=$log->time.' '.$log->status.'! '
                        .$log->monitorItem->item_name.':'.$log->item_value;
                    $send[$email->email]['id'][]=$log->id;
                }
            }
        }
        foreach ($send as $email=>$data) {
            if ( Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['mail']['username'])
                ->setTo($email)
                ->setSubject('aMonitor Alert')
                ->setTextBody('Something wrong with your items:' . implode(',\n ', $data['body']))
                ->setHtmlBody('<p>Something wrong with items:<br>' . implode('<br>', $data['body']) . '</p>')
                ->send() )
            {
                $logs=AlertLog::find()->where(['in','id',$data['id']])->all();
                foreach ($logs as $log) {
                    $log->email_send.=$email . ' ';
                    $log->update();
                }
            }
        }
    }
}
