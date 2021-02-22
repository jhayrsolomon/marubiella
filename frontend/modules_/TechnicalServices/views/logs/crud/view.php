<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\technical\RequestLog */

$this->title = 'OneLab';
$context = 'Technical Services Logs: ';
$this->params['breadcrumbs'][] = ['label' => 'Request Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>
<div class="request-log-view" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).'&nbsp;'; ?>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                ?= Html::a('Create Oop Log', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>-->
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***Description***</i>
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
                        'request_id',
                        'updated_fields',
                        'updated_by',
                        'updated_date',
                        'remarks',
                    ],
                ]) ?>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12">
                ?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                ?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>-->
    </div>
</div>
