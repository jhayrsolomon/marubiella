<?php

namespace frontend\modules\models\accounting\search;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use frontend\modules\models\accounting\FundCluster as FundClusterModel;

/**
 * FundCluster represents the model behind the search form of `frontend\modules\models\FundCluster`.
 */
class FundCluster extends FundClusterModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fund_code', 'fund_name', 'description'], 'safe'],
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
        $query = FundClusterModel::find();

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
        ]);

        $query->andFilterWhere(['like', 'fund_code', $this->fund_code])
            ->andFilterWhere(['like', 'fund_name', $this->fund_name]);

        return $dataProvider;
    }
    
    public function getAll()
    {
        $get = FundClusterModel::find()->all();
        $result = ArrayHelper::map($get, 'id', 'fund_name');
        return $result;
    }
    
    public function getDetailsById($id)
    {
        $query = FundClusterModel::find();
        $query->where(['id' => $id]);
        
        return $query->one();
    }
    
    public function getAllFundDetails()
    {
        $query = FundClusterModel::find();
        
        return $query->all();
    }
    
    public function getDetailsByCode($code)
    {
        $query = FundClusterModel::find();
        $query->where(['fund_code' => $code]);
        
        return $query->one();
    }
    
}
