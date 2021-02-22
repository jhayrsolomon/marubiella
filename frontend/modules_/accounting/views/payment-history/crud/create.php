<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\accounting\PaymentHistory */

$this->title = 'Create Payment History';
$this->params['breadcrumbs'][] = ['label' => 'Payment Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
