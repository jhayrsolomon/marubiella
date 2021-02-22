<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\models\cashier\OrCategory;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\cashier\OrSeries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="or-series-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'category_id')->textInput() ?>-->
    <?= $form->field($model, 'category_id')
        ->dropDownList(
            ArrayHelper::map(OrCategory::find()->all(), 'id', 'category'),           // Flat array ('id'=>'label')
            ['prompt'=>'-----Select Category-----']    // options
        )->label('Official Receipt Ccategory'); ?>

    <?= $form->field($model, 'start_or')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'next_or')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_or')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'status_id')->textInput() ?>-->
    <?= $form->field($model, 'status_id')->radioList( [1 => 'Active', 2 => 'Inactive'], ['unselect' => null] )->label('Status') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
