<?php

namespace frontend\modules\employee\controllers;

use Yii;
use frontend\modules\models\Employee;
use frontend\modules\models\EmployeeSearch;
use yii\web\Controller;

/**
 * Default controller for the `employee` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
