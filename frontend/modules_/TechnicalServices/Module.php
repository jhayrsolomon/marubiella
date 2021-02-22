<?php

namespace frontend\modules\TechnicalServices;

/**
 * TechnicalServices module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\TechnicalServices\controllers';

    public $layout = '/technicalservices';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
