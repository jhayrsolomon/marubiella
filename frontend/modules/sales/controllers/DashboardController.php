<?php

namespace frontend\modules\sales\controllers;

use Yii;
use frontend\modules\models\EmployeeDailyTimeRecord;
use frontend\modules\models\EmployeeDailyTimeRecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\models\Employee;
use frontend\modules\models\SalesOnline;
use frontend\modules\models\SalesOnlineSearch;
use frontend\modules\models\SalesProduct;
//use yii\db\Query;

/**
 * DashboardController implements the CRUD actions for EmployeeDailyTimeRecord model.
 */
class DashboardController extends Controller
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
     * Lists all EmployeeDailyTimeRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModelTimeRecord = new EmployeeDailyTimeRecordSearch();
        $user_id = Yii::$app->user->identity->id;
        $employee = Employee::find()->where(['user_id'=>$user_id])->one();
        //$sales = SalesOnline::find()->where(['employee_id'=>$employee->id])->all();
        if(isset($_POST['date_timeinout'])){
            if($_POST['date_timeinout'] == 'time_all'){
                $timeRecordIn = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'in'])->all();
                $timeRecordOut = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'out'])->all();
            } else {
                if($_POST['date_timeinout'] == 'time_week'){
                    $d = date('d',strtotime('last Monday'));
                    $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
                    $start_Date = date('Y-m-d',strtotime('last Monday'));
                }
                if($_POST['date_timeinout'] == 'time_month'){
                    $start_Date = date_format(date_create(date('Y-m-').'1'), 'Y-m-d');
                    $end_Date = date('Y-m-t');
                }
                $timeRecordIn = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'in'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
                $timeRecordOut = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'out'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
            }
            /*if($_POST['date_timeinout'] == 'time_week'){
                $d = date('d',strtotime('last Monday'));
                $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
                $start_Date = date('Y-m-d',strtotime('last Monday'));
                
                $timeRecordIn = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'in'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
                $timeRecordOut = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'out'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
            }
            if($_POST['date_timeinout'] == 'time_month'){
                $start_Date = date_format(date_create(date('Y-m-').'1'), 'Y-m-d');
                $end_Date = date('Y-m-t');
                $timeRecordIn = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'in'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
                $timeRecordOut = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'out'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
            }*/
        } else {
            $d = date('d',strtotime('last Monday'));
            $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
            $start_Date = date('Y-m-d',strtotime('last Monday'));

            $timeRecordIn = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'in'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
            $timeRecordOut = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'out'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
        }
        
        if(isset($_POST['date_sales'])){
            if($_POST['date_sales'] == 'sales_all'){
                //$sales = SalesOnline::find()->where(['employee_id'=>$employee->id])->all();
                $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 2 and sales_online.employee_id = '.$employee->id.' GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
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
                $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 2 and sales_online.date_created between "'.$start_Date.'" and "'.$end_Date.'" and sales_online.employee_id = '.$employee->id.' GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
            }
            /*if($_POST['date_sales'] == 'sales_week'){
                $d = date('d',strtotime('last Monday'));
                $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
                $start_Date = date('Y-m-d',strtotime('last Monday'));
                
                //$sales = SalesOnline::find()->where(['employee_id'=>$employee->id])->andWhere(['between', 'date_created', $start_Date, $end_Date])->all();
                $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 1 and sales_online.date_created between "'.$start_Date.'" and "'.$end_Date.'" GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
            }
            if($_POST['date_sales'] == 'sales_month'){
                $start_Date = date_format(date_create(date('Y-m-').'1'), 'Y-m-d');
                $end_Date = date('Y-m-t');
                
                //$sales = SalesOnline::find()->where(['employee_id'=>$employee->id])->andWhere(['between', 'date_created', $start_Date, $end_Date])->all();
                $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 1 and sales_online.date_created between "'.$start_Date.'" and "'.$end_Date.'" GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
            }*/
        } else {
            $d = date('d',strtotime('last Monday'));
            $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
            $start_Date = date('Y-m-d',strtotime('last Monday'));
            $sales = Yii::$app->marubiella->createCommand('SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id WHERE sales_online.sales_status_id = 2 and sales_online.date_created between "'.$start_Date.'" and "'.$end_Date.'" and sales_online.employee_id = '.$employee->id.' GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d") ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), "%Y-%m-%d"), sales_product.product_id ASC')->queryAll();
        }
        //$timeRecord = $searchModelTimeRecord->searchTimeRecordByUserId();
        /*SELECT from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), '%Y-%m-%d') as pdate, sales_product.product_id, SUM(sales_product.quantity) as sum_qty FROM sales_product
        INNER JOIN sales_online ON sales_product.sales_online_id = sales_online.id
        WHERE sales_online.sales_status_id = 1
        GROUP BY sales_product.product_id, from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), '%Y-%m-%d') 
        ORDER BY from_unixtime( UNIX_TIMESTAMP(sales_product.date_created), '%Y-%m-%d'), sales_product.product_id ASC*/

        return $this->render('index', [
            'timeRecordIn' => $timeRecordIn,
            'timeRecordOut' => $timeRecordOut,
            'sales' => $sales,
            'employee' => $employee,
        ]);
    }
    
    public function actionAddtimerecord()
    {
        if(isset($_POST['stat']) && isset($_POST['timedate'])){
            $model = new EmployeeDailyTimeRecord();
            $user_id = Yii::$app->user->identity->id;
            $employee_id = Yii::$app->user->identity->id;
            $row = $model->find()->where(['user_id'=>$user_id, 'in_out'=>$_POST['stat'], 'today_date'=>date('Y-m-d')])->all();
            if(count($row)>0){
                $message = 'You are already Timed '.$_POST['stat'];
                return $message;
            } else {
                if($_POST['stat'] == 'in'){
                    if(strtotime($_POST['timedate']) >= strtotime(date('H:i:s', mktime(8, 30, 0)))){
                        $remarks = 'late';
                    } else {
                        $remarks  = 'On Time';
                    }
                } 
                if($_POST['stat'] == 'out'){
                    if(strtotime($_POST['timedate']) <= strtotime(date('H:i:s', mktime(17, 0, 0)))){
                        $remarks = 'Undertime';
                    } else {
                        $remarks  = 'On Time';
                    }
                }
                $model->user_id = $user_id;
                $model->employee_id = $employee_id;
                $model->today_date = date('Y-m-d');
                $model->in_out = $_POST['stat'];
                $model->time_report = $_POST['timedate'];
                $model->remark = $remarks;
                $model->save();
                $message = 'Successfully Timed '.$_POST['stat'];
                return $message;
            }
        }
    }

    /**
     * Displays a single EmployeeDailyTimeRecord model.
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
     * Creates a new EmployeeDailyTimeRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new EmployeeDailyTimeRecord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing EmployeeDailyTimeRecord model.
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
     * Deletes an existing EmployeeDailyTimeRecord model.
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
     * Finds the EmployeeDailyTimeRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmployeeDailyTimeRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmployeeDailyTimeRecord::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
