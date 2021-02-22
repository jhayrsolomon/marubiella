<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\search\OrderOfPayment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$context = 'Receipt';
$this->title = 'OneLab | Receipt';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="receipt-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" style="background-color:#00adf1; color: white;">
                <h2><b>
                    Manage<!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                    <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
                </b></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                <?= Html::a('Create Order Of Payment', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= GridView::widget([
                    'moduleId' => 'gridview',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'transaction_num',
                        'customer_id',
                        'total_amount',
                        'total_balance',
                        'status_id',
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width:100px;color:#3c8dbc'],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return Html::a(
                                        '',
                                        ['create'],
                                        [
                                            'title' => 'Create Request',
                                            'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->id,
                                                'custName'=> $model->customer_id,
                                            ],
                                            'class' => 'btn-success btn-xs glyphicon glyphicon-file',
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
