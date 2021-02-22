<?php

namespace frontend\modules\models\technical\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\technical\Request as RequestModel;

/**
 * RequestSearch represents the model behind the search form of `frontend\modules\models\technical\Request`.
 */
class Request extends RequestModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'div_id', 'status_id'], 'integer'],
            [['reference_number', 'request_date', 'due_date', 'created_date', 'remarks'], 'safe'],
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
        $query = RequestModel::find();

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
            'status_id' => $this->status_id,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'reference_number', $this->reference_number])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function searchRequestByCustomerId($id)
    {
        $query = RequestModel::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $query->where([
            'customer_id' => $id,
            'status_id' => 3,
        ]);
        
        return $dataProvider;
    }
    
    public function getRequestById(array $reqId)
    {
        $query = RequestModel::find();
        
        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);*/
        
        $query->where(['in', 'id', $reqId]);
        
        //return $dataProvider;
        return $query->all();
    }
}
