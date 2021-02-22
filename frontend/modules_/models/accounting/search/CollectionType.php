<?php

namespace frontend\modules\models\accounting\search;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use frontend\modules\models\accounting\CollectionType as CollectionTypeModel;

/**
 * CollectionType represents the model behind the search form of `frontend\modules\models\CollectionType`.
 */
class CollectionType extends CollectionTypeModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fund_id'], 'integer'],
            [['collection_code', 'uacs', 'subject_code', 'uacs_desc', 'collection_name'], 'safe'],
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
        $query = CollectionTypeModel::find();

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

        $query->andFilterWhere(['like', 'collection_code', $this->collection_code])
            ->andFilterWhere(['like', 'uacs', $this->uacs])
            ->andFilterWhere(['like', 'subject_code', $this->subject_code])
            ->andFilterWhere(['like', 'uacs_desc', $this->uacs_desc])
            ->andFilterWhere(['like', 'collection_name', $this->collection_name]);

        return $dataProvider;
    }
    
    public function searchCollection($params)
    {
        $query = CollectionTypeModel::find();
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

        $query->andFilterWhere(['like', 'collection_code', $this->collection_code]);

        return $dataProvider;
    }
    
    public function getAll()
    {
        $query = CollectionTypeModel::find()->all();
        //$result = ArrayHelper::map($get, 'id', 'collection_name');
        return $query;
    }
    
    public function getType($id)
    {
        $query = CollectionTypeModel::find();
        $query->where(['id' => $id]);
        return $query->one();
    }
    
    public function getDetailsById($id)
    {
        $query = CollectionTypeModel::find();
        $query->where(['id' => $id]);
        
        return $query->one();
    }
    
}
