<?php
//use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

$this->title = 'Onelab';
//$params = ucfirst(Yii::$app->controller->action->id);
$params = 'Transaction Request';
$context = 'Order Of Payment&#58;&nbsp;';

$this->params['breadcrumbs'][] = [
    'label' => $oop->description,
    'url' => [$oop->action]
];
$this->params['breadcrumbs'][] = [
    'label' => 'Customer',
    'url' => ['customer', 'type_code'=> $oop->type_code]
];
$this->params['breadcrumbs'][] = $params;
?>
<div class="order-of-payment-request" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).$oop->description.'&nbsp;&#45;'.'&nbsp;'.$params; ?>
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
                <b style="font-size: 24px;"><?= $customer->customerName; ?></b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?= $customer->address; ?></i><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?= $customer->email; ?></i>
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
                                            'request',
                                            'type_code' => $_GET['type_code'],
                                            'id' => $_GET['id'],
                                            'div_code' => $val->code,
                                        ],
                                        [
                                            'title' => $val->code,
                                            /*'data-method' => 'POST',
                                            'data-params' => [
                                                'id'=> Yii::$app->request->post('id'),
                                                'custName'=> Yii::$app->request->post('custName'),
                                            ],*/
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
                <i>***&nbsp;&nbsp;Check the <input type="checkbox" alt="Request" title="Request" readonly/> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">box</i>, from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Item Column</b> on the left most side of the page, you wish to include into the request for <b>Order-of-Payment</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
        <form method="post" action="details" onsubmit="return addrequest();">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" name="custId" id="custId" value="<?= $_GET['id']; ?>">
            <input type="hidden" name="div_code" id="div_code" value="<?= $_GET['div_code'];?>">
            <input type="hidden" name="type_code" id="type_code" value="<?= $_GET['type_code'];?>">
            <input type="hidden" name="custName" id="custName" value="<?= Yii::$app->request->post('custName'); ?>" >
            <div class="row">
                <div class="col-lg-12">
                    <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'header' => 'Item',
                                    'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 25%'],
                                    'class' => '\kartik\grid\CheckboxColumn',
                                    'name' => 'requestId[]',
                                    'checkboxOptions' => function ($model, $key, $index, $column) {
                                        return ['value' => $model->id];
                                    },
                                ],
                                'reference_number',
                                'request_date',
                                'total_amount',
                                'due_date',
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