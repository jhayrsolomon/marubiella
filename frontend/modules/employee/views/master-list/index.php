<?php

use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use frontend\modules\models\Status;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employee';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Master List';
?>
<div class="employee-index" style="background-color: white;">
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
                        'Add Employee',
                        ['create',],
                        [
                            'title' => 'Employee',
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
                        //'id',
                        //'user_id',
                        //'user_code',
                        'firstname',
                        'middlename',
                        'lastname',
                        'cellphone_number',
                        //'telephone_number',
                        [
                            'attribute' => 'date_of_birth',
                            'value' => function($model){
                                return date('M d, Y', strtotime($model->date_of_birth));
                            },
                        ],
                        //'date_of_birth',
                        //'is_active',
                        //'employment_designation_id',
                        //'employment_status_id',
                        [
                            'attribute' => 'status_id',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'header' => 'Status',
                            'value' => function($model){
                                $status = Status::find()->where(['id' => $model->status_id])->one();
                                return $status->status_code;
                            }
                        ],
                        //'status_id',
                        //'date_created',
                        //'date_updated',
                        //'date_deleted',

                        //['class' => 'yii\grid\ActionColumn'],
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

