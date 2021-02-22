<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrderOfPayment */

$this->title = 'Create Order Of Payment';
$this->params['breadcrumbs'][] = ['label' => 'Order Of Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-of-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
