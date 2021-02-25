<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\SalesOnlineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-online-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
    <div class="container-fluid bg-info">
        <div class="row">
            <label for="search">Search:</label>
            <div class="col-md-12 col-sm-12 form-group" id="search">
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'sales_code') ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($model, 'employee_id') ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php // $form->field($model, 'id') ?>

    

    <?php // $form->field($model, 'sales_tracking_number') ?>

    <?php // $form->field($model, 'courier_id') ?>

    

    <?php // echo $form->field($model, 'team_id') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'customer_type_id') ?>

    <?php // echo $form->field($model, 'total_amount') ?>

    <?php // echo $form->field($model, 'care_of') ?>

    <?php // echo $form->field($model, 'sales_status_id') ?>

    <?php // echo $form->field($model, 'osr_remark') ?>

    <?php // echo $form->field($model, 'page') ?>

    <?php // echo $form->field($model, 'csr_id') ?>

    <?php // echo $form->field($model, 'csr_remark') ?>

    <?php // echo $form->field($model, 'dispatcher_id') ?>

    <?php // echo $form->field($model, 'dispatcher_remark') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_updated') ?>

    <?php // echo $form->field($model, 'date_deleted') ?>

    <!--<div class="form-group">
        ?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        ?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>-->

    <?php ActiveForm::end(); ?>

</div>
