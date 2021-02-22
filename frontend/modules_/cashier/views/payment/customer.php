<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use frontend\modules\models\cashier\search\PaymentType as PaymentTypeSearch;
use frontend\modules\models\agency\search\Division as DivisionSearch;
/* @var $this yii\web\View */

$modelType = new PaymentTypeSearch();
$payment = $modelType->getTypeByCode($_GET['type_code']);

$searchModel = new DivisionSearch();
$div = $searchModel->getAllDivisionDetails();

$this->title = 'Onelab';
$context = 'Payment: ';
$params = ucfirst(Yii::$app->controller->action->id);
$this->params['breadcrumbs'][] = [
    'label' => $payment->description,
    'url' => [$payment->action]
];
$this->params['breadcrumbs'][] = $params;

?>
<div class="payment-customer" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage<!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).$payment->description.'&nbsp;&#45;'.'&nbsp;'.$params; ?>
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
            <div class="col-lg-12" style="padding-top: 20px;">
                <fieldset class="legend-border">
                    <legend class="legend-border">Divisions
                        <div class="btn-group">
                            <?php
                                foreach($div as $val){
                                    echo Html::a(
                                        $val->code,
                                        [
                                            'customer',
                                            'type_code' => $_GET['type_code'],
                                            'div_code' => $val->code,
                                        ],
                                        [
                                            'title' => $val->code,
                                            'class' => ($_GET['div_code'] == $val->code) ? 'active btn btn-primary' : 'btn btn-primary',
                                            
                                        ]
                                    );
                                }
                            ?>
                        </div>
                    </legend>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="btn-success btn-xs fa fa-arrow-circle-right"  title="Request"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">View Request</i> button, from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to display <b>Order-of-Payment Requests</b>&nbsp;&nbsp;***</i>
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
                        [
                            'header' => 'Customer Name',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => 'customerdetails.customerName',
                        ],
                        [
                            'header' => 'Address',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => 'customerdetails.address',
                        ],
                        [
                            'header' => 'Email',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => 'customerdetails.email',
                        ],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width: 5%; color: #3c8dbc;'],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return Html::a(
                                        '',
                                        [
                                            'oop-requests',
                                            'type_code' => $_GET['type_code'],
                                            'div_code' => $_GET['div_code'],
                                            'id' => $model->customerdetails->customerId,
                                            'fund' => '101',
                                        ],
                                        [
                                            'title' => 'View OOP Request',
                                            /*'data-method' => 'POST',
                                            'data-params' => [
                                                'customer_id'=> $model->customerdetails->customerId,
                                            ],*/
                                            'class' => 'btn-success btn-sm fa fa-arrow-circle-right',
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
</div><!-- order-of-payment -->
