<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Marubiella | Home';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index" style="background-color: white;">
    <div class="row">
        <div class="col-lg-12" style="text-align: center !important;">
            <img class="logo" src="<?= Yii::$app->request->baseUrl ?>/images/marubiella.png" alt="MARUBIELLA Logo"/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="text-align: center !important;">
            <h1>
                Marubiella Information Management System
            </h1>
        </div>
    </div>
</div>
