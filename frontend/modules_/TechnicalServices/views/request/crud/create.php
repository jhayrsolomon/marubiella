<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\technical\Request */

$params = ucfirst(Yii::$app->controller->action->id);
$this->title = 'OneLab';
$context = 'Technical Services&nbsp;&#45;'.ucfirst(Yii::$app->controller->id);
$this->params['breadcrumbs'][] = ['label' => 'Request', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Customer', 'url' => ['customer']];
$this->params['breadcrumbs'][] = $params;
?>
<div class="request-create" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false,
                    ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <b style="font-size: 24px;"><?= $customer->customerName; ?></b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?= $customer->address; ?></i><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><?= $customer->email; ?></i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid">
                    <?= $this->render('_formCreate', [
                        'modelRequest' => $modelRequest,
                        'customer' => $customer,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
