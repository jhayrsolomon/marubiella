<?php

use yii\helpers\Html;
use frontend\modules\models\Employee;
use frontend\modules\models\SalesOnline;
use frontend\modules\models\Product;
use frontend\modules\models\SalesStatus;
use frontend\modules\models\Customer;

$this->title = 'Dashboard';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'User Code';

?>
<div class="sales-default-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 context">
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).': '.$employee->user_code; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h3><?= $employee->firstname.' '.$employee->lastname; ?></h3>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3 form-group pull-right">
                <!--<button class="form-control btn btn-danger"><i class="fa fa-location-arrow" aria-hidden="true"></i>CHECK LOCATION</button>-->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger form-control" data-toggle="modal" data-target="#checkLocation">
                    <i class="fa fa-location-arrow" aria-hidden="true"></i>CHECK LOCATION
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 form-group">
                <div class="col-sm-3">Time in:<input class="form-control input-sm" type="datetime" disabled value="<?= date('M d, Y'); ?>"></div>
                <div class="col-sm-3">Date<input class="form-control input-sm" type="datetime" disabled value="<?= date('M d, Y'); ?>"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 form-group">
                <div class="col-sm-2 col-sm-2">
                    <button class="form-control btn btn-primary btn-sm" onclick="time('in');">Time in</button>
                </div>
                <div class="col-sm-2 col-sm-2">
                    <button class="form-control btn btn-primary btn-sm" onclick="time('out');">Time out</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="in_out_record" class="table table-sm table-condensed">
                <!--<table id="in_out_record" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">-->
                    <thead>
                        <tr class="bg-info">
                            <th colspan="4">
                                <?php
                                    if(isset($_POST['date_timeinout'])){
                                        if($_POST['date_timeinout'] == 'time_all'){
                                            $timeall = 'btn-md active';
                                            $timeweek = 'btn-sm';
                                            $timemonth = 'btn-sm';
                                        }
                                        if($_POST['date_timeinout'] == 'time_week'){
                                            $timeall = 'btn-sm';
                                            $timeweek = 'btn-md active';
                                            $timemonth = 'btn-sm';
                                        }
                                        if($_POST['date_timeinout'] == 'time_month'){
                                            $timeall = 'btn-sm';
                                            $timeweek = 'btn-sm';
                                            $timemonth = 'btn-md active';
                                        }
                                    } else {
                                        $timeall = 'btn-sm';
                                        $timeweek = 'btn-md active';
                                        $timemonth = 'btn-sm';
                                    }
                                ?>
                                <!--<button class="btn btn-primary ?= $all;?>">All</button>
                                <button class="btn btn-primary ?= $week;?>">This Week</button>
                                <button class="btn btn-primary ?= $month;?>">This Month</button>-->
                                <?= Html::a('All', 
                                    ['/sales/dashboard'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_timeinout' => 'time_all',
                                        /*'date_sales' => function(){
                                            if(isset($_POST['date_sales'])){
                                                return $_POST['date_sales'];
                                            } else {
                                                return null;
                                            }
                                        },*/
                                    ],
                                    'class' => ['btn btn-primary '.$timeall],
                                ]) ?>
                                <?= Html::a('This Week', 
                                    ['/sales/dashboard'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_timeinout' => 'time_week',
                                        /*'date_sales' => function(){
                                            if(isset($_POST['date_sales'])){
                                                return $_POST['date_sales'];
                                            } else {
                                                return null;
                                            }
                                        },*/
                                    ],
                                    'class' => ['btn btn-primary '.$timeweek],
                                ]) ?>
                                <?= Html::a('This Month', 
                                    ['/sales/dashboard'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_timeinout' => 'time_month',
                                        /*'date_sales' => function(){
                                            if(isset($_POST['date_sales'])){
                                                return $_POST['date_sales'];
                                            } else {
                                                return null;
                                            }
                                        },*/
                                    ],
                                    'class' => ['btn btn-primary '.$timemonth],
                                ]) ?>
                            </th>
                        </tr>
                        <tr>
                            <th class="context" colspan="4"> In-Out Time Report</th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($timeRecordIn) == 0) {
                                echo "<tr><td colspan='4'>No Result Found</td></tr>";
                            } else {
                                foreach($timeRecordIn as $key=>$value){
                                    echo "<tr>
                                        <td>".$value->today_date."</td>
                                        <td>".$value->time_report."</td>
                                        <td>".((isset($timeRecordOut[$key]->time_report))?$timeRecordOut[$key]->time_report : '')."</td>
                                        <td>".$value->remark."<br>".((isset($timeRecordOut[$key]->remark))?$timeRecordOut[$key]->remark : '')."</td>
                                    </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-info">
                            <th colspan="9">
                                <?php
                                    if(isset($_POST['date_sales'])){
                                        if($_POST['date_sales'] == 'sales_all'){
                                            $salesall = 'btn-md active';
                                            $salesweek = 'btn-sm';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['date_sales'] == 'sales_week'){
                                            $salesall = 'btn-sm';
                                            $salesweek = 'btn-md active';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['date_sales'] == 'sales_month'){
                                            $salesall = 'btn-sm';
                                            $salesweek = 'btn-sm';
                                            $salesmonth = 'btn-md active';
                                        }
                                    } else {
                                        $salesall = 'btn-sm';
                                        $salesweek = 'btn-md active';
                                        $salesmonth = 'btn-sm';
                                    }
                                ?>
                                <!--<button class="btn btn-primary ?= $all;?>">All</button>
                                <button class="btn btn-primary ?= $week;?>">This Week</button>
                                <button class="btn btn-primary ?= $month;?>">This Month</button>-->
                                <?= Html::a('All', 
                                    ['/sales/dashboard'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_sales' => 'sales_all',
                                        /*'date_timeinout' => function(){
                                            if(isset($_POST['date_timeinout'])){
                                                return $_POST['date_timeinout'];
                                            } else {
                                                return null;
                                            }
                                        },*/
                                    ],
                                    'class' => ['btn btn-primary '.$salesall],
                                ]) ?>
                                <?= Html::a('This Week', 
                                    ['/sales/dashboard'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_sales' => 'sales_week',
                                        /*'date_timeinout' => function(){
                                            if(isset($_POST['date_timeinout'])){
                                                return $_POST['date_timeinout'];
                                            } else {
                                                return null;
                                            }
                                        },*/
                                    ],
                                    'class' => ['btn btn-primary '.$salesweek],
                                ]) ?>
                                <?= Html::a('This Month', 
                                    ['/sales/dashboard'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_sales' => 'sales_month',
                                        /*'date_timeinout' => function(){
                                            if(isset($_POST['date_timeinout'])){
                                                return $_POST['date_timeinout'];
                                            } else {
                                                return null;
                                            }
                                        },*/
                                    ],
                                    'class' => ['btn btn-primary '.$salesmonth],
                                ]) ?>
                            </th>
                        </tr>
                        <tr>
                            <th class="context" colspan="9">Sales Report</th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <th>Sales Status</th>
                            <th>Sales Code</th>
                            <th>Customer Name</th>
                            <th>Product(s)</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Total Amount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($sales) == 0){
                                echo "<tr><td colspan='8'>No Record(s)</td></tr>";
                            } else {
                                foreach($sales as $value){
                                    $status = SalesStatus::find()->where(['id'=>$value->sales_status_id])->one();
                                    $customer = Customer::find()->where(['id'=>$value->customer_id])->one();
                                    $customerName = $customer->customer_firstname.' '.$customer->customer_lastname;
                                    //$product = Product::find()->where(['IN', 'id', json_decode($value->product_id)])->all();
                                    echo "<tr>
                                        <td>".date('Y-m-d', strtotime($status->date_created))."</td>
                                        <td>".$status->sales_status_code."</td>
                                        <td>".$value->sales_code."</td>
                                        <td>".$customerName."</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>".number_format($value->total_amount, 2, '.', ',')."</td>
                                        <td>".
                                            (($value->osr_remark == null)?'':$value->osr_remark).'<br>'.
                                            (($value->csr_remark == null)?'':$value->csr_remark).'<br>'.
                                            (($value->dispatcher_remark == null)?'':$value->dispatcher_remark).'<br>'
                                        ."</td>
                                    </tr>";
                                    /*foreach($product as $p){
                                            echo $p->product_name.'<br>';
                                        }
                                    foreach(json_decode($value->quantity) as $q){
                                            echo $q.'<br>';
                                        }
                                    foreach(json_decode($value->collectible_amount) as $a){
                                            echo number_format($a, 2, '.', ',').'<br>';
                                        }*/
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="checkLocation" tabindex="-1" role="dialog" aria-labelledby="checkLocationTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="col-sm-9">
                    <h4 class="modal-title" id="checkLocationTitle"><strong>Check Location for ODC</strong></h4>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="close btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span>
                    </button>
                </div>
            </div>
            <div class="modal-body form-group">
                <label for="searchLocation">Location</label>
                <input type="text" class="form-control" name="searchLocation" id="searchLocation" placeholder="Enter Location" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Verify</button>
            </div>
        </div>
    </div>
</div>
