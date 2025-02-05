<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\FundCluster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fund-cluster-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'fund_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fund_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
