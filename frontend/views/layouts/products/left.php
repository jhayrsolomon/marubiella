<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;

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
            <li>
                <a href="<?php echo Url::base(true).'/products/dashboard';?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo Url::base(true).'/products/master-list';?>">
                    <i class="fa fa-list-alt"></i> <span>Master List</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
