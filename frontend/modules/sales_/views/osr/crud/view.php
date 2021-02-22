<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\SalesOnline */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Onlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sales-online-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sales_code',
            'sales_tracking_number',
            'courier_id',
            'employee_id',
            'team_id',
            'customer_id',
            'customer_type_id',
            'product_id:ntext',
            'quantity:ntext',
            'collectible_amount:ntext',
            'total_amount',
            'care_of',
            'sales_status_id',
            'osr_remark',
            'page',
            'csr_id',
            'csr_remark',
            'dispatcher_id',
            'dispatcher_remark',
            'is_active',
            'date_created',
            'date_updated',
            'date_deleted',
        ],
    ]) ?>

</div>
