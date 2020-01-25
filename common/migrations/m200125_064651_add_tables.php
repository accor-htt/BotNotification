<?php

use yii\db\Migration;

/**
 * Class m200125_064651_add_tables
 */
class m200125_064651_add_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Channels', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200125_064651_add_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200125_064651_add_tables cannot be reverted.\n";

        return false;
    }
    */
}
