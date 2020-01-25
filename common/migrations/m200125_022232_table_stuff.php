<?php

use yii\db\Migration;

class m200125_022232_table_stuff extends Migration
{
    public function safeUp()
    {
        $this->createTable('Staff', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'rocket_chat_id' => $this->string(),
            'email' => $this->string(),
            'date_birthday' => $this->dateTime(),
            'date_start_work' => $this->dateTime(),
            'departament' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200125_022232_table_stuff cannot be reverted.\n";

        return false;
    }
}
