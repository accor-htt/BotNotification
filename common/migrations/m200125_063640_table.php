<?php

use yii\db\Migration;

class m200125_063640_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('TimeDaemons', [
            'name' => $this->string(),
            'last_time_work' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200125_063640_table cannot be reverted.\n";

        return false;
    }
    */
}
