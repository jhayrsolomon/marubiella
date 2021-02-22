<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

$this->title = 'OneLab';
$context = 'Order Of Payment';
$this->params['breadcrumbs'][] = ['label' => 'Order Of Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>
<div class="order-of-payment-view" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
                : <?= $oop->transaction_num; ?>
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
                <b style="font-size: 24px;"><?= $oop->customerdetails->customerName; ?></b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?= $oop->customerdetails->address; ?></i><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?= $oop->customerdetails->email; ?></i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="col-lg-12" style="background-color: #00adf1; color: white; font-size: 20px; padding:5px;">
                    <b>Request Details</b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" >
                <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <thead>
                        <tr>
                            <th colspan="2" style='color: #3c8dbc; font-weight: bold; width: 23%;'>Fund Cluster</th>
                            <td style='width: 23%;'><?= $oop->fund->fund_name; ?></td>
                            <th style='color: #3c8dbc; font-weight: bold; width: 23%;'>Collection Type</th>
                            <td style='width: 23%;'><?= $type; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2" style='color: #3c8dbc; font-weight: bold; width: 23%;'>Date</th>
                            <td style='width: 23%;'><?= $oop->oop_date; ?></td>
                            <th style='color: #3c8dbc; font-weight: bold; width: 23%;'>Overall Status</th>
                            <td style='width: 23%;'><?= $oop->status->description.' - '.$oop->paymentstatus->description; ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2" style='color: #3c8dbc; font-weight: bold; width: 23%;'>Payment Method</th>
                            <td style='width: 23%;'><?= $oop->paymentmethod->description; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="6">&nbsp;</th>
                        </tr>
                        <tr style="color: #3c8dbc; font-weight: bold;">
                            <th>Item</th>
                            <th>Request Reference Number</th>
                            <th>101 (GF)</th>
                            <th>184 (TF)</th>
                            <th>Balance</th>
                            <th>Amount To Pay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total_balance = 0;
                            $total_amount = 0;
                            foreach($requestDetails as $key => $item){
                                $collect = $modelCollection->getDetailsById($oopDetails[$key]->id);
                                echo"
                                    <tr>
                                        <th>".($key+1)."</th>
                                        <td>".(($requestData->request_num == 'requestRefNum') ? $item->requestRefNum : $item->reference_number)."</td>
                                        <td>".number_format($collect->general_fund, 2)."</td>
                                        <td>".number_format($collect->trust_fund, 2)."</td>
                                        <td>".number_format($oopDetails[$key]->balance, 2)."</td>
                                        <td>".number_format(($oopDetails[$key]->amount-$oopDetails[$key]->balance), 2)."</td>
                                    </tr>
                                ";
                                $total_balance +=$oopDetails[$key]->balance;
                                $total_amount +=$oopDetails[$key]->amount;
                            }
                        ?>
                        <tr>
                            <td colspan="6"></td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <th style='color: #3c8dbc; font-weight: bold; width: 23%;'>Total Amount To be Paid</th>
                            <th style='width: 23%;'><?= number_format($total_amount, 2); ?></th>
                            
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <th style='color: #3c8dbc; font-weight: bold; width: 23%;'>Total Balance</th>
                            <th style='width: 23%; color: red'><?= number_format($total_balance, 2); ?></th>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <th style='color: #3c8dbc; font-weight: bold; width: 23%;'>Total Amount To Pay</th>
                            <th style='width: 23%; color: blue'><?= number_format($oop->total_amount, 2); ?></th>
                            
                        </tr>
                    </tbody>
                    <footer>
                        <tr>
                            <td colspan="6"></td>
                        </tr>
                        <tr style="color: #3c8dbc; font-weight: bold;">
                            <th colspan="6">Remarks</th>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding:20px;">
                                <?= $oop->remarks; ?>
                            </td>
                        </tr>
                    </footer>
                </table>
                <!--<div class="row">
                    <div class="col-lg-12" style="text-align: right;padding-bottom: 20px;">
                        ?= Html::a('Print Order of Payment',
                            ['print-oop'],
                            [
                                'data-method' => 'POST',
                                'data-params' => [
                                    'eppDetails' => $eppDetails,
                                    'merchant' => $merchant,
                                    'oopDetails' => $oopDetails,
                                    'paymentDetails' => $paymentDetails,

                                ],
                                'class' => 'btn btn-primary'
                            ]
                        ); ?>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
