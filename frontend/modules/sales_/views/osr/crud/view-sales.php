<?php

use yii\helpers\Html;
use frontend\modules\models\Employee;
use frontend\modules\models\SalesOnline;
use frontend\modules\models\Product;
use frontend\modules\models\SalesStatus;
use frontend\modules\models\Customer;

$this->title = 'OSR';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Sales';
$this->params['breadcrumbs'][] = ['label' => 'Sales Onlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="sales-online-view-sales" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 context">
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group row">
                <label for="employee" class="col-sm-2 col-form-label"><h5><strong>Employee</strong></h5></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="employee" placeholder="Employee Name" value="<?= $employee->firstname.' '.$employee->lastname; ?>" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="in_out_record" class="table table-sm table-condensed table-bordered">
                <!--<table id="in_out_record" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">-->
                    <thead>
                        <tr class="bg-info">
                            <th colspan="8">
                                <?php
                                    if(isset($_POST['view_date_sales'])){
                                        if($_POST['view_date_sales'] == 'view_sales_today'){
                                            $salestoday = 'btn-md active';
                                            $salesall = 'btn-md';
                                            $salesweek = 'btn-sm';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['view_date_sales'] == 'view_sales_all'){
                                            $salestoday = 'btn-md';
                                            $salesall = 'btn-md active';
                                            $salesweek = 'btn-sm';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['view_date_sales'] == 'view_sales_week'){
                                            $salestoday = 'btn-sm';
                                            $salesall = 'btn-sm';
                                            $salesweek = 'btn-md active';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['view_date_sales'] == 'view_sales_month'){
                                            $salestoday = 'btn-sm';
                                            $salesall = 'btn-sm';
                                            $salesweek = 'btn-sm';
                                            $salesmonth = 'btn-md active';
                                        }
                                    } else {
                                        $salestoday = 'btn-md active';
                                        $salesall = 'btn-sm';
                                        $salesweek = 'btn-sm';
                                        $salesmonth = 'btn-sm';
                                    }
                                ?>
                                <?= Html::a('Today', 
                                    ['/sales/osr/view-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_today',
                                    ],
                                    'class' => ['btn btn-primary '.$salestoday],
                                ]) ?>
                                <?= Html::a('This Week', 
                                    ['/sales/osr/view-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_week',
                                    ],
                                    'class' => ['btn btn-primary '.$salesweek],
                                ]) ?>
                                <?= Html::a('This Month', 
                                    ['/sales/osr/view-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_month',
                                    ],
                                    'class' => ['btn btn-primary '.$salesmonth],
                                ]) ?>
                                <?= Html::a('All', 
                                    ['/sales/osr/view-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_all',
                                    ],
                                    'class' => ['btn btn-primary '.$salesall],
                                ]) ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">
                                <div class="form-group row">
                                    <!--<label for="search" class="col-sm-2 col-form-label"><i class="fa fa-search" aria-hidden="true"></i></label>-->
                                    <div class="col-sm-10">
                                        <input type="search" class="form-control" id="search" placeholder="Search...">
                                    </div>
                                </div>
                            </th>
                            <th colspan="4"></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th class="text-center" width="2%">#</th>
                            <th class="text-center" width="15%">Products</th>
                            <th class="text-center" width="5%">Qty</th>
                            <th class="text-center" width="8%">Add-ons</th>
                            <th class="text-center" width="10%">Price</th>
                            <th class="text-center" width="15%">Name</th>
                            <th class="text-center" width="15%">Status</th>
                            <th class="text-center" width="15%">Log Status</th>
                            <th class="text-center" width="15%">Delivery Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            $totalqty = 0;
                            $totalprice = 0;
                            if(count($sales) == 0){
                                echo "<tr><td colspan='8'>No Record(s)</td></tr>";
                            } else {
                                foreach($sales as $key=>$value){
                                    $status = SalesStatus::find()->where(['id'=>$value->sales_status_id])->one();
                                    $customer = Customer::find()->where(['id'=>$value->customer_id])->one();
                                    $customerName = $customer->customer_firstname.' '.$customer->customer_lastname;
                                    $product = Product::find()->where(['IN', 'id', json_decode($value->product_id)])->all();
                                    echo "<tr>
                                        <td class='text-center'>".($key+1)."</td>
                                        <td>";
                                        foreach($product as $p){
                                            echo $p->product_name.'<br>';
                                        }
                                        echo "</td>
                                        <td>";
                                        foreach(json_decode($value->quantity) as $q){
                                            echo $q.'<br>';
                                            $totalqty += (int)$q;
                                        }
                                        echo "</td>
                                        <td></td>
                                        <td>";
                                        foreach(json_decode($value->collectible_amount) as $a){
                                            echo number_format($a, 2, '.', ',').'<br>';
                                            $totalprice += (int)$a;
                                        }
                                        echo "</td>
                                        <td>".$customerName."</td>
                                        <td>".$status->sales_status_name."</td>
                                        <td>".$value->dispatcher_remark."</td>
                                        <td>".$value->dispatcher_remark."</td>
                                    </tr>";
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot class="text-center">
                        <td colspan="2"><strong>TOTAL</strong></td>
                        <td><strong><?= $totalqty; ?></strong></td>
                        <td></td>
                        <td><strong><?= number_format($totalprice, 2, '.', ','); ?></strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>