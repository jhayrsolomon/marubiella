<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\ModeOfPayment */

$this->title = 'Create Mode Of Payment';
$this->params['breadcrumbs'][] = ['label' => 'Mode Of Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mode-of-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
