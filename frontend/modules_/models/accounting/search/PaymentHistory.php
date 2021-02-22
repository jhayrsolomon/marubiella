<?php

namespace frontend\modules\models\accounting\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\accounting\PaymentHistory as PaymentHistoryModel;

/**
 * PaymentHistory represents the model behind the search form of `frontend\modules\models\accounting\PaymentHistory`.
 */
class PaymentHistory extends PaymentHistoryModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'details_id', 'receipt_id'], 'integer'],
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
        $query = PaymentHistoryModel::find();

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
            'details_id' => $this->details_id,
            'receipt_id' => $this->receipt_id,
        ]);

        return $dataProvider;
    }
}
