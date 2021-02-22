<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\bootstrap4\Modal;
//use kartikorm\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'user_id')->textInput() ?>-->
    <div class="container-fluid">
        <div class="row">
            <label for="name">Name:</label>
            <div class="col-md-12 col-sm 12" id="name">
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => 'Firstname']) ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'middlename')->textInput(['maxlength' => true, 'placeholder' => 'Middlename']) ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => 'Lastname']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="address">Address:</label>
            <div class="col-md-12 col-sm 12" id="address">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-3 col-sm-3">
                        <!--?= Html::dropDownList('region_id', null, $region, ['class' => 'form-control', 'prompt' => 'Select Region', 'aria-required' => 'true', 'aria-invalid' => 'true']); ?>-->
                        <?= $form->field($address, 'region_id')->dropDownList($region,[
                            'prompt'=>'Select Region',
                            //'onchange' => 'getProvince();',
                            /*'ajax' => [
                                'type'=>'POST', 
                                'url'=>Url::to(['master-list/loadprovince']), //or $this->createUrl('loadcities') if '$this' extends CController
                                //'update'=>'#employeeaddress-province_id', //or 'success' => 'function(data){...handle the data in the way you want...}',
                                'success' => 'function(data){
                                    console.log(data);
                                }',
                                'data'=>['region_id'=>'js:this.value',]
                            ]*/
                        ])->label('Region'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($address, 'province_id')->dropDownList(['prompt'=>'Select Province'])->label('Province'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($address, 'municipality_id')->dropDownList(['prompt'=>'Select Municipality'])->label('Municipality'); ?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($address, 'barangay_id')->dropDownList(['prompt'=>'Select Barangay'])->label('Barangay'); ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($address, 'prefix_address')->textInput(['maxlength' => true, 'placeholder' => 'House/BLock/Lot No., Street, Subdivision/Village'])->label('Address') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <label for="others">Others:</label>
            <div class="col-md-12 col-sm 12" id="others">
                <div class="col-md-4 col-sm-4">
                    <!--?= $form->field($model, 'date_of_birth')->textInput() ?>-->
                    <?= $form->field($model, 'date_of_birth')->widget(DatePicker::classname(), [ 'options' => ['placeholder' => 'MM/DD/YYYY', 'class' =>['form-control-sm']], 'pluginOptions' => [ 'autoclose'=>true, 'format' => 'yyyy-mm-dd' ]]); ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'cellphone_number')->textInput(['maxlength' => true, 'placeholder' => '09XX-XXX-XXXX']) ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'telephone_number')->textInput(['maxlength' => true, 'placeholder' => '(02)-XXX-XX-XX']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm 12">
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($affiliation, 'employment_designation_id')->dropDownList($employment_designation,['prompt'=>'Select Designation'])->label('Designation'); ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($affiliation, 'employment_status_id')->dropDownList($employment_status,['prompt'=>'Select Employment Status'])->label('Employment Status'); ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'status_id')->dropDownList($status,['prompt'=>'Select Status'])->label('Status'); ?>
                </div>
            </div>
        </div>
        <!--?= $form->field($model, 'user_code')->textInput() ?>
        ?= $form->field($model, 'address_id')->textInput() ?>

        ?= $form->field($model, 'is_active')->textInput() ?>

        ?= $form->field($model, 'employment_designation_id')->textInput() ?>

        ?= $form->field($model, 'employment_status_id')->textInput() ?>
        ?= $form->field($model, 'status_id')->textInput() ?>

        ?= $form->field($model, 'date_created')->textInput() ?>

        ?= $form->field($model, 'date_updated')->textInput() ?>

        ?= $form->field($model, 'date_deleted')->textInput() ?>-->

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
