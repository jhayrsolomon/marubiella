<?php

namespace frontend\modules\cashier\controllers;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
