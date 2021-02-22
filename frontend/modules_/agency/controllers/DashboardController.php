<?php

namespace frontend\modules\agency\controllers;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
