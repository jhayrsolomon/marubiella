<?php

namespace frontend\modules\models\cashier\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\cashier\Payment as PaymentModel;

/**
 * Payment represents the model behind the search form of `frontend\modules\models\cashier\Payment`.
 */
class Payment extends PaymentModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'division_id', 'fund_id', 'fund_type_id', 'customer_id', 'payment_type_id'], 'integer'],
            [['or_number', 'created_date', 'timestamp', 'remarks'], 'safe'],
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
        $query = PaymentModel::find();

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
            'division_id' => $this->division_id,
            'fund_id' => $this->fund_id,
            'fund_type_id' => $this->fund_type_id,
            'customer_id' => $this->customer_id,
            'payment_type_id' => $this->payment_type_id,
            'total_amount' => $this->total_amount,
            'created_date' => $this->created_date,
            'timestamp' => $this->timestamp,
            'status_code' => $this->status_code,
        ]);

        $query->andFilterWhere(['like', 'or_number', $this->or_number])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
