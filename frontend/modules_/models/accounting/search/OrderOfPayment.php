<?php

namespace frontend\modules\models\accounting\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\models\accounting\OrderOfPayment as OrderOfPaymentModel;
use frontend\modules\models\accounting\search\FundCluster as FundClusterSearch;
use frontend\modules\models\accounting\search\OopCollection as OopCollectionSearch;
use frontend\modules\models\accounting\search\OopDetails as OopDetailsSearch;
use frontend\modules\models\agency\search\Division as DivisionSearch;
use frontend\modules\models\cashier\search\PaymentType as PaymentTypeSearch;

/**
 * OrderOfPayment represents the model behind the search form of `frontend\modules\models\OrderOfPayment`.
 */
class OrderOfPayment extends OrderOfPaymentModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'oop_type_id', 'customer_id', 'fund_id', 'type_id', 'oop_status_id'], 'integer'],
            [['transaction_num', 'oop_date', 'create_time', 'remarks'], 'safe'],
            [['total_amount', 'total_balance'], 'number'],
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
        $query = OrderOfPaymentModel::find();

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
            'oop_type_id' => $this->oop_type_id,
            'customer_id' => $this->customer_id,
            'fund_id' => $this->fund_id,
            'type_id' => $this->type_id,
            'total_amount' => $this->total_amount,
            'total_balance' => $this->total_balance,
            'oop_status_id' => $this->oop_status_id,
            'oop_date' => $this->oop_date,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'transaction_num', $this->transaction_num])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
    
    public function searchOopByOopTypeId($params, $oop_type_id)
    {
        $query = OrderOfPaymentModel::find();
        //$query->with('customerdetails');
        //$query->with('status');
        //$query->with('fund');
        $query->where(['oop_type_id' => $oop_type_id]);

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

        $query->andFilterWhere(['like', 'transaction_num', $this->transaction_num]);

        return $dataProvider;
    }
    
    public function generateOopNumber()
    {
        $count = OrderOfPaymentModel::find()
            ->where(['LIKE', 'transaction_num', date('Y')])
            ->count();
        
        $length = strlen($count);
        $series = $count + 1;
        
        if($count == 0){
            $op_num = date('Y').'-'.date('m').'-000'.$series;
        } else {
            if($length == 1){
                $op_num = date('Y').'-'.date('m').'-000'.$series;
            }
            if($length == 2){
                $op_num = date('Y').'-'.date('m').'-00'.$series;
            }
            if($length == 3){
                $op_num = date('Y').'-'.date('m').'-0'.$series;
            }
            if($length >= 4){
                $op_num = date('Y').'-'.date('m').'-'.$series;
            }
        }
        
        return $op_num;
    }
    
    public function searchOopByTransactionNumber($id)
    {
        $query = OrderOfPaymentModel::find()
            ->where(['transaction_num' => $id])
            ->all();
        
        return $query;
    }
    
    public function searchOopRequestByCustomerIdDivisionIdFundCode($params, $customerId, $divisionCode, $fundCode)
    {
        $divModel = new DivisionSearch();
        $div = $divModel->getDivisionByCode($divisionCode);
        
        $fundModel = new FundClusterSearch();
        $fund = $fundModel->getDetailsByCode($fundCode);
        
        /*$fundModel = new FundClusterSearch();
        $fund = $fundModel->getDetailsByCode($fundCode);*/
        
        $query = OrderOfPaymentModel::find();
        //$query->where(['fund_id' => $fund->id]);
        $query->andWhere(['customer_id' => $customerId]);
        $query->andWhere(['division_id' => $div->id]);
        $query->andWhere(['fund_id' => $fund->id]);
        
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
        
        $query->andFilterWhere(['like', 'transaction_num', $this->transaction_num]);

        return $dataProvider;
    }
    
    public function getDetailsByTransactionNum($id)
    {
        $query = OrderOfPaymentModel::find()
            ->where(['transaction_num' => $id])
            ->one();
        
        return $query;
    }
    
    public function getDetailsById($id)
    {
        $query = OrderOfPaymentModel::find()
            ->where(['id' => $id])
            ->one();
        
        return $query;
    }
    
    public function getCustomerViaOopByDivisionCode($params, $divCode, $paymentCode)
    {
        $modelDiv = new DivisionSearch();
        $div = $modelDiv->getDivisionByCode($divCode);
        
        $modelType = new PaymentTypeSearch();
        $type = $modelType->getTypeByCode($paymentCode);
        
        $query = OrderOfPaymentModel::find();
        $query->where(['payment_method_id' => $type->id]);
        $query->andWhere(['division_id' => $div->id]);

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

        $query->andFilterWhere(['like', 'transaction_num', $this->transaction_num]);
        
        $query->groupBy(['customer_id']);

        return $dataProvider;
    }
    
    public function getOopRequestByCustomerIdDivisionIdFundCode($params, $customerId, $divisionCode, $fundCode)
    {
        $divModel = new DivisionSearch();
        $div = $divModel->getDivisionByCode($divisionCode);
        
        $fundModel = new FundClusterSearch();
        $fund = $fundModel->getDetailsByCode($fundCode);
        
        $query = OrderOfPaymentModel::find();
        $query->andWhere(['customer_id' => $customerId]);
        $query->andWhere(['division_id' => $div->id]);
        $query->andWhere(['fund_id' => $fund->id]);
        
        $query->andFilterWhere(['like', 'transaction_num', $this->transaction_num]);

        return $query->all();
    }
    
    public function getDetailsByOopIdDivisionIdFundCode(array $reqId, $divCode, $fundCode)
    {
        $fundModel = new FundClusterSearch();
        $fund = $fundModel->getDetailsByCode($fundCode);
        
        $divisionModel = new DivisionSearch();
        $division = $divisionModel->getDivisionByCode($divCode);
        
        $query = OrderOfPaymentModel::find();
        $query->with('oopdetails');
        
        $query->where(['in', 'id', $reqId]);
        $query->andWhere(['division_id' => $division->id]);
        $query->andWhere(['fund_id' => $fund->id]);
        $oop = $query->all();
        
        $element = array();
        $obj = array();
        $general =0;
        $trust = 0;
        $balance = 0;
        $total_amount = 0;
        
        foreach($oop as $key=>$item){
            $oopDetailsModel = new OopDetailsSearch();
            $oopDetails = $oopDetailsModel->getDetailsByOopId($item->id);
            
            foreach($oopDetails as $details){
                $collectionModel = new OopCollectionSearch();
                $collection = $collectionModel->getAllDetailsByOopDetailsId($details->id);
                foreach($collection as $fund){
                    $general += $fund->general_fund;
                    $trust += $fund->trust_fund;
                }
                $balance += $details->balance;
                $total_amount += $details->amount;
            }
            //OOP Number
            array_push($element, $item->transaction_num);
            //OOP Total General Fund
            array_push($element, $general);
            //OOP Total Trust Fund
            array_push($element, $trust);
            //OOP Balance
            array_push($element, $balance);
            //OOP Total Amount
            array_push($element, $total_amount);
            //OOP Total Amount
            array_push($element, $item->total_amount);
            
            array_push($obj, $element);
        }
        
        return $obj;
    }
    
    public function getDetailsByOopIdDivisionIdFundId(array $reqId, $divId, $fundId)
    {
        
        $query = OrderOfPaymentModel::find();
        $query->with('oopdetails');
        
        $query->where(['in', 'id', $reqId]);
        $query->andWhere(['division_id' => $divId]);
        $query->andWhere(['fund_id' => $fundId]);
        $oop = $query->all();
        
        $element = array();
        $obj = array();
        $general =0;
        $trust = 0;
        $balance = 0;
        $total_amount = 0;
        
        foreach($oop as $key=>$item){
            $oopDetailsModel = new OopDetailsSearch();
            $oopDetails = $oopDetailsModel->getDetailsByOopId($item->id);
            
            foreach($oopDetails as $details){
                $collectionModel = new OopCollectionSearch();
                $collection = $collectionModel->getAllDetailsByOopDetailsId($details->id);
                foreach($collection as $fund){
                    $general += $fund->general_fund;
                    $trust += $fund->trust_fund;
                }
                $balance += $details->balance;
                $total_amount += $details->amount;
            }
            //OOP Number
            array_push($element, $item->transaction_num);
            //OOP Total General Fund
            array_push($element, $general);
            //OOP Total Trust Fund
            array_push($element, $trust);
            //OOP Balance
            array_push($element, $balance);
            //OOP Total Amount
            array_push($element, $total_amount);
            //OOP Total Amount
            array_push($element, $item->total_amount);
            
            array_push($obj, $element);
        }
        
        return $obj;
    }
    
    public function getCashierCustomerViaOopByDivisionCode($params, $divCode, $paymentCode)
    {
        $modelDiv = new DivisionSearch();
        $div = $modelDiv->getDivisionByCode($divCode);
        
        $modelType = new PaymentTypeSearch();
        $type = $modelType->getTypeByCode($paymentCode);
        
        $query = OrderOfPaymentModel::find();
        $query->where(['payment_method_id' => $type->id]);
        $query->andWhere(['division_id' => $div->id]);
        $query->andWhere(['oop_status_id' => 3]);

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

        $query->andFilterWhere(['like', 'transaction_num', $this->transaction_num]);
        
        $query->groupBy(['customer_id']);

        return $dataProvider;
    }
    
    //public function getOopRequestByFundIdCustomerIdDivisionId($params, $fundCode, $customerId, $divisionCode)
    
    /*public function searchOpById($id)
    {
        $query = OrderOfPaymentModel::find()
            ->where(['id' => $id])
            ->one();
        
        return $query;
    }*/
    
    /*public function countOop()
    {
        $query = OrderOfPaymentModel::find()
            ->where(['LIKE', 'transaction_num', date('Y')])
            ->count();
        return $query;
            
    }
    
    */
    
    /*public function searchOpByTsr($id)
    {
        $query = OrderOfPaymentModel::find()
            ->where(['transaction_num' => $id])
            ->all();
        
        return $query;
    }
    
    public function getDetailsByTsr($id)
    {
        $query = OrderOfPaymentModel::find();
        $query->where(['transaction_num' => $id]);
        
        return $query->one();
    }
    
    
    
    */
}
