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
            <div class="col-md-4 col-sm-4">
                <label for="customer">Customer Details:</label>
                <div class="col-md-12 col-sm-12 form-group" id="customer">
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'customer_firstname')->textInput(['maxlength' => true, 'placeholder' => 'Firstname', 'class' => 'form-control form-control-sm'])->label('Firstname') ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'customer_middlename')->textInput(['maxlength' => true, 'placeholder' => 'Middlename', 'class' => 'form-control form-control-sm'])->label('Middlename') ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'customer_lastname')->textInput(['maxlength' => true, 'placeholder' => 'Lastname', 'class' => 'form-control form-control-sm'])->label('Lastname') ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'gender')->dropDownList(['Male', 'Female'], ['prompt'=>'Select Gender', 'class' => 'form-control form-control-sm'])->label('Gender'); ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'age')->textInput(['maxlength' => true, 'placeholder' => 'Age', 'type'=>'number', 'class' => 'form-control form-control-sm'])->label('Age') ?>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <label for="address">Customer Address:</label>
                <div class="col-md-12 col-sm-12 form-group" id="address">
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'prefix_address')->textarea(['rows' => '2', 'placeholder' => 'House/BLock/Lot No., Street, Subdivision/Village', 'class' => 'form-control form-control-sm'])->label('Prefix Address') ?>
                        <!--?= $form->field($modelCustomer, 'prefix_address')->textInput(['maxlength' => true, 'placeholder' => 'House/BLock/Lot No., Street, Subdivision/Village'])->label('Prefix Address') ?>-->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'region_id')->dropDownList($region,['prompt'=>'Select Region', 'class' => 'form-control form-control-sm'])->label('Region'); ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'province_id')->dropDownList(['prompt'=>'Select Province', 'class' => 'form-control form-control-sm'])->label('Province'); ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'municipality_id')->dropDownList(['prompt'=>'Select Municipality', 'class' => 'form-control form-control-sm'])->label('Municipality'); ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'barangay_id')->dropDownList(['prompt'=>'Select Barangay', 'class' => 'form-control form-control-sm'])->label('Barangay'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <label for="others">Other Details:</label>
                <div class="col-md-12 col-sm-12 form-group" id="others">
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($model, 'customer_type_id')->dropDownList($customerType, ['prompt'=>'Select Customer Type', 'class' => 'form-control form-control-sm'])->label('Customer Type'); ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($model, 'care_of')->textInput(['maxlength' => true, 'placeholder' => 'Name', 'class' => 'form-control form-control-sm'])->label('Care of Name')->label('Care of') ?>
                    </div>
                    <!--<div class="col-md-12 col-sm-12">
                        ?= $form->field($model, 'sales_status_id')->dropDownList($salesStatus, ['prompt'=>'Select Status', 'class' => 'form-control form-control-sm'])->label('Status'); ?>
                    </div>-->
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($model, 'osr_remark')->textarea(['rows' => '2', 'placeholder' => 'Remark', 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($model, 'page')->textInput(['maxlength' => true, 'placeholder' => 'Page', 'class' => 'form-control form-control-sm'])->label('Page') ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($modelCustomer, 'landmark')->textarea(['rows' => '2', 'placeholder' => 'Landmark', 'class' => 'form-control form-control-sm'])->label('Landmark') ?>
                        <!--?= $form->field($modelCustomer, 'landmark')->textInput(['maxlength' => true, 'placeholder' => 'Landmark'])->label('Landmark') ?>-->
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <label for="contact">Contact Details</label>
                <div class="col-md-12 col-sm-12" id="contact">

                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($modelCustomer, 'cellphone_number')->textInput(['maxlength' => true, 'placeholder' => 'Cellphone Number', 'class' => 'form-control form-control-sm'])->label('Cellphone Number') ?>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($modelCustomer, 'telephone_number')->textInput(['maxlength' => true, 'placeholder' => 'Telephone Number', 'class' => 'form-control form-control-sm'])->label('Telephone Number') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="product">Product Details</label>
            <div class="col-md-12 col-sm-12 form-group" id="product">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">Product Name</th>
                            <th width="30%">Quantity</th>
                            <th width="30%">Amount</th>
                            <th width="5%">
                                <button type="button" class="btn btn-success btn-sm" onclick="addRowProduct();">
                                    <i class="fa fa-plus" aria-hidden="true"></i> <span>Add</span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="productRow">
                        <tr>
                            <th class="text-center">1</th>
                            <td>
                                <?= $form->field($modelProductSales, 'product_id')->dropDownList($product, ['prompt'=>'Select Product', 'name'=>'product_id[]', 'id' => 'product_id0', 'class' => 'form-control form-control-sm', 'onchange' => 'getDetails(0);'])->label(''); ?>
                            </td>
                            <td>
                                <?= $form->field($modelProductSales, 'quantity')->textInput(['maxlength' => true, 'placeholder' => 'Quantity', 'type' => 'number', 'name' => 'quantity[]', 'id' => 'quantity0', 'class' => 'form-control form-control-sm', 'onchange' => 'getQuantity(0);'])->label('') ?>
                            </td>
                            <td>
                                <?= $form->field($modelProductSales, 'collectible_amount')->textInput(['maxlength' => true, 'placeholder' => '0.00', 'type' => 'number', 'name' => 'collectible_amount[]', 'id' => 'collectible_amount0', 'readonly' => true, 'class' => 'form-control form-control-sm'])->label('') ?>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right center"><strong>TOTAL AMOUNT</strong></td>
                            <td>
                                <?= $form->field($model, 'total_amount')->textInput(['readonly' => true, 'placeholder' => '0.00', 'type' => 'number', 'class' => 'form-control form-control-sm'])->label('') ?>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>