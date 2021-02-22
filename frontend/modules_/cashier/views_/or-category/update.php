<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrCategory */

$this->title = 'Update Or Category: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Or Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="or-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
