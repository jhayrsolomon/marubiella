<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\accounting\search\PaymentHistory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OneLab';
$context = ucfirst(Yii::$app->controller->id);
?>
<div class="payment-history-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                ?= Html::a('Create Payment History', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>-->
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="btn-success btn-xs glyphicon glyphicon-eye-open" title="View"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">View</i> button,from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to perform desired action for the<!--to display the details of the--> <b>Payment History</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***Dispaly Payment History: Customer Name, email and address with TSR Number, Order of Payment and  Official Receipt Number***</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        [
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index) {

                                /*$modelSearch = new OopDetailsSearch();
                                $dataProvider = $modelSearch->searchDetailsByOopId($model->id);
                                
                                if($model->fund_id == 1){
                                    $req = CollectionTypeSearch::getType($model->type_id);
                                    $type = $req->collection_name;
                                } if($model->fund_id == 2) {
                                    $req = ServiceSearch::getType($model->type_id);
                                    $type = $req->service_title;
                                }

                                return $this->render('oopExpandRow', ['dataProvider' => $dataProvider, 'fund' => $model->fund->fund_name, 'type' => $type]);*/
                            },
                        ],
                        //'id',
                        [
                            //'attribute' => 'customerdetails.customerName',
                            'header' => 'Customer Name',
                            'headerOptions' => ['style' => 'color: #3c8dbc; width: 20%;'],
                            'value' => 'Customer Name',
                        ],
                        [
                            //'attribute' => 'customerdetails.email',
                            'header' => 'Email',
                            'headerOptions' => ['style' => 'color: #3c8dbc; width: 20%;'],
                            'value' => 'Email',
                        ],
                        [
                            //'attribute' => 'customerdetails.address',
                            'header' => 'Address',
                            'headerOptions' => ['style' => 'color: #3c8dbc; width: 20%;'],
                            'value' => 'Address',
                        ],
                        [
                            //'attribute' => 'customerdetails.address',
                            'header' => 'Email',
                            'headerOptions' => ['style' => 'color: #3c8dbc; width: 20%;'],
                            'value' => 'Email',
                        ],
                        'details_id',
                        'receipt_id',

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
