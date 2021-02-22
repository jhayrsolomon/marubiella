<?php

namespace frontend\modules\products\controllers;

use Yii;
use frontend\modules\models\Product;
use frontend\modules\models\ProductSearch;
use yii\web\Controller;

/**
 * Default controller for the `products` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
