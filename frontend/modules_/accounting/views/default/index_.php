<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use frontend\modules\models\search\OopDetails as OopDetailsSearch;
use frontend\modules\models\search\CollectionType as CollectionTypeSearch;
use frontend\modules\models\search\Service as ServiceSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\search\OrderOfPayment */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*$this->title = 'Order Of Payments';
$this->params['breadcrumbs'][] = $this->title;*/

$context = 'Order Of Payment';
$this->title = 'Onelab';
?>
<div class="order-of-payment-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                <?= Html::a('Create Order Of Payment', ['orderofpayment/customer'], ['class' => 'btn btn-success']) ?>
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

                                $modelSearch = new OopDetailsSearch();
                                $dataProvider = $modelSearch->searchDetailsByOopId($model->id);
                                
                                if($model->fund_id == 1){
                                    $req = CollectionTypeSearch::getType($model->type_id);
                                    $type = $req->collection_name;
                                } if($model->fund_id == 2) {
                                    $req = ServiceSearch::getType($model->type_id);
                                    $type = $req->service_title;
                                }

                                return $this->render('oopExpandRow', ['dataProvider' => $dataProvider, 'fund' => $model->fund->fund_name, 'type' => $type]);
                            },
                        ],
                        /*['class' => 'yii\grid\SerialColumn'],

                        'id',*/
                        'transaction_num',
                        [
                            'header' => 'Customer Name',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 25%'],
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
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%'],
                            'value' => function($model){
                                return number_format($model->total_amount,2);
                            }
                        ],
                        /*'total_amount',*/
                        //'total_balance',
                        [
                            'header' => 'Status',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%'],
                            'value' => 'status.description',
                        ],
                        [
                            'header' => 'Date Created',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%'],
                            'value' => function($model){
                                return Datetime::createFromFormat('Y-m-d', $model->date_op)->format('F d, Y');
                            }
                        ],
                        //'date_op',
                        //'create_time',

                        //['class' => 'yii\grid\ActionColumn'],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%',],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return Html::a(
                                        '',
                                        ['update_oop'],
                                        [
                                            'title' => 'Update',
                                            'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id,
                                            ],
                                            'class' => 'btn-primary btn-xs glyphicon glyphicon-edit',
                                        ]
                                    ).'&nbsp;'.Html::a(
                                        '',
                                        ['delete_op'],
                                        [
                                            'title' => 'Delete',
                                            'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id,
                                            ],
                                            'class' => 'btn-danger btn-xs glyphicon glyphicon-remove',
                                        ]
                                    );
                                }
                            ]
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>