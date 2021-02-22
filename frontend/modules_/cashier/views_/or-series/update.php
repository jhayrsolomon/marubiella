<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrSeries */

$this->title = 'Update Or Series: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Or Series', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="or-series-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
