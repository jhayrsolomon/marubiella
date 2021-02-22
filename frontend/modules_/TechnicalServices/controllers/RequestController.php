<?php

namespace frontend\modules\TechnicalServices\controllers;

use Yii;
use frontend\modules\models\technical\Request;
use frontend\modules\models\technical\search\Request as RequestSearch;
use frontend\modules\models\technical\search\Particulars as ParticularsSearch;
use frontend\modules\models\ulims\search\CustomerDetails as CustomerDetailsSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCustomer()
    {
        $searchModel = new CustomerDetailsSearch();
        $dataProvider = $searchModel->searchCustomer(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 10];
        return $this->render('customer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('crud/create', [
            'model' => $model,
        ]);
    }*/
    public function actionCreate()
    {
        $cust_id = Yii::$app->request->get('id');
        $modelCustomer = new CustomerDetailsSearch();
        $customer = $modelCustomer->getDetailsById($cust_id);

        $modelRequest = new Request();
        
        if ($modelRequest->load(Yii::$app->request->post()))
        {
            try{
                $modelRequest->request_date = Yii::$app->formatter->asDate($_POST['request_date'], 'php:Y-m-d');
                $modelRequest->due_date = Yii::$app->formatter->asDate($_POST['due_date'], 'php:Y-m-d');
                $modelRequest->status_id = 3;

                $result = $modelRequest->save();
                
                $connection = Yii::$app->technical;
                $transaction = $connection->beginTransaction();
                
                if($result) {
                    foreach($_POST['code'] as $key => $value){
                        $connection->createCommand()->insert('particulars', [
                            'request_id' => $modelRequest->id,
                            'code' => $value,
                            'description' => $_POST['description'][$key],
                            'amount' => $_POST['amount'][$key]
                        ])->execute();
                    }
                    $connection->createCommand()->insert('request_log', [
                        'request_id' => $modelRequest->id,
                        'updated_fields' => "Create Technical Services Request",
                        'updated_by' => Yii::$app->user->identity->id,
                        'remarks' => 'New'
                    ])->execute();
                }
                $transaction->commit();
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            return $this->redirect(['view', 'id' => $modelRequest->id]);
        }
        
        return $this->render('crud/create', [
            'modelRequest' => $modelRequest,
            //'modelParticulars' => $modelParticulars,
            'customer' => $customer,
        ]);
    }
    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelParticulars = new ParticularsSearch();
        $modelCustomer = new CustomerDetailsSearch();
        
        $particulars = $modelParticulars->getAllByRequestId($id);
        $customer = $modelCustomer->getDetailsById($model->customer_id);
        
        return $this->render('crud/view', [
            'model' => $model,
            'particulars' => $particulars,
            'customer' => $customer,
        ]);
    }
    /*public function actionView($id)
    {
        return $this->render('crud/view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['crud/view', 'id' => $model->id]);
        }

        return $this->render('crud/update', [
            'model' => $model,
        ]);
    }*/
    public function actionUpdate($id)
    {
        $modelRequest = $this->findModel($id);
        $modelParticulars = new ParticularsSearch();
        $modelCustomer = new CustomerDetailsSearch();
        
        $particulars = $modelParticulars->getAllByRequestId($id);
        $customer = $modelCustomer->getDetailsById($modelRequest->customer_id);
        
        return $this->render('crud/update', [
            'modelRequest' => $modelRequest,
            'particulars' => $particulars,
            'customer' => $customer,
        ]);
    }

    /**
     * Deletes an existing Request model.
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
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
