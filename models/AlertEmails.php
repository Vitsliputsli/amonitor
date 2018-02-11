<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alert_emails".
 * @package app\models
 */
class AlertEmails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alert_emails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['id', 'monitor_items_id', 'monitor_groups_id'], 'integer'],
            [['email'], 'string', 'max' => 1000],
            [['id'], 'unique'],
            [['monitor_items_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => MonitorItems::className(),
                'targetAttribute' => ['monitor_items_id' => 'id']],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MONITOR_ITEMS_ID' => Yii::t('translation','Monitor Item'),
            'MONITOR_GROUPS_ID' => Yii::t('translation','Monitor Group'),
            'EMAIL' => Yii::t('translation','Email'),
        ];
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
    public function getMonitorItem()
    {
        return $this->hasOne(MonitorItems::className(), ['id' => 'monitor_items_id']);
    }

}
