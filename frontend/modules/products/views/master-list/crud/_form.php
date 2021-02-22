<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number']) ?>

    <!--?= $form->field($model, 'is_active')->textInput() ?>

    ?= $form->field($model, 'date_created')->textInput() ?>

    ?= $form->field($model, 'date_updated')->textInput() ?>

    ?= $form->field($model, 'date_deleted')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
