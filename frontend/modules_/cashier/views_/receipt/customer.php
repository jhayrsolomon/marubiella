<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrderOfPayment */
/* @var $form ActiveForm */

/*$this->title = 'Receipts';
$this->params['breadcrumbs'][] = $this->title;*/

$context = 'Official Receipts&nbsp;|&nbsp;Customer';
$this->title = 'OneLab | Official Receipts';
?>
<div class="ooplist" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                <!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="glyphicon glyphicon-file" title="Request"></a> button from the right side of the page to display the Transaction Request of the Customer&nbsp;&nbsp;***</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
                                    return Html::a(
                                        '',
                                        ['request'],
                                        [
                                            'title' => 'View Order-of-Payment',
                                            'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->customerId,
                                                'custName'=> $model->customerName,
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
</div><!-- ooplist -->
