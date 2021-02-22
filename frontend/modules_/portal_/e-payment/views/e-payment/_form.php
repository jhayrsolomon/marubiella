<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\portal\EPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="epayment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'merchant_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merchant_reference_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'particulars')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
