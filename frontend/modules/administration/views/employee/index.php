<?php

use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use frontend\modules\models\Status;
use frontend\modules\models\EmployeeAffiliation;
use frontend\modules\models\EmploymentDesignation;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Employee Master List';
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
                        'firstname',
                        'middlename',
                        'lastname',
                        'cellphone_number',
                        [
                            'attribute' => 'date_of_birth',
                            'value' => function($model){
                                return date('M d, Y', strtotime($model->date_of_birth));
                            },
                        ],
                        [
                            'attribute' => 'employee_affilition_id',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'header' => 'Affiliation',
                            'value' => function($model){
                                $affiliation = EmployeeAffiliation::find()->where(['employee_id' => $model->id])->one();
                                $designation = EmploymentDesignation::find()->where(['id'=>$affiliation->employment_designation_id])->one();
                                return $designation->employment_designation_code_description;
                            }
                        ],
                        [
                            'attribute' => 'status_id',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'header' => 'Status',
                            'value' => function($model){
                                $status = Status::find()->where(['id' => $model->status_id])->one();
                                return $status->status_code;
                            }
                        ],
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
