<?php

namespace frontend\modules\accounting\controllers;

use Yii;
use frontend\modules\models\accounting\CollectionType;
use frontend\modules\models\accounting\search\CollectionType as CollectionTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CollectiontypeController implements the CRUD actions for CollectionType model.
 */
class CollectionTypeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CollectionType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CollectionTypeSearch();
        $dataProvider = $searchModel->searchCollection(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CollectionType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('crud/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CollectionType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CollectionType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['crud/view', 'id' => $model->id]);
        }

        return $this->render('crud/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CollectionType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('crud/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CollectionType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CollectionType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CollectionType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CollectionType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
