<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\technical\RequestLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'request_id')->textInput() ?>

    <?= $form->field($model, 'updated_fields')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
