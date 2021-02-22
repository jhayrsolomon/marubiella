<?php

namespace frontend\modules\models\accounting\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\accounting\OopCollection as OopCollectionModel;

/**
 * OopCollection represents the model behind the search form of `frontend\modules\models\OopCollection`.
 */
class OopCollection extends OopCollectionModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'oop_details_id'], 'integer'],
            [['general_fund', 'trust_fund'], 'number'],
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
        $query = OopCollectionModel::find();

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
            'oop_details_id' => $this->oop_details_id,
            'general_fund' => $this->general_fund,
            'trust_fund' => $this->trust_fund,
        ]);

        return $dataProvider;
    }
    
    public function getDetailsById($id)
    {
        $query = OopCollectionModel::find();
        $query->where(['oop_details_id' => $id]);
        
        return $query->one();
    }
    
    public function getAllDetailsByOopDetailsId($id)
    {
        $query = OopCollectionModel::find();
        $query->where(['oop_details_id' => $id]);
        
        return $query->all();
    }
}
