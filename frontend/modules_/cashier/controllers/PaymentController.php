<?php

namespace frontend\modules\cashier\controllers;

use Yii;
use frontend\modules\models\cashier\Payment;
use frontend\modules\models\cashier\search\Payment as PaymentSearch;
use frontend\modules\models\cashier\search\PaymentType as PaymentTypeSearch;
use frontend\modules\models\cashier\search\LdcSeries as LdcSeriesSearch;
use frontend\modules\models\cashier\search\OrCategory as OrCategorySearch;
use frontend\modules\models\cashier\search\OrSeries as OrSeriesSearch;
use frontend\modules\models\cashier\search\CheckType as CheckTypeSearch;
use frontend\modules\models\cashier\PaymentParticulars;
use frontend\modules\models\cashier\PaymentOopDetails;
use frontend\modules\models\cashier\CheckDetails;
use frontend\modules\models\cashier\LddapDetails;
use frontend\modules\models\cashier\search\ModeOfPayment as ModeOfPaymentSearch;
use frontend\modules\models\accounting\search\OrderOfPayment as OrderOfPaymentSearch;
use frontend\modules\models\accounting\search\FundCluster as FundClusterSearch;
use frontend\modules\models\accounting\search\CollectionType as CollectionTypeSearch;
use frontend\modules\models\accounting\search\Service as ServiceSearch;
use frontend\modules\models\accounting\search\OopType as OopTypeSearch;
use frontend\modules\models\ulims\search\CustomerDetails as CustomerDetailsSearch;
use frontend\modules\models\agency\search\Division as DivisionSearch;
use frontend\modules\models\agency\search\RequestData as RequestDataSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentMethodController implements the CRUD actions for Payment model.
 */
class PaymentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Payment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $modelType = new PaymentTypeSearch();
        $payment = $modelType->getTypeByCode('OTC');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'payment' => $payment,
        ]);
    }
    
    public function actionOverTheCounter()
    {
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $modelType = new PaymentTypeSearch();
        $payment = $modelType->getTypeByCode('OTC');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'payment' => $payment,
        ]);
    }
    
    public function actionEPayment()
    {
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $modelType = new PaymentTypeSearch();
        $payment = $modelType->getTypeByCode('EP');
        
        return $this->render('e-payment', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'payment' => $payment,
        ]);
    }
    
    public function actionInKind()
    {
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $modelType = new PaymentTypeSearch();
        $payment = $modelType->getTypeByCode('IK');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'payment' => $payment,
        ]);
    }
    
    public function actionCustomer()
    {
        if(isset($_GET['type_code']) && isset($_GET['div_code'])) {
            
            $searchModel = new OrderOfPaymentSearch();
            $dataProvider = $searchModel->getCashierCustomerViaOopByDivisionCode(Yii::$app->request->queryParams, $_GET['div_code'], $_GET['type_code']);
            
            return $this->render('customer', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['/cashier']);
        }
    }
    
    public function actionOopRequests()
    {
        if(isset($_GET['type_code']) && isset($_GET['div_code']) && isset($_GET['fund']) && isset($_GET['id'])) {
            $searchModel = new OrderOfPaymentSearch();
            //$dataProvider = $searchModel->getOopRequestByFundIdCustomerIdDivisionId(Yii::$app->request->queryParams, $_GET['fund'], $_GET['id'], $_GET['div_code']);
            $dataProvider = $searchModel->searchOopRequestByCustomerIdDivisionIdFundCode(Yii::$app->request->queryParams, $_GET['id'], $_GET['div_code'], $_GET['fund']);
            
            return $this->render('oop-requests', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }/* else {
            return $this->redirect(['/cashier']);
        }*/
    }

    /**
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionOfficialReceipt()
    {
        if(isset($_POST['oop_id'])){

            /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }*/
            $modelType = new PaymentTypeSearch();
            $payment = $modelType->getTypeByCode($_POST['type_code']);
            
            $modelCustomer = new CustomerDetailsSearch();
            $customer = $modelCustomer->getDetailsById($_POST['customer_id']);
            
            $oopModel = new OrderOfPaymentSearch();
            $oopDetails = $oopModel->getDetailsByOopIdDivisionIdFundCode($_POST['oop_id'], $_POST['div_code'], $_POST['fund_code']);
            
            $oop = $oopModel->getDetailsById($_POST['oop_id'][0]);

            $ldcModel = new LdcSeriesSearch();
            $ldc = $ldcModel->generateLDCSeries($oop->fund_id);
            
            $categoryList = OrCategorySearch::getAll();
            
            $checkTypeList = CheckTypeSearch::getAll();
            
            $seriesModel = new OrSeriesSearch();
            $orSeries = $seriesModel->getSeriesNumber(1);
            
            $fundModel = new FundClusterSearch();
            $fund = $fundModel->getDetailsByCode($_POST['fund_code']);
            
            
            if($fund->id == 1){
                $typeModel = new CollectionTypeSearch();
                $incomeType = $typeModel->getType($oop->type_id);
                /*$type = $typeModel->getType($oop->type_id);
                $incomeType = $type->collection_name.' ('.$type->collection_code.')';*/
            }
            if($fund->id == 2){
                $typeModel = new ServiceSearch();
                $incomeType = $typeModel->getType($oop->type_id);
                /*$type = $typeModel->getType($oop->type_id);
                $incomeType = $type->service_title.' ('.$type->service_code.')';*/
            }
            
            $divisionModel = new DivisionSearch();
            $division = $divisionModel->getDivisionByCode($_POST['div_code']);
            
            return $this->render('crud/create', [
                'payment' => $payment,
                'customer' => $customer,
                'oop' => $oop,
                'fund' => $fund,
                'incomeType' => $incomeType,
                'division' => $division,
                'oopDetails' => $oopDetails,
                'ldc' => $ldc,
                'categoryList' => $categoryList,
                'checkTypeList' => $checkTypeList,
                'orSeries' => $orSeries,
            ]);
        } else {
            return $this->redirect(['/cashier']);
        }
    }
    
    public function actionGetornumber()
    {
        if(isset($_POST['id'])){
            $seriesModel = new OrSeriesSearch();
            $series = $seriesModel->getSeriesNumber($_POST['id']);
            
            $obj['next'] = ($series->next_or+1);
            $obj['end'] = $series->end_or;
            
            \Yii::$app->response->format = 'json';
            
            return $obj;
        }
    }
    
    public function actionGetchecktype()
    {
        $checkModel = new CheckTypeSearch();
        $checkType  = $checkModel->getType();
        
        \Yii::$app->response->format = 'json';
        return $checkType;
    }
    
    public function actionCreatetwo()
    {
        return $this->render('crud/view');
    }
    
    public function actionCreate()
    {
        if(isset($_POST['ldc_number']) && isset($_POST['ldc_date']) && isset($_POST['or_number']) && isset($_POST['or_date']) && isset($_POST['or_category']) && isset($_POST['payor_name']) && isset($_POST['oop_id']) && isset($_POST['customer_id']) && isset($_POST['fund_id']) && isset($_POST['fund_type_id']) && isset($_POST['division_id']) && isset($_POST['payment_type_id']) && isset($_POST['amount_to_pay'])){
        //&& isset($_POST['remarks'])
            $connection = Yii::$app->cashier;
            $transaction = $connection->beginTransaction();
        
            $connectionAccounting = Yii::$app->accounting;
            $transactionAccounting = $connectionAccounting->beginTransaction();
        
            try {
                
                $paymentResult = $connection->createCommand()->insert('payment', [
                    'or_number' => $_POST['or_number'],
                    'division_id' => $_POST['division_id'],
                    'fund_id' => $_POST['fund_id'],
                    'fund_type_id' => $_POST['fund_type_id'],
                    'customer_id' => $_POST['customer_id'],
                    'payment_type_id' => $_POST['payment_type_id'],
                    'total_amount' => $_POST['amount_to_pay'],
                    'payor_name' => $_POST['payor_name'],
                    'created_date' => $_POST['or_date'],
                    'status_code' => 100,
                    'remarks' => $_POST['remark'],
                ])->execute();
                
                $paymentId = $connection->getLastInsertID();
                
                if($paymentResult){
                    $connection->createCommand()->insert('ldc_series', [
                        'payment_id' => $paymentId,
                        'fund_id' => $_POST['fund_id'],
                        'ldc_code' => $_POST['ldc_number'],
                        'ldc_date' =>  $_POST['ldc_date'],
                    ])->execute();
                    
                    $oop_id = $_POST['oop_id'];
                    foreach($oop_id as $item){
                        $connection->createCommand()->insert('payment_oop_details', [
                            'payment_id' => $paymentId,
                            'oop_id' => $item,
                        ])->execute();
                    }
                    foreach($_POST['mode_of_payment'] as $key=>$item){
                        $connection->createCommand()->insert('payment_particulars', [
                            'payment_id' => $paymentId,
                            'mode_of_payment_id' => $item,
                            'general_amount' => $_POST['general'][$key],
                            'trust_amount' => $_POST['trust'][$key],
                        ])->execute();
                        
                        if($item == 2){
                            foreach($_POST['check_type'] as $key=>$item){
                                $connection->createCommand()->insert('check_details', [
                                    'payment_id' => $paymentId,
                                    'check_type_id' => $item,
                                    'bank_name' => $_POST['check_bank_name'][$key],
                                    'bank_branch' => $_POST['check_bank_branch'][$key],
                                    'check_number' => $_POST['check_number'][$key],
                                    'check_date' => $_POST['check_date'][$key],
                                    'amount' => $_POST['check_amount'][$key],
                                    'revert_status_code' => 777,
                                    'revert_reason' => '',
                                ])->execute();
                            }
                        }
                        if($item == 4){
                            foreach($_POST['lddap_name'] as $key=>$item){
                                $connection->createCommand()->insert('lddap_details', [
                                    'payment_id' => $paymentId,
                                    'bank_name' => $_POST['lddap_name'][$key],
                                    'bank_branch' => $_POST['lddap_bank_branch'][$key],
                                    'lddap_number' => $_POST['lddap_number'][$key],
                                    'lddap_date' => $_POST['lddap_date'][$key],
                                    'lddap_amount' => $_POST['lddap_amount'][$key],
                                ])->execute();
                            }
                        }
                    }
                    $connection->createCommand()->insert('payment_log', [
                        'payment_id' => $paymentId,
                        'updated_fields' => 'Create Payment',
                        'updated_by' => Yii::$app->user->identity->id,
                        'updated_date' => date("Y-m-d"),
                        'remarks' => 'New',
                    ])->execute();
                    
                    foreach($oop_id as $item){

                        $oopModel = new OrderOfPaymentSearch();
                        $oop = $oopModel->getDetailsById($item);
                        $connectionAccounting->createCommand()->update('order_of_payment',
                            [
                                'oop_status_id' => 1
                            ], 
                            'id=:oopId', 
                            [
                                ':oopId' => $oop->id
                            ])->execute();
                        
                    }
                    
                    $orSeriesModel = new OrSeriesSearch();
                    $orSeries = $orSeriesModel->getSeriesNumber($_POST['or_category']);
                    
                    $next = $orSeries->next_or+1;
                    $connection->createCommand()->update('or_series',
                    [
                        'next_or' => $next
                    ], 
                    'category_id=:orCategory', 
                    [
                        ':orCategory' => $_POST['or_category']
                    ])->execute();
                }
                $transactionAccounting->commit();
                $transaction->commit();
                
                
                return $this->redirect(['view', 'id' => $paymentId]); 
                
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }
    
    /**
     * Displays a single Payment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $modelLDC = new LdcSeriesSearch();
        $ldc = $modelLDC->getLdcById($id);
        
        $modelCategory = new OrCategorySearch();
        $category = $modelCategory->getCategoryById($model->or_category_id);
        
        $modelType = new PaymentTypeSearch();
        $payment = $modelType->getTypeById($model->payment_type_id);
        
        $modelFund = new FundClusterSearch();
        $fund = $modelFund->getDetailsById($model->fund_id);
        
        if($model->fund_id == 1){
            $typeModel = new CollectionTypeSearch();
            $incomeType = $typeModel->getType($model->fund_type_id);
            $type = $incomeType->collection_name." (".$incomeType->collection_code.")"." (".$incomeType->uacs."-".$incomeType->subject_code.")";
        }
        if($model->fund_id == 2){
            $typeModel = new ServiceSearch();
            $incomeType = $typeModel->getType($model->fund_type_id);
            $type = $incomeType->service_title." (".$incomeType->service_code.")"." (".$incomeType->uacs."-".$incomeType->subject_code.")";
        }
        
        $modelParticulars = new PaymentParticulars();
        $particulars = $modelParticulars->getAllDetailsById($id);
        
        $modelId = array();
        foreach($particulars as $item){
            array_push($modelId, $item->mode_of_payment_id);
        }
        
        $modelMode = new ModeOfPaymentSearch();
        $mode = $modelMode->getModeById($modelId);
        
        $modeOfPaymentDetails = array();
        foreach($particulars as $key=>$item){
            if($item->mode_of_payment_id == 2){
                $modelCheckDetails = new CheckDetails();
                $checkDetails = $modelCheckDetails->getDetailsById($id);
                $modeOfPaymentDetails['check'] = $checkDetails;
            }
            if($item->mode_of_payment_id == 4){
                $modelLddapDetails = new LddapDetails();
                $lddapDetails = $modelLddapDetails->getDetailsById($id);
                $modeOfPaymentDetails['lddap'] = $lddapDetails;
            }
        }
        
        $modelPaymentOopDetails = new PaymentOopDetails();
        $pod = $modelPaymentOopDetails->getAllDetailsById($id);
        
        $reqId = array();
        foreach($pod as $key=>$item){
            array_push($reqId, $item->oop_id);
        }
        
        $modelOopDetails = new OrderOfPaymentSearch();
        $oopDetails = $modelOopDetails->getDetailsByOopIdDivisionIdFundId($reqId,$model->division_id, $model->fund_id);
        
        $modelOop = new OrderOfPaymentSearch();
        $oop = $modelOop->getDetailsById($pod[0]->oop_id);
        
        $modelDivision = new DivisionSearch();
        $division = $modelDivision->getDivisionById($model->division_id);
        
        $modelOopType = new OopTypeSearch();
        $oopType = $modelOopType->getTypeById($oop->oop_type_id);
        
        $searchRD = new RequestDataSearch();
        $rd = $searchRD->getModelByTypeCodeDivisionCode($division->code, $oopType->type_code);
        $method = $rd->model;

        $modelSearchRequest = new $method;
        $list = $modelSearchRequest->getRequestById($reqId);
        
        $modelCustomer = new CustomerDetailsSearch();
        $customer = $modelCustomer->getDetailsById($model->customer_id);
        
        if($modeOfPaymentDetails){
            return $this->render('crud/viewdetails', [
                'model' => $model,
                'ldc' => $ldc,
                'category' => $category,
                'payment' => $payment,
                'fund' => $fund,
                'type' => $type,
                'particulars' => $particulars,
                'mode' => $mode,
                'modeOfPaymentDetails' => $modeOfPaymentDetails,
                'oopDetails' => $oopDetails,
                'list' => $list,
                'requestData' => $rd,
                'customer' => $customer,
            ]);
        } else {
            return $this->render('crud/view', [
                'model' => $model,
                'ldc' => $ldc,
                'category' => $category,
                'payment' => $payment,
                'fund' => $fund,
                'type' => $type,
                'particulars' => $particulars,
                'mode' => $mode,
                'oopDetails' => $oopDetails,
                'list' => $list,
                'requestData' => $rd,
                'customer' => $customer,
            ]);
        }
        
    }
    /*public function actionCreate()
    {
        if(isset(Yii::$app->request)){
            $req = Yii::$app->request;
            $req_id = $req->post('oop_id');
            $div_code = $req->post('div_code');
            $type_code = $req->post('type_code');
            
            return $this->render('crud/create');
        } else {
            return $this->redirect(['/cashier']);
        }
    }*/

    /**
     * Updates an existing Payment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('crud/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Payment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
