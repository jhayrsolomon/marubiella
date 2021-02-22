<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Profile</a>
            </div>
        </div>

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">Main Navigation</li>
            <li>
                <a href="/marubiella/backend/web/admin/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/marubiella/backend/web/gii"><i><img src="/marubiella/favicon.ico" /></i><span>Gii</span></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>RBAC</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/marubiella/backend/web/admin/assignment"><i class="fa fa-tasks"></i>Assignment</a>
                    </li>
                    <li>
                        <a href="/marubiella/backend/web/admin/menu"><i class="fa fa-list"></i>Menu</a>
                    </li>
                    <li>
                        <a href="/marubiella/backend/web/admin/permission"><i class="fa fa-key"></i><span>Permission</span></a>
                    </li>
                    <li>
                        <a href="/marubiella/backend/web/admin/role"><i class="fa fa-tags"></i><span>Role</span></a>
                    </li>
                    <li>
                        <a href="/marubiella/backend/web/admin/route"><i class="fa fa-road"></i><span>Route</span></a>
                    </li>
                    <li>
                        <a href="/marubiella/backend/web/admin/rule"><i class="fa fa-check-square-o"></i><span>Rule</span></a>
                    </li>
                    <li>
                        <a href="/marubiella/backend/web/admin/user"><i class="fa fa-users"></i><span>User</span></a>
                    </li>
                    <li>
                        
                    </li>
                </ul>
            </li>
            <li>
                <a href="/marubiella/backend/web/admin/user/signup"><i class="fa fa-users"></i><span>Sign Up</span></a>
            </li>
            <li>
                <a href="/marubiella/backend/web/admin/user/signup-employee"><i class="fa fa-users"></i><span>Create Account</span></a>
            </li>
        </ul>
        <!--?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header"></li>',
                    ['label' => '<i class="fa fa-dashboard"></i><span>Dashboard</span>', 'url' => ['dashboard/index']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Assignment</span>', 'url' => ['/admin/assignment']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Menu</span>', 'url' => ['/admin/menu']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Permission</span>', 'url' => ['/admin/permission']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Role</span>', 'url' => ['/admin/role']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Route</span>', 'url' => ['/admin/route']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Rule</span>', 'url' => ['/admin/rule']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>User</span>', 'url' => ['/admin/user']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Profile</span>', 'url' => ['/profile/staff']],
                    
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii']],
                    
                    ['label' => '<i class="fa fa-th"></i><span>Tools</span>', 'url' => ['tool/index']],
                ],
            ]
        );
        ?>-->
    </section>

</aside>
