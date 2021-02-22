<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\agency\RequestData */

$this->title = 'Create Request Data';
$this->params['breadcrumbs'][] = ['label' => 'Request Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
