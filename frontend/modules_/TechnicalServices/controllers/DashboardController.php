<?php

namespace frontend\modules\TechnicalServices\controllers;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
