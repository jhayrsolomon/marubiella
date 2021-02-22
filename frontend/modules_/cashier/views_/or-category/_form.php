<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="or-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fund_id')->textInput() ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
