<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\view\CustomerDetails */
/* @var $form ActiveForm */

$params = ucfirst(Yii::$app->controller->action->id);
$this->title = 'OneLab';
$this->params['breadcrumbs'][] = ['label' => 'Request', 'url' => ['index']];
$this->params['breadcrumbs'][] = $params;
$context = 'Technical Services&nbsp;&#45;'.ucfirst(Yii::$app->controller->id);
?>
<div class="request-customer" style="background-color: white;">
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
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="btn-success btn-xs glyphicon glyphicon-file" title="Request"></a> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">Create Request</i> button, from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Action Column</b> on the right most side of the page, to display the Transaction Request of the Customer&nbsp;&nbsp;***</i>
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
                                    return Html::a(
                                        '',
                                        ['create', 'id'=> $model->customerId],
                                        [
                                            'title' => 'Create Request',
                                            /*'onclick' => 'customerSession('.$model->customerId.')',*/
                                            /*'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> $model->customerId,
                                                'custName'=> $model->customerName,
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
    
    <!--?php $form = ActiveForm::begin(); ?>

    
        <div class="form-group">
            ?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    ?php ActiveForm::end(); ?>-->

</div><!-- request-customer -->
