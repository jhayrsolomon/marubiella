<?php

namespace frontend\modules\accounting\controllers;

use Yii;
use frontend\modules\models\accounting\OrderOfPayment;
use frontend\modules\models\accounting\Service;
use frontend\modules\models\accounting\CollectionType;
use frontend\modules\models\accounting\search\FundCluster as FundClusterSearch;
use frontend\modules\models\accounting\search\OrderOfPayment as OrderOfPaymentSearch;
use frontend\modules\models\accounting\search\CollectionType as CollectionTypeSearch;
use frontend\modules\models\accounting\search\Service as ServiceSearch;
use frontend\modules\models\accounting\search\OopType as OopTypeSearch;
use frontend\modules\models\accounting\search\OopDetails as OopDetailsSearch;
use frontend\modules\models\accounting\search\OopCollection as OopCollectionSearch;
use frontend\modules\models\cashier\search\PaymentType as PaymentTypeSearch;
use frontend\modules\models\agency\search\Division as DivisionSearch;
use frontend\modules\models\ulims\search\CustomerDetails as CustomerDetailsSearch;

//use frontend\modules\models\ulims\search\Request as UlimsRequestSearch;
//use frontend\modules\models\technical\Request as TechnicalRequestSearch;
use frontend\modules\models\agency\search\RequestData as RequestDataSearch;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderOfPaymentController implements the CRUD actions for OrderOfPayment model.
 */
class OrderOfPaymentController extends Controller
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
     * Lists all OrderOfPayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderOfPaymentSearch();
        $dataProvider = $searchModel->searchOopByOopTypeId(Yii::$app->request->queryParams, 1);
        
        $modelType = new OopTypeSearch();
        $oop = $modelType->getTypeByCode('TA');

        $dataProvider->pagination = ['pageSize' => 10];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 
            'type_code' => 'TA',
            'oop' => $oop,
        ]);
    }
    
    public function actionTestingAndAnalysis()
    {
        $searchModel = new OrderOfPaymentSearch();
        $dataProvider = $searchModel->searchOopByOopTypeId(Yii::$app->request->queryParams, 1);

        $modelType = new OopTypeSearch();
        $oop = $modelType->getTypeByCode('TA');

        $dataProvider->pagination = ['pageSize' => 10];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 
            'type_code' => 'TA',
            'oop' => $oop,
        ]);
    }
    
    public function actionTechnicalServices()
    {
        $searchModel = new OrderOfPaymentSearch();
        $dataProvider = $searchModel->searchOopByOopTypeId(Yii::$app->request->queryParams, 2);

        $modelType = new OopTypeSearch();
        $oop = $modelType->getTypeByCode('TS');

        $dataProvider->pagination = ['pageSize' => 10];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 
            'type_code' => 'TS',
            'oop' => $oop,
        ]);
    }
    
    public function actionCustomer()
    {
        if(isset($_GET['type_code'])){
            $searchModel = new CustomerDetailsSearch();
            $dataProvider = $searchModel->searchCustomer(Yii::$app->request->queryParams);
            
            $modelType = new OopTypeSearch();
            $oop = $modelType->getTypeByCode($_GET['type_code']);
            
            $dataProvider->pagination = ['pageSize' => 10];
            return $this->render('customer', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                //'type_code' => $_GET['type_code'],
                'oop' => $oop,
            ]);
        } else {
            return $this->redirect(['/accounting']);
        }
    }
    
    public function actionRequest()
    {
        //if(isset($_POST['id']) && isset($_POST['custName']) && isset($_GET['type_code']) && isset($_GET['div_code'])){
        if(isset($_GET['type_code']) && isset($_GET['id']) && isset($_GET['div_code'])){
            $searchRD = new RequestDataSearch();
            $rd = $searchRD->getModelByTypeCodeDivisionCode($_GET['div_code'], $_GET['type_code']);
            
            $modelType = new OopTypeSearch();
            $oop = $modelType->getTypeByCode($_GET['type_code']);
            
            $modelDivision = new DivisionSearch();
            $div = $modelDivision->getAllDivisionDetails();

            $modelCustomer = new CustomerDetailsSearch();
            $customer = $modelCustomer->getDetailsById($_GET['id']);
            
            if($rd){
                $method = $rd->model;
                $searchModel = new $method;

                $dataProvider = $searchModel->searchRequestByCustomerId($_GET['id']);
                //$dataProvider->pagination = ['pageSize' => 10];

                $typeModel = new OopTypeSearch();
                $oop = $typeModel->getTypeByCode($_GET['type_code']);

                return $this->render($oop->action, [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'oop' => $oop,
                    'div' => $div,
                    'customer' => $customer,
                ]);
            } else {
                return $this->render('no-result', [
                    'oop' => $oop,
                    'div' => $div,
                    'customer' => $customer,
                ]);
            }
        } else {
            return $this->redirect(['/accounting']);
        }
    }
    public function actionDetails()
    {
        if(isset($_POST['custId']) && isset($_POST['div_code']) && isset($_POST['type_code']) && isset($_POST['requestId'])){
            $render = strtolower($_POST['type_code']).'-details';
            
            $searchRD = new RequestDataSearch();
            $rd = $searchRD->getModelByTypeCodeDivisionCode($_POST['div_code'], $_POST['type_code']);
            $method = $rd->model;
            
            $modelSearchRequest = new $method;
            $list = $modelSearchRequest->getRequestById($_POST['requestId']);
            
            $collectionCode = CollectionType::find()->all();
            $service = Service::find()->all();
            
            $modelSearchOop = new OrderOfPaymentSearch();
            $op_num = $modelSearchOop->generateOopNumber();
            
            $modelDiv = new DivisionSearch();
            $div = $modelDiv->getDivisionByCode($_POST['div_code']);

            $modelType = new OopTypeSearch();
            $oop = $modelType->getTypeByCode($_POST['type_code']);
            
            $fundList = FundClusterSearch::getAll();
            
            $paymentTypeList = PaymentTypeSearch::getAll();
            
            $modelCustomer = new CustomerDetailsSearch();
            $customer = $modelCustomer->getDetailsById($_POST['custId']);
            
            return $this->render($render, [
                'dataProvider' => $list,
                'collectionCode' => $collectionCode,
                'service' => $service,
                'opNumber' => $op_num,
                'div' => $div,
                'oop' => $oop,
                'fundList' => $fundList,
                'paymentTypeList' => $paymentTypeList,
                'customer' => $customer,
                
            ]);
        } else {
            return $this->redirect(['/accounting']);
        }
    }
    public function actionGetincometype()
    {
        if(isset($_POST['type'])){
            if($_POST['type'] == 'collection'){
                $modelSearch = new CollectionTypeSearch();
                $data = $modelSearch->getAll();
            }
            if($_POST['type'] == 'service'){
                $modelSearch = new ServiceSearch();
                $data = $modelSearch->getAll();
            }
            
            $obj['type'] = $_POST['type'];
            $obj['data'] = $data;
            
            \Yii::$app->response->format = 'json';
            
            return $obj;
        }
    }
    
    public function actionCreate()
    {
        if(isset($_POST['reqId'])){
            
            //$req = Yii::$app->request;
            $id = $_POST['reqId'];
            $opNum = $_POST['opNum'];
            
            $modelSearch = new OrderOfPaymentSearch();
            
            //$opNum = $modelSearch->generateOopNumber();
            
            //$opCheck = $modelSearch->searchOopByTransactionNumber($opNum);
            $opCheck = $modelSearch->searchOopByTransactionNumber($opNum);
            
            if(count($opCheck) == 1){
                $opNum = $modelSearch->generateOopNumber();
            }
            
            $connection = Yii::$app->accounting;
            $transaction = $connection->beginTransaction();
            
            $connectionPortal = Yii::$app->portal;
            $transactionPortal = $connection->beginTransaction();
            
            try{
                if($_POST['payment_type'] == 2){
                    
                    $merchantRefNo = strtolower(md5($opNum.''.date('MdYc')));
                    
                    $modelCustomer = new CustomerDetailsSearch();
                    $customer = $modelCustomer->getDetailsById($_POST['custId']);
                    
                    $modelFund = new FundClusterSearch();
                    $fund = $modelFund->getDetailsById($_POST['fund']);
                    
                    if($_POST['fund'] == 1){
                        $req = CollectionTypeSearch::getType($_POST['incomeCode']);
                        $type = $req->collection_code.'-'.$req->uacs.'-'.$req->subject_code;
                    }
                    if($_POST['fund'] == 2) {
                        $req = ServiceSearch::getType($_POST['incomeCode']);
                        $type = $req->service_code.'-'.$req->uacs.'-'.$req->subject_code;
                    }
                    
                    $modelDiv = new DivisionSearch();
                    $div = $modelDiv->getDivisionById($_POST['div_id']);
                    
                    $particulars = 'customer_name='.$customer->customerName.';customer_email='.$customer->email.';fund_code='.$fund->fund_code.';type='.$type.';agency=Industrial Technology Development Institute'.';division_name='.$div->name;
                    
                    $epaymentResult = $connectionPortal->createCommand()->insert('e_payment', [
                        'merchant_code' => '2019010002',
                        'merchant_reference_number' => $merchantRefNo,
                        'particulars' => $particulars,
                        'transaction_type' => 'DOST OneLab',
                        'total_amount' => $_POST['total'],
                        'status_id' => 3,
                        'created_date' => date('Y-m-d'),
                    ])->execute();
                }
                
                $paymentStatus = 5;
                if($_POST['totalBalance'] <> 0.00){
                    $paymentStatus = 4;
                }
                $oopResult = $connection->createCommand()->insert('order_of_payment', [
                    //'transaction_num' => $_POST['opNum'],
                    'transaction_num' => $opNum,
                    'payment_method_id' => $_POST['payment_type'],
                    //TEsting or Technical Services
                    'oop_type_id' => $_POST['oop_type_id'],
                    'customer_id' => $_POST['custId'],
                    'division_id' => $_POST['div_id'],
                    'fund_id' => $_POST['fund'],
                    'type_id' => $_POST['incomeCode'],
                    'total_amount' => $_POST['total'],
                    'total_balance' => $_POST['totalBalance'],
                    'oop_status_id' => 3,
                    'payment_status_id' => $paymentStatus,
                    'oop_date' => date('Y-m-d'),
                    'remarks' => $_POST['remark']
                ])->execute();
                
                $opId = $connection->getLastInsertID();

                if($oopResult){

                    $modelSearchOp = new OrderOfPaymentSearch();

                    $op = $modelSearchOp->searchOopByTransactionNumber($opNum);
                    $status = 5;
                    foreach($id as $key=>$value){
                        if($_POST['balance'][$key] <> 0.00){
                            $status = 4;
                        }
                        $oopDetailsResult = $connection->createCommand()->insert('oop_details', [
                            'op_id' => $opId,
                            'request_id' => $value,
                            'amount' => $_POST['amount'][$key],
                            'balance' => $_POST['balance'][$key],
                            'status_id' => $status
                        ])->execute();

                        $detailsId = $connection->getLastInsertID();

                        $oopCollectionResult = $connection->createCommand()->insert('oop_collection', [
                            'oop_details_id' => $detailsId,
                            'general_fund' => $_POST['generalFund'][$key],
                            'trust_fund' => $_POST['trustFund'][$key],
                        ])->execute();
                    }

                    $oopLogResult = $connection->createCommand()->insert('oop_log', [
                        'oop_id' => $opId,
                        'updated_fields' => "Create Order of Payment",
                        'updated_by' => Yii::$app->user->identity->id,
                        'remarks' => 'New'
                    ])->execute();
                }
                $transaction->commit();
                $transactionPortal->commit();
                    
                
                return $this->redirect(['view', 'id' => $opId]);
                
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
                
            /*if($oopResult && $oopDetailsResult && $oopCollectionResult && $oopLogResult){
                return $this->redirect(['view-oop', 'id' => $opId]);
            }*/
            //return $this->render('oop', ['opNumber' => $opNum, 'cust_id' => $_POST['custId']]);
            
            
        } else {
            return $this->redirect(['/accounting']);
        }
    }
    
    public function actionView()
    {
        if(isset($_GET['id'])){
            $oopModel = new OrderOfPaymentSearch();
            $oop = $oopModel->getDetailsById($_GET['id']);

            if($oop->fund_id == 1){
                $req = CollectionTypeSearch::getType($oop->type_id);
                $type = $req->collection_name;
            } if($oop->fund_id == 2) {
                $req = ServiceSearch::getType($oop->type_id);
                $type = $req->service_title;
            }

            $divisionModel = new DivisionSearch();
            $div = $divisionModel->getDivisionById($oop->division_id);

            $oopTypeModel = new OopTypeSearch();
            $oopType = $oopTypeModel->getTypeById($oop->oop_type_id);

            $oopDetailsModel = new OopDetailsSearch();
            $oopDetails = $oopDetailsModel->getDetailsByOopId($oop->id);
            $request_id = array();
            foreach($oopDetails as $item){
                array_push($request_id, $item->request_id);
            }

            $rdModel = new RequestDataSearch();
            $requestData = $rdModel->getModelByTypeCodeDivisionCode($div->code, $oopType->type_code);
            $method = $requestData->model;
            $requestModel = new $method;
            $requestDetails = $requestModel->getRequestById($request_id);
            
            $modelCollection = new OopCollectionSearch();
            
            return $this->render('crud/view', [
                'id' => $_GET['id'],
                'oop' => $oop,
                'type' => $type,
                'requestDetails' => $requestDetails,
                'oopDetails' => $oopDetails,
                'requestData' => $requestData,
                'modelCollection' => $modelCollection,
                
            ]);
        } else {
            return $this->redirect(['/accounting']);
        }
    }
    
    public function actionUpdate()
    {
        if(isset($_GET['id'])){
            $model = $this->findModel($_GET['id']);
            
            $modelDivision = new DivisionSearch();
            $division = $modelDivision->getDivisionById($model->division_id);
            
            $modelRequest = new OopDetailsSearch();
            $request = $modelRequest->getDetailsByOopId($model->id);
            
            if($model->fund_id == 1){
                $modelType = new CollectionTypeSearch();
                $type = $modelType->getAll();
            } else {
                $modelType = new ServiceSearch();
                $type = $modelType->getAll();
            }
            
            $modelOopDetails = new OopDetailsSearch();
            $oopDetails = $modelOopDetails->getDetailsByOopId($model->id);
            
            $collection = array();
            $modelCollection = new OopCollectionSearch();
            foreach($oopDetails as $key=>$item){
                $val = $modelCollection->getDetailsById($item->id);
                array_push($collection, $val);
            }
            
            $requestId = array();
            
            foreach($request as $key=>$item){
                array_push($requestId, $item->request_id);
            }
            
            $oopTypeModel = new OopTypeSearch();
            $oopType = $oopTypeModel->getTypeById($model->oop_type_id);
            
            $searchRD = new RequestDataSearch();
            $rd = $searchRD->getModelByTypeCodeDivisionCode($division->code, $oopType->type_code);
            $method = $rd->model;
            
            $modelSearchRequest = new $method;
            $list = $modelSearchRequest->getRequestById($requestId);
            
            $fundList = FundClusterSearch::getAll();
            
            $paymentTypeList = PaymentTypeSearch::getAll();
            
            $modelCustomer = new CustomerDetailsSearch();
            $customer = $modelCustomer->getDetailsById($model->customer_id);
            
            $render = strtolower($oopType->type_code).'-update';
            
            return $this->render('crud/'.$render, [
                'dataProvider' => $list,
                'oopType' => $oopType,
                'model' => $model,
                'oopDetails' => $oopDetails,
                'collection' => $collection,
                'fundList' => $fundList,
                'incomeType' => $type,
                'paymentTypeList' => $paymentTypeList,
                'customer' => $customer,
            ]);
        } else {
            return $this->redirect(['/accounting']);
        }
    }
    
    public function actionUpdateSave()
    {
        if(isset($_POST['oopId'])){
            
            $id = $_POST['reqId'];
            
            $modelSearch = new OrderOfPaymentSearch();
            $model = $modelSearch->getDetailsById($_POST['oopId']);
            
            $paymentStatus = 5;
            if($_POST['totalBalance'] <> 0.00){
                $paymentStatus = 4;
            }
            
            $connection = Yii::$app->accounting;
            $transaction = $connection->beginTransaction();
            $oopResult = $connection->createCommand()->update('order_of_payment',
                [
                    'transaction_num' => $model->transaction_num,
                    'payment_method_id' => $_POST['payment_type'],
                    //TEsting or Technical Services
                    'oop_type_id' => $model->oop_type_id,
                    'customer_id' => $model->customer_id,
                    'division_id' => $model->division_id,
                    'fund_id' => $_POST['fund'],
                    'type_id' => $_POST['incomeCode'],
                    'total_amount' => $_POST['total'],
                    'total_balance' => $_POST['totalBalance'],
                    'oop_status_id' => 3,
                    'payment_status_id' => $paymentStatus,
                    'oop_date' => $model->oop_date,
                    'remarks' => $_POST['remark']
                ], 
                'id=:oopId', 
                [':oopId' => $_POST['oopId']])->execute();
            
            
            if($oopResult){
                $modelDetails = new OopDetailsSearch();
                $details = $modelDetails->getDetailsByOopId($_POST['oopId']);
                
                $status = 5;
                foreach($details as $key=>$item){
                    if($_POST['balance'][$key] <> 0.00){
                        $status = 4;
                    }
                    
                    $connection->createCommand()->update('oop_details',
                    [
                        'amount' => $_POST['amount'][$key],
                        'balance' => $_POST['balance'][$key],
                        'status_id' => $status
                    ], 
                    'id=:detailsId', 
                    [':detailsId' => $item->id])->execute();
                    
                    $connection->createCommand()->update('oop_collection',
                    [
                        'general_fund' => $_POST['generalFund'][$key],
                        'trust_fund' => $_POST['trustFund'][$key],
                    ], 
                    'oop_details_id=:detailsId', 
                    [':detailsId' => $item->id])->execute();
                }
                
                $connection->createCommand()->insert('oop_log', [
                    'oop_id' => $_POST['oopId'],
                    'updated_fields' => json_encode($_POST),
                    'updated_by' => Yii::$app->user->identity->id,
                    'remarks' => 'Update order of payment'
                ])->execute();
            }
            
            /*$modelDetails = new OopDetailsSearch();
            $details = $modelDetails->getDetailsByOopId($_POST['oopId']);
            
            foreach($details as $key=>$item){
                
            }*/
            
            $transaction->commit();
            
            return $this->redirect(['view', 'id' => $_POST['oopId']]);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    

    /**
     * Displays a single OrderOfPayment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new OrderOfPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    /**
     * Updates an existing OrderOfPayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing OrderOfPayment model.
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
     * Finds the OrderOfPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderOfPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderOfPayment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
