<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\cashier\search\Payment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Onelab';
$context = 'Payment: ';

?>
<div class="payment-order-of-payment" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).'&nbsp;'.$payment->description; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                <div class="col-lg-3">
                    <?= Html::a(
                        'Check Out',
                        [
                            'customer', 
                            'type_code' => $payment->type_code,
                            'div_code' => 'STD',
                        ],
                        [
                            'title' => 'Receipt',
                            'class' => 'btn btn-success'
                        ]
                    ); ?>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="btn-primary btn-xs glyphicon glyphicon-edit" title="Update"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">Update</i>, <a class="btn-success btn-xs glyphicon glyphicon-eye-open" title="View"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">View</i> OR <a class="btn-danger btn-xs glyphicon glyphicon-remove" title="Delete"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">Delete</i> button,from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to perform desired action for the<!--to display the details of the--> <b>Over-the-Counter Receipt</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        //'or_number',
                        [
                            'attribute' => 'or_number',
                            'header' => 'Official Receipt Number',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => 'or_number',
                        ],
                        //'payment_method_id',
                        'total_amount',
                        //'created_date',
                        [
                            'attribute' => 'created_date',
                            'header' => 'Date Created',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 15%;'],
                            'value' => function($model){
                                return Datetime::createFromFormat('Y-m-d', $model->created_date)->format('F d, Y');
                            }
                        ],
                        //'timestamp',
                        //'status_id',
                        [
                            'header' => 'Status',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => 'status.description',
                        ],
                        //'remarks',

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
                                            'class' => 'btn-primary btn-xs glyphicon glyphicon-edit',
                                        ]
                                    ).'&nbsp;'.Html::a(
                                        '',
                                        ['view', 'id' => $model->id],
                                        [
                                            'title' => 'View',
                                            'class' => 'btn-success btn-xs glyphicon glyphicon-eye-open',
                                        ]
                                    ).
                                        //With user Privedge of admin
                                        '&nbsp;'.Html::a(
                                        '',
                                        [''],
                                        [
                                            'title' => 'Delete',
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
