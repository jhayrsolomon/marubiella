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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sales_code') ?>

    <?= $form->field($model, 'sales_tracking_number') ?>

    <?= $form->field($model, 'courier_id') ?>

    <?= $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'team_id') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'customer_type_id') ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'collectible_amount') ?>

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

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
