<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\CheckType */

$this->title = 'Create Check Type';
$this->params['breadcrumbs'][] = ['label' => 'Check Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
