<?php

namespace frontend\modules\customers\controllers;

use Yii;
use frontend\modules\models\Customer;
use frontend\modules\models\CustomerSearch;
use yii\web\Controller;

/**
 * Default controller for the `customers` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
