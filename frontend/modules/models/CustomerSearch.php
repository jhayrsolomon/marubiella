<?php

namespace frontend\modules\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\Customer;

/**
 * CustomerSearch represents the model behind the search form of `frontend\modules\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_type_id', 'barangay_id', 'municipality_id', 'province_id', 'region_id', 'customer_status_id', 'is_active'], 'integer'],
            [['customer_code', 'customer_firstname', 'customer_middlename', 'customer_lastname', 'prefix_address', 'landmark', 'date_created', 'date_updated', 'date_deleted'], 'safe'],
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
        $query = Customer::find();

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
            'customer_type_id' => $this->customer_type_id,
            'barangay_id' => $this->barangay_id,
            'municipality_id' => $this->municipality_id,
            'province_id' => $this->province_id,
            'region_id' => $this->region_id,
            'customer_status_id' => $this->customer_status_id,
            'is_active' => $this->is_active,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'date_deleted' => $this->date_deleted,
        ]);

        $query->andFilterWhere(['like', 'customer_code', $this->customer_code])
            ->andFilterWhere(['like', 'customer_firstname', $this->customer_firstname])
            ->andFilterWhere(['like', 'customer_middlename', $this->customer_middlename])
            ->andFilterWhere(['like', 'customer_lastname', $this->customer_lastname])
            ->andFilterWhere(['like', 'prefix_address', $this->prefix_address])
            ->andFilterWhere(['like', 'landmark', $this->landmark]);

        return $dataProvider;
    }
}
