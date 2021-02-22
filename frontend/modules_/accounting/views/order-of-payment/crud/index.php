<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\search\OrderOfPayment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Of Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-of-payment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order Of Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'transaction_num',
            'customer_id',
            'fund_id',
            'type_id',
            //'total_amount',
            //'total_balance',
            //'status_id',
            //'date_op',
            //'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
