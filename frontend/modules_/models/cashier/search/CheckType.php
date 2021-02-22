<?php

namespace frontend\modules\models\cashier\search;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use frontend\modules\models\cashier\CheckType as CheckTypeModel;

/**
 * CheckType represents the model behind the search form of `frontend\modules\models\cashier\CheckType`.
 */
class CheckType extends CheckTypeModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['check_code', 'description'], 'safe'],
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
        $query = CheckTypeModel::find();

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

        $query->andFilterWhere(['like', 'check_code', $this->check_code])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
    
    public function getAll()
    {
        $get = CheckTypeModel::find()->all();
        $result = ArrayHelper::map($get, 'id', 'check_code');
        return $result;
    }
    
    public function getType()
    {
        $get = CheckTypeModel::find()->all();
        //$result = ArrayHelper::map($get, 'id', 'check_code');
        return $get;
    }
}
