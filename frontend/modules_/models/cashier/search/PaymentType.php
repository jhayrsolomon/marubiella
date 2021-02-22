<?php

namespace frontend\modules\models\cashier\search;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use frontend\modules\models\cashier\PaymentType as PaymentTypeModel;

/**
 * PaymentType represents the model behind the search form of `frontend\modules\models\cashier\PaymentType`.
 */
class PaymentType extends PaymentTypeModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type_code', 'description', 'action'], 'safe'],
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
        $query = PaymentTypeModel::find();

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
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'action', $this->action]);

        return $dataProvider;
    }
    
    public function getTypeByCode($code)
    {
        $query = PaymentTypeModel::find();
        $query->where(['type_code' => $code]);
        
        return $query->one();
    }
    
    public function getTypeById($id)
    {
        $query = PaymentTypeModel::find();
        $query->where(['id' => $id]);
        
        return $query->one();
    }
    
    public function getAll()
    {
        $get = PaymentTypeModel::find()->all();
        $result = ArrayHelper::map($get, 'id', 'description');
        return $result;
    }
}
