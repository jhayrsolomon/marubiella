<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = 'OneLab';
$context = 'Official Receipt Number: ';
$this->params['breadcrumbs'][] = [
    'label' => $payment->description,
    'url' => [$payment->action]
];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>
<!--<style>
    div{
        background-color: darkgoldenrod #7cca62
    }
</style>-->

<div class="order-of-payment-view" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
                : <?= $model->or_number; ?>
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
            <div class="col-lg-12">
                <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <thead>
                        <tr>
                            <th style="background-color: darkgoldenrod; color: white;" colspan="7">Order of Payment Details</th>
                        </tr>
                        <tr style="color: #3c8dbc; font-weight: bold;">
                            <th style="width: 3%; ">#</th>
                            <th>OOP Reference Number</th>
                            <th>TSR Number</th>
                            <th style='text-align: center;'>General Fund (101)</th>
                            <th style='text-align: center;'>Trust Fund (184)</th>
                            <th style='text-align: center;'>Balance</th>
                            <th style='text-align: center;'>Amount to Pay</th>
                            <!--<th style='text-align: center;'>Subtotal</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $itemCount = count($oopDetails);
                            $general = 0;
                            $trust = 0;
                            $balance = 0;
                            $subtotal = 0;
                            $total = 0;
                            foreach($oopDetails as $key=>$item){
                                $general += $item[1];
                                $trust += $item[2];
                                $balance += $item[3];
                                $subtotal += $item[4];
                                $total += $subtotal;
                                echo"
                                    <td rowspan='".$itemCount."'>".($key+1)."</td>
                                    <td rowspan='".$itemCount."'>".$item[0]."</td>
                                    <td>".(($requestData->request_num == 'requestRefNum') ? $list[$key]->requestRefNum : $list[$key]->reference_number)."</td>
                                    <td class='text-center'>".number_format($item[1], 2)."</td>
                                    <td class='text-center'>".number_format($item[2], 2)."</td>
                                    <td class='text-center'>".number_format($item[3], 2)."</td>
                                    <td class='text-center'>".number_format($item[4], 2)."</td>
                                ";
                                /*<td rowspan='".$itemCount."'>".number_format($subtotal, 2)."</td>*/
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align: right;">Total</th>
                            <th style="text-align: center;"><?= number_format($general, 2);?></th>
                            <th style="text-align: center;"><?= number_format($trust, 2);?></th>
                            <th style="text-align: right;">Total Balance</th>
                            <th style="color: red; text-align: center; background-color: #eeeeee;">
                                <?= number_format($balance, 2);?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5"></th>
                            <th style="text-align: right;">Total Amount to Pay</th>
                            <th style='text-align: center; color: blue; background-color: #eeeeee;'>
                                <?= number_format($total, 2);?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <thead>
                        <tr style="background-color: cornflowerblue; color: white; font-weight: bold; padding: 5px;">
                            <th colspan="2">Particulars</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style='width: 25%; color: #3c8dbc; font-weight: bold;'>LDC Number</th>
                            <td style='width: 75%; font-weight: bold; background-color: white; color: blue;'>
                                <div class="col-lg-12">
                                    <div class="form-group col-lg-6"><?= $ldc->ldc_code; ?></div>
                                    <div class="form-group col-lg-6"><?= $ldc->ldc_date; ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style='color: #3c8dbc; font-weight: bold;'>OR Number</th>
                            <td style="color:red; font-weight: bold; background-color: white;">
                                <div class="form-group col-lg-12">
                                    <div class="col-lg-6"><?= $model->or_number; ?></div>
                                    <div class="col-lg-6"><?= $model->created_date; ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style='color: #3c8dbc; font-weight: bold;'>OR Category</th>
                            <td><?= $category->category; ?></td>
                        </tr>
                        <tr>
                            <th style='color: #3c8dbc; font-weight: bold;'>Fund Cluster</th>
                            <td><?= $fund->fund_name; ?></td>
                        </tr>
                        <tr>
                            <th style='color: #3c8dbc; font-weight: bold;'>Nature of Collection</th>
                            <td><?= $type; ?></td>
                        </tr>
                        <tr>
                            <th style='color: #3c8dbc; font-weight: bold;'>Payor Name</th>
                            <td><?= $model->payor_name; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <table id="payment" class="table" width="100%">
                    <thead>
                        <tr style="background-color: cornflowerblue; color: white; font-weight: bold; padding: 5px;">
                            <th width="20%">Mode of Payment</th>
                            <th width="25%" class="text-center">General Fund (101)</th>
                            <th width="25%" class="text-center">Trust Fund (184)</th>
                            <th width="25%" class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total = 0;
                            $totalGeneral = 0;
                            $totalTrust = 0;
                            foreach($particulars as $key=>$item){
                                $subTotal = $item->general_amount+$item->trust_amount;
                                $totalGeneral += $item->general_amount;
                                $totalTrust += $item->trust_amount;
                                $total += $subTotal;
                                echo "<tr>
                                    <td>".$mode[$key]->description."</td>
                                    <td class='text-center'>".number_format($item->general_amount, 2)."</td>
                                    <td class='text-center'>".number_format($item->trust_amount, 2)."</td>
                                    <td class='text-center'>".number_format($subTotal, 2)."</td>
                                </tr>";
                                
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total Amount</th>
                            <th class='text-center'><?= number_format($totalGeneral,2); ?></th>
                            <th class='text-center'><?= number_format($totalTrust,2); ?></th>
                            <th class='text-center'><?= number_format($total,2); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label style="color: #3c8dbc;" for="remark">Remarks:</label>
                    <?= $model->remarks; ?>
                </div>
            </div>    
        </div>
        <?php
            foreach($particulars as $key=>$item){
                if($item->mode_of_payment_id == 2){
                    echo"<div class='row'>
                        <div class='col-lg-12'>
                            <table class='kv-grid-table table table-hover table-bordered table-striped kv-table-wrap'>
                                <thead>
                                    <tr style='background-color: cornflowerblue; color: white;'>
                                        <th colspan='7' style='font-weight: bold; padding: 5px; vertical-align: middle'>Check Details</th>
                                    </tr>
                                    <tr style='color: #3c8dbc; font-weight: bold;'>
                                        <th style='width: 2%;'>#</th>
                                        <th style='width: 14%;'>Check Type</th>
                                        <th style='width: 22%;'>Bank Name</th>
                                        <th style='width: 22%;'>Branch Name</th>
                                        <th style='width: 14%;'>Check Number</th>
                                        <th style='width: 13%;'>Check Date</th>
                                        <th style='width: 13%;'>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                    foreach($modeOfPaymentDetails['check'] as $keyCheck=>$check){
                                        echo "<tr>
                                            <td>".($keyCheck+1)."</td>
                                            <td>".$check->check_type_id."</td>
                                            <td>".$check->bank_name."</td>
                                            <td>".$check->bank_branch."</td>
                                            <td>".$check->check_number."</td>
                                            <td>".$check->check_date."</td>
                                            <td>".number_format($check->amount,2)."</td>
                                        </tr>";
                                    }
                                echo "</tbody>
                            </table>
                        </div>    
                    </div>";
                }
                if($item->mode_of_payment_id == 4){
                    echo"<div class='row'>
                        <div class='col-lg-12'>
                            <table class='kv-grid-table table table-hover table-bordered table-striped kv-table-wrap'>
                                <thead>
                                    <tr style='background-color: cornflowerblue; color: white;'>
                                        <th colspan='6' style='font-weight: bold; padding: 5px; vertical-align: middle;'>LDDAP Details</th>
                                    </tr>
                                    <tr style='color: #3c8dbc; font-weight: bold;'>
                                        <th style='width: 2%;'>#</th>
                                        <th style='width: 20%;'>LDDAP Name</th>
                                        <th style='width: 20%;'>Bank Branch Name</th>
                                        <th style='width: 20%;'>LDDAP Number</th>
                                        <th style='width: 19%;'>LDDAP Date</th>
                                        <th style='width: 19%;'>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                    foreach($modeOfPaymentDetails['lddap'] as $keyLddap=>$lddap){
                                        echo "<tr>
                                            <td>".($keyLddap+1)."</td>
                                            <td>".$lddap->bank_name."</td>
                                            <td>".$lddap->bank_branch."</td>
                                            <td>".$lddap->lddap_number."</td>
                                            <td>".$lddap->lddap_date."</td>
                                            <td>".number_format($lddap->lddap_amount,2)."</td>
                                        </tr>";
                                    }
                                echo "</tbody>
                            </table>
                        </div>    
                    </div>";
                }
            }
        ?>
        <div class="row" style="padding-bottom: 10px;">
            <div class="col-lg-12">
                <button type="button" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Print Payment Details</button>
                <button type="button" class="btn btn-warning pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Print OR</button>
            </div>
        </div>
    </div>
</div>