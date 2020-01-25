<?php

use yii\db\Migration;

/**
 * Class m200125_045618_add_column_in_staff
 */
class m200125_045618_add_column_in_staff extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('Staff', 'jira_nickname', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200125_045618_add_column_in_staff cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200125_045618_add_column_in_staff cannot be reverted.\n";

        return false;
    }
    */
}
