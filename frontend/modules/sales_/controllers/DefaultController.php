<?php

namespace frontend\modules\sales\controllers;

use Yii;
use frontend\modules\models\SalesOnline;
use frontend\modules\models\SalesOnlineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\models\EmployeeDailyTimeRecord;
use frontend\modules\models\EmployeeDailyTimeRecordSearch;
use frontend\modules\models\Employee;


/**
 * Default controller for the `sales` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModelTimeRecord = new EmployeeDailyTimeRecordSearch();
        $user_id = Yii::$app->user->identity->id;
        $employee = Employee::find()->where(['user_id'=>$user_id])->one();
        $sales = SalesOnline::find()->where(['employee_id'=>$employee->id])->all();
        if(isset($_POST['date_timeinout'])){
            if($_POST['date_timeinout'] == 'time_all'){
                $timeRecordIn = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'in'])->all();
                $timeRecordOut = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'out'])->all();
            }
            if($_POST['date_timeinout'] == 'time_week'){
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
            }
        } else {
            $d = date('d',strtotime('last Monday'));
            $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
            $start_Date = date('Y-m-d',strtotime('last Monday'));

            $timeRecordIn = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'in'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
            $timeRecordOut = EmployeeDailyTimeRecord::find()->where(['user_id'=>$user_id, 'in_out'=>'out'])->andWhere(['between','today_date', $start_Date, $end_Date])->all();
        }
        //$timeRecord = $searchModelTimeRecord->searchTimeRecordByUserId();

        return $this->render('index', [
            'timeRecordIn' => $timeRecordIn,
            'timeRecordOut' => $timeRecordOut,
            'sales' => $sales,
            'employee' => $employee,
        ]);
    }
}
