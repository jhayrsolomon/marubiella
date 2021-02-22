<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use frontend\modules\models\accounting\search\OopType as OopTypeSearch;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrderOfPayment */

$modelType = new OopTypeSearch();
$oop = $modelType->getTypeByCode($type_code);

$this->title = 'Onelab';
$params = ucfirst(Yii::$app->controller->action->id);
$context = 'Order Of Payment&#58;&nbsp;';
$this->params['breadcrumbs'][] = [
    'label' => $oop->description,
    'url' => [$oop->action]
];
$this->params['breadcrumbs'][] = $params;

\yii\web\YiiAsset::register($this);
?>
<div class="order-of-payment-view" style="background-color: white;">
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
            <div class="col-lg-12">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                        'transaction_num',
                        'customer_id',
                        'fund_id',
                        'type_id',
                        'total_amount',
                        'total_balance',
                        'status_id',
                        'date_op',
                        //'create_time',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <!--?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    ?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>-->
                    <?= Html::a(
                        'Update',
                        ['update', 'type_code' => $type_code, 'id' => $model->id],
                        [
                            'title' => 'Update',
                            /*'data-method' => 'POST',
                            'data-params' => [
                                'id'=> $model->id
                            ],*/
                            'class' => 'btn btn-primary'
                        ]
                    ) ?>
                    <?= Html::a(
                        'Delete',
                        [''],
                        [
                            'title' => 'Delete',
                            /*'data-method' => 'POST',
                            'data-params' => [
                                'id'=> $model->id
                            ],*/
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]
                    ) ?>
                </p>
            </div>
        </div>
    </div>
</div>
