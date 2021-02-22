<?php

namespace frontend\modules\models\cashier\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\cashier\Receipt as ReceiptModel;

/**
 * Receipt represents the model behind the search form of `frontend\modules\models\Receipt`.
 */
class Receipt extends ReceiptModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'op_id', 'mode_of_payment_id', 'status_id'], 'integer'],
            [['or_num', 'date', 'created_date'], 'safe'],
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
        $query = ReceiptModel::find();

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
            'op_id' => $this->op_id,
            'mode_of_payment_id' => $this->mode_of_payment_id,
            'date' => $this->date,
            'created_date' => $this->created_date,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'or_num', $this->or_num]);

        return $dataProvider;
    }
    
    public function getCountOr()
    {
        $query = ReceiptModel::find();
        $query->where(['status_id' => 1]);
        $count = $query->count();
        
        $or = $count+1;
        
        return $or;
    }
}
