<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Staff".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $rocket_chat_id
 * @property string|null $email
 * @property string|null $date_birthday
 * @property string|null $date_start_work
 * @property int|null $departament
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_birthday', 'date_start_work'], 'safe'],
            [['departament'], 'default', 'value' => null],
            [['departament'], 'integer'],
            [['username', 'rocket_chat_id', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'rocket_chat_id' => 'Rocket Chat ID',
            'email' => 'Email',
            'date_birthday' => 'Date Birthday',
            'date_start_work' => 'Date Start Work',
            'departament' => 'Departament',
        ];
    }
}
