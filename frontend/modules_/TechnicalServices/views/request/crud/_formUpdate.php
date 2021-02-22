<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

use frontend\modules\models\agency\Division;
use frontend\modules\models\technical\search\Particulars as ParticularsSearch;
/* @var $this yii\web\View */
/* @var $model frontend\modules\models\technical\Request */
/* @var $form yii\widgets\ActiveForm */

$modelSearch = new ParticularsSearch();
$request = $modelSearch->getParticularsByRequestId($modelRequest->id);
?>

<div class="request-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-12">
            <!--<h4><b>
                ?= $custName; ?>
            </b></h4>
            ?= $form->field($modelRequest, 'customer_id')->hiddenInput([
                'value' => $customer_id,
            ])->label(false) ?>-->
            <h4><b>
                <?= $customer->customerName; ?>
            </b></h4>
            <?= $form->field($modelRequest, 'customer_id')->hiddenInput([
                'value' => $customer->customerId,
            ])->label(false) ?>
            
        </div>
    </div>
    <div class="row">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <i>***&nbsp;&nbsp;Fill-up all the necessary field/s for the request of <b>Technical Services</b>&nbsp;&nbsp;***</i>
            </div>
        </div>
    <div class="row">
        <div class="col-lg-12">
            <div class=" col-lg-3 form-group">
                <label style="color: #3c8dbc;">Reference Number</label>
                <?= $form->field($modelRequest, 'reference_number')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false) ?>
            </div>
            <div class="col-lg-3 form-group">
                <label style="color: #3c8dbc;">Division</label>
                <?= $form->field($modelRequest, 'div_id')
                    ->dropdownList(
                        ArrayHelper::map(Division::find()->all(), 'id', 'code'),
                        ['prompt' => '---Select Division---'])
                    ->label(false);
                ?>
                <!--<select class='form-control' name='division' id='division' >
                    <option value=''>Select Division</option>
                    ?php
                        $req = DivisionSearch::getAll();
                        foreach($req as $key=>$value){
                            echo "<option value='".$key."'>".$value."</option>";
                        }
                    ?>
                </select>-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class=" col-lg-3 form-group">
                <!--// Usage with model and Active Form (with no default initial value)-->
                <label style="color: #3c8dbc;">Request Date <i>(mm/dd/yyyy)</i></label>
                <?= $form->field($modelRequest, 'request_date')->widget(DatePicker::classname(), [
                    'options' => [
                        'placeholder' => 'Enter Request Date...',
                        'name' => 'request_date',
                     ],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ])->label(false); ?>
            </div>
            <div class=" col-lg-3 form-group">
                <!--// Usage with model and Active Form (with no default initial value)-->
                <label style="color: #3c8dbc;">Due Date <i>(mm/dd/yyyy)</i></label>
                <?= $form->field($modelRequest, 'due_date')->widget(DatePicker::classname(), [
                    'options' => [
                        'placeholder' => 'Enter Due Date...',
                        'name' => 'due_date',
                        'onchange' => 'validateDate()',
                    ],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ])->label(false); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table ">
                <thead>
                    <tr style="background-color: #1e5878;">
                        <th colspan="5" style="color: white; font-size: 16px; font-weight: bold;">
                            Particulars
                        </th>
                    </tr>
                    <tr>
                        <th style="color: #3c8dbc;">Item</th>
                        <th style="color: #3c8dbc;" colspan="3">Details</th>
                    </tr>
                </thead>
                <tbody id="particulars">
                    <tr id="par0">
                        <th width="5%"><label style="color: #3c8dbc;">1</label></th>
                        <td width="17%">
                            <label style="color: #3c8dbc;">Code</label>
                            <input type="text" id="code0" class="form-control" name="code[]" maxlength="50" aria-required="true" aria-invalid="true" value="<?= $request->code; ?>" required>
                        </td>
                        <td width="58%">
                            <label style="color: #3c8dbc;">Description</label>
                            <textarea id="description0" class="form-control" name="description[]" maxlength="500" rows="1" aria-required="true" required><?= $request->description; ?></textarea>
                        </td>
                        <td width="15%">
                            <label style="color: #3c8dbc;">Amount</label>
                            <input type="number" id="amount0" class="form-control" name="amount[]" onchange="totalAmount();" aria-required="true" value="<?= $modelRequest->total_amount; ?>" required>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            <label style="color: #3c8dbc;">Remarks</label>
                            <?= $form->field($modelRequest, 'remarks')->textarea(
                                [
                                    'rows' => '1',
                                    'maxlength' => true,
                                    'class' => 'form-control'
                                ])->label(false) ?>
                        </td>
                        <td width="8%" align="right">
                            <br>
                            <label style="color: #3c8dbc;">Total</label>
                        </td>
                        <td width="15%">
                            <br>
                            <?= $form->field($modelRequest, 'total_amount')->textInput(
                                [
                                    'type'=> 'number',
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    //'value' => '0.00',
                                    'readonly' => true
                                ])->label(false) ?>
                        </td>
                        <td width="5%"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!--?= $form->field($model, 'reference_number')->textInput(['maxlength' => true]) ?>

    ?= $form->field($model, 'request_date')->textInput() ?>

    ?= $form->field($model, 'due_date')->textInput() ?>

    ?= $form->field($model, 'total_amount')->textInput() ?>

    ?= $form->field($model, 'customer_id')->textInput() ?>

    ?= $form->field($model, 'div_id')->textInput() ?>

    ?= $form->field($model, 'status_id')->textInput() ?>

    ?= $form->field($model, 'created_date')->textInput() ?>

    ?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>-->

    <div class="form-group">
        <!--?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>-->
        <?= Html::submitButton('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>