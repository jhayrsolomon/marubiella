<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\portal\search\EPayment */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'E Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epayment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create E Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'merchant_code',
            'merchant_reference_number',
            'particulars',
            'transaction_type',
            //'total_amount',
            //'status_id',
            //'created_date',
            //'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
