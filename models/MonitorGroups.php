<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monitor_groups".
 * @package app\models
 */
class MonitorGroups extends \yii\db\ActiveRecord
{
    /**
     * @var string $status - monitoring items status (success,warning,danger)
     * @var array $count - count of monitoring items
     */
    public $status='success';
    public $count=['warning'=>0,'alert'=>0];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monitor_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['group_name'], 'required'],
            [['group_name'], 'string', 'max' => 1000],
            [['id'], 'unique'],
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
            'group_name' => Yii::t('translation', 'Group Name'),
            'active' => Yii::t('translation', 'Active'),
        ];
    }
}
