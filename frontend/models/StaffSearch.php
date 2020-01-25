<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Staff;

/**
 * StaffSearch represents the model behind the search form of `app\models\Staff`.
 */
class StaffSearch extends Staff
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'departament'], 'integer'],
            [['username', 'rocket_chat_id', 'email', 'date_birthday', 'date_start_work'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Staff::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_birthday' => $this->date_birthday,
            'date_start_work' => $this->date_start_work,
            'departament' => $this->departament,
        ]);

        $query->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'rocket_chat_id', $this->rocket_chat_id])
            ->andFilterWhere(['ilike', 'email', $this->email]);

        return $dataProvider;
    }
}
