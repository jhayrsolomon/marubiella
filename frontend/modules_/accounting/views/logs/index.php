<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

use frontend\modules\models\ulims\search\CustomerDetails as CustomerDetailsSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\accounting\search\OopLog */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OneLab';
$context = ucfirst(Yii::$app->controller->id);
?>
<div class="oop-log-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                ?= Html::a('Create Oop Log', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>-->
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="btn-success btn-xs glyphicon glyphicon-eye-open" title="View"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">View</i> button,from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to perform desired action for the<!--to display the details of the--> <b>Order of Payment Logs</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        //'oop_id',
                        [
                            'header' => 'OOP Reference Number',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => 'oop.transaction_num',
                        ],
                        [
                            'header' => 'Customer Name',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => function($model){
                                $searchModel = new CustomerDetailsSearch();
                                
                                $customer = $searchModel->getDetailsById($model->oop->customer_id);
                                
                                return $customer->customerName;
                            },
                        ],
                        [
                            'attribute' => 'updated_fields',
                            'headerOptions' => ['style' => 'word-wrap: break-word; width: 20%;'],
                        ],
                        //'updated_fields',
                        //'updated_by',
                        [
                            'header' => 'Staff Name',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => function(){
                                return 'Developer';
                            },
                        ],
                        'updated_date',
                        'remarks',

                        //['class' => 'yii\grid\ActionColumn'],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 7%',],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return Html::a(
                                        '',
                                        ['view', 'id'=> $model->id],
                                        [
                                            'title' => 'View',
                                            /*'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id
                                            ],*/
                                            'class' => 'btn-success btn-xs glyphicon glyphicon-eye-open',
                                        ]
                                    );
                                }
                            ]
                        ]
                    ],
                    'responsive'=>true,
                    'hover'=>true,
                ]); ?>
            </div>
        </div>
    </div>
</div>
