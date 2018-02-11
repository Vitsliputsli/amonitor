<?php

use yii\db\Migration;

/**
 * Class m171109_151519_create_table_monitor_items
 */
class m171109_151519_create_table_monitor_items extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('monitor_items',[
            'id'=>$this->primaryKey(),
            'monitor_groups_id'=>$this->integer()->notNull(),
            'item_name'=>$this->string(1000)->comment('Monitoring items name'),
            'warning_operator'=>$this->string(50)->comment('Warning. Compare operator for value'),
            'warning_value'=>$this->string(100)->comment('Warning. Value'),
            'alert_operator'=>$this->string(50)->comment('Alert. Compare operator for value'),
            'alert_value'=>$this->string(100)->comment('Alert. Value'),
            'value'=>$this->string(100)->comment('Monitoring items value'),
            'db_error'=>$this->string(1000)->comment('Database error'),
            'time'=>$this->timestamp()->comment('Item update time'),
            'work_interval'=>$this->string(11)->comment('Items work interval (example 8:00-18:00)'),
            'work_days'=>$this->string(100)->comment('Items work days (example fri,13)'),
            'active'=>$this->boolean()->defaultValue(1)->comment('Item is active or inactive')
        ]);
        $this->addForeignKey('fk_monitor_items_monitor_group', 'monitor_items','monitor_groups_id','monitor_groups','id', 'cascade');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('monitor_items');
    }

}
