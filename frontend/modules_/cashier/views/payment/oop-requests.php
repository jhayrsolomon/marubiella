<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use frontend\modules\models\cashier\search\PaymentType as PaymentTypeSearch;
use frontend\modules\models\ulims\search\CustomerDetails as CustomerDetailsSearch;
use frontend\modules\models\accounting\search\CollectionType as CollectionTypeSearch;
use frontend\modules\models\accounting\search\Service as ServiceSearch;
/* @var $this yii\web\View */

$modelType = new PaymentTypeSearch();
$payment = $modelType->getTypeByCode($_GET['type_code']);

$modelCustomer = new CustomerDetailsSearch();
$customer = $modelCustomer->getDetailsById($_GET['id']);


/*if(oop_type_id / code == 1 / TA){
    $modelCustomer = new $reques_data->model;
    $customer = $modelCustomer->getCustomerById($_GET['id']);
} else {
    $modelCustomer = new $reques_data->model;
    $customer = $modelCustomer->getCustomerById($_GET['id']);
}

$modelCustomer = new CustomerDetailsSearch();
$customer = $modelCustomer->getCustomerById($_GET['id'])*/

$this->title = 'Onelab';
$context = 'Payment: ';
$params = 'OOP Request';
$this->params['breadcrumbs'][] = [
    'label' => $payment->description,
    'url' => [$payment->action]
];
$this->params['breadcrumbs'][] = [
    'label' => 'Customer',
    'url' => [
        'customer',
        'type_code' => $_GET['type_code'],
        'div_code' => $_GET['div_code'],
    ]
];
$this->params['breadcrumbs'][] = $params;

?>

<div class="payment-customer" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).'&nbsp;'.$payment->description.'&nbsp;&#45;'.'&nbsp;'.$params; ?>
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
                    <legend class="legend-border">Fund Cluster
                        <div class="btn-group">
                            <?php
                                echo Html::a(
                                    'General Fund (101)',
                                    [
                                        'oop-requests',
                                        'type_code' => $_GET['type_code'],
                                        'div_code' => $_GET['div_code'],
                                        'fund' => '101',
                                        'id' => $_GET['id'],
                                    ],
                                    [
                                        'title' => '',
                                        'class' => 'active btn btn-primary',
                                        'class' => ($_GET['fund'] == '101') ? 'active btn btn-primary' : 'btn btn-primary',
                                    ]
                                );
                                echo Html::a(
                                    'Trust Fund (184)',
                                    [
                                        'oop-requests',
                                        'type_code' => $_GET['type_code'],
                                        'div_code' => $_GET['div_code'],
                                        'fund' => '184',
                                        'id' => $_GET['id'],
                                    ],
                                    [
                                        'title' => '',
                                        'class' => 'active btn btn-primary',
                                        'class' => ($_GET['fund'] == '184') ? 'active btn btn-primary' : 'btn btn-primary',
                                    ]
                                );
                            ?>
                        </div>
                    </legend>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Check the <input type="checkbox" alt="Request" title="Request" readonly/> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">box</i>, from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Item Column</b> on the left most side of the page, you wish to include in <b>Official Receipt Request</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
        <form method="post" action="official-receipt">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" name="type_code" id="type_code" value="<?= $_GET['type_code']; ?>" />
            <input type="hidden" name="div_code" id="div_code" value="<?= $_GET['div_code'];?>" />
            <input type="hidden" name="fund_code" id="fund_code" value="<?= $_GET['fund'];?>" />
            <input type="hidden" name="customer_id" id="customer_id" value="<?= $_GET['id'];?>" />
            <div class="row">
                <div class="col-lg-12">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            [
                                'class' => '\kartik\grid\CheckboxColumn',
                                'name' => 'oop_id[]',
                                'checkboxOptions' => function ($model, $key, $index, $column) {
                                    return ['value' => $model->id];
                                },
                            ],
                            'transaction_num',
                            [
                                'header' => 'Fund Cluster',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => 'fund.fund_name',
                            ],
                            //'type_id',
                            [
                                'header' => 'Income Type',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => function($model){
                                    if($model->fund_id == 1){
                                        $req = CollectionTypeSearch::getType($model->type_id);
                                        $type = $req->collection_name;
                                    } if($model->fund_id == 2) {
                                        $req = ServiceSearch::getType($model->type_id);
                                        $type = $req->service_title;
                                    }
                                    return $type;
                                },
                            ],
                            //'total_amount',
                            [
                            'header' => 'Amount to Pay',
                            'headerOptions' => ['style' => 'color: #3c8dbc;'],
                            'value' => function($model){
                                return number_format($model->total_amount,2);
                            }
                        ],
                            [
                                'attribute' => 'oop_date',
                                'header' => 'OOP Date',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => function($model){
                                    return Datetime::createFromFormat('Y-m-d', $model->oop_date)->format('F d, Y');
                                },
                            ],
                            [
                                'header' => 'Overall Status',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => function($model){
                                    return $model->status->description.' - '.$model->paymentstatus->description;
                                }
                            ],
                        ],
                        'responsive'=>true,
                        'hover'=>true,
                    ]); ?>

                </div>
            </div>
            <div class="row" style="padding-bottom: 10px;" >
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Official Receipt Request</button>
                </div>
            </div>
        </form>
    </div>
</div>