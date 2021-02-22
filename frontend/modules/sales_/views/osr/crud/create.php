<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\SalesOnline */

/*$this->title = 'Create Sales Online';
$this->params['breadcrumbs'][] = ['label' => 'Sales Onlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/

$this->title = 'Sales';
//$context = 'Sales: ';
$params = 'Add Sales';
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['/sales/dashboard']];
$this->params['breadcrumbs'][] = $params;
?>
<div class="sales-online-create" style="background-color: white;">
    <div class="container-fluid">
        <!--<div class="row">
            <div class="col-lg-12 context">
                Manage ?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)).'&nbsp;'.$params; ?>
            </div>
        </div>-->
        <div class="row">
            <div class="col-lg-12">
                <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'homeLink' => false,
                    ]);
                ?>
            </div>
        </div>
        <?= $this->render('_form', [
            'model' => $model,
            'modelCustomer' => $modelCustomer,
            'customerType' => $customerType,
            'product' => $product,
            'barangay' => $barangay,
            'municipality' => $municipality,
            'province' => $province,
            'region' => $region,
            'salesStatus' => $salesStatus,
        ]) ?>
    </div>
</div>
