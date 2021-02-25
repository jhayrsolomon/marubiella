<?php

use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
use yii\widgets\Breadcrumbs;
use frontend\modules\models\Refprovince;
use frontend\modules\models\Refcitymun;
use frontend\modules\models\Refbrgy;
use frontend\modules\models\EmployeeAddress;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Employees Attendance';
?>
<div class="employee-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?= Html::a('Export Report', 
                    [''], [
                    'data-method' => 'POST',
                    'data-params' => [
                        'view_date_sales' => 'view_sales_week',
                    ],
                    'class' => ['btn btn-danger pull-right'],
                ]) ?>
                <?php
                    echo '<div class="input-group drp-container pull-right">';
                    echo DateRangePicker::widget([
                        'name'=>'date_range_1',
                        'value'=>date('01'.'-M-y').' to '.date('t-M-y'),
                        'convertFormat'=>true,
                        'useWithAddon'=>true,
                        'pluginOptions'=>[
                            'locale'=>[
                                'format'=>'d-M-y',
                                'separator'=>' to ',
                            ],
                            'opens'=>'left'
                        ]
                    ]);
                    echo '</div>';
                ?>
                <?php 
                    echo '<div class="input-group-append pull-right">
                        <span class="input-group-text">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                    </div>';
                    echo '<label class="control-label pull-right">Date Range</label>';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index) {
                                
                                return $this->render('attendanceExpandRow', [
                                    //'modelSales' => $modelSales,
                                ]);
                            },
                        ],
                        //'user_code',
                        'firstname',
                        'middlename',
                        'lastname',
                        'date_of_birth',
                        /*[
                            'header' => 'Address',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => function($model){
                                $employeeAddress = EmployeeAddress::find()->where(['id'=>$model->employee_address_id])->one();
                                $barangay = Refbrgy::find()->where(['id'=>$employeeAddress->barangay_id])->one();
                                $citymun = Refcitymun::find()->where(['id'=>$employeeAddress->municipality_id])->one();
                                $province = Refprovince::find()->where(['id'=>$employeeAddress->province_id])->one();
                                $address = $employeeAddress->prefix_address.', '.$barangay->brgyDesc.', '.$citymun->citymunDesc.', '.$province->provDesc;
                                return $address;
                            },
                        ],*/
                        //'employee_address_id',
                        'employee_affiliation_id',
                    ],
                    'responsive'=>true,
                    'hover'=>true,
                ]); ?>
            </div>
        </div>
    </div>
</div>
