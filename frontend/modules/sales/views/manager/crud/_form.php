<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\SalesOnline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-online-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sales_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_tracking_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'courier_id')->textInput() ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'customer_type_id')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'care_of')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_status_id')->textInput() ?>

    <?= $form->field($model, 'osr_remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csr_id')->textInput() ?>

    <?= $form->field($model, 'csr_remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dispatcher_id')->textInput() ?>

    <?= $form->field($model, 'dispatcher_remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'date_updated')->textInput() ?>

    <?= $form->field($model, 'date_deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
