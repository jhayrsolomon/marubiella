<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\models\EmployeeDailyTimeRecord */

$this->title = 'Create Employee Daily Time Record';
$this->params['breadcrumbs'][] = ['label' => 'Employee Daily Time Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-daily-time-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
