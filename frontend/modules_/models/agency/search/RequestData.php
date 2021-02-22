<?php

namespace frontend\modules\models\agency\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\agency\RequestData as RequestDataModel;

/**
 * RequestData represents the model behind the search form of `frontend\modules\models\agency\RequestData`.
 */
class RequestData extends RequestDataModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'type_code', 'model'], 'safe'],
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
        $query = RequestDataModel::find();

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
            ->andFilterWhere(['like', 'type_code', $this->type_code])
            ->andFilterWhere(['like', 'model', $this->model]);

        return $dataProvider;
    }
    
    public function getModelByTypeCodeDivisionCode($code, $type_code)
    {
        $query = RequestDataModel::find();
        $query->where(['code' => $code]);
        $query->andWhere(['type_code' => $type_code]);
        return $query->one();        
    }
}
