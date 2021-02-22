<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = 'OneLab';
$context = 'Payment: ';
$params = 'Official Receipt';
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
                <!--<pre>
                    ?php
                        print_r($_POST);
                    ?>
                </pre>-->
                <b style="font-size: 24px;"><?= $customer->customerName; ?></b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?= $customer->address; ?></i><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?= $customer->email; ?></i>
            </div>
        </div>
        <form method="post" action="create" id="officail-receipt-form" onsubmit="return validateOfficialReceipt();" >
            
        <div class="row">
            <div class="col-lg-12" >
                <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
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
                            $totalGeneral = 0;
                            $totalTrust = 0;
                            foreach($oopDetails as $key=>$item){
                                $amount = $item[4]-$item[3];
                                echo "<tr>
                                    <td>".($key+1)."</td>
                                    <td>".$item[0]."</td>
                                    <td style='text-align: center;'>".number_format($item[1], 2)."</td>
                                    <td style='text-align: center;'>".number_format($item[2], 2)."</td>
                                    <td style='text-align: center;'>".number_format($item[3], 2)."</td>
                                    <td style='text-align: center;'>".number_format($amount, 2)."</td>
                                </tr>";
                                $totalBalance +=$item[3];
                                $totalGeneral +=$item[1];
                                $totalTrust +=$item[2];
                                $totalAmount +=$amount;
                            }
                        ?>
                        <tr>
                            <th colspan="6"></th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align: right;">Total</th>
                            <th style="text-align: center;"><?= number_format($totalGeneral, 2);?></th>
                            <th style="text-align: center;"><?= number_format($totalTrust, 2);?></th>
                            <th style="text-align: right;">Total Balance</th>
                            <th style="color: red; text-align: center; background-color: #eeeeee;">
                                <?= number_format($totalBalance, 2);?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4"></th>
                            <th style="text-align: right;">Total Amount to Pay</th>
                            <th style='text-align: center; color: blue; background-color: #eeeeee;'>
                                <?= number_format($totalAmount, 2);?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12" >
                <div class="col-lg-12" style="background-color: #00adf1; color: white; font-size: 16px; padding:5px;">
                    <b>Official Receipt</b>
                </div>
            </div>
        </div>-->
        <div class="row">
            <!--<div class="col-lg-12" >-->
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
                                <td style='width: 75%;'>
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-6">
                                            <input class='form-control' style="color:red; font-weight: bold; background-color: white; color: blue;" type='text' name='ldc_number' id='ldc_number' value="<?= $ldc; ?>" readonly />

                                        </div>
                                        <div class="form-group col-lg-6" style="font-weight: bold; background-color: white; color: blue;">
                                            <input class='form-control' type='hidden' name='ldc_date' id='ldc_date' value="<?= $date; ?>" /> <?= $ldcDate; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style='color: #3c8dbc; font-weight: bold;'>OR Number</th>
                                <td>
                                    <div class="form-group col-lg-12">
                                        <div class="col-lg-6">
                                            <!--<input class='form-control' style="color:red; font-weight: bold; background-color: white;" type='text' name='or_number' id='or_number' value="?= $orSeries->next_or; ?>" readonly />-->
                                            <input class='form-control' style="color:red; font-weight: bold; background-color: white;" type='text' name='or_number' id='or_number' value="0000000000" readonly/>

                                        </div>
                                        <div class="col-lg-6" style="font-weight: bold; background-color: white;">
                                            <input class='form-control' type='hidden' name='or_date' id='or_date' value="<?= $today; ?>" />
                                            <?= Datetime::createFromFormat('Y-m-d', $today)->format('F d, Y'); ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style='color: #3c8dbc; font-weight: bold;'>OR Category</th>
                                <td>
                                    <div class="form-group col-lg-12">
                                        <select class='form-control' name='or_category' id='or_category' onchange="orCategory();" required>
                                            <option value="">-----Select OR Category-----</option>
                                            <?php
                                                foreach($categoryList as $key=>$value){
                                                    echo "<option value='".$key."'>".$value."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style='color: #3c8dbc; font-weight: bold;'>Fund Cluster</th>
                                <td>
                                    <?= $oop->fund->fund_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style='color: #3c8dbc; font-weight: bold;'>Nature of Collection</th>
                                <td>
                                    <?= ($oop->fund->id == 1) ? $incomeType->collection_name.' ('.$incomeType->collection_code.')' : $incomeType->service_title.' ('.$incomeType->service_code.')'; ?>
                               </td>
                            </tr>
                            <tr>
                                <th style='color: #3c8dbc; font-weight: bold;'>Payor Name</th>
                                <td>
                                    <div class='form-group'>
                                        <input class='form-control' type='text' name='payor_name' id='payor_name' placeholder="Payor Name" required/>
                                    </div>
                                </td>
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
                        <tbody id="payment_details">
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="mode_of_payment[]" id="cash" value="1" onclick="modeOfPayment('cash');"><b>Cash</b></label>
                                    </div>
                                </th>
                                <td>
                                    <div class='form-group'>
                                        <input class='cash form-control' type='number' name='general[]' id='general1' onchange='amountOfPayment(1);' placeholder='0.00' readonly />
                                    </div>
                                </td>
                                <td>
                                    <div class='form-group'>
                                        <input class='cash form-control' type='number' name='trust[]' id='trust1' onchange='amountOfPayment(1)' placeholder='0.00' readonly />
                                    </div>
                                </td>
                                <th>
                                    <div class='form-group'>
                                        <input class='form-control' type='number' name='total[]' id='total1' placeholder="0.00" readonly />
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
                                        <input class="check form-control" type="number" name="general[]" id="general2" onchange="amountOfPayment(2);" placeholder="0.00" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input class="check form-control" type="number" name="trust[]" id="trust2" onchange="amountOfPayment(2);" placeholder="0.00" readonly>
                                    </div>
                                </td>
                                <th>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="total[]" id="total2" placeholder="0.00" readonly>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="mode_of_payment[]" id="lddap" value="4" onclick="modeOfPayment('lddap');"><b>LDDAP-ADA</b></label>
                                    </div>
                                </th>
                                <td>
                                    <div class="form-group">
                                        <input class="lddap form-control" type="number" name="general[]" id="general4" onchange="amountOfPayment(4);" placeholder="0.00" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input class="lddap form-control" type="number" name="trust[]" id="trust4" onchange="amountOfPayment(4);" placeholder="0.00" readonly>
                                    </div>
                                </td>
                                <th>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="total[]" id="total4" placeholder="0.00" readonly>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="mode_of_payment[]" id="deposit" value="3" onclick="modeOfPayment('deposit');"><b>Direct Deposit</b></label>
                                    </div>
                                </th>
                                <td>
                                    <div class='form-group'>
                                        <input class='form-control' type='hidden' name='general[]' id='general3' value="0" />
                                    </div>
                                </td>
                                <td>
                                    <div class='form-group'>
                                        <input class='deposit form-control' type='number' name='trust[]' id='trust3' onchange='amountOfPayment(3)' placeholder='0.00' readonly />
                                    </div>
                                </td>
                                <th>
                                    <div class='form-group'>
                                        <input class='form-control' type='number' name='total[]' id='total3'  placeholder="0.00" readonly />
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Amount</th>
                                <th>
                                    <div class='form-group'>
                                        <input class='form-control' type='number' name='total_gf_amount' id='total_gf_amount'  placeholder="0.00" readonly />
                                    </div>
                                </th>
                                <th>
                                    <div class='form-group'>
                                        <input class='form-control' type='number' name='total_tf_amount' id='total_tf_amount'  placeholder="0.00" readonly />
                                    </div>
                                </th>
                                <th>
                                    <div class='form-group'>
                                        <input class='form-control' type='number' name='total_amount' id='total_amount'  placeholder="0.00" readonly />
                                    </div>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <!--</div>-->
        </div>
        <div class="row" id="checkDetails" hidden>
            <div class="col-lg-12" >
                <table style="width: 100%;" class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <thead>
                        <tr style="background-color: cornflowerblue; color: white;">
                            <th colspan="6" style="font-weight: bold; padding: 5px; vertical-align: middle">Check Details</th>
                            <th>
                                <div class="btn btn-xs btn-success" id="check" onclick="addCheckDetails();" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<b>Check Details</b></div>
                            </th>
                        </tr>
                        <tr style='color: #3c8dbc; font-weight: bold;'>
                            <th style="width: 2%;">#</th>
                            <th style="width: 14%;">Check Type</th>
                            <th style="width: 22%;">Bank Name</th>
                            <th style="width: 22%;">Branch Name</th>
                            <th style="width: 14%;">Check Number</th>
                            <th style="width: 13%;">Check Date</th>
                            <th style="width: 13%;">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody id="checkTable">
                        <tr id="checkDetails0">
                            <td>1</td>
                            <td>
                                <!--<div class='form-group'>
                                    <input class='form-control' type="text" name="check_type[]" id="check_type0" placeholder="Check Type" readonly />
                                </div>-->
                                <div class="form-group col-lg-12">
                                    <select class='form-control' name='check_type[]' id='check_type0' onchange="bankName()" >
                                        <option value="">Select Check Type</option>
                                        <?php
                                            foreach($checkTypeList as $key=>$value){
                                                echo "<option value='".$key."'>".$value."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="text" name="check_bank_name[]" id="check_bank_name0" placeholder="Bank Name" readonly />
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="text" name="check_bank_branch[]" id="check_bank_branch0" placeholder="Bank Branch Name" readonly />
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="text" name="check_number[]" id="check_number0" placeholder="Check Number" readonly />
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="date" name="check_date[]" id="check_date0" readonly />
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="number" name="check_amount[]" id="check_amount0" placeholder="0.00" readonly />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <!--<tfoot>
                        <tr>
                            <th colspan="6">Total Check Amount</th>
                            <th>
                                <div class='form-group'>
                                    <input class='form-control' type="number" name="check_total_amount" id="check_total_amount" placeholder="0.00" readonly />
                                </div>
                            </th>
                        </tr>
                    </tfoot>-->
                </table>
            </div>
        </div>
        <div class="row" id="lddapDetails" hidden>
            <div class="col-lg-12">
                <table style="width: 100%;" class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <thead>
                        <tr style="background-color: cornflowerblue; color: white;">
                            <th colspan="5" style="font-weight: bold; padding: 5px; vertical-align: middle;">LDDAP Details</th>
                            <th>
                                <div class="btn btn-xs btn-success" id="lddap" onclick="addLddapDetails();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<b>LDDAP-ADA Details</b></div>
                            </th>
                        </tr>
                        <tr style='color: #3c8dbc; font-weight: bold;'>
                            <th style="width: 2%;">#</th>
                            <th style="width: 20%;">LDDAP Name</th>
                            <th style="width: 20%;">Bank Branch Name</th>
                            <th style="width: 20%;">LDDAP Number</th>
                            <th style="width: 19%;">LDDAP Date</th>
                            <th style="width: 19%;">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="lddapTable">
                        <tr id="lddapDetails0">
                            <td>1</td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="text" name="lddap_name[]" id="lddap_name0" placeholder="LDDAP Name" readonly />
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="text" name="lddap_bank_branch[]" id="lddap_bank_branch0" placeholder="Bank Branch Name" readonly />
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="text" name="lddap_number[]" id="lddap_number0" placeholder="Check Number" readonly />
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="date" name="lddap_date[]" id="lddap_date0" placeholder="Date" readonly />
                                </div>
                            </td>
                            <td>
                                <div class='form-group'>
                                    <input class='form-control' type="number" name="lddap_amount[]" id="lddap_amount0" placeholder="0.00" readonly />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <!--<tfoot>
                        <tr>
                            <th colspan="5">Total LDDAP Amount</th>
                            <th>
                                <div class='form-group'>
                                    <input class='form-control' type="number" name="lddap_total_amount" id="lddap_total_amount" placeholder="0.00" readonly />
                                </div>
                            </th>
                        </tr>
                    </tfoot>-->
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label style="color: #3c8dbc;" for="remark">Remarks:</label>
                    <textarea class="form-control" rows="5" name="remark" id="remark">&nbsp;</textarea>
                </div>
            </div>    
        </div>
        <?=yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)?>
        
        <input type='hidden' name='customer_id' id='customer_id' value='<?= $_POST['customer_id']; ?>' />
        <input type='hidden' name='division_id' id='division_id' value='<?= $division->id; ?>' />
        <input type='hidden' name='fund_id' id='fund_id' value='<?= $fund->id; ?>' />
        <input type='hidden' name='fund_type_id' id='fund_type_id' value='<?= $incomeType->id; ?>' />
        <input type='hidden' name='payment_type_id' id='payment_type_id' value='<?= $payment->id; ?>' />
        <input type='hidden' name='amount_to_pay' id='amount_to_pay' value='<?= $totalAmount; ?>' />
            
        <?php
            foreach($_POST['oop_id'] as $key=>$item){
                echo "<input type='hidden' name='oop_id[]' id='oop_id".$key."' value='".$item."' />";
            }    
        ?>
        <!--<input type='hidden' name='oop_id' id='oop_id' value='?= json_encode($_POST['oop_id']); ?>' />-->
        <div class="row" style="padding-bottom: 10px;">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Create Official Receipt</button>
            </div>
        </div>
        </form>
    </div>
</div>