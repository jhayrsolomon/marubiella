<?php

//use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use frontend\modules\models\accounting\search\OrderOfPayment as OrderOfPaymentSearch;
use frontend\modules\models\ulims\search\CustomerDetails as CustomerDetailsSearch;
use frontend\modules\models\accounting\search\OopDetails as OopDetailsSearch;
use frontend\modules\models\ulims\search\Request as RequestSearch;
use frontend\modules\models\accounting\search\OopCollection as OopCollectionSearch;
use frontend\modules\models\accounting\search\FundCluster as FundClusterSearch;
use frontend\modules\models\accounting\search\CollectionType as CollectionTypeSearch;
use frontend\modules\models\accounting\search\Service as ServiceSearch;

$context = 'Order Of Payment';
$this->title = 'OneLab';
//$this->params['breadcrumbs'][] = $this->title;
?>

<?php

    $oopModel = new OrderOfPaymentSearch();
    $oop = $oopModel->getDetailsByTransactionNum($opNumber);
    
    //$cust_id = $oop->customer_id;
    $customerModel = new CustomerDetailsSearch();
    $customer = $customerModel->getDetailsById($cust_id);

    $oopDetailsModel = new OopDetailsSearch();
    $details = $oopDetailsModel->getDetailsById($oop->id);

    /*$oopDetailsModel = new OopDetailsSearch();
    $details = $oopDetailsModel->getDetails($oop->id);

    $fundModel = new FundClusterSearch();
    $fund = $fundModel->getDetails($opNumber);*/

    $fundModel = new FundClusterSearch();
    $fund = $fundModel->getDetailsById($oop->fund_id);

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

<div class="order-of-payment-create" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                <!--?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id)); ?>-->
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
                : <?= $oop->transaction_num; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="customer">Customer Name</label>
                    <input class="form-control" type="text" id="customer" value="<?= $customer->customerName; ?>" readonly/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="custname">Email</label>
                    <input class="form-control" type="text" id="custName" value="<?= $customer->email; ?>" readonly/>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="refNum">Fund Cluster</label>
                    <input class="form-control" type="text" id="refNum" value="<?= $fund->fund_name; ?>" readonly/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="custname">Income Code</label>
                    <input class="form-control" type="text" id="custName" value="<?= $type->$name; ?>" readonly/>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table" width="100%">
                    <thead>
                        <tr>
                            <th colspan="4" style="font-size: 1.17em;" ><h4>Payment Details</h4></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <th colspan="2">Division of Collection</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Reference Number</th>
                            <th>101 (GF)</th>
                            <th>184 (TF)</th>
                            <th>Amount</th>
                        </tr>
                        <?php
                            foreach($details as $key => $item){
                                $modelRequest = new RequestSearch();
                                
                                $request = $modelRequest->getDetailsById($item->request_id);
                                
                                $modelCollection = new OopCollectionSearch();
                                
                                $collect = $modelCollection->getDetailsById($item->id);
                                
                                echo"
                                    <tr>
                                        <td>".$request->requestRefNum."</td>
                                        <td>".number_format($collect->general_fund, 2)."</td>
                                        <td>".number_format($collect->trust_fund, 2)."</td>
                                        <td>".$item->amount."</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;" >
                                <?= Html::a('Print Order of Payment',
                                    ['print-oop'],
                                    [
                                        'data-method' => 'POST',
                                        /*'data-params' => [
                                            'eppDetails' => $eppDetails,
                                            'merchant' => $merchant,
                                            'oopDetails' => $oopDetails,
                                            'paymentDetails' => $paymentDetails,

                                        ],*/
                                        'class' => 'btn btn-primary'
                                    ]
                                ); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!--<pre>
            ?= print_r($details); ?>
        </pre>-->
    </div>
</div>