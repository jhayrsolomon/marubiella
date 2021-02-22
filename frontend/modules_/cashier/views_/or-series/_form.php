<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrSeries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="or-series-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'start_or')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'next_or')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_or')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
