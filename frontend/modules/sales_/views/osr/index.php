<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\SalesOnlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Onlines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-online-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sales Online', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sales_code',
            'sales_tracking_number',
            'courier_id',
            'employee_id',
            //'team_id',
            //'customer_id',
            //'customer_type_id',
            //'product_id:ntext',
            //'quantity:ntext',
            //'collectible_amount:ntext',
            //'total_amount',
            //'care_of',
            //'sales_status_id',
            //'osr_remark',
            //'page',
            //'csr_id',
            //'csr_remark',
            //'dispatcher_id',
            //'dispatcher_remark',
            //'is_active',
            //'date_created',
            //'date_updated',
            //'date_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
