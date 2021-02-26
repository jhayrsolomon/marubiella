<?php

use yii\helpers\Html;
use kartik\daterange\DateRangePicker;
use yii\widgets\ActiveForm;

use frontend\modules\models\Product;

$this->title = 'OSR';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Sales Report';
$this->params['breadcrumbs'][] = ['label' => 'Sales Onlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$product = Product::find()->all();
$countP = count($product);
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
                ?= Html::a('Export Report', 
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
                            <th colspan="<?= ($countP+2); ?>">My Sales: Validated</th>
                        </tr>
                        <tr class="bg-info">
                            <th colspan="<?= ($countP+2); ?>">
                                <?php
                                    if(isset($_POST['date_sales'])){
                                        if($_POST['date_sales'] == 'sales_today'){
                                            $salestoday = 'btn-md active';
                                            $salesall = 'btn-sm';
                                            $salesweek = 'btn-sm';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['date_sales'] == 'sales_all'){
                                            $salestoday = 'btn-sm';
                                            $salesall = 'btn-md active';
                                            $salesweek = 'btn-sm';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['date_sales'] == 'sales_week'){
                                            $salestoday = 'btn-sm';
                                            $salesall = 'btn-sm';
                                            $salesweek = 'btn-md active';
                                            $salesmonth = 'btn-sm';
                                        }
                                        if($_POST['date_sales'] == 'sales_month'){
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
                                    ['/sales/encoder/view-report'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_sales' => 'sales_today',
                                    ],
                                    'class' => ['btn btn-primary '.$salestoday],
                                ]) ?>
                                <?= Html::a('This Week', 
                                    ['/sales/encoder/view-report'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_sales' => 'sales_week',
                                    ],
                                    'class' => ['btn btn-primary '.$salesweek],
                                ]) ?>
                                <?= Html::a('This Month', 
                                    ['/sales/encoder/view-report'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_sales' => 'sales_month',
                                    ],
                                    'class' => ['btn btn-primary '.$salesmonth],
                                ]) ?>
                                <?= Html::a('All', 
                                    ['/sales/encoder/view-report'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date_sales' => 'sales_all',
                                    ],
                                    'class' => ['btn btn-primary '.$salesall],
                                ]) ?>
                            </th>
                        </tr>
                        <!--<tr>
                            <th colspan="3">
                                <div class="form-group row">
                                    <label for="search" class="col-sm-2 col-form-label"><i class="fa fa-search" aria-hidden="true"></i></label>
                                    <div class="col-sm-10">
                                        <input type="search" class="form-control" id="search" placeholder="Search...">
                                    </div>
                                </div>
                            </th>
                            <th colspan="?= ($countP-1); ?>"></th>
                        </tr>-->
                        <tr>
                            <th>Date</th>
                            <?php
                                foreach($product as $item){
                                    echo "<th>".$item->product_name."</th>";
                                }
                            ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $countS = count($sales);
                            for($x=0; $x < $countP; $x++){
                                $totaly[$x] = 0;
                            }
                            $totalAll = 0;
                            for($s=0; $s < $countS; $s++){
                                $p = $s;
                                $totalx = 0;
                                echo "<tr>
                                    <td>".$sales[$s]['pdate']."</td>";
                                for($x=0; $x < $countP; $x++){
                                    if(isset($sales[$p]['pdate'])){
                                        if($sales[$s]['pdate'] == $sales[$p]['pdate']){
                                            //echo "<td>".$sales[$x]['sum_qty']."</td>";
                                            $totaly[$x] += $sales[$p]['sum_qty'];
                                            echo "<td>".$sales[$p]['sum_qty']."</td>";
                                            $totalx += $sales[$p]['sum_qty'];
                                            $p++;
                                        } else {
                                            for($a=$p; $a<$countP; $a++){
                                                echo "<td>0</td>";
                                            }
                                            break;
                                        }
                                    } else {
                                        echo "<td>0</td>";
                                    }
                                }
                                echo "<td>".$totalx."</td>";
                                $totalAll += $totalx;
                                $s=($p-1);
                                echo "</tr>";
                                
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><strong>Total</strong></th>
                            <?php
                                for($x=0; $x<count($totaly); $x++){
                                    echo "<th><strong>".$totaly[$x]."</strong></th>";
                                }
                                echo "<th></th>";
                            ?>
                        </tr>
                        <tr>
                            <th colspan="<?= ($countP+1); ?>">Grand Total</th>
                            <th class="bg-info"><?= $totalAll; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>