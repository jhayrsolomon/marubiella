<?php

namespace frontend\modules\cashier\controllers;

use Yii;
use frontend\modules\models\Receipt;
use frontend\modules\models\search\Receipt as ReceiptSearch;
/*use frontend\modules\models\search\CustomerDetails as CustomerDetailsSearch;*/
use frontend\modules\models\search\OrderOfPayment as OrderOfPaymentSearch;
use frontend\modules\models\search\LdcSeries as LdcSeriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OverTheCounterController extends \yii\web\Controller
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
     * Lists all Receipt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReceiptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination = ['pageSize' => 10];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionOoplist()
    {
        $searchModel = new OrderOfPaymentSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 10];
        return $this->render('ooplist', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        
    }
    
    public function actionCreate()
    {
        if(isset(Yii::$app->request)){
            $req = Yii::$app->request;
            $id = $_POST['id'];
            
            $oopModel = new OrderOfPaymentSearch();
            $oop = $oopModel->searchOpById($id);
            
            $fund = $oop->fund_id;
            $ldcModel = new LdcSeriesSearch();
            $ldc = $ldcModel->generateLdcNumber($fund);
            
            
            
            return $this->render('create', ['ldc' => $ldc, 'oop' => $oop]);
        }
    }
    
    /*public function actionCustomer()
    {
        $searchModel = new CustomerDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 10];
        return $this->render('customer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    
    
    public function actionCreate()
    {
        return $this->render('create');
    }*/
    
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
