<?php

use yii\db\Migration;

/**
 * Class m171109_153547_create_table_db_queries
 */
class m171109_153547_create_table_db_queries extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('db_queries',[
            'id'=>$this->primaryKey(),
            'monitor_items_id'=>$this->integer()->notNull(),
            'db_query'=>$this->string(4000)->comment('Database query. Get item for monitoring'),
            'db_name'=>$this->string(100)->comment('Database name. Choose config for connect to DB-server'),
        ]);
        $this->addForeignKey('fk_db_queries_monitor_items', 'db_queries','monitor_items_id','monitor_items','id', 'cascade');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('db_queries');
    }
}
