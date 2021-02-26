<?php

namespace frontend\modules\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\SalesOnline;

/**
 * SalesOnlineSearch represents the model behind the search form of `frontend\modules\models\SalesOnline`.
 */
class SalesOnlineSearch extends SalesOnline
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'courier_id', 'employee_id', 'team_id', 'customer_id', 'customer_type_id', 'sales_status_id', 'csr_id', 'dispatcher_id', 'is_active'], 'integer'],
            [['sales_code', 'sales_tracking_number', 'care_of', 'osr_remark', 'page', 'csr_remark', 'dispatcher_remark', 'date_created', 'date_updated', 'date_deleted'], 'safe'],
            [['total_amount'], 'number'],
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
        $query = SalesOnline::find();

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
            'courier_id' => $this->courier_id,
            'employee_id' => $this->employee_id,
            'team_id' => $this->team_id,
            'customer_id' => $this->customer_id,
            'customer_type_id' => $this->customer_type_id,
            'total_amount' => $this->total_amount,
            'sales_status_id' => $this->sales_status_id,
            'csr_id' => $this->csr_id,
            'dispatcher_id' => $this->dispatcher_id,
            'is_active' => $this->is_active,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'date_deleted' => $this->date_deleted,
        ]);

        $query->andFilterWhere(['like', 'sales_code', $this->sales_code])
            ->andFilterWhere(['like', 'sales_tracking_number', $this->sales_tracking_number])
            ->andFilterWhere(['like', 'care_of', $this->care_of])
            ->andFilterWhere(['like', 'osr_remark', $this->osr_remark])
            ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'csr_remark', $this->csr_remark])
            ->andFilterWhere(['like', 'dispatcher_remark', $this->dispatcher_remark]);

        return $dataProvider;
    }
    
    public function searchUnavailableToday($params, $today)
    {
        $query = SalesOnline::find()->where(['like', 'date_created', $today])->andWhere(['sales_status_id'=>3]);

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
            'courier_id' => $this->courier_id,
            'employee_id' => $this->employee_id,
            'team_id' => $this->team_id,
            'customer_id' => $this->customer_id,
            'customer_type_id' => $this->customer_type_id,
            'total_amount' => $this->total_amount,
            'sales_status_id' => $this->sales_status_id,
            'csr_id' => $this->csr_id,
            'dispatcher_id' => $this->dispatcher_id,
            'is_active' => $this->is_active,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'date_deleted' => $this->date_deleted,
        ]);

        $query->andFilterWhere(['like', 'sales_code', $this->sales_code])
            ->andFilterWhere(['like', 'sales_tracking_number', $this->sales_tracking_number])
            ->andFilterWhere(['like', 'care_of', $this->care_of])
            ->andFilterWhere(['like', 'osr_remark', $this->osr_remark])
            ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'csr_remark', $this->csr_remark])
            ->andFilterWhere(['like', 'dispatcher_remark', $this->dispatcher_remark]);

        return $dataProvider;
    }
    
    public function searchToday($params, $today)
    {
        $query = SalesOnline::find()->where(['like', 'date_created', $today])->andWhere(['<>', 'sales_status_id', 2]);

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
            'courier_id' => $this->courier_id,
            'employee_id' => $this->employee_id,
            'team_id' => $this->team_id,
            'customer_id' => $this->customer_id,
            'customer_type_id' => $this->customer_type_id,
            'total_amount' => $this->total_amount,
            'sales_status_id' => $this->sales_status_id,
            'csr_id' => $this->csr_id,
            'dispatcher_id' => $this->dispatcher_id,
            'is_active' => $this->is_active,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'date_deleted' => $this->date_deleted,
        ]);

        $query->andFilterWhere(['like', 'sales_code', $this->sales_code])
            ->andFilterWhere(['like', 'sales_tracking_number', $this->sales_tracking_number])
            ->andFilterWhere(['like', 'care_of', $this->care_of])
            ->andFilterWhere(['like', 'osr_remark', $this->osr_remark])
            ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'csr_remark', $this->csr_remark])
            ->andFilterWhere(['like', 'dispatcher_remark', $this->dispatcher_remark]);

        return $dataProvider;
    }
    
    public function searchBetween($params, $start, $end)
    {
        $query = SalesOnline::find()->where(['between', 'date_created', $start, $end])->andWhere(['<>', 'sales_status_id', 2]);

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
            'courier_id' => $this->courier_id,
            'employee_id' => $this->employee_id,
            'team_id' => $this->team_id,
            'customer_id' => $this->customer_id,
            'customer_type_id' => $this->customer_type_id,
            'total_amount' => $this->total_amount,
            'sales_status_id' => $this->sales_status_id,
            'csr_id' => $this->csr_id,
            'dispatcher_id' => $this->dispatcher_id,
            'is_active' => $this->is_active,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'date_deleted' => $this->date_deleted,
        ]);

        $query->andFilterWhere(['like', 'sales_code', $this->sales_code])
            ->andFilterWhere(['like', 'sales_tracking_number', $this->sales_tracking_number])
            ->andFilterWhere(['like', 'care_of', $this->care_of])
            ->andFilterWhere(['like', 'osr_remark', $this->osr_remark])
            ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'csr_remark', $this->csr_remark])
            ->andFilterWhere(['like', 'dispatcher_remark', $this->dispatcher_remark]);

        return $dataProvider;
    }
    
    public function searchUnavailableBetween($params, $start, $end)
    {
        $query = SalesOnline::find()->where(['between', 'date_created', $start, $end])->andWhere(['sales_status_id'=>3]);

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
            'courier_id' => $this->courier_id,
            'employee_id' => $this->employee_id,
            'team_id' => $this->team_id,
            'customer_id' => $this->customer_id,
            'customer_type_id' => $this->customer_type_id,
            'total_amount' => $this->total_amount,
            'sales_status_id' => $this->sales_status_id,
            'csr_id' => $this->csr_id,
            'dispatcher_id' => $this->dispatcher_id,
            'is_active' => $this->is_active,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
            'date_deleted' => $this->date_deleted,
        ]);

        $query->andFilterWhere(['like', 'sales_code', $this->sales_code])
            ->andFilterWhere(['like', 'sales_tracking_number', $this->sales_tracking_number])
            ->andFilterWhere(['like', 'care_of', $this->care_of])
            ->andFilterWhere(['like', 'osr_remark', $this->osr_remark])
            ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'csr_remark', $this->csr_remark])
            ->andFilterWhere(['like', 'dispatcher_remark', $this->dispatcher_remark]);

        return $dataProvider;
    }
}
