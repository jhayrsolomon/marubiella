<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\Customer */

$this->title = 'Marubiella';
$context = 'Customer: ' . $model->customer_code;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view" style="background-color: white;">
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
            <div class="col-md-12 col-sm 12">
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td><?= $model->customer_firstname.' '.$model->customer_lastname; ?></td>
                            <th>Status</th>
                            <td><?= $model->customer_status_id; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td colspan="3"><?= $address; ?></td>
                        </tr>
                        <tr>
                            <th>Customer Type</th>
                            <td><?= $type->customer_type_name; ?></td>
                            <th>Customer Status</th>
                            <td><?= $status->customer_status_name; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-md-12 col-sm 12">
                ?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                        'customer_code',
                        'customer_firstname',
                        'customer_middlename',
                        'customer_lastname',
                        'customer_type_id',
                        'prefix_address',
                        'barangay_id',
                        'municipality_id',
                        'province_id',
                        'region_id',
                        'landmark',
                        'customer_status_id',
                        //'is_active',
                        //'date_created',
                        //'date_updated',
                        //'date_deleted',
                    ],
                ]) ?>
            </div>
        </div>-->
    </div>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
