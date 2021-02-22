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
    <?= $form->field($modelRequest, 'customer_id')->hiddenInput([
        'value' => $customer->customerId,
    ])->label(false) ?>
    <div class="row">
        <div class="col-lg-12">
            <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">
                <thead>
                    <tr style="background-color: #00adf1; color: white; font-size: 20px;">
                        <th colspan="4">
                            Particulars
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <i>***&nbsp;&nbsp;Fill-up all the necessary field/s for the request of <b>Order-of-Payment</b>&nbsp;&nbsp;***</i>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 25%; ">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label style="color: #3c8dbc;">Reference Number</label>
                                    <?= $form->field($modelRequest, 'reference_number')->textInput(['maxlength' => true, 'class' => 'form-control'])->label(false) ?>
                                </div>
                            </div>
                        </td>
                        <td style="width: 25%; ">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label style="color: #3c8dbc;">Division</label>
                                    <?= $form->field($modelRequest, 'div_id')
                                        ->dropdownList(
                                            ArrayHelper::map(Division::find()->all(), 'id', 'code'),
                                            ['prompt' => '---Select Division---'])
                                        ->label(false);
                                    ?>
                                </div>
                            </div>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="col-lg-12">
                                <div class="form-group">
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
                            </div>
                        </td>
                        <td>
                            <div class="col-lg-12">
                                <div class="form-group">
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
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap" width="100%">
                                <thead style="color: #3c8dbc;">
                                    <tr>
                                        <th>#</th>
                                        <th colspan="3" style="text-align: center">Request Details</th>
                                        <th>
                                            <button type="submit" class="btn btn-success pull-right" onclick="addPar();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add row</button>
                                        </th>
                                    </tr>
                                    <tr style="color: #3c8dbc;">
                                        <th></th>
                                        <th>Sample Code</th>
                                        <th>Sample Description</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="particulars">
                                    <tr id="par0">
                                        <td width="5%">
                                            <label style="color: #3c8dbc;">1</label>
                                        </td>
                                        <td width="25%">
                                            <input type="text" id="code0" class="form-control" name="code[]" maxlength="50" aria-required="true" aria-invalid="true" placeholder="Sample Code" required>
                                        </td>
                                        <td width="45%">
                                            <textarea id="description0" class="form-control" name="description[]" maxlength="500" rows="1" aria-required="true" required></textarea>
                                        </td>
                                        <td width="20%">
                                            <input type="number" id="amount0" class="form-control" name="amount[]" onchange="totalAmount();" aria-required="true" placeholder="0.00" required>
                                        </td>
                                        <td width="5%"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <label style="color: #3c8dbc;">Remarks</label>
                                            <?= $form->field($modelRequest, 'remarks')->textarea(
                                                [
                                                    'rows' => '1',
                                                    'maxlength' => true,
                                                    'class' => 'form-control'
                                                ])->label(false) ?>
                                        </td>
                                        <td>
                                            <label style="color: #3c8dbc;">Total</label>
                                            <?= $form->field($modelRequest, 'total_amount')->textInput(
                                            [
                                                'type'=> 'number',
                                                'maxlength' => true,
                                                'class' => 'form-control',
                                                'value' => '0.00',
                                                'readonly' => true
                                            ])->label(false) ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="form-group">
                                                <?= Html::submitButton('Save Request', ['class' => 'btn btn-success']) ?>
                                                <!--?= Html::submitButton('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Save Request', ['class' => 'btn btn-success']) ?>-->
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>