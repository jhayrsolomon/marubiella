<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\CustomerType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_type_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_type_description')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'is_active')->textInput() ?>

    ?= $form->field($model, 'date_created')->textInput() ?>

    ?= $form->field($model, 'date_updated')->textInput() ?>

    ?= $form->field($model, 'date_deleted')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
