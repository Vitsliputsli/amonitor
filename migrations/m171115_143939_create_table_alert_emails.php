<?php

use yii\db\Migration;

/**
 * Class m171115_143939_create_table_alert_emails
 */
class m171115_143939_create_table_alert_emails extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('alert_emails',[
            'id'=>$this->primaryKey(),
            'monitor_items_id'=>$this->integer(),
            'monitor_groups_id'=>$this->integer(),
            'email'=>$this->string(1000)->comment('Email for send when items alert'),
        ]);
        $this->addForeignKey('fk_alert_emails_monitor_items', 'alert_emails','monitor_items_id','monitor_items','id', 'cascade');
        $this->addForeignKey('fk_alert_emails_monitor_group', 'alert_emails','monitor_groups_id','monitor_groups','id', 'cascade');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('alert_emails');
    }

}
