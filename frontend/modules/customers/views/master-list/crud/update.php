<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\Customer */

$this->title = 'Marubiella';
$context = 'Customer: ' . $model->customer_code;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update" style="background-color: white;">
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
        <?= $this->render('_formu', [
            'model' => $model,
            'region' => $region,
            'province' => $province,
            'municipality' => $municipality,
            'barangay' => $barangay,
            'customer_type' => $customer_type,
            'customer_status' => $customer_status,
        ]) ?>
    </div>
</div>
