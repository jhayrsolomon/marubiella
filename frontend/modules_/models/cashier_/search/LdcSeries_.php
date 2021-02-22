<?php

namespace frontend\modules\models\cashier\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\cashier\LdcSeries as LdcSeriesModel;

/**
 * LdcSeries represents the model behind the search form of `frontend\modules\models\LdcSeries`.
 */
class LdcSeries extends LdcSeriesModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'receipt_id', 'fund_id'], 'integer'],
            [['ldc_code'], 'safe'],
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
        $query = LdcSeriesModel::find();

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
            'receipt_id' => $this->receipt_id,
            'fund_id' => $this->fund_id,
        ]);

        $query->andFilterWhere(['like', 'ldc_code', $this->ldc_code]);

        return $dataProvider;
    }
    
    public function generateLdcNumber($id)
    {
        $count = LdcSeriesModel::find()
            ->where(['fund_id' => $id])
            ->andWhere(['like', 'ldc_code', date('Y')])
            ->count();
        
        $series = (int)$count + 1;
        $length = strlen($count);
        if($id == 1){
            $code = 'GF';
        }
        if($id == 2){
            $code = 'TF';
        }
        if($id == 3){
            $code = 'TRAINING';
        }
        if($length == 1){
            $ldc_series = date('Y').'-000'.$series.'-'.$code;
        }
        if($length == 2){
            $ldc_series = date('Y').'-00'.$series.'-'.$code;
        }
        if($length == 3){
            $ldc_series = date('Y').'-0'.$series.'-'.$code;
        }
        if($length >= 4){
            $ldc_series = date('Y').'-'.$series.'-'.$code;
        }
        
        return $ldc_series;
    }
}
