<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\accounting\OopLog */

$this->title = 'Create Oop Log';
$this->params['breadcrumbs'][] = ['label' => 'Oop Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oop-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
