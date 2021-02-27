<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;
$controllerCss = 'active menu-open';
$actionCss = 'active';

include('permission.php');
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar04.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel(Yii::$app->user->identity->username)); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Profile</a>
            </div>
        </div>

        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">Main Navigation</li>
            <li class="<?= (Yii::$app->controller->id == 'dashboard')?$actionCss:''; ?>" <?= $dashboard; ?> >
                <a href="<?php echo Url::base(true).'/sales/dashboard';?>">
                    <i class="fa fa-calendar" aria-hidden="true"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?= (Yii::$app->controller->id == 'osr')?$controllerCss:''; ?>" <?= $osr; ?> >
                <a href="#">
                    <i class="fa fa-users"></i> <span>OSR</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (Yii::$app->controller->id == 'osr' && Yii::$app->controller->action->id == 'add-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/osr/add-sales';?>">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Add Sales</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'osr' && Yii::$app->controller->action->id == 'view-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/osr/view-sales';?>">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Monitoring Sales</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'osr' && Yii::$app->controller->action->id == 'view-report')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/osr/view-report';?>">
                            <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Sales Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= (Yii::$app->controller->id == 'junior-leader')?$controllerCss:''; ?>" <?= $junior; ?> >
                <a href="#">
                    <i class="fa fa-users"></i> <span>Junior Leader</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (Yii::$app->controller->id == 'junior-leader' && Yii::$app->controller->action->id == 'add-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/junior-leader/add-sales';?>">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Add Sales</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'junior-leader' && Yii::$app->controller->action->id == 'view-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/junior-leader/view-sales';?>">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Sales Monitoring</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'junior-leader' && Yii::$app->controller->action->id == 'view-report')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/junior-leader/view-report';?>">
                            <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Sales Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= (Yii::$app->controller->id == 'leader')?$controllerCss:''; ?>" <?= $leader; ?> >
                <a href="#">
                    <i class="fa fa-users"></i> <span>Leader</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (Yii::$app->controller->id == 'leader' && Yii::$app->controller->action->id == 'add-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/leader/add-sales';?>">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Add Sales</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'leader' && Yii::$app->controller->action->id == 'view-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/leader/view-sales';?>">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Sales Monitoring</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'leader' && Yii::$app->controller->action->id == 'view-report')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/leader/view-report';?>">
                            <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Sales Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= (Yii::$app->controller->id == 'manager')?$controllerCss:''; ?>" <?= $manager; ?> >
                <a href="#">
                    <i class="fa fa-users"></i> <span>Manager</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (Yii::$app->controller->id == 'manager' && Yii::$app->controller->action->id == 'add-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/manager/add-sales';?>">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Add Sales</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'manager' && Yii::$app->controller->action->id == 'view-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/manager/view-sales';?>">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Sales Monitoring</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'manager' && Yii::$app->controller->action->id == 'view-report')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/manager/view-report';?>">
                            <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Sales Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= (Yii::$app->controller->id == 'csr')?$controllerCss:''; ?>" <?= $csr; ?> >
                <a href="#">
                    <i class="fa fa-users"></i> <span>CSR</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (Yii::$app->controller->id == 'csr' && Yii::$app->controller->action->id == 'verify-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/csr/verify-sales';?>">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Verify Sales</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'csr' && Yii::$app->controller->action->id == 'add-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/csr/add-sales';?>">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Add Sales</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'csr' && Yii::$app->controller->action->id == 'view-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/csr/view-sales';?>">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Sales Monitoring</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'csr' && Yii::$app->controller->action->id == 'view-report')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/csr/view-report';?>">
                            <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Sales Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= (Yii::$app->controller->id == 'encoder')?$controllerCss:''; ?>" <?= $encoder; ?> >
                <a href="#">
                    <i class="fa fa-users"></i> <span>Encoder</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (Yii::$app->controller->id == 'encoder' && Yii::$app->controller->action->id == 'logistics')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/encoder/logistics';?>">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Logistics</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'encoder' && Yii::$app->controller->action->id == 'add-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/encoder/add-sales';?>">
                            <i class="fa fa-address-card-o" aria-hidden="true"></i> <span>Add Sales</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'encoder' && Yii::$app->controller->action->id == 'view-sales')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/encoder/view-sales';?>">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Sales Monitoring</span>
                        </a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'encoder' && Yii::$app->controller->action->id == 'view-report')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/sales/encoder/view-report';?>">
                            <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Sales Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--<li class="?= (Yii::$app->controller->id == 'csr')?$actionCss:''; ?>">
                <a href="?php echo Url::base(true).'/sales/csr';?>">
                    <i class="fa fa-calendar" aria-hidden="true"></i> <span>CSR</span>
                </a>
            </li>-->
        </ul>
    </section>

</aside>
