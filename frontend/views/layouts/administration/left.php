<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;

$controllerCss = 'active menu-open';
$actionCss = 'active';
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
            <li class="<?= (Yii::$app->controller->id == 'dashboard')?$actionCss:''; ?>">
                <a href="<?php echo Url::base(true).'/administration/dashboard';?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?= (Yii::$app->controller->id == 'employee')?$controllerCss:''; ?>">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Employee</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (Yii::$app->controller->id == 'employee' && Yii::$app->controller->action->id == 'master-list')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/administration/employee/master-list'?>"><i class="fa fa-list-alt"></i>Master List</a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'employee' && Yii::$app->controller->action->id == 'attendance')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/administration/employee/attendance'?>"><i class="fa fa-list-alt"></i>Attendance</a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'employee' && Yii::$app->controller->action->id == 'payroll')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/administration/employee/payroll'?>"><i class="fa fa-list-alt"></i>Payroll</a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'employee' && Yii::$app->controller->action->id == 'status')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/administration/employee/status'?>"><i class="fa fa-list-alt"></i>Status</a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?= (Yii::$app->controller->id == 'employment-designation' || Yii::$app->controller->id == 'employment-status')?$controllerCss:''; ?>">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Employment</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (Yii::$app->controller->id == 'employment-designation')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/administration/employment-designation'?>"><i class="fa fa-list-alt"></i>Designation</a>
                    </li>
                    <li class="<?= (Yii::$app->controller->id == 'employment-status')?$actionCss:''; ?>">
                        <a href="<?php echo Url::base(true).'/administration/employment-status'?>"><i class="fa fa-list-alt"></i>Status</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
