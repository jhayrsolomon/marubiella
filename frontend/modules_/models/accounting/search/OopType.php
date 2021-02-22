<?php

namespace frontend\modules\models\accounting\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\accounting\OopType as OopTypeModel;

/**
 * OopType represents the model behind the search form of `frontend\modules\models\OopType`.
 */
class OopType extends OopTypeModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type_code', 'description'], 'safe'],
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
        $query = OopTypeModel::find();

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

        $query->andFilterWhere(['like', 'type_code', $this->type_code])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
    
    public function getTypeByCode($code)
    {
        $query = OopTypeModel::find();
        $query->where(['type_code' => $code]);
        
        return $query->one();
    }
    
    public function getTypeById($id)
    {
        $query = OopTypeModel::find();
        $query->where(['id' => $id]);
        
        return $query->one();
    }
}
