<?php

use yii\helpers\Html;


$this->title = 'OneLab: e-Payment';
?>

<div class="order-of-payment-detials" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                OneLab - ePayment Portal
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <b>Click the Proceed Payment Button to continue.</b><br><i>*****You will be redirected to the LandBank LinkBiz Portal for processing your payment.*****</i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <b style="font-size: 24px;">?= $oop->customerdetails->customerName; ?></b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>?= $oop->customerdetails->address; ?></i><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>?= $oop->customerdetails->email; ?></i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <pre>
                    <?= print_r($details); ?>
                </pre>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="col-lg-12" style="background-color: #00adf1; color: white; font-size: 20px; padding:5px;">
                    <b>Particulars</b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <thead>
                        <tr style='color: #3c8dbc;'>
                            <th style='width: 7%;'>#</th>
                            <th style='width: 50%;'>OOP Number</th>
                            <th style='width: 20%;'>Date</th>
                            <th style='width: 20%;'>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">
                                <button type="submit" class="btn btn-success pull-right"><!--<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>-->&nbsp;Proceed Payment</button>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
