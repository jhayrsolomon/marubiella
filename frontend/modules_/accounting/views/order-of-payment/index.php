<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use frontend\modules\models\accounting\search\OopDetails as OopDetailsSearch;
use frontend\modules\models\accounting\search\CollectionType as CollectionTypeSearch;
use frontend\modules\models\accounting\search\Service as ServiceSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\search\OrderOfPayment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OneLab';
/*$params = 'Order Of Payments';
$this->params['breadcrumbs'][] = $params;*/
/*$modelType = new OopTypeSearch();
$oop = $modelType->getTypeByCode($type_code);*/
$context = 'Order Of Payment&#58;&nbsp;';
//$this->title = 'Onelab | Order-of-Payment';
?>
<div class="orderofpayment-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).$oop->description; ?>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12">
                ?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                ?>
            </div>
        </div>-->
        <div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                <div class="col-lg-3">
                    <?= Html::a(
                        'Create Order Of Payment',
                        ['customer', 'type_code'=> $oop->type_code],
                        [
                            'title' => 'Order of Payment',
                            /*'data-method' => 'POST',
                            'data-params' => [
                                'type_code'=> $type->type_code,
                            ],*/
                            'class' => 'btn btn-success'
                        ]
                    ); ?>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="btn-primary btn-xs glyphicon glyphicon-edit" title="Update"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">Update</i>, <a class="btn-success btn-xs glyphicon glyphicon-eye-open" title="View"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">View</i> OR <a class="btn-danger btn-xs glyphicon glyphicon-remove" title="Delete"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">Delete</i> button,from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to perform desired action for the<!--to display the details of the--> <b>Order-of-Payment Request</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    //'moduleId' => 'gridviewKrajee',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index) {
                                $modelSearch = new OopDetailsSearch();
                                $dataProvider = $modelSearch->searchDetailsByOopId($model->id);
                                
                                if($model->fund_id == 1){
                                    $req = CollectionTypeSearch::getType($model->type_id);
                                    $type = $req->collection_name;
                                } if($model->fund_id == 2) {
                                    $req = ServiceSearch::getType($model->type_id);
                                    $type = $req->service_title;
                                }
                                
                                

                                return $this->render('oopExpandRow', [
                                    'dataProvider' => $dataProvider,
                                    'fund' => $model->fund,
                                    'type' => $type,
                                    'type_id' => $model->oop_type_id,
                                ]);
                            },
                        ],
                        /*['class' => 'yii\grid\SerialColumn'],

                        'id',*/
                        [
                            
                            'attribute' => 'transaction_num',
                            'header' => 'OOP Number',
                            'headerOptions' => ['style' => 'color: #3c8dbc; width: 20%;'],
                            'value' => 'transaction_num',
                        ],
                        [
                            'header' => 'Customer Name',
                            'headerOptions' => ['style' => 'color: #3c8dbc; width: 30%;'],
                            'value' => 'customerdetails.customerName',
                        ],
                        /*[
                            'header' => 'Fund',
                            'headerOptions' => ['style' => 'width:100px;color:#3c8dbc'],
                            'value' => 'fund.fund_name',
                        ],
                        [
                            'header' => 'Type',
                            'headerOptions' => ['style' => 'width:100px;color:#3c8dbc'],
                            'value' => function ($model){ 
                                if($model->fund_id == 1){
                                    $req = CollectionTypeSearch::getType($model->type_id);
                                    return $req->collection_name;
                                } else {
                                    $req = ServiceSearch::getType($model->type_id);
                                    return $req->service_title;
                                }
                            },
                        ],*/
                        [
                            'header' => 'Amount to Pay',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => function($model){
                                return number_format($model->total_amount,2);
                            }
                        ],
                        /*'total_amount',*/
                        //'total_balance',
                        [
                            'header' => 'Overall Status',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%;'],
                            'value' => function($model){
                                return $model->status->description.' - '.$model->paymentstatus->description;
                            },
                        ],
                        [
                            'header' => 'Date Created',
                            'headerOptions' => ['style' => 'color: #3c8dbc; width: 15%;'],
                            'value' => function($model){
                                return Datetime::createFromFormat('Y-m-d', $model->oop_date)->format('F d, Y');
                            }
                        ],
                        //'date_op',
                        //'create_time',

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
                                        ['update', 'id' => $model->id],
                                        [
                                            'title' => 'Update',
                                            /*'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id
                                            ],*/
                                            'class' => 'btn-primary btn-xs glyphicon glyphicon-edit',
                                        ]
                                    ).'&nbsp;'.Html::a(
                                        '',
                                        ['view', 'id' => $model->id],
                                        [
                                            'title' => 'View',
                                            /*'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id
                                            ],*/
                                            'class' => 'btn-success btn-xs glyphicon glyphicon-eye-open',
                                        ]
                                    ).
                                        //With user Privedge of admin
                                        '&nbsp;'.Html::a(
                                        '',
                                        [''],
                                        [
                                            'title' => 'Delete',
                                            /*'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id,
                                            ],*/
                                            'class' => 'btn-danger btn-xs glyphicon glyphicon-remove',
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