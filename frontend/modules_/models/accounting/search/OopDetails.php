<?php

namespace frontend\modules\models\accounting\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\accounting\OopDetails as OopDetailsModel;

/**
 * OopDetails represents the model behind the search form of `frontend\modules\models\OopDetails`.
 */
class OopDetails extends OopDetailsModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'op_id', 'request_id', 'division_id', 'status_id'], 'integer'],
            [['amount', 'balance'], 'number'],
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
        $query = OopDetailsModel::find();

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
            'request_id' => $this->request_id,
            'division_id' => $this->division_id,
            'amount' => $this->amount,
            'balance' => $this->balance,
            'status_id' => $this->status_id,
        ]);

        return $dataProvider;
    }
    
    //get all records by OOP ID 
    public function searchDetailsByOopId($oopId)
    {
        $query = OopDetailsModel::find();
        //$query->with('request');
        //$query->with('status');

        $query->where(["op_id" => $oopId]);
    
        $details = $query->all();

        return $details;
    }
    
    public function getDetailsByOopId($id)
    {
        $query = OopDetailsModel::find();
        $query->where(['op_id' => $id]);
        
        return $query->all();
    }
    
    public function getByOopId($id)
    {
        $query = OopDetailsModel::find();
        $query->where(['op_id' => $id]);
        
        return $query->one();
    }
    
    public function getDetailsById($id)
    {
        $query = OopDetailsModel::find();
        $query->where(['op_id' => $id]);
        
        return $query->all();
    }
}
