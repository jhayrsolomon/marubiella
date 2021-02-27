<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\SalesOnlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use frontend\modules\models\Employee;
use frontend\modules\models\SalesOnline;
use frontend\modules\models\Product;
use frontend\modules\models\SalesStatus;
use frontend\modules\models\Customer;
use frontend\modules\models\SalesProduct;
use kartik\daterange\DateRangePicker;
use yii\widgets\ActiveForm;

$this->title = 'CSR';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Sales Monitoring';
$this->params['breadcrumbs'][] = ['label' => 'Sales Onlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="sales-online-index" style="background-color: white;">
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
        <div class="row">
            <div class="col-sm-12">
                <table id="in_out_record" class="table table-sm table-condensed table-bordered">
                <!--<table id="in_out_record" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">-->
                    <thead>
                        <tr class="bg-info">
                            <th colspan="10">
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
                                    ['/sales/csr/verify-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_today',
                                    ],
                                    'class' => ['btn btn-primary '.$salestoday],
                                ]) ?>
                                <?= Html::a('This Week', 
                                    ['/sales/csr/verify-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_week',
                                    ],
                                    'class' => ['btn btn-primary '.$salesweek],
                                ]) ?>
                                <?= Html::a('This Month', 
                                    ['/sales/csr/verify-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_month',
                                    ],
                                    'class' => ['btn btn-primary '.$salesmonth],
                                ]) ?>
                                <?= Html::a('All', 
                                    ['/sales/csr/verify-sales'], [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'view_date_sales' => 'view_sales_all',
                                    ],
                                    'class' => ['btn btn-primary '.$salesall],
                                ]) ?>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php echo $this->render('crud/_search', ['model' => $searchModel, 'view_date_sales'=>(isset($_POST['view_date_sales']))?$_POST['view_date_sales']:'view_sales_today']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!--?php echo $this->render('crud/_search', ['model' => $searchModel]); ?>-->
                <div class="col-md-12 col-sm-12 bg-primary"><h5><strong>For Confirmation</strong></h5></div>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index) {
                                if(isset($_POST['view_date_sales'])){
                                    if($_POST['view_date_sales'] == 'view_sales_all'){
                                        $start_Date = date_format(date_create(date('Y-').'1-'.'1'), 'Y-m-d');
                                        $end_Date = date('Y-m-t');
                                        $sales = SalesOnline::find()->where(['<>', 'sales_status_id', 2])->all();
                                        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                                    } else {
                                        if($_POST['view_date_sales'] == 'view_sales_today'){
                                            $today = date('Y-m-d');
                                            $sales = SalesOnline::find()->where(['like', 'date_created', $today])->andWhere(['<>', 'sales_status_id', 2])->all();
                                        } else {
                                            if($_POST['view_date_sales'] == 'view_sales_week'){
                                                $d = date('d',strtotime('last Monday'));
                                                $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
                                                $start_Date = date('Y-m-d',strtotime('last Monday'));
                                            }
                                            if($_POST['view_date_sales'] == 'view_sales_month'){
                                                $start_Date = date_format(date_create(date('Y-m-').'1'), 'Y-m-d');
                                                $end_Date = date('Y-m-t');
                                            }
                                            $sales = SalesOnline::find()->where(['between', 'date_created', $start_Date, $end_Date])->andWhere(['<>', 'sales_status_id', 2])->all();
                                        }
                                    }
                                } else {
                                    $today = date('Y-m-d');
                                    $sales = SalesOnline::find()->where(['like', 'date_created', $today])->andWhere(['<>', 'sales_status_id', 2])->all();
                                }
                                foreach($sales as $value){
                                    if($model->sales_code == $value->sales_code){
                                        $salesModel = $value;
                                        $customer = Customer::find()->where(['id'=>$value->customer_id])->one();
                                        $customerName = $customer->customer_firstname.' '.$customer->customer_lastname;
                                        $customerContact = 'Cell#:'.$customer->cellphone_number.'<br>Tell#:'.$customer->telephone_number;
                                        //$product = Product::find()->where(['IN', 'id', json_decode($value->product_id)])->all();
                                        $productSales = SalesProduct::find()->where(['sales_online_id'=>$value->id])->all();
                                        $productId = array();
                                        foreach($productSales as $item){
                                            array_push($productId, $item->product_id);
                                        }
                                        $product = Product::find()->where(['IN', 'id', $productId])->all();
                                    }
                                }
                                
                                return $this->render('csrExpandRow', [
                                    'salesModel' => $salesModel,
                                    'customerName' => $customerName,
                                    'customerContact' => $customerContact,
                                    'productSales' => $productSales,
                                    'product' => $product,
                                ]);
                            },
                        ],

                        //'id',
                        'sales_code',
                        //'sales_tracking_number',
                        //'courier_id',
                        //'employee_id',
                        [
                            'attribute' => 'employee_id',
                            'header' => 'Employee',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                $employee = Employee::find()->where(['id'=>$model->employee_id])->one();
                                $name = $employee->firstname.' '.$employee->lastname;
                                return $name;
                            },
                        ],
                        'team_id',
                        [
                            'header' => 'Branch',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                        ],
                        //'customer_id',
                        //'customer_type_id',
                        //'care_of',
                        //'sales_status_id',
                        [
                            'attribute' => 'sales_status_id',
                            'header' => 'Sales Status',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                $status = SalesStatus::find()->where(['id'=>$model->sales_status_id])->one();
                                $name = $status->sales_status_name;
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'total_amount',
                            'header' => 'Total Amount',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                return number_format($model->total_amount, 2, '.', ',');
                            },
                        ],
                        //'total_amount',
                        //'osr_remark',
                        //'page',
                        //'csr_id',
                        //'csr_remark',
                        //'dispatcher_id',
                        //'dispatcher_remark',
                        //'is_active',
                        //'date_created',
                        //'date_updated',
                        //'date_deleted',

                        //['class' => 'yii\grid\ActionColumn'],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 7%',],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return "<button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#checkLocation' onclick='getSalesId(".$model->id.")'>
                                        <i class='glyphicon glyphicon-edit' aria-hidden='true'></i>
                                    </button>";

                                }
                            ]
                        ]
                    ],
                    'responsive'=>true,
                    'hover'=>true,
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="col-md-12 col-sm-12 bg-danger"><h5><strong>Unavailable</strong></h5></div>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderUnavailable,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index) {
                                if(isset($_POST['view_date_sales'])){
                                    if($_POST['view_date_sales'] == 'view_sales_all'){
                                        $start_Date = date_format(date_create(date('Y-').'1-'.'1'), 'Y-m-d');
                                        $end_Date = date('Y-m-t');
                                        $sales = SalesOnline::find()->where(['sales_status_id'=>3])->all();
                                        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                                    } else {
                                        if($_POST['view_date_sales'] == 'view_sales_today'){
                                            $today = date('Y-m-d');
                                            $sales = SalesOnline::find()->where(['like', 'date_created', $today])->andWhere(['sales_status_id'=>3])->all();
                                        } else {
                                            if($_POST['view_date_sales'] == 'view_sales_week'){
                                                $d = date('d',strtotime('last Monday'));
                                                $end_Date = date_format(date_create(date('Y-m-').($d+6)), 'Y-m-d');
                                                $start_Date = date('Y-m-d',strtotime('last Monday'));
                                            }
                                            if($_POST['view_date_sales'] == 'view_sales_month'){
                                                $start_Date = date_format(date_create(date('Y-m-').'1'), 'Y-m-d');
                                                $end_Date = date('Y-m-t');
                                            }
                                            $sales = SalesOnline::find()->where(['between', 'date_created', $start_Date, $end_Date])->andWhere(['<>', 'sales_status_id', 2])->all();
                                        }
                                    }
                                } else {
                                    $today = date('Y-m-d');
                                    $sales = SalesOnline::find()->where(['like', 'date_created', $today])->andWhere(['<>', 'sales_status_id', 2])->all();
                                }
                                foreach($sales as $value){
                                    if($model->sales_code == $value->sales_code){
                                        $salesModel = $value;
                                        $customer = Customer::find()->where(['id'=>$value->customer_id])->one();
                                        $customerName = $customer->customer_firstname.' '.$customer->customer_lastname;
                                        $customerContact = 'Cell#:'.$customer->cellphone_number.'<br>Tell#:'.$customer->telephone_number;
                                        //$product = Product::find()->where(['IN', 'id', json_decode($value->product_id)])->all();
                                        $productSales = SalesProduct::find()->where(['sales_online_id'=>$value->id])->all();
                                        $productId = array();
                                        foreach($productSales as $item){
                                            array_push($productId, $item->product_id);
                                        }
                                        $product = Product::find()->where(['IN', 'id', $productId])->all();
                                    }
                                }
                                
                                return $this->render('csrExpandRow', [
                                    'salesModel' => $salesModel,
                                    'customerName' => $customerName,
                                    'customerContact' => $customerContact,
                                    'productSales' => $productSales,
                                    'product' => $product,
                                ]);
                            },
                        ],

                        //'id',
                        'sales_code',
                        //'sales_tracking_number',
                        //'courier_id',
                        //'employee_id',
                        [
                            'attribute' => 'employee_id',
                            'header' => 'Employee',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                $employee = Employee::find()->where(['id'=>$model->employee_id])->one();
                                $name = $employee->firstname.' '.$employee->lastname;
                                return $name;
                            },
                        ],
                        'team_id',
                        [
                            'header' => 'Branch',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                        ],
                        //'customer_id',
                        //'customer_type_id',
                        //'care_of',
                        //'sales_status_id',
                        [
                            'attribute' => 'sales_status_id',
                            'header' => 'Sales Status',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                $status = SalesStatus::find()->where(['id'=>$model->sales_status_id])->one();
                                $name = $status->sales_status_name;
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'total_amount',
                            'header' => 'Total Amount',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                return number_format($model->total_amount, 2, '.', ',');
                            },
                        ],
                        //'total_amount',
                        //'osr_remark',
                        //'page',
                        //'csr_id',
                        //'csr_remark',
                        //'dispatcher_id',
                        //'dispatcher_remark',
                        //'is_active',
                        //'date_created',
                        //'date_updated',
                        //'date_deleted',

                        //['class' => 'yii\grid\ActionColumn'],
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 7%',],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return "<button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#checkLocation' onclick='getSalesId(".$model->id.")'>
                                        <i class='glyphicon glyphicon-edit' aria-hidden='true'></i>
                                    </button>";

                                }
                            ]
                        ]
                    ],
                    'responsive'=>true,
                    'hover'=>true,
                ]); ?>
            </div>
        </div>
        <!--<pre>
            ?php
                var_dump($sales);
            ?>
        </pre>-->
    </div>
</div>

<div class="modal fade" id="checkLocation" tabindex="-1" role="dialog" aria-labelledby="checkLocationTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="col-sm-9">
                    <h4 class="modal-title" id="checkLocationTitle"><strong>Update Sales</strong></h4>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="close btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span>
                    </button>
                </div>
            </div>
            <?php $form = ActiveForm::begin(['method' => 'post','action' => ['csr/update-sales'],]); ?>
            <div class="modal-body form-group">
                <input type="hidden" id="salesId" name="salesId" />
                <?= $form->field($modelSales, 'sales_status_id')->dropDownList($salesStatus, ['prompt'=>'Select Status', 'class' => 'form-control form-control-sm'])->label('Sales Status')->label('Sales Status'); ?>
                <?= $form->field($modelSales, 'csr_remark')->textarea(['rows' => '2', 'placeholder' => 'Remark(s)', 'class' => 'form-control form-control-sm'])->label('Remark(s)'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>