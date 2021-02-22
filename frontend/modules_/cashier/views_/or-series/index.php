<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\search\OrSeries */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Or Series';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="or-series-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Or Series', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'start_or',
            'next_or',
            'end_or',
            //'status_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
