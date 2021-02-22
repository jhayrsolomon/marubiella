<?php

namespace frontend\modules\models\portal\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\portal\EPayment as EPaymentModel;

/**
 * EPayment represents the model behind the search form of `frontend\modules\models\portal\EPayment`.
 */
class EPayment extends EPaymentModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_id'], 'integer'],
            [['merchant_code', 'merchant_reference_number', 'particulars', 'transaction_type', 'created_date', 'timestamp'], 'safe'],
            [['total_amount'], 'number'],
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
        $query = EPaymentModel::find();

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
            'total_amount' => $this->total_amount,
            'status_id' => $this->status_id,
            'created_date' => $this->created_date,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'merchant_code', $this->merchant_code])
            ->andFilterWhere(['like', 'merchant_reference_number', $this->merchant_reference_number])
            ->andFilterWhere(['like', 'particulars', $this->particulars])
            ->andFilterWhere(['like', 'transaction_type', $this->transaction_type]);

        return $dataProvider;
    }
    
    public function getDetailsByMRN($mrn)
    {
        $query = EPaymentModel::find()
            ->where(['merchant_reference_number' => $mrn])
            ->one();
        
        return $query;
    }
}
