<?php

use yii\db\Migration;

/**
 * Class m171116_122339_create_table_alert_log
 */
class m171116_122339_create_table_alert_log extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('alert_log',[
            'id'=>$this->primaryKey(),
            'monitor_items_id'=>$this->integer(),
            'time'=>$this->timestamp()->comment('Item alert time'),
            'status'=>$this->string(100)->comment('Type of alert (warning, alert)'),
            'item_value'=>$this->string(100)->comment('Items value'),
            'email_send'=>$this->string(1000)->comment('Flag email send'),
        ]);
        $this->addForeignKey('fk_alert_log_monitor_items', 'alert_log','monitor_items_id','monitor_items','id', 'cascade');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('alert_log');
    }

}
