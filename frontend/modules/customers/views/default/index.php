<?php

use yii\helpers\Html;
//use yii\grid\GridView;

use kartik\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use frontend\modules\models\Refregion;
use frontend\modules\models\Refprovince;
use frontend\modules\models\Refcitymun;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer';
//$this->params['breadcrumbs'][] = $this->title;
$context = 'Master List';
?>
<div class="customer-index" style="background-color: white;">
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
                        'Add Customer',
                        Url::toRoute(['master-list/create']),
                        [
                            'title' => 'Customer',
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

                        //'id',
                        'customer_code',
                        'customer_firstname',
                        'customer_middlename',
                        'customer_lastname',
                        //'customer_type_id',
                        //'prefix_address',
                        [
                            'attribute' => 'region_id',
                            'header' => 'Region',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                $region = Refregion::find()->where(['id' => $model->region_id])->one();
                                return $region->regDesc;
                            },
                        ],
                        [
                            'attribute' => 'province_id',
                            'header' => 'Province',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                $province = Refprovince::find()->where(['id' => $model->province_id])->one();
                                return $province->provDesc;
                            },
                        ],
                        [
                            'attribute' => 'municipality_id',
                            'header' => 'Municipality',
                            'headerOptions' => ['style' => 'color: #3c8dbc;',],
                            'value' => function($model){
                                $municipality = Refcitymun::find()->where(['id' => $model->municipality_id])->one();
                                return $municipality->citymunDesc;
                            },
                        ],
                        //'barangay_id',
                        //'municipality_id',
                        //'province_id',
                        //'region_id',
                        //'landmark',
                        'customer_status_id',
                        //'is_active',
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
                                        Url::toRoute(['master-list/update', 'id' => $model->id]),
                                        //['update', 'id' => $model->id],
                                        [
                                            'title' => 'Update',
                                            'class' => 'btn-primary btn-xs glyphicon glyphicon-edit',
                                        ]
                                    ).'&nbsp;'.Html::a(
                                        '',
                                        Url::toRoute(['master-list/view', 'id' => $model->id]),
                                        //['view', 'id' => $model->id],
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
