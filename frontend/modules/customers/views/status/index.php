<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\CustomerStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-status-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customer Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_status_code',
            'customer_status_name',
            'customer_status_description',
            'is_active',
            //'date_created',
            //'date_updated',
            //'date_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
