<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\technical\RequestLog */

$this->title = 'Create Request Log';
$this->params['breadcrumbs'][] = ['label' => 'Request Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
