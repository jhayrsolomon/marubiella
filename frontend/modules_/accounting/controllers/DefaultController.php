<?php

namespace frontend\modules\accounting\controllers;

use Yii;
use frontend\modules\models\accounting\search\OrderOfPayment as OrderOfPaymentSearch;
use yii\web\Controller;

/**
 * Default controller for the `accounting` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
        /*$searchModel = new OrderOfPaymentSearch();
        $dataProvider = $searchModel->searchOop(Yii::$app->request->queryParams, 1);

        $dataProvider->pagination = ['pageSize' => 10];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
    }
}
