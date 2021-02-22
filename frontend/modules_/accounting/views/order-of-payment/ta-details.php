<?php
//use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
//use yii\helpers\ArrayHelper;

$this->title = 'Onelab';
$params = ucfirst(Yii::$app->controller->action->id);
//$params = 'Transaction Request';
$context = 'Order Of Payment&#58;&nbsp;';

$this->params['breadcrumbs'][] = [
    'label' => $oop->description,
    'url' => [$oop->action]
];
$this->params['breadcrumbs'][] = [
    'label' => 'Customer',
    'url' => ['customer', 'type_code'=> $_POST['type_code']]
];
$this->params['breadcrumbs'][] = [
    'label' => 'Transaction Request',
    'url' => [
        'request',
        'type_code'=> $_POST['type_code'],
        'id'=> $_POST['custId'],
        'div_code' => $_POST['div_code'],
    ],
    'data-method' => 'POST',
    'data-params' => [
        'id'=> Yii::$app->request->post('custId'),
        'custName'=> Yii::$app->request->post('custName')
    ]
];
$this->params['breadcrumbs'][] = $params;
?>
<div class="order-of-payment-detials" style="background-color: white;">
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
            <div class="col-lg-12" >
                <div class="col-lg-12" style="background-color: #00adf1; color: white; font-size: 20px; padding:5px;">
                    <b>Payment Details</b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Fill-up all the necessary field/s for the request of <b>Order-of-Payment</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
        <form name="oop-form" id="oop-form" method="post" action="create" onsubmit="return checkOop();">
        <div class="row">
            <div class="col-lg-12">
                <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                    <thead>
                        <tr>
                            <th style="width: 25%; color: #3c8dbc;">OOP Reference Number</th>
                            <td style="width: 25%; "><?= $opNumber; ?></td>
                            <th style="width: 25%; color: #3c8dbc;">Date</th>
                            <td style="width: 25%; "><?= date('F d, Y'); ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="col-lg-12">
                                    <div class='form-group'>
                                        <label style="color: #3c8dbc;" for="payment_type">Payment Method</label>
                                        <select class='form-control' name='payment_type' id='payment_type' >
                                            <option value=''>Select Payment Method</option>
                                            <?php
                                                foreach($paymentTypeList as $key=>$value){
                                                    echo "<option value='".$key."'>".$value."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="col-lg-12">
                                    <div class='form-group'>
                                        <label style="color: #3c8dbc;" for="fund">Fund Cluster</label>
                                        <select class='form-control' name='fund' id='fund' onchange="fundCluster();" >
                                            <option value=''>Select Fund Cluster</option>
                                            <?php
                                                foreach($fundList as $key=>$value){
                                                    echo "<option value='".$key."'>".$value."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="col-lg-12">
                                    <div class='form-group'>
                                        <label style="color: #3c8dbc;" for="incomeCode">Collection Type</label>
                                        <select class='form-control' name='incomeCode' id='incomeCode' >
                                            <optgroup>
                                                <option value="">Select Income Code</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="4">
                                <table class="table" width="100%">
                                    <thead style="color: #3c8dbc;">
                                        <tr>
                                            <th colspan="2"></th>
                                            <th class="text-center" colspan="2">Division of Collection</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th class="text-center" width="20%" >Reference Number</th>
                                            <th class="text-center" width="20%" >Amount-to-Pay</th>
                                            <th class="text-center" width="20%" >184 (TF)</th>
                                            <th class="text-center" width="20%" >101 (GF)</th>
                                            <th class="text-center" width="20%" >Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php
                                            $sum = 0;
                                            foreach($dataProvider as $key => $item){
                                        ?>
                                                <tr>
                                                    <td>
                                                        <input type='text' name='reqId[]' id='reqId<?= $key; ?>' value='<?= $item->id; ?>' hidden />
                                                        <?= $item->requestRefNum; ?>
                                                    </td>
                                                    <td>
                                                        <div class='form-group'>
                                                            <input type='number' placeholder='Amount' name='balance[]' id='bal<?= $key; ?>' hidden />
                                                            <input type='number' placeholder='Amount' class='form-control' name='toPay[]' id='tp<?=$key; ?>' onchange='balance(<?= $key; ?>);' />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class='form-group'>
                                                            <input type='number' placeholder='Amount' class='form-control' name ='trustFund[]' id='tf<?= $key; ?>' onchange='trustFundAmount(<?= $key; ?>, <?= $item->total; ?>);' readonly/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class='form-group'>
                                                            <input type='number' class='form-control' name ='generalFund[]' id='gf<?=$key; ?>' value='<?= $item->total; ?>' readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class='form-group'>
                                                            <input type='number' class='form-control' name ='amount[]' id='amount<?=$key; ?>' value='<?= $item->total; ?>' readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                                $sum = $sum + $item->total;
                                            }
                                        ?>
                                        <tr>
                                            <th colspan="3" rowspan="3">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label style="color: #3c8dbc;" for="remark">Remarks:</label>
                                                        <textarea class="form-control" rows="5" name="remark" id="remark"></textarea>
                                                    </div>
                                                </div>
                                            </th>
                                            <th class="text-right center" style="color: #008ECC;" valign="buttom">Sub Total</th>
                                            <th>
                                                <input type="number" class='form-control' name ='sum' id='sum' value="<?= $sum; ?>" readonly />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-right center" style="color: #008ECC;" valign="buttom">Balance</th>
                                            <th>
                                                <input type="number" class='form-control' name ='totalBalance' id='totalBalance' value="0.00" style="color: white;" readonly />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-right center" style="color: #008ECC;" valign="buttom">Total</th>
                                            <th>
                                                <input type="number" class='form-control' name ='total' id='total' value="<?= $sum; ?>" readonly />
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?=yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)?>
        <input type='hidden' name='opNum' id='opNum' value='<?= $opNumber; ?>' />
        <input type='hidden' name='custId' id='custId' value='<?= Yii::$app->request->post('custId'); ?>' />
        <input type='hidden' name='oop_type_id' id='oop_type_id' value='<?= $oop->id; ?>' />
        <input type='hidden' name='div_id' id='div_id' value='<?= $div->id; ?>' />
        <div class="row" style="padding-bottom: 10px;" >
            <div class="col-lg-12">
                <button type="submit" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Create Order of Payment</button>
            </div>
        </div>
        </form>
    </div>
</div>