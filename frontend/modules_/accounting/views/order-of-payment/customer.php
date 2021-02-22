<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;

$this->title = 'OneLab';
$params = ucfirst(Yii::$app->controller->action->id);
$context = 'Order Of Payment&#58;&nbsp;';
$this->params['breadcrumbs'][] = [
    'label' => $oop->description,
    'url' => [$oop->action]
];
$this->params['breadcrumbs'][] = $params;

?>

<div class="order-of-payment-customer" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage<!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).$oop->description.'&nbsp;&#45;'.'&nbsp;'.$params; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false,
                    ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="btn-success btn-xs glyphicon glyphicon-file" title="Request"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">View Request</i> button, from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to display the Transaction Request of the Customer&nbsp;&nbsp;***</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= GridView::widget([
                    'moduleId' => 'gridview',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'customerName',
                        'address',
                        'email',
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width:100px;color:#3c8dbc'],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    /*$action = strtolower($_GET['type_code']);*/
                                    return Html::a(
                                        '',
                                        //[$action.'-request', 'type_code'=> $_GET['type_code'], 'div' => 'STD'],
                                        [
                                            'request',
                                            'type_code'=> $_GET['type_code'], 
                                            'id'=> $model->customerId,
                                            'div_code' => 'STD',
                                        ],
                                        [
                                            'title' => 'View Request',
                                            /*'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->customerId,
                                                'custName'=> $model->customerName,
                                                //'type_code'=> $_GET['type_code'],
                                            ],*/
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
