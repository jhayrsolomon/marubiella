<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm 12">
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'customer_code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'customer_type_id')->dropDownList($customer_type,['prompt'=>'Select Type'])->label('Customer Type'); ?>
                    
                    <!--?= $form->field($model, 'customer_type_id')->textInput() ?>-->
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'customer_status_id')->dropDownList($customer_status,['prompt'=>'Select Status'])->label('Status'); ?>
                    
                    <!--?= $form->field($model, 'customer_status_id')->textInput() ?>-->
                </div>
            </div>
        </div>
        <div class="row">
            <label for="customer_name">Customer's Name:</label>
            <div class="col-md-12 col-sm 12" id="customer_name">
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'customer_firstname')->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'customer_middlename')->textInput(['maxlength' => true, 'placeholder' => 'Middlename']) ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'customer_lastname')->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="address">Address:</label>
            <div class="col-md-12 col-sm 12" id="address">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($model, 'region_id')->dropDownList($region,[
                            'prompt'=>'Select Region',
                        ])->label('Region'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($model, 'province_id')->dropDownList(['prompt'=>'Select Province'])->label('Province'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($model, 'municipality_id')->dropDownList(['prompt'=>'Select Municipality'])->label('Municipality'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($model, 'barangay_id')->dropDownList(['prompt'=>'Select Barangay'])->label('Barangay'); ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($model, 'prefix_address')->textInput(['maxlength' => true, 'placeholder' => 'House/BLock/Lot No., Street, Subdivision/Village'])->label('Prefix Address') ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($model, 'landmark')->textInput(['maxlength' => true, 'placeholder' => 'Landmark']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
