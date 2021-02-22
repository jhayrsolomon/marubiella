<?php

namespace frontend\modules\models\agency\search;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use frontend\modules\models\agency\Division as DivisionModel;

/**
 * Division represents the model behind the search form of `frontend\modules\models\Division`.
 */
class Division extends DivisionModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'name'], 'safe'],
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
        $query = DivisionModel::find();

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

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
    
    //For Array Map
    public function getAll()
    {
        $get = DivisionModel::find()->all();
        $result = ArrayHelper::map($get, 'id', 'code');
        return $result;
    }
    
    public function getDivisionByCode($code)
    {
        $query = DivisionModel::find();
        $query->where(['code' => $code]);
        
        return $query->one();
    }
    
    public function getDivisionById($id)
    {
        $query = DivisionModel::find();
        $query->where(['id' => $id]);
        
        return $query->one();
    }
    
    public function getAllDivisionDetails()
    {
        $query = DivisionModel::find();
        
        return $query->all();
    }
}
