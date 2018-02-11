<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "db_queries".
 * @package app\models
 */
class DbQueries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'db_queries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['db_query','db_name','monitor_items_id'], 'required'],
            [['id', 'monitor_items_id'], 'integer'],
            [['db_query'], 'string', 'max' => 4000],
            [['db_name'], 'string', 'max' => 100],
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
            'monitor_items_id' => Yii::t('translation', 'Monitor Item'),
            'db_query' => Yii::t('translation', 'Db Query'),
            'db_name' => Yii::t('translation', 'Db Name'),
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
