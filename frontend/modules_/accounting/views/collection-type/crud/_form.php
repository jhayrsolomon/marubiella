<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\models\accounting\FundCLuster;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\CollectionType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="collection-type-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'collection_name')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'fund_id')->textInput() ?>-->
    <?= $form->field($model, 'fund_id')
        ->dropDownList(
            ArrayHelper::map(FundCLuster::find()->all(), 'id', 'fund_name'),           // Flat array ('id'=>'label')
            ['prompt'=>'-----Select Fund Cluster-----']    // options
        )->label('Fund Cluster'); ?>

    <?= $form->field($model, 'collection_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uacs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uacs_desc')->textInput(['maxlength' => true])->label('UACS Description') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
