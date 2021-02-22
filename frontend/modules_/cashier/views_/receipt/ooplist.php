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

$context = 'Official Receipt&nbsp;|&nbsp;For Payment ';
$this->title = 'OneLab | Official Receipts';
?>
<div class="default-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                <!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        /*[
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index) {

                                $modelSearch = new OopDetailsSearch();
                                $dataProvider = $modelSearch->searchDetails($model->id);
                                
                                if($model->fund_id == 1){
                                    $req = CollectionTypeSearch::getType($model->type_id);
                                    $type = $req->collection_name;
                                } if($model->fund_id == 2) {
                                    $req = ServiceSearch::getType($model->type_id);
                                    $type = $req->service_title;
                                }

                                return $this->render('oopExpandRow', ['dataProvider' => $dataProvider, 'fund' => $model->fund->fund_name, 'type' => $type]);
                            },
                        ],*/
                        /*[
                            'class' => '\kartik\grid\CheckboxColumn',
                            'name' => 'requestId[]',
                            'checkboxOptions' => function ($model, $key, $index, $column) {
                                return ['value' => $model->id];
                            },
                        ],*/
                        /*['class' => 'yii\grid\SerialColumn'],

                        'id',*/
                        //'id',
                        'transaction_num',
                        [
                            'header' => 'Customer Name',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 25%;'],
                            'value' => 'customerdetails.customerName',
                        ],
                        [
                            'header' => 'Amount to Pay',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%'],
                            'value' => function($model){
                                return number_format($model->total_amount,2);
                            }
                        ],
                        [
                            'header' => 'Fund',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%;'],
                            'value' => 'fund.fund_name',
                        ],
                        [
                            'header' => 'Type',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 15%;'],
                            'value' => function ($model){ 
                                if($model->fund_id == 1){
                                    $req = CollectionTypeSearch::getType($model->type_id);
                                    return $req->collection_name;
                                } else {
                                    $req = ServiceSearch::getType($model->type_id);
                                    return $req->service_title;
                                }
                            },
                        ],
                        //'total_balance',
                        /*[
                            'header' => 'Status',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 5%'],
                            'value' => 'status.description',
                        ],*/
                        [
                            'header' => 'OP Date',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 15%'],
                            'value' => function($model){
                                return Datetime::createFromFormat('Y-m-d', $model->date_op)->format('F d, Y');
                            }
                        ],
                        //'create_time',

                        //['class' => 'yii\grid\ActionColumn'],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%;'],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return Html::a(
                                        '',
                                        ['create'],
                                        [
                                            'title' => 'Create Receipt',
                                            'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id,
                                            ],
                                            'class' => 'btn-primary btn-xs glyphicon glyphicon-edit',
                                        ]
                                    );
                                }
                            ]
                        ]
                    ],
                ]); ?>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                ?= Html::a('Create Receipt', ['orderofpayment/customer'], ['class' => 'btn btn-success float-right']) ?>
            </div>
        </div>-->
    </div>
</div>

<!--<div class="accounting-default-index">
    <h1>?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "?= $this->context->action->id ?>".
        The action belongs to the controller "?= get_class($this->context) ?>"
        in the "?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code>?= __FILE__ ?></code>
    </p>
</div>-->