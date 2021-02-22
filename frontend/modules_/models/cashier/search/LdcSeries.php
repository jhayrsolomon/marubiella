<?php

namespace frontend\modules\models\cashier\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\cashier\LdcSeries as LdcSeriesModel;

/**
 * LdcSeries represents the model behind the search form of `frontend\modules\models\cashier\LdcSeries`.
 */
class LdcSeries extends LdcSeriesModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'payment_id', 'fund_id'], 'integer'],
            [['ldc_code', 'ldc_date'], 'safe'],
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
            'payment_id' => $this->payment_id,
            'fund_id' => $this->fund_id,
            'ldc_date' => $this->ldc_date,
        ]);

        $query->andFilterWhere(['like', 'ldc_code', $this->ldc_code]);

        return $dataProvider;
    }
    
    public function generateLDCSeries($fundId)
    {
        $count = LdcSeriesModel::find()
            ->where(['fund_id' => $fundId])
            ->count();
        $infix = 'TF';
        if($fundId == 1){
            $infix = 'GF';
        }
        
        $length = strlen($count);
        $series = $count + 1;
        
        if($count == 0){
            $ldc = date('Y').'-'.date('m').'-'.$infix.'-000'.$series;
        } else {
            if($length == 1){
                $ldc = date('Y').'-'.date('m').'-'.$infix.'-000'.$series;
            }
            if($length == 2){
                $ldc = date('Y').'-'.date('m').'-'.$infix.'-00'.$series;
            }
            if($length == 3){
                $ldc = date('Y').'-'.date('m').'-'.$infix.'-0'.$series;
            }
            if($length >= 4){
                $ldc = date('Y').'-'.date('m').'-'.$infix.'-'.$series;
            }
        }
        
        return $ldc;
        
    }
    
    public function getLdcById($id)
    {
        $query = LdcSeriesModel::find();
        $query->where(['payment_id' => $id]);
        
        return $query->one();
    }
}
