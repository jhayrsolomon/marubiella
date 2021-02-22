<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OopType */

$this->title = 'OneLab';
$context = 'Order-of-Payment: ';
$this->params['breadcrumbs'][] = ['label' => 'Order-of-Payment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>
<div class="oop-type-view" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).'&nbsp;'.$model->type_code; ?>
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
                        'id',
                        'type_code',
                        'description',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['', 'id' => $model->id], [
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

    <h1><?= Html::encode($this->title) ?></h1>

    

    

</div>
