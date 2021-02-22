<?php

namespace frontend\modules\models\technical;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\technical\Request;

/**
 * RequestSearch represents the model behind the search form of `frontend\modules\models\technical\Request`.
 */
class RequestSearch extends Request
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reference_number', 'customer_id', 'div_id'], 'safe'],
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
        $query = Request::find();

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
            'request_date' => $this->request_date,
            'due_date' => $this->due_date,
            'total_amount' => $this->total_amount,
            'customer_id' => $this->customer_id,
            'div_id' => $this->div_id,
            'fund_id' => $this->fund_id,
            'type_id' => $this->type_id,
            'status_id' => $this->status_id,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'reference_number', $this->reference_number]);

        return $dataProvider;
    }
    
    public function searchRequest($params)
    {
        $query = Request::find();
        $query->with('status');
        $query->with('customerdetails');

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

        return $dataProvider;
    }
}
