<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_code') ?>

    <?= $form->field($model, 'customer_firstname') ?>

    <?= $form->field($model, 'customer_middlename') ?>

    <?= $form->field($model, 'customer_lastname') ?>

    <?php // echo $form->field($model, 'customer_type_id') ?>

    <?php // echo $form->field($model, 'prefix_address') ?>

    <?php // echo $form->field($model, 'barangay_id') ?>

    <?php // echo $form->field($model, 'municipality_id') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'region_id') ?>

    <?php // echo $form->field($model, 'landmark') ?>

    <?php // echo $form->field($model, 'customer_status_id') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_updated') ?>

    <?php // echo $form->field($model, 'date_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
