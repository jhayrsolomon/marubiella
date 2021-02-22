<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\accounting\OopLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oop-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oop_id')->textInput() ?>

    <?= $form->field($model, 'updated_fields')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
