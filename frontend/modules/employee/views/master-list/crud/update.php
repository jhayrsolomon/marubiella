<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\Employee */

$this->title = 'Marubiella';
$context = 'Employee: ' . $model->user_code;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-update" style="background-color: white;">
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
        <!--<div class="row">
            <div class="col-lg-12">-->
                <?= $this->render('_formu', [
                    'model' => $model,
                    'address' => $address,
                    'affiliation' => $affiliation,
                    'status' => $status,
                    'region' => $region,
                    'province' => $province,
                    'municipality' => $municipality,
                    'barangay' => $barangay,
                    'employment_designation' => $employment_designation,
                    'employment_status' => $employment_status,
                ]) ?>
            <!--</div>
        </div>-->
    </div>
</div>
