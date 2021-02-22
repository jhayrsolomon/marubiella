<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\EmployeeDailyTimeRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employee Daily Time Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-daily-time-record-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employee Daily Time Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'employee_id',
            'today_date',
            'in_out',
            //'time_report',
            //'date_created',
            //'date_updated',
            //'date_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
