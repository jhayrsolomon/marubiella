<?php

namespace frontend\modules\models\accounting\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\accounting\Service as ServiceModel;

/**
 * Service represents the model behind the search form of `frontend\modules\models\Service`.
 */
class Service extends ServiceModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fund_id'], 'integer'],
            [['service_code', 'service_title'], 'safe'],
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
        $query = ServiceModel::find();

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
            'fund_id' => $this->fund_id,
        ]);

        $query->andFilterWhere(['like', 'service_code', $this->service_code])
            ->andFilterWhere(['like', 'service_title', $this->service_title]);

        return $dataProvider;
    }
    
    public function searchService($params)
    {
        $query = ServiceModel::find();
        //$query->with('fund');

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
            'fund_id' => $this->fund_id,
        ]);

        $query->andFilterWhere(['like', 'service_code', $this->service_code])
            ->andFilterWhere(['like', 'service_title', $this->service_title]);

        return $dataProvider;
    }
    
    public function getAll()
    {
        $query = ServiceModel::find()->all();
        return $query;
    }
    
    public function getType($id)
    {
        $query = ServiceModel::find();
        $query->where(['id' => $id]);
        return $query->one();
    }
    
    public function getDetailsById($id)
    {
        $query = ServiceModel::find();
        $query->where(['id' => $id]);
        
        return $query->one();
    }
}
