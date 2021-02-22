<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\SalesOnline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-online-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <label for="name">Customer Name:</label>
            <div class="col-md-12 col-sm 12" id="name">
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($modelCustomer, 'customer_firstname')->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($modelCustomer, 'customer_middlename')->textInput(['maxlength' => true, 'placeholder' => 'Middlename']) ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($modelCustomer, 'customer_lastname')->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>
                </div>
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'care_of')->textInput(['maxlength' => true, 'placeholder' => 'Landmark'])->label('Care of Name') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="address">Address:</label>
            <div class="col-md-12 col-sm 12" id="address">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($modelCustomer, 'prefix_address')->textarea(['rows' => '2', 'placeholder' => 'House/BLock/Lot No., Street, Subdivision/Village'])->label('Prefix Address') ?>
                        <!--?= $form->field($modelCustomer, 'prefix_address')->textInput(['maxlength' => true, 'placeholder' => 'House/BLock/Lot No., Street, Subdivision/Village'])->label('Prefix Address') ?>-->
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($modelCustomer, 'landmark')->textarea(['rows' => '2', 'placeholder' => 'Landmark'])->label('Landmark') ?>
                        <!--?= $form->field($modelCustomer, 'landmark')->textInput(['maxlength' => true, 'placeholder' => 'Landmark'])->label('Landmark') ?>-->
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($modelCustomer, 'region_id')->dropDownList($region,[
                            'prompt'=>'Select Region',
                        ])->label('Region'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($modelCustomer, 'province_id')->dropDownList(['prompt'=>'Select Province'])->label('Province'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($modelCustomer, 'municipality_id')->dropDownList(['prompt'=>'Select Municipality'])->label('Municipality'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($modelCustomer, 'barangay_id')->dropDownList(['prompt'=>'Select Barangay'])->label('Barangay'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="others">Others Info</label>
            <div class="col-md-12 col-sm 12" id="others">
                <div class="col-md-3 col-sm-3">
                    <?= $form->field($model, 'customer_type_id')->dropDownList($customerType, ['prompt'=>'Select Customer Type'])->label('Customer Type'); ?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <?= $form->field($modelCustomer, 'gender')->dropDownList(['male', 'female'], ['prompt'=>'Select Gender'])->label('Gender'); ?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <?= $form->field($modelCustomer, 'age')->textInput(['maxlength' => true, 'placeholder' => 'Age', 'type'=>'number'])->label('Age') ?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <?= $form->field($model, 'sales_status_id')->dropDownList($salesStatus, ['prompt'=>'Select Status'])->label('Status'); ?>
                </div>
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'osr_remark')->textarea(['rows' => '2', 'placeholder' => 'Remark']) ?>
                </div>
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'page')->textInput(['maxlength' => true, 'placeholder' => 'Page'])->label('Page') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="product">Product Details</label>
            <div class="col-md-12 col-sm 12" id="product">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= $form->field($model, 'product_id')->dropDownList($product, ['prompt'=>'Select Product', 'name'=>'product_id[]'])->label(''); ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'quantity')->textInput(['maxlength' => true, 'placeholder' => 'Quantity', 'type' => 'number', 'name' => 'quantity[]'])->label('') ?>
                            </td>
                            <td>
                                <?= $form->field($model, 'collectible_amount')->textInput(['maxlength' => true, 'placeholder' => '0.00', 'type' => 'number', 'name' => 'collectible_amount[]', 'readonly' => true])->label('') ?>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="pull-right">TOTAL AMOUNT</th>
                            <th></th>
                            <th>
                                <?= $form->field($model, 'total_amount')->textInput(['readonly' => true, 'placeholder' => '0.00'])->label('') ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!--?= $form->field($model, 'sales_code')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'sales_tracking_number')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'courier_id')->textInput() ?>

    ?= $form->field($model, 'employee_id')->textInput() ?>

    ?= $form->field($model, 'team_id')->textInput() ?>

    ?= $form->field($model, 'customer_id')->textInput() ?>

    ?= $form->field($model, 'customer_type_id')->textInput() ?>

    ?= $form->field($model, 'product_id')->textarea(['rows' => 6]) ?>

    ?= $form->field($model, 'quantity')->textarea(['rows' => 6]) ?>

    ?= $form->field($model, 'collectible_amount')->textarea(['rows' => 6]) ?>

    ?= $form->field($model, 'total_amount')->textInput() ?>

    ?= $form->field($model, 'care_of')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'sales_status_id')->textInput() ?>

    ?= $form->field($model, 'osr_remark')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'page')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'csr_id')->textInput() ?>

    ?= $form->field($model, 'csr_remark')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'dispatcher_id')->textInput() ?>

    ?= $form->field($model, 'dispatcher_remark')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'is_active')->textInput() ?>

    ?= $form->field($model, 'date_created')->textInput() ?>

    ?= $form->field($model, 'date_updated')->textInput() ?>

    ?= $form->field($model, 'date_deleted')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
