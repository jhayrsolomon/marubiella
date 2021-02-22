<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = 'Onelab';
$params = 'Transaction Request';
$context = 'Order Of Payment&#58;&nbsp;';

$this->params['breadcrumbs'][] = [
    'label' => $oop->description,
    'url' => [$oop->action]
];
$this->params['breadcrumbs'][] = [
    'label' => 'Customer',
    'url' => [
        'customer',
        'type_code'=> $oop->type_code
    ]
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
                <i>***&nbsp;&nbsp;Check the <input type="checkbox" alt="Request" title="Request" readonly/> <i style="border-bottom: 1px dotted #000; text-decoration: none; color: gray">box</i>, from the <b style="border-bottom: 1px dotted #000; text-decoration: none; color: blue">Item Column</b> on the left most side of the page, you wish to include in <b>Order-of-Payment Request</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!--<table class="table table-striped">-->
                <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <thead style="color: #3c8dbc;">
                        <tr>
                            <th style='width: 5%;'>Item</th>
                            <th style='width: 35%;'>Request Reference Number</th>
                            <th style='width: 20%;'>Request Date</th>
                            <th style='width: 20%;'>Total</th>
                            <th style='width: 20%;'>Report Due</th>
                        </tr>
                        <tr id="w0-filters" class="filters skip-export">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5">No results found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>