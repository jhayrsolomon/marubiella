<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\accounting\search\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fund_id') ?>

    <?= $form->field($model, 'service_code') ?>

    <?= $form->field($model, 'uacs') ?>

    <?= $form->field($model, 'subject_code') ?>

    <?php // echo $form->field($model, 'uacs_desc') ?>

    <?php // echo $form->field($model, 'service_title') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
