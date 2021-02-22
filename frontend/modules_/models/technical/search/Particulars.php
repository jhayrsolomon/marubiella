<?php

namespace frontend\modules\models\technical\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\technical\Particulars as ParticularsModel;

/**
 * ParticularsSearch represents the model behind the search form of `frontend\modules\models\technical\Particulars`.
 */
class Particulars extends ParticularsModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'request_id'], 'integer'],
            [['code', 'description'], 'safe'],
            [['amount'], 'number'],
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
        $query = ParticularsModel::find();

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
            'request_id' => $this->request_id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
    
    public function getAllByRequestId($id)
    {
        $query = ParticularsModel::find();
        $query->where(['request_id' => $id]);
        
        return $query->all();
    }
    
    public function getParticularsByRequestId($id)
    {
        $query = ParticularsModel::find();
        $query->where(['request_id' => $id]);
        
        return $query->one();
    }
}
