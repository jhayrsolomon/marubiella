<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\models\accounting\FundCLuster;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\cashier\OrCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="or-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'fund_id')->textInput() ?>-->
    <?= $form->field($model, 'fund_id')
        ->dropDownList(
            ArrayHelper::map(FundCLuster::find()->all(), 'id', 'fund_name'),           // Flat array ('id'=>'label')
            ['prompt'=>'-----Select Fund Cluster-----']    // options
        )->label('Fund Cluster'); ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
