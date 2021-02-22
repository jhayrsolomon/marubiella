<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\Employee */

$this->title = 'Employee';
$context = 'Employee: ' . $model->status_id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view" style="background-color: white;">
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
                            <td><?= $model->firstname.' '.$model->lastname; ?></td>
                            <th>Date of Birth</th>
                            <td><?= date('M d, Y', strtotime($model->date_of_birth)); ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td colspan="3"><?= $address; ?></td>
                        </tr>
                        <tr>
                            <th>Contact Information</th>
                            <td colspan="3"><?= 'Cellphone #: '.$model->cellphone_number.'; Telephone #: '.$model->telephone_number; ?></td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td><?= $affiliation['designation']; ?></td>
                            <th>Employment Status</th>
                            <td><?= $affiliation['status']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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

    <!--?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'user_code',
            'firstname',
            'middlename',
            'lastname',
            'cellphone_number',
            'telephone_number',
            'date_of_birth',
            'is_active',
            'status_id',
            'date_created',
            'date_updated',
            'date_deleted',
        ],
    ]) ?>-->

</div>
