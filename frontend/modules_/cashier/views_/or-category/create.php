<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrCategory */

$this->title = 'Create Or Category';
$this->params['breadcrumbs'][] = ['label' => 'Or Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="or-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
