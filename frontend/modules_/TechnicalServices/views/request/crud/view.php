<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\technical\Request */

$params = ucfirst(Yii::$app->controller->action->id);
$this->title = 'OneLab';
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $params;
$context = 'Technical Services&nbsp;&#45;'.ucfirst(Yii::$app->controller->id);
//\yii\web\YiiAsset::register($this);
?>
<div class="request-view" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage<!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
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
                        'reference_number',
                        'request_date',
                        'due_date',
                        'total_amount',
                        //'customer_id',
                        //'div_id',
                        //'status_id',
                        [
                            'label' => 'Customer Name',
                            'options' => ['style' => 'color: #3c8dbc;'],
                            'value' => $model->customerdetails->customerName,
                        ],
                        [
                            'label' => 'Division',
                            'options' => ['style' => 'color: #3c8dbc;'],
                            'value' => $model->division->name,
                        ],
                        [
                            'label' => 'Division',
                            'options' => ['style' => 'color: #3c8dbc;'],
                            'value' => $model->status->description,
                        ],
                        'created_date',
                        'remarks',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </div>
    </div>
</div>
