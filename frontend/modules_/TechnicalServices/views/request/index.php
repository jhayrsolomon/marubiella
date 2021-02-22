<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\technical\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$params = 'Request';
$this->title = 'OneLab';
$context = 'Technical Services&nbsp;&#45;'.$params;
?>
<div class="request-index" style="background-color: white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                <div class="col-lg-3">
                    <?= Html::a('Create Request', ['customer'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="btn-primary btn-xs glyphicon glyphicon-edit" title="Request"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">Update</i> and <a class="btn-success btn-xs glyphicon glyphicon-eye-open" title="View"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">View</i> button,from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to display the details of the <b>Technical Service Request</b>&nbsp;&nbsp;***</i>
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

                        //'id',
                        'reference_number',
                        [
                            //'attribute' => 'customer_id',
                            'header' => 'Customer Name',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 25%'],
                            'value' => 'customerdetails.customerName',
                        ],
                        'request_date',
                        'due_date',
                        'total_amount',
                        //'customer_id',
                        //'fund_id',
                        //'type_id',
                        //'status_id',
                        //'created_date',
                        [
                            'header' => 'Status',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 10%'],
                            'value' => 'status.description',
                        ],

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
                                                'id'=> $model->id,
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
                                                'id'=> $model->id,
                                            ],*/
                                            'class' => 'btn-success btn-xs glyphicon glyphicon-eye-open',
                                        ]
                                    );//.
                                        //With user Privedge of admin
                                        /*'&nbsp;'.Html::a(
                                        '',
                                        ['delete'],
                                        [
                                            'title' => 'Delete',
                                            'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id,
                                            ],
                                            'class' => 'btn-danger btn-xs glyphicon glyphicon-remove',
                                        ]
                                    );*/
                                }
                            ]
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
