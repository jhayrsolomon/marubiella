<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\search\OrCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Or Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="or-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Or Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fund_id',
            'category',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
