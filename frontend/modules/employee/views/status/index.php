<?php

use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Status';
?>
<div class="status-index" style="background-color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 context">
                Manage
                <?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($context)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding: 10px;">
                <div class="col-lg-3">
                    <?= Html::a(
                        'Add Status',
                        ['create',],
                        [
                            'title' => 'Status',
                            'class' => 'btn btn-success'
                        ]
                    ); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'status_code',
                        'status_description',

                        /*['class' => 'yii\grid\ActionColumn'],*/
                        [
                            'header' => 'Action',
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width: 100px; color: #3c8dbc; width: 7%',],
                            'template' => '{assign}',
                            'buttons' => [
                                'assign' => function($url, $model, $key) {
                                    return Html::a(
                                        '',
                                        ['update', 'id' => $model->id],
                                        [
                                            'title' => 'Update',
                                            'class' => 'btn-primary btn-xs glyphicon glyphicon-edit',
                                        ]
                                    ).'&nbsp;'.Html::a(
                                        '',
                                        ['view', 'id' => $model->id],
                                        [
                                            'title' => 'View',
                                            'class' => 'btn-success btn-xs glyphicon glyphicon-eye-open',
                                        ]
                                    ).
                                        //With user Privedge of admin
                                        '&nbsp;'.Html::a(
                                        '',
                                        [''],
                                        [
                                            'title' => 'Delete',
                                            'class' => 'btn-danger btn-xs glyphicon glyphicon-remove',
                                        ]
                                    );
                                }
                            ]
                        ]
                    ],
                    'responsive'=>true,
                    'hover'=>true,
                ]); ?>
            </div>
        </div>
    </div>
</div>
