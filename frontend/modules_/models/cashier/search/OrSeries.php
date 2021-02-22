<?php

namespace frontend\modules\models\cashier\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\cashier\OrSeries as OrSeriesModel;

/**
 * OrSeries represents the model behind the search form of `frontend\modules\models\cashier\OrSeries`.
 */
class OrSeries extends OrSeriesModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'status_id'], 'integer'],
            [['start_or', 'next_or', 'end_or'], 'safe'],
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
        $query = OrSeriesModel::find();

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
            'category_id' => $this->category_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'start_or', $this->start_or])
            ->andFilterWhere(['like', 'next_or', $this->next_or])
            ->andFilterWhere(['like', 'end_or', $this->end_or]);

        return $dataProvider;
    }
    
    public function getSeriesNumber($categoryId)
    {
        $query = OrSeriesModel::find()
            ->where(['category_id' => $categoryId])
            ->andWhere(['status_id' => 1])
            ->one();
        
        return $query;
    }
}
