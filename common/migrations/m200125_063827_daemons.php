<?php

use yii\db\Migration;

/**
 * Class m200125_063827_daemons
 */
class m200125_063827_daemons extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200125_063827_daemons cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200125_063827_daemons cannot be reverted.\n";

        return false;
    }
    */
}
