<?php
//use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

$context = 'Order Of Payment&nbsp;|&nbsp;Customer&nbsp;|&nbsp;Request';
//$this->title = 'OneLab | Order-of-Payment';
//$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Request';
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="order-of-payment-request" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                <!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-top: 20px;">
                <fieldset class="legend-border">
                    <legend class="legend-border">Divisions
                        <div class="btn-group">
                            <button type="button" class="active btn btn-primary">Standards and Testing</button>
                            <button type="button" class="btn btn-primary">National Metrology</button>
                            <button type="button" class="btn btn-primary">Admatel</button>
                            <button type="button" class="btn btn-primary">Research and Development</button>
                        </div>
                    </legend>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div id="customerName" class="col-lg-12" style="font-style: bold; font-size: 24px;">
                <!--<label for="usr">Customer Name:</label>
                <input type="text" class="form-control" id="usr" value="?= Yii::$app->request->post('custName'); ?>">-->
                <h2><b>
                    <?= Yii::$app->request->post('custName'); ?>
                </b></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Click the <a class="glyphicon glyphicon-file" title="Request"></a> button from the right side of the page to display the Transaction Request of the Customer&nbsp;&nbsp;***</i>
            </div>
        </div>
        <form method="post" action="details" onsubmit="return addrequest();">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" name="custId" id="custId" value="<?= Yii::$app->request->post('id'); ?>">
            <input type="hidden" name="divId" id="divId" value="1">
            <input type="hidden" name="custName" id="custName" value="<?= Yii::$app->request->post('custName'); ?>" >
            <div class="row">
                <div class="col-lg-12">
                    <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'id' => 'request',
                            'moduleId' => 'gridview',
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            
                            'columns' => [
                                [
                                    'class' => '\kartik\grid\CheckboxColumn',
                                    'name' => 'requestId[]',
                                    'checkboxOptions' => function ($model, $key, $index, $column) {
                                        return ['value' => $model->id];
                                    },
                                ],
                                'requestRefNum',
                                'requestDate',
                                'total',
                                'reportDue',
                            ],
                        ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
            <div class="row" style="padding-bottom: 10px;" >
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;For Order of Payment</button>
                </div>
            </div>
        </form>
    </div>
</div>