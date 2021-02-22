<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<header class="main-header">
    <!--<a class="logo-sm" href="#" role="button" ><img src="?= Yii::$app->request->baseUrl?>/images/onelab.png" alt="OneLab Logo" width="5%"></a>-->
    <?= Html::a(
        '<span class="logo-mini">
            <img class="logo" src="'.Yii::$app->request->baseUrl.'/images/onelab.png" alt="OneLab Logo"/>
        </span>');
    ?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <?php
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                        [
                            'label' => 'Home',
                            'url' => ['/site/index'],
                        ],
                        [
                            'label' => 'Admin',
                            'url' => ['/admin/permission'],
                            'visible' => Yii::$app->user->can('rbac'),
                        ],
                        [
                            'label' => 'Accounting',
                            'url' => ['/accounting/order-of-payment/testing-and-calibration'],
                            'visible' => Yii::$app->user->can('orderofpayment'),
                        ],
                        [
                            'label' => 'Cashier',
                            'url' => ['/cashier'],
                            'visible' => Yii::$app->user->can('receipt'),
                        ],
                        [
                            'label' => 'Portal',
                            'url' => ['/portal'],
                            'visible' => Yii::$app->user->can('portal'),
                        ],
                        [
                            'label' => 'Technical Services',
                            'url' => ['/TechnicalServices'],
                            'visible' => Yii::$app->user->can('technical'),
                        ],
                        Yii::$app->user->isGuest ? (
                            [
                                'label' => 'Login',
                                'url' => ['/site/login']
                            ]
                        ) : (
                            '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                            . '</li>'
                        )
                    ],
                ]);
            ?>
        </div>
    </nav>
</header>