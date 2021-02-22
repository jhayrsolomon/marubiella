<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use frontend\modules\models\accounting\search\OrderOfPayment as OrderOfPaymentSearch;
use frontend\modules\models\accounting\search\CollectionType as CollectionTypeSearch;
use frontend\modules\models\accounting\search\Service as ServiceSearch;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\cashier\Payment */






$this->title = 'OneLab';
$context = 'Official Receipt: ';
$params = 'Create';
$this->params['breadcrumbs'][] = [
    'label' => $payment->description,
    'url' => [$payment->action]
];
$this->params['breadcrumbs'][] = [
    'label' => 'Customer',
    'url' => [
        'customer',
        'type_code' => $_POST['type_code'],
        'div_code' => $_POST['div_code'],
    ]
];
$this->params['breadcrumbs'][] = [
    'label' => 'Request',
    'url' => [
        'oop-requests',
        'type_code' => $_POST['type_code'],
        'div_code' => $_POST['div_code'],
        'fund' => $_POST['fund_code'],
        'id' => $_POST['customer_id'],
    ]
];
$this->params['breadcrumbs'][] = $params;

$today=date("Y-m-d");

$day = date('l', strtotime($today));

if($day == 'Friday'){
    $d = date('d')+2;
    $date = date('Y-m-').$d;
    $ldcDate = Datetime::createFromFormat('Y-m-d', $date)->format('F d, Y');
} else {
    $d = date('d')+1;
    $date = date('Y-m-').$d;
    $ldcDate = Datetime::createFromFormat('Y-m-d', $date)->format('F d, Y');
}
?>
<div class="payment-create" style="background-color: white;">
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
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Description<b></b>&nbsp;&nbsp;***</i>
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
            <div class="col-lg-12" >
                <div class="col-lg-12" style="background-color: #00adf1; color: white; font-size: 20px; padding:5px;">
                    <b>Official Receipt</b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" >
                <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <tbody>
                        <tr>
                            <td style="width: 40%">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style='width: 25%; color: #3c8dbc; font-weight: bold;'>LDC Number</th>
                                            <td style='width: 75%;'>
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-6">
                                                        <input class='form-control' style="color:red; font-weight: bold; background-color: white; color: blue;" type='text' name='ldc_nuumber' id='ldc_nuumber' value="<?= $ldc; ?>" readonly />

                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <input class='form-control' style="font-weight: bold; background-color: white;" type='text' name='ldc_date' id='ldc_date' placeholder="Date Bukas (Weekdays lang)" value="<?= $ldcDate; ?>" readonly />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style='color: #3c8dbc; font-weight: bold;'>OR Number</th>
                                            <td>
                                                <div class="form-group col-lg-12">
                                                    <div class="col-lg-6">
                                                        <input class='form-control' style="color:red; font-weight: bold; background-color: white;" type='text' name='or_number' id='or_number' value="<?= $orSeries->next_or; ?>" readonly />

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input class='form-control' style="font-weight: bold; background-color: white;" type='text' name='or_date' id='or_date' placeholder="Date Ngayon" value="<?= Datetime::createFromFormat('Y-m-d', $today)->format('F d, Y'); ?>" readonly />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style='color: #3c8dbc; font-weight: bold;'>OR Category</th>
                                            <th>
                                                <div class="form-group col-lg-12">
                                                    <select class='form-control' name='or_category' id='or_category' onchange="orCategory();" >
                                                        <?php
                                                            foreach($categoryList as $key=>$value){
                                                                echo "<option value='".$key."'>".$value."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style='color: #3c8dbc; font-weight: bold;'>Fund Cluster</th>
                                            <td><?= $oop->fund->fund_name; ?></td>
                                        </tr>
                                        <tr>
                                            <th style='color: #3c8dbc; font-weight: bold;'>Nature of Collection</th>
                                            <td><?= $incomeType; ?></td>
                                        </tr>
                                        <tr>
                                            <th style='color: #3c8dbc; font-weight: bold;'>Payor Name</th>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control' type='text' name='payor_name' id='payor_name' placeholder="Payor Name" />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="width: 60%">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="background-color: cornflowerblue; color: white;" colspan="6">Order of Payment Details</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 7%;">#</th>
                                            <th>OOP Reference Number</th>
                                            <th style='text-align: center;'>General Fund (101)</th>
                                            <th style='text-align: center;'>Trust Fund (184)</th>
                                            <th style='text-align: center;'>Balance</th>
                                            <th style='text-align: center;'>Amount to Pay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $totalBalance = 0;
                                            $totalAmount = 0;
                                            foreach($oopDetails as $key=>$item){
                                                $amount = $item[4]-$item[3];
                                                echo "<tr>
                                                    <td>".($key+1)."</td>
                                                    <td>".$item[0]."</td>
                                                    <td style='text-align: center;'>".$item[1]."</td>
                                                    <td style='text-align: center;'>".number_format($item[2], 2)."</td>
                                                    <td style='text-align: center;'>".number_format($item[3], 2)."</td>
                                                    <td style='text-align: center;'>".number_format($amount, 2)."</td>
                                                </tr>";
                                                $totalBalance +=$item[3];
                                                $totalAmount +=$amount;
                                            }
                                        ?>
                                        <tr>
                                            <th colspan="6"></th>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4"></th>
                                            <th style="text-align: right;">Total Balance</th>
                                            <th style="color: red; text-align: center;"><?= number_format($totalBalance, 2);?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="4"></th>
                                            <th style="text-align: right;">Total Amount to Pay</th>
                                            <th style='text-align: center;'><?= number_format($totalAmount, 2);?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <div>
                <?php
                    $searchModel = new OrderOfPaymentSearch();
                    $dataProvider = $searchModel->getOopRequestByCustomerIdDivisionIdFundCode(Yii::$app->request->queryParams, $_POST['customer_id'], $_POST['div_code'], $_POST['fund_code']);

                    /*echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'attribute' => 'transaction_num',
                                'header' => 'OOP Reference Number',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => 'transaction_num',
                            ],
                            [
                                'header' => 'Fund Cluster',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => 'fund.fund_name',
                            ],
                            [
                                'header' => 'Account Code',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => function($model){
                                    if($model->fund_id == 1){
                                        $req = CollectionTypeSearch::getType($model->type_id);
                                        $code = $req->collection_code.' ('.$req->uacs.'-'.$req->subject_code.')';
                                    } if($model->fund_id == 2) {
                                        $req = ServiceSearch::getType($model->type_id);
                                        $code = $req->service_code.' ('.$req->uacs.'-'.$req->subject_code.')';
                                    }
                                    return $code;
                                },
                            ],
                            [
                                'header' => 'Nature of Collection',
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
                            'total_amount',
                            [
                                'attribute' => 'date_op',
                                'header' => 'Date',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => 'date_op',
                            ],
                            [
                                'header' => 'Status',
                                'headerOptions' => ['style' => 'color: #3c8dbc;'],
                                'value' => 'status.description',
                            ],
                        ]
                    ]); */
                ?>
            </div>
        </div>
        <form name="payment-form" id="payent-form" method="post" action="create" onsubmit="return checkPayment();">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <div class="row">
                <div class="col-lg-12" >
                    <div class="col-lg-12" style="background-color: #00adf1; color: white; font-size: 20px; padding:5px;">
                        <b>Particulars</b>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6 pull-rigth">
                        <div class="row">
                            <div class="col-lg-12" style="padding:5px;">
                                <table id="payment" class="table" width="100%">
                                    <thead>
                                        <tr style="background-color: cornflowerblue; color: white; font-size: 16px; font-weight: bold; padding: 5px;">
                                            <th width="20%"></th>
                                            <th width="25%" class="text-center">General Fund (101)</th>
                                            <th width="25%" class="text-center">Trust Fund (184)</th>
                                            <th width="25%" class="text-center">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="payment_details">
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="mode_of_payment[]" id="cash" value="1" onclick="modeOfPayment('cash');"><b>Cash</b></label>
                                                </div>
                                            </th>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='cash form-control' type='number' name='cash_101' id='cash_101' onchange='' placeholder='0.00' readonly />
                                                </div>
                                            </td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='cash form-control' type='number' name='cash_184' id='cash_184' onchange='' placeholder='0.00' readonly />
                                                </div>
                                            </td>
                                            <th>
                                                <div class='form-group'>
                                                    <input class='form-control' type='number' name='total_cash' id='total_cash' value='0.00' readonly />
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="mode_of_payment[]" id="check" value="2" onclick="modeOfPayment('check');"><b>Check</b></label><br/>
                                                    <!--<div class="btn btn-sm btn-success" id="check" onclick="addPaymentDetails('check');" readonly><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Check Details</div>-->
                                                </div>
                                            </th>
                                            <td>
                                                <div class="form-group">
                                                    <input class="check form-control" type="number" name="check_101" id="check_101" onchange="" placeholder="0.00" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="check form-control" type="number" name="check_184" id="check_184" onchange="" placeholder="0.00" readonly>
                                                </div>
                                            </td>
                                            <th>
                                                <div class="form-group">
                                                    <input class="form-control" type="number" name="total_check" id="total_check" value="0.00" readonly>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="mode_of_payment[]" id="lddap" value="3" onclick="modeOfPayment('lddap');"><b>LDDAP-ADA</b></label>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="form-group">
                                                    <input class="lddap form-control" type="number" name="lddap_101" id="lddap_101" onchange="" placeholder="0.00" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="lddap form-control" type="number" name="lddap_184" id="lddap_184" onchange="" placeholder="0.00" readonly>
                                                </div>
                                            </td>
                                            <th>
                                                <div class="form-group">
                                                    <input class="form-control" type="number" name="total_lddap" id="total_lddap" value="0.00" readonly>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="mode_of_payment[]" id="deposit" value="4" onclick="modeOfPayment('deposit');"><b>Cash Deposit</b></label>
                                                </div>
                                            </th>
                                            <td>
                                                <!--<div class='form-group'>
                                                    <input class='form-control' type='number' name='cash_deposit_101' id='cash_deposit_101' onchange='' placeholder='0.00' />
                                                </div>-->
                                            </td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='deposit form-control' type='number' name='cash_deposit_184' id='cash_deposit_184' onchange='' placeholder='0.00' readonly />
                                                </div>
                                            </td>
                                            <th>
                                                <div class='form-group'>
                                                    <input class='form-control' type='number' name='total_cash_deposit' id='total_cash_deposit'  value='0.00' readonly />
                                                </div>
                                            </th>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total Amount</th>
                                            <th>
                                                <div class='form-group'>
                                                    <input class='form-control' type='number' name='total_gf_amount' id='total_gf_amount'  value='0.00' readonly />
                                                </div>
                                            </th>
                                            <th>
                                                <div class='form-group'>
                                                    <input class='form-control' type='number' name='total_tf_amount' id='total_tf_amount'  value='0.00' readonly />
                                                </div>
                                            </th>
                                            <th>
                                                <div class='form-group'>
                                                    <input class='form-control' type='number' name='' id=''  value='0.00' readonly />
                                                </div>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12" style="padding: 5px;">
                                <table style="width: 100%;" class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                                    <thead>
                                        <tr style="background-color: cornflowerblue; color: white;">
                                            <th colspan="4" style="font-size: 16px; font-weight: bold; padding: 5px; vertical-align: middle">Check Details</th>
                                            <th>
                                                <div class="btn btn-sm btn-success" id="check" onclick="addPaymentDetails('check');" disabled><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Check Details</div>
                                            </th>
                                        </tr>
                                        <tr style='color: #3c8dbc; font-weight: bold;'>
                                            <th style="width: 5%;">#</th>
                                            <th style="width: 25%;">Check Type</th>
                                            <th style="width: 30%;">Check Number</th>
                                            <th style="width: 20%;">Check Date</th>
                                            <th style="width: 20%;">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="2">1</td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control'type="text" name="check_type" id="check_type" placeholder="Check Type" readonly />
                                                </div>
                                            </td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control'type="text" name="check_number[]" id="check_number0" placeholder="Check Number" readonly />
                                                </div>
                                            </td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control'type="date" name="check_date[]" id="check_date0" readonly />
                                                </div>
                                            </td>
                                            <td rowspan="2">
                                                <div class='form-group'>
                                                    <input class='form-control'type="number" name="total_amount[]" id="total_amount0" value="0.00" readonly />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width: 20%;">Bank Name</th>
                                                            <th style="width:80%;"><input class='form-control'type="text" name="bank_name[]" id="bank_name0" placeholder="Bank Name" readonly /></th>
                                                        </tr>
                                                        <tr>
                                                            <th style="width: 20%;">Bank Branch Name</th>
                                                            <th style="width:80%;"><input class='form-control'type="text" name="bank_branch[]" id="bank_branch0" placeholder="Bank Branch Name" readonly /></th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--<div class="col-lg-12">
                                                    <div class='form-group'>
                                                        <label>Bank Name</label>
                                                        <input class='form-control'type="text" name="bank_name[]" id="bank_name0" placeholder="Bank Name" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class='form-group'>
                                                        <label>Bank Branch</label>
                                                        <input class='form-control'type="text" name="bank_branch[]" id="bank_branch0" placeholder="Bank Name" readonly />
                                                    </div>
                                                </div>-->
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Total Check Amount</th>
                                            <th>
                                                <div class='form-group'>
                                                    <input class='form-control'type="number" name="total_amount" id="total_amount" value="0.00" readonly />
                                                </div>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="padding: 5px;">
                                <table style="width: 100%;" class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                                    <thead>
                                        <tr style="background-color: cornflowerblue; color: white;">
                                            <th colspan="5" style="font-size: 16px; font-weight: bold; padding: 5px; vertical-align: middle;">LDDAP Details</th>
                                            <th>
                                                <div class="btn btn-sm btn-success" id="lddap" onclick="addPaymentDetails('lddap');" disabled><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;LDDAP-ADA Details</div>
                                            </th>
                                        </tr>
                                        <tr style='color: #3c8dbc; font-weight: bold;'>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>LDDAP Number</th>
                                            <th>LDDAP Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control'type="text" name="check_type[]" id="check_type" placeholder="Check Type" readonly />
                                                </div>
                                            </td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control'type="text" name="bank_name[]" id="bank_name" placeholder="Bank Name" readonly />
                                                </div>
                                            </td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control'type="text" name="check_number[]" id="check_number" placeholder="Check Number" readonly />
                                                </div>
                                            </td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control'type="date" name="check_date[]" id="check_date" placeholder="Date" readonly />
                                                </div>
                                            </td>
                                            <td>
                                                <div class='form-group'>
                                                    <input class='form-control'type="number" name="amount[]" id="total_amount" value="0.00" readonly />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total LDDAP Amount</th>
                                            <th>
                                                <div class='form-group'>
                                                    <input class='form-control'type="number" name="total_amount" id="total_amount" value="0.00" readonly />
                                                </div>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-bottom: 10px;">
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Create Official Receipt</button>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </form>
    </div>
</div>
