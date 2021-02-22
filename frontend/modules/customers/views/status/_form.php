<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\CustomerStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_status_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_status_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_status_description')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'is_active')->textInput() ?>

    ?= $form->field($model, 'date_created')->textInput() ?>

    ?= $form->field($model, 'date_updated')->textInput() ?>

    ?= $form->field($model, 'date_deleted')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
