<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\search\ReceiptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*$this->title = 'Receipts';
$this->params['breadcrumbs'][] = $this->title;*/

$context = 'Official Receipt';
$this->title = 'OneLab | Official Receipts';
?>
<div class="receipt-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage<!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                <?= Html::a('Create Receipt', ['ooplist'], ['class' => 'btn btn-success']) ?>
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
                        'op_id',
                        'or_num',
                        'mode_of_payment_id',
                        'date',
                        //'created_date',
                        //'status_id',

                        //['class' => 'yii\grid\ActionColumn'],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width:100px;color:#3c8dbc'],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return Html::a(
                                        '',
                                        ['update_receipt'],
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
                                        ['delete_receipt'],
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