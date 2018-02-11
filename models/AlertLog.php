<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alert_log".
 * @package app\models
 */
class AlertLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alert_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'monitor_items_id'], 'integer'],
            [['time','email_send'], 'safe'],
            [['status'], 'string', 'max' => 100],
            [['item_value'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['monitor_items_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => MonitorItems::className(),
                'targetAttribute' => ['monitor_items_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'monitor_items_id' => Yii::t('translation','Monitor Item'),
            'time' => Yii::t('translation','Time'),
            'status' => Yii::t('translation','Alert Type'),
            'item_value' => Yii::t('translation','Item Value'),
            'email_send' => Yii::t('translation','Alert has sended to emails'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitorItem()
    {
        return $this->hasOne(MonitorItems::className(), ['id' => 'monitor_items_id']);
    }

}
