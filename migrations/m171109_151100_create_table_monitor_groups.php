<?php

use yii\db\Migration;

/**
 * Class m171109_151100_create_table_monitor_groups
 */
class m171109_151100_create_table_monitor_groups extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('monitor_groups',[
            'id'=>$this->primaryKey(),
            'group_name'=>$this->string(1000)->comment('Monitoring group name'),
            'active'=>$this->boolean()->defaultValue(1)->comment('Group is active or inactive')
        ]);
        $this->insert('monitor_groups', ['group_name'=>null]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('monitor_groups');
    }

}
