<?php

use yii\db\Migration;

/**
 * Class m200527_103543_add_new_otchet
 */
class m200527_103543_add_new_otchet extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('Staff', 'report_sigen_roy', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200527_103543_add_new_otchet cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_103543_add_new_otchet cannot be reverted.\n";

        return false;
    }
    */
}
