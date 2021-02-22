<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<header class="main-header">
    <?= Html::a(
        '<span class="logo-mini">
            <img class="logo" src="'.Yii::$app->request->baseUrl.'/images/marubiella.png" alt="marubiella Logo"/>
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
                            'url' => ['/admin'],
                            'visible' => Yii::$app->user->can('gii'),
                        ],
                        /*[
                            'label' => 'Profile',
                            'url' => ['/profile'],
                            'visible' => Yii::$app->user->can('profile'),
                        ],*/
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