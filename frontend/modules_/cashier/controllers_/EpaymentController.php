<?php

namespace frontend\modules\cashier\controllers;

class EpaymentController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
