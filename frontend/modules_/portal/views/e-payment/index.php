<?php

use yii\helpers\Html;

$this->title = 'OneLab: e-Payment';
?>
<style>
    #background{
        background-image: url('<?= Yii::$app->request->baseUrl; ?>/images/onelab_opacity.png');
        background-size: cover;
        background-position: top;
    }
    #mrn{
        border-radius: 3px;
        font-size: 20px;
        height: auto;
    }
    #mrn-label{
        background-color: black;
        color: aliceblue;
        font-size: 20px;
        border-radius: 3px;
        padding: 10px;
    }
    #mrn-submit{
        background-color: #00506b;
        color: white;
        font-size: 20px;
    }
</style>
<form action="e-payment/details" method="post" name="mrn-form" id="mrn-form">
    <?=yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)?>
    <div class="e-payment-index" >
        <div class="container-fluid" id="background">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8" style="padding-top: 150px;">
                        <div class="col-lg-12 form-group">
                            <label id="mrn-label" for="mrn" ><b>Merchant Reference Number</b></label>
                            <input type="text" class="form-control" placeholder="Enter Merchant Reference Number" id="mrn" name="mrn">
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8" style="padding-bottom: 150px;">
                        <div class="col-lg-12 form-group">
                            <button id="mrn-submit" class="btn btn-lg pull-right"><b>Submit</b></button>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
</form>