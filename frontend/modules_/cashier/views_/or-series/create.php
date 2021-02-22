<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\OrSeries */

$this->title = 'Create Or Series';
$this->params['breadcrumbs'][] = ['label' => 'Or Series', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="or-series-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
