<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrderOfPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-of-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'transaction_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'fund_id')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'total_balance')->textInput() ?>

    <!--?= $form->field($model, 'status_id')->textInput() ?>

    ?= $form->field($model, 'date_op')->textInput() ?>

    ?= $form->field($model, 'create_time')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
