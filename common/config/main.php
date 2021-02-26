<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
            //'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
        ],
        'user' => [
            //'class' => 'mdm\admin\models\User',
            'identityClass' => 'mdm\admin\models\User',
            //'loginUrl' => ['admin/user/login'],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                    //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/views/yiisoft/yii2-app'
                    '@app/views' => '@frontend/views'
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
                /*'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],*/
            ],
        ],
        'access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        // find if the user has acces to the controller action
                        return Yii::$app->user->can(Yii::$app->controller->id.'-'.$action->id);
                    },
                ],
            ],
        ],
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // your other grid module settings
        ],
        'gridviewKrajee' =>  [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ],
        /*'employee' => [
            'class' => 'frontend\modules\employee\Module',
        ],*/
        'sales' => [
            'class' => 'frontend\modules\sales\Module',
        ],
        'administration' => [
            'class' => 'frontend\modules\administration\Module',
        ],
        'accounting' => [
            'class' => 'frontend\modules\accounting\Module',
        ],
        'products' => [
            'class' => 'frontend\modules\products\Module',
        ],
        /*'products' => [
            'class' => 'frontend\modules\products\Module',
        ],
        'customers' => [
            'class' => 'frontend\modules\customers\Module',
        ],*/
        //Fornetend Modules
        /*'accounting' => [
            'class' => 'frontend\modules\accounting\Module',
        ],
        'cashier' => [
            'class' => 'frontend\modules\cashier\Module',
        ],
        'agency' => [
            'class' => 'frontend\modules\agency\Module',
        ],
        'portal' => [
            'class' => 'frontend\modules\portal\Module',
        ],
        'TechnicalServices' => [
            'class' => 'frontend\modules\TechnicalServices\Module',
        ],
        'report' => [
            'class' => 'frontend\modules\report\Module',
        ],*/
        
        //Backend Modules
        'admin' => [
            'class' => 'backend\modules\admin\Module',
        ],
        /*'profile' => [
            'class' => 'backend\modules\profile\Module',
        ],*/
        
    ],
    'timeZone' => 'Asia/Manila', //set timezone to Manila
    /*'components' => [
        
    ],*/
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            //'admin/*',
        ]
    ]
];
