<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\CustomerType */

$this->title = 'Create Customer Type';
$this->params['breadcrumbs'][] = ['label' => 'Customer Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
