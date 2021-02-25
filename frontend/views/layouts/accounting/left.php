<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;

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
                <a href="<?php echo Url::base(true).'/employee/dashboard';?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <!--<li>
                <a href="?php echo Url::base(true).'/employee/master-list'?>"><i class="fa fa-list-alt"></i>Master List</a>
            </li>
            <li>
                <a href="?php echo Url::base(true).'/employee/employment-designation'?>"><i class="fa fa-list-alt"></i>Employment Designation</a>
            </li>
            <li>
                <a href="?php echo Url::base(true).'/employee/employment-status'?>"><i class="fa fa-circle-o"></i>Employment Status</a>
            </li>
            <li>
                <a href="?php echo Url::base(true).'/employee/status'?>">
                    <i class="glyphicon glyphicon-stats"></i> <span>Status</span>
                </a>
            </li>-->
            <!--<li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Employee</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="?php echo Url::base(true).'/employee/master-list'?>"><i class="fa fa-list-alt"></i>Master List</a>
                    </li>
                </ul>
            </li>-->
            <!--<li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Admin</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="?php echo Url::base(true).'/employee/employment-designation'?>"><i class="fa fa-list-alt"></i>Employment Designation</a>
                    </li>
                    <li>
                        <a href="?php echo Url::base(true).'/employee/employment-status'?>"><i class="fa fa-circle-o"></i>Employment Status</a>
                    </li>
                    <li>
                        <a href="?php echo Url::base(true).'/employee/status'?>">
                            <i class="glyphicon glyphicon-stats"></i> <span>Status</span>
                        </a>
                    </li>
                </ul>
            </li>-->
        </ul>
    </section>

</aside>
