<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\portal\EPayment */

$this->title = 'Create E Payment';
$this->params['breadcrumbs'][] = ['label' => 'E Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epayment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
