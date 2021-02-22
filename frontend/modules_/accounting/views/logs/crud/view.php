<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\accounting\OopLog */

$this->title = 'OneLab';
$context = 'Oop Logs: ';
$this->params['breadcrumbs'][] = ['label' => 'Oop Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>
<div class="oop-log-view" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).'&nbsp;'.$model->oop->transaction_num; ?>
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
                        //'oop_id',
                        [
                            'label' => 'OOP Reference Number',
                            'options' => ['style' => 'color: #3c8dbc;'],
                            'value' => $model->oop->transaction_num,
                        ],
                        'updated_fields',
                        'updated_by',
                        'updated_date',
                        'remarks',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
