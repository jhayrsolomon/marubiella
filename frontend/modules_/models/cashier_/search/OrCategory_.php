<?php

namespace frontend\modules\models\cashier\search;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use frontend\modules\models\cashier\OrCategory as OrCategoryModel;

/**
 * OrCategory represents the model behind the search form of `frontend\modules\models\OrCategory`.
 */
class OrCategory extends OrCategoryModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fund_id'], 'integer'],
            [['category'], 'safe'],
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
        $query = OrCategoryModel::find();

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

        $query->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
    
    public function getAll()
    {
        $get = OrCategoryModel::find()->all();
        $result = ArrayHelper::map($get, 'id', 'category');
        return $result;
    }
}
