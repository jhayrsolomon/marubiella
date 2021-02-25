<?php

namespace frontend\modules\sales\controllers;

use Yii;
use frontend\modules\models\SalesOnline;
use frontend\modules\models\SalesOnlineSearch;
use frontend\modules\models\Customer;
use frontend\modules\models\CustomerType;
use frontend\modules\models\Product;
use frontend\modules\models\SalesProduct;
use frontend\modules\models\Refbrgy;
use frontend\modules\models\Refcitymun;
use frontend\modules\models\Refprovince;
use frontend\modules\models\Refregion;
use frontend\modules\models\SalesStatus;
use frontend\modules\models\Employee;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * EncoderController implements the CRUD actions for SalesOnline model.
 */
class EncoderController extends Controller
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
     * Lists all SalesOnline models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesOnlineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalesOnline model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('crud/view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionLogistics()
    {
        return $this->render('logistics');
    }
    
    public function actionViewReport()
    {
        $user_id = Yii::$app->user->identity->id;
        $employee = Employee::find()->where(['user_id'=>$user_id])->one();
        
        if(isset($_POST['date_sales'])){
            if($_POST['date_sales'] == 'sales_all'){
                //$sales = SalesOnline::find()->where(['employee_id'=>$employee->id])->all();
                $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 2 GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
            } else {
                if($_POST['date_sales'] == 'sales_week'){
                    $d = date('d',strtotime('last Monday'));
                    $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
                    $start_Date = date('Y-m-d',strtotime('last Monday'));
                }
                if($_POST['date_sales'] == 'sales_month'){
                    $start_Date = date_format(date_create(date('Y-m-').'1'), 'Y-m-d');
                    $end_Date = date('Y-m-t');
                }
                if($_POST['date_sales'] == 'sales_today'){
                    $start_Date = date('Y-m-d');
                    $end_Date = date('Y-m-d');
                }
                $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 2 and sales_online.date_created between "'.$start_Date.'" and "'.$end_Date.'" GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
            }
        } else {
            $start_Date = date('Y-m-d');
            $end_Date = date('Y-m-d');
            $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 2 and sales_online.date_created between "'.$start_Date.'" and "'.$end_Date.'" GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
        }
        return $this->render('crud/view-report', [
            'sales' => $sales,
            'employee' => $employee,
        ]);
    }
    
    public function actionViewSales()
    {
        $user_id = Yii::$app->user->identity->id;
        $employee = Employee::find()->where(['user_id'=>$user_id])->one();
        
        if(isset($_POST['view_date_sales'])){
            if($_POST['view_date_sales'] == 'view_sales_today'){
                $today = date('Y-m-d');
                $sales = SalesOnline::find()->where(['employee_id' => $employee->id, 'date_created' => $today])->all();
            }
            if($_POST['view_date_sales'] == 'view_sales_week'){
                $d = date('d',strtotime('last Monday'));
                $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
                $start_Date = date('Y-m-d',strtotime('last Monday'));
                
                $sales = SalesOnline::find()->where(['employee_id' => $employee->id])->andWhere(['between', 'date_created', $start_Date, $end_Date])->all();
            }
            if($_POST['view_date_sales'] == 'view_sales_month'){
                $start_Date = date_format(date_create(date('Y-m-').'1'), 'Y-m-d');
                $end_Date = date('Y-m-t');
                
                $sales = SalesOnline::find()->where(['employee_id' => $employee->id])->andWhere(['between', 'date_created', $start_Date, $end_Date])->all();
            }
            if($_POST['view_date_sales'] == 'view_sales_all'){
                $sales = SalesOnline::find()->where(['employee_id' => $employee->id])->all();
            }
            //SELECT product_id, SUM(quantity) FROM sales_product GROUP BY product_id, from_unixtime( UNIX_TIMESTAMP(date_created), '%Y-%m-%d') ORDER BY from_unixtime( UNIX_TIMESTAMP(date_created), '%Y-%m-%d'), product_id ASC
        } else {
            $today = date('Y-m-d');
            $sales = SalesOnline::find()->where(['employee_id' => $employee->id, 'date_created' => $today])->all();
        }
        
        return $this->render('crud/view-sales', [
            'sales' => $sales,
            'employee' => $employee,
        ]);
    }
    
    public function actionAddSales()
    {
        $model = new SalesOnline();
        $modelCustomer = new Customer();
        $modelProductSales = new SalesProduct();
        $customerType = ArrayHelper::map(CustomerType::find()->all(), 'id', 'customer_type_code');
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'product_name');
        $barangay = ArrayHelper::map(Refbrgy::find()->all(), 'id', 'brgyDesc');
        $municipality = ArrayHelper::map(Refcitymun::find()->all(), 'id', 'citymunDesc');
        $province = ArrayHelper::map(Refprovince::find()->all(), 'id', 'provDesc');
        $region = ArrayHelper::map(Refregion::find()->all(), 'id', 'regDesc');
        $salesStatus = ArrayHelper::map(SalesStatus::find()->all(), 'id', 'sales_status_name');
        
        if ($modelCustomer->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['collectible_amount'])) {
            /*echo '<pre>';
            var_dump($_POST['product_id'][0]);die;*/
            
            $modelCustomer->customer_code = substr(strtolower($_POST['Customer']['customer_firstname']),0,1).substr(strtolower($_POST['Customer']['customer_lastname']),0,1).substr(strtolower($_POST['Customer']['gender']),0,1).strtotime(date('r'));
            $modelCustomer->customer_firstname = strtolower($_POST['Customer']['customer_firstname']);
            $modelCustomer->customer_middlename = strtolower($_POST['Customer']['customer_middlename']);
            $modelCustomer->customer_lastname = strtolower($_POST['Customer']['customer_lastname']);
            $modelCustomer->gender = strtolower(($_POST['Customer']['gender'] == 0)?'male':'female');
            $modelCustomer->customer_status_id = 1;
            //echo '<pre>';var_dump(Yii::$app->user->identity->id);die;
            $modelCustomer->save(false);
            
            $customerId = $modelCustomer->getPrimaryKey();
            $user_id = Yii::$app->user->identity->id;
            $employee = Employee::find()->where(['user_id'=>$user_id])->one();
            $teamId = 1;
            
            $model->employee_id = $employee->id;
            $model->team_id = $teamId;
            $model->customer_id = $customerId;
            $model->sales_code = substr(strtolower($employee->firstname),0,1).substr(strtolower($employee->lastname),0,1).$teamId.strtotime(date('r'));
            $model->sales_status_id = 1;
            $model->save(false);
            
            
            $salesId = $model->getPrimaryKey();
            $product_id = $_POST['product_id'];
            foreach($product_id as $key=>$item){
                //echo $item;
                $productSales = [
                    'sales_online_id' => $salesId,
                    'product_id' => $item,
                    'quantity' => $_POST['quantity'][$key],
                    'collectible_amount' => $_POST['collectible_amount'][$key],
                ];
                /*$modelProductSales->sales_online_id = $salesId;
                $modelProductSales->product_id = $item;
                $modelProductSales->quantity = $_POST['quantity'][$key];
                $modelProductSales->collectible_amount = $_POST['collectible_amount'][$key];*/
                
                Yii::$app->marubiella->createCommand()->insert('sales_product', $productSales)->execute();
            } //echo count($product_id);die;
            
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('crud/create', [
            'model' => $model,
            'modelCustomer' => $modelCustomer,
            'modelProductSales' => $modelProductSales,
            'customerType' => $customerType,
            'product' => $product,
            'barangay' => $barangay,
            'municipality' => $municipality,
            'province' => $province,
            'region' => $region,
            'salesStatus' => $salesStatus,
        ]);
    }

    /**
     * Creates a new SalesOnline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new SalesOnline();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing SalesOnline model.
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
     * Deletes an existing SalesOnline model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the SalesOnline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalesOnline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesOnline::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
