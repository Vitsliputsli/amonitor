<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monitor_items".
 * @package app\models
 */
class MonitorItems extends \yii\db\ActiveRecord
{
    /**
     * @var string $status - monitoring items status (success,warning,danger)
     * @var string $condition - monitoring items status condition (reason for item has the status)
     */
    public $status='';
    public $condition;
    public $activity;
    public $work_interval_start;
    public $work_interval_end;
    public $workDays=[];
    private $dayOfWeek=['sun','mon','tue','wed','thu','fri','sat'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monitor_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','monitor_groups_id'], 'integer'],
            [['item_name'], 'required'],
            [['item_name', 'warning_value', 'db_error'], 'string', 'max' => 1000],
            [['warning_value', 'alert_value', 'value'], 'string', 'max' => 100],
            [['warning_operator', 'alert_operator'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['work_interval'], 'string', 'max'=>11],
            [['work_interval_start'], 'string', 'max'=>5],
            [['work_interval_end'], 'string', 'max'=>5],
            [['work_days'], 'string', 'max'=>100],
            [['active'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'monitor_groups_id' => Yii::t('translation', 'Group'),
            'item_name' => Yii::t('translation', 'Item Name'),
            'warning_value' => Yii::t('translation', 'Warning Value'),
            'warning_operator' => Yii::t('translation', 'Warning Operator'),
            'alert_value' => Yii::t('translation', 'Alert Value'),
            'alert_operator' => Yii::t('translation', 'Alert Operator'),
            'value' => Yii::t('translation', 'Monitoring items value'),
            'db_error' => Yii::t('translation', 'Database error'),
            'time' => Yii::t('translation', 'Item update time'),
            'work_interval' => Yii::t('translation', 'Work interval'),
            'work_days' => Yii::t('translation', 'Days'),
            'active' => Yii::t('translation', 'Active'),
        ];
    }

    /**
     *
     * @return bool
     */
    public function beforeValidate()
    {
        $this->setAttribute('work_interval',$this->work_interval_start . '-' . $this->work_interval_end);
        if(!$this->workDaysData()) {
            $this->addError('work_days',
                Yii::t('translation',
                    'Incorrect format. You may use numbers from 1 to 31 for days of month and sun,tue,wed,thu,fri,sat for days of week, with comma separated. Example: "fri,3"'
                ));
        } else {
            sort($this->workDays['days']);
            $this->setAttribute('work_days',
                implode(',',array_merge($this->workDays['days'],$this->workDays['daysofweek'])));
        };
        return parent::beforeValidate();
    }

    /**
     *
     */
    public function afterFind()
    {
        $this->work_interval_start = substr($this->getAttribute('work_interval'),0,5);
        $this->work_interval_end = substr($this->getAttribute('work_interval'),6,5);
        if($this->workDaysData()) {
            $workDays = $this->workDays['days'];
            foreach ($this->workDays['daysofweek'] as $day) {
                $workDays[] = Yii::t('translation-daysofweek', $day);
            }
            $this->setAttribute('work_days', implode(',',array_merge($workDays)));
        }
        if (
            (
                is_null($this->getAttribute('WORK_INTERVAL'))
                or ($this->work_interval_start < $this->work_interval_end
                    and strtotime($this->work_interval_start)<=time()
                    and strtotime($this->work_interval_end)+60>time())
                or ($this->work_interval_start > $this->work_interval_end
                    and (strtotime($this->work_interval_start)<=time()
                    or strtotime($this->work_interval_end)+60>time()))
            ) and (
                (in_array(date('j'),$this->workDays['days']) or empty($this->workDays['days']))
                and (in_array(mb_strtolower(date('D')),$this->workDays['daysofweek'])
                    or empty($this->workDays['daysofweek']))
            )
        )
        {
            $this->activity=true;
        } else {
            $this->activity=false;
        }
        return parent::afterFind();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitorGroup()
    {
        return $this->hasOne(MonitorGroups::className(), ['id' => 'monitor_groups_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDbQuery()
    {
        return $this->hasOne(DbQueries::className(), ['monitor_items_id' => 'id']);
    }

    /**
     * @return bool
     */
    private function workDaysData()
    {
        $this->workDays=['days'=>[],'daysofweek'=>[]];
        $data = explode(',',$this->getAttribute('work_days'));
        foreach ($data as $day) {
            $day = trim($day);
            if(is_numeric($day)) {
                // number - number day of month
                if ((int)$day<1 or (int)$day>31 or (int)ceil($day)!==(int)$day) {
                    return false;
                }
                $this->workDays['days'][] = $day;
            } else {
                if (!empty($day)) {
                    // string - day of week
                    $dayOriginalName = Yii::t('reverse-daysofweek', mb_strtolower($day));
                    if (is_numeric(array_search($dayOriginalName, $this->dayOfWeek))) {
                        $this->workDays['daysofweek'][] = $dayOriginalName;
                    } else {
                        return false;
                    }
                }
            }
        }
        return true;
    }

}
