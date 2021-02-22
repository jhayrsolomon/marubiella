<?php

namespace frontend\modules\models\agency\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\agency\Database as DatabaseModel;

/**
 * Database represents the model behind the search form of `frontend\modules\models\agency\Database`.
 */
class Database extends DatabaseModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'model'], 'safe'],
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
        $query = DatabaseModel::find();

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
            ->andFilterWhere(['like', 'model', $this->model]);

        return $dataProvider;
    }
    
    public function getModelByCode($code)
    {
        $query = DatabaseModel::find();
        $query->where(['code' => $code]);
        return $query->one();        
    }
}
