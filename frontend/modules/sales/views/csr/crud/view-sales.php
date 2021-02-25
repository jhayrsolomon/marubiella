<?php

use yii\helpers\Html;
use frontend\modules\models\Employee;
use frontend\modules\models\SalesOnline;
use frontend\modules\models\Product;
use frontend\modules\models\SalesStatus;
use frontend\modules\models\Customer;
use frontend\modules\models\SalesProduct;
use kartik\daterange\DateRangePicker;
use yii\widgets\ActiveForm;

$this->title = 'OSR';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Sales Monitoring';
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
            <div class="col-sm-6 form-group">
                <label for="employee" class="col-sm-2 col-form-label"><h5><strong>Employee</strong></h5></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="employee" placeholder="Employee Name" value="<?= $employee->firstname.' '.$employee->lastname; ?>" disabled>
                </div>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-sm-12">
                ?= Html::a('Export Sales', 
                    [''], [
                    'data-method' => 'POST',
                    'data-params' => [
                        'view_date_sales' => 'view_sales_week',
                    ],
                    'class' => ['btn btn-danger pull-right'],
                ]) ?>

                ?php
                    echo '<div class="input-group drp-container pull-right">';
                    echo DateRangePicker::widget([
                        'name'=>'date_range_1',
                        'value'=>date('01'.'-M-y').' to '.date('t-M-y'),
                        'convertFormat'=>true,
                        'useWithAddon'=>true,
                        'pluginOptions'=>[
                            'locale'=>[
                                'format'=>'d-M-y',
                                'separator'=>' to ',
                            ],
                            'opens'=>'left'
                        ]
                    ]);
                    echo '</div>';
                ?>
                ?php 
                    echo '<div class="input-group-append pull-right text-center">
                        <span class="input-group-text">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                    </div>';
                    echo '<label class="control-label pull-right text-center">Date Range</label>';
                ?>
            </div>
        </div>-->
        <div class="row">
            <div class="col-sm-12">
                <table id="in_out_record" class="table table-sm table-condensed table-bordered">
                <!--<table id="in_out_record" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">-->
                    <thead>
                        <tr class="bg-primary">
                            <th colspan="10">My Sales</th>
                        </tr>
                        <tr class="bg-info">
                            <th colspan="10">
                                <?php
                                    if(isset($_POST['view_date_sales'])){
                                        if($_POST['view_date_sales'] == 'view_sales_today'){
                                            $salestoday = 'btn-md active';
                                            $salesall = 'btn-sm';
                                            $salesweek = 'btn-sm';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['view_date_sales'] == 'view_sales_all'){
                                            $salestoday = 'btn-sm';
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
                                    ['/sales/csr/view-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_today',
                                    ],
                                    'class' => ['btn btn-primary '.$salestoday],
                                ]) ?>
                                <?= Html::a('This Week', 
                                    ['/sales/csr/view-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_week',
                                    ],
                                    'class' => ['btn btn-primary '.$salesweek],
                                ]) ?>
                                <?= Html::a('This Month', 
                                    ['/sales/csr/view-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_month',
                                    ],
                                    'class' => ['btn btn-primary '.$salesmonth],
                                ]) ?>
                                <?= Html::a('All', 
                                    ['/sales/csr/view-sales'], [
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
                            <th colspan="7"></th>
                        </tr>
                        <tr>
                            <th class="text-center" width="2%">#</th>
                            <th class="text-center" width="11%">Date</th>
                            <th class="text-center" width="15%">Products</th>
                            <th class="text-center" width="5%">Qty</th>
                            <th class="text-center" width="8%">Add-ons</th>
                            <th class="text-center" width="10%">Price</th>
                            <th class="text-center" width="15%">Name</th>
                            <th class="text-center" width="12%">Status</th>
                            <th class="text-center" width="12%">Log Status</th>
                            <th class="text-center" width="12%">Del. Status</th>
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
                                    //$product = Product::find()->where(['IN', 'id', json_decode($value->product_id)])->all();
                                    $productSales = SalesProduct::find()->where(['sales_online_id'=>$value->id])->all();
                                    $productId = array();
                                    foreach($productSales as $item){
                                        array_push($productId, $item->product_id);
                                    }
                                    $product = Product::find()->where(['IN', 'id', $productId])->all();
                                    echo "<tr>
                                        <td class='text-center'>".($key+1)."</td>
                                        <td class='text-center'>".date('Y-m-d', strtotime($value->date_created))."</td>
                                        <td>";
                                        foreach($product as $p){
                                            echo $p->product_name.'<br>';
                                        }
                                        echo "</td>
                                        <td>";
                                        foreach($productSales as $q){
                                            echo $q->quantity.'<br>';
                                            $totalqty += (int)$q->quantity;
                                        }
                                        echo "</td>
                                        <td></td>
                                        <td>";
                                        foreach($productSales as $a){
                                            echo number_format($a->collectible_amount, 2, '.', ',').'<br>';
                                            $totalprice += (int)$a->collectible_amount;
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
                        <td colspan="3"><strong>TOTAL</strong></td>
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