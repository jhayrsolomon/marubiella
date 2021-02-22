<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use frontend\modules\models\search\FundCluster as FundClusterSearch;
use frontend\modules\models\search\OrCategory as OrCategorySearch;
use frontend\modules\models\search\CollectionType as CollectionTypeSearch;
use frontend\modules\models\search\Service as ServiceSearch;
use frontend\modules\models\search\Receipt as ReceiptSearch;
use frontend\modules\models\search\OopDetails as OopDetailsSearch;
use frontend\modules\models\search\Request as RequestSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\search\OrderOfPayment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$context = 'Official Receipt';
$this->title = 'OneLab | Create Receipt';
//$this->params['breadcrumbs'][] = $this->title;

$modelOr = new ReceiptSearch();
$or = $modelOr->getCountOr();

$modelFund = new FundClusterSearch();
$fund = $modelFund->getDetailsById($oop->fund_id);

$modelOopDetails = new OopDetailsSearch();
$details = $modelOopDetails->getDetailsByOopId($oop->id);




if($oop->fund_id == 1)
{
    $typeModel = new CollectionTypeSearch();
    $type = $typeModel->getDetailsById($oop->type_id);
    $name = 'collection_name';
    $code = 'collection_code';

}
if($oop->fund_id == 2)
{
    $typeModel = new ServiceSearch();
    $type = $typeModel->getDetailsById($oop->type_id);
    $name = 'service_title';
    $code = 'service_code';
}
?>

<div class="receipt-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" style="background-color:#00adf1; color: white;">
                <h2><b>
                    <!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                    <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
                </b></h2>
            </div>
        </div>
        <br/>
    <form name="receipt-form" id="receipt-form" method="post" action="" onsubmit="">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="ldcNumber">LDC Number</label>
                            <input class="form-control" type="text" name="ldcNumber" id="ldcNumber" value="<?= $ldc; ?>" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="orCategory">OR Category</label>
                            <select class='form-control' name='orCategory' id='orCategory' onchange="orCategory();" >
                                <option value=''>Select OR Category</option>
                                <?php
                                    $req = OrCategorySearch::getAll();
                                    foreach($req as $key=>$value){
                                        echo "<option value='".$key."'>".$value."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="orNumber">OR Number</label>
                            <input class="form-control" type="text" name="orNumber" id="orNumber" placeholder="OR Number" value="<?= $or; ?>" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="fund">Fund Cluster</label>
                            <input class="form-control" type="text" name="fund" id="fund" placeholder="Fund Cluster" value="<?= $fund->fund_name; ?>" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="accountCode">Account Code</label>
                            <input class="form-control" type="text" name="accountCode" id="accountCode" placeholder="Account Code" value="<?= $type->$code; ?>" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="natureOfCollection">Nature of Collection</label>
                            <input class="form-control" type="text" name="natureOfCollection" id="natureOfCollection" placeholder="Nature of Collection" value="<?= $type->$name; ?>" readonly/>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="type">Payment Type</label>
                            <div id="type" class="col-lg-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="">Cash</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="">Check</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="">LDDAP-ADA</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="">Direct Deposrit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="particulars" >Particulars</label>
                            <div id="particulars">
                                <table width="100%">
                                    <tr style="background-color:#2e3f59; color: white;">
                                        <th>Reference Number</th>
                                        <th>Amount to Pay</th>
                                        <th>Balance</th>
                                    </tr>
                                    <?php
                                        foreach($details as $key => $value){
                                            $modelRequest = new RequestSearch();
                                            $request = $modelRequest->getDetailsById($value->id);
                                            echo "<tr>
                                                <td>".$request->requestRefNum."</td>
                                                <td>".number_format($value->amount, 2)."</td>
                                                <td>".number_format($value->balance, 2)."</td>
                                            </tr>";
                                        }
                                    ?>
                                </table>
                            </div>
                            <!--<textarea class="form-control" name="particulars" id="particulars" placeholder="Particulars" readonly>
                            ?= $textarea; ?>
                            </textarea>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="payment" >Payment</label>
                            <table id="payment" class="table" width="100%">
                                <thead>
                                    <tr style="background-color:#2e3f59; color: white;">
                                        <th width="25%"></th>
                                        <th width="25%" class="text-center">101</th>
                                        <th width="25%" class="text-center">184</th>
                                        <th width="25%" class="text-center">Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="payment_details">
                                    <tr>
                                        <td colspan="5" align="right">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!--<div class="btn btn-success" id="cash" onclick="addPaymentDetails('1');"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Cash Payment</div>-->
                                                    <div class="btn btn-success" id="check" onclick="addPaymentDetails('check');"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Check Payment</div>
                                                    <div class="btn btn-success" id="lddap" onclick="addPaymentDetails('lddap');"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;LDDAP-ADA Payment</div>
                                                    <!--<div class="btn btn-success" id="direct" onclick="addPaymentDetails('direct');"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Direct Deposit</div>-->
                                                </div>    
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="cash">
                                        <th>Cash Amount</th>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Cash Deposit</th>
                                        <td>
                                        </td>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <!--
                                    <tr>
                                        <th>Check Amount</th>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>LDDAP-ADA Amount</th>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                        <td>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total Amount</th>
                                        <th>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </th>
                                        <th>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </th>
                                        <th>
                                            <div class='form-group'>
                                                <input class='form-control' type='number' name='' id='' onchange='' placeholder=' Cash Amount' />
                                            </div>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"></textarea>
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-lg-12" style="background-color:#2e3f59; color: white;">
                        <h2><b>Payment</b></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row"></div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>-->
            </div>
        </div>
        <div class="row" style="padding-bottom: 10px;">
            <div class="col-lg-12">
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Create Official Receipt</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
