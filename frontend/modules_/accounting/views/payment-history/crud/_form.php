<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\accounting\PaymentHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'details_id')->textInput() ?>

    <?= $form->field($model, 'receipt_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
