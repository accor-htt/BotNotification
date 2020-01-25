<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "TimeDaemons".
 *
 * @property string|null $name
 * @property int|null $last_time_work
 */
class TimeDaemons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TimeDaemons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_time_work'], 'default', 'value' => null],
            [['last_time_work'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'last_time_work' => 'Last Time Work',
        ];
    }
}
