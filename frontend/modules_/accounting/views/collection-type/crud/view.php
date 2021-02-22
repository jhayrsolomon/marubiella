<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\CollectionType */

$this->title = 'OneLab';
$context = 'Collection Type: '.$model->collection_name;
$this->params['breadcrumbs'][] = ['label' => 'Collection Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>

<div class="collection-type-view" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>*** Description ***</i>
                <!--<i>***&nbsp;&nbsp;Click the <a class="btn-success btn-xs glyphicon glyphicon-file" title="Request"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">Create Request</i> button, from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to display the Transaction Request of the Customer&nbsp;&nbsp;***</i>-->
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
                        //'fund_id',
                        'collection_name',
                        [
                            'label' => 'Fund Cluster',
                            'options' => ['style' => 'color: #3c8dbc;'],
                            'value' => $model->fund->fund_name.' ('.$model->fund->fund_code.')',
                        ],
                        'collection_code',
                        'uacs',
                        'subject_code',
                        'uacs_desc',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
