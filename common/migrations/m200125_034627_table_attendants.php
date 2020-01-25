<?php

use yii\db\Migration;

/**
 * Class m200125_034627_table_attendants
 */
class m200125_034627_table_attendants extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Attendants', [
            'date' => $this->dateTime(),
            'staff' => 'integer[]'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('Attendants');

//        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200125_034627_table_attendants cannot be reverted.\n";

        return false;
    }
    */
}
