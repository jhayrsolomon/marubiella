<?php

namespace frontend\modules\sales\controllers;

use Yii;
use frontend\modules\models\SalesOnline;
use frontend\modules\models\SalesOnlineSearch;
//use frontend\modules\models\Customer;
//use frontend\modules\models\CustomerType;
//use frontend\modules\models\Product;
//use frontend\modules\models\SalesProduct;
//use frontend\modules\models\Refbrgy;
//use frontend\modules\models\Refcitymun;
//use frontend\modules\models\Refprovince;
//use frontend\modules\models\Refregion;
//use frontend\modules\models\SalesStatus;
use frontend\modules\models\Employee;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManagerController implements the CRUD actions for SalesOnline model.
 */
class ManagerController extends Controller
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
                $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 2 and sales_online.date_created between "'.$start_Date.'" and "'.$end_Date.'" GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
            }
        } else {
            $d = date('d',strtotime('last Monday'));
            $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
            $start_Date = date('Y-m-d',strtotime('last Monday'));
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

    /**
     * Displays a single SalesOnline model.
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
