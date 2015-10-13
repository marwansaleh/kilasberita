<ul class="sidebar-menu">
    <li class="header">MAINMENU</li>
    <!-- Optionally, you can add icons to the links -->
    <li <?php echo $active_menu=='dashboard'?'class="active"':''; ?>><a href="<?php echo site_url('cms/dashboard'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    <li <?php echo $active_menu=='article'?'class="active"':''; ?>><a href="<?php echo site_url('cms/article'); ?>"><i class="fa fa-file-text"></i> <span>Article</span></a></li>
    <li <?php echo $active_menu=='photo'?'class="active"':''; ?>><a href="<?php echo site_url('cms/photo'); ?>"><i class="fa fa-photo"></i> <span>Photo News</span></a></li>
    <li <?php echo $active_menu=='category'?'class="active"':''; ?>><a href="<?php echo site_url('cms/category'); ?>"><i class="fa fa-briefcase"></i> <span>Category</span></a></li>
    <li <?php echo $active_menu=='comment'?'class="active"':''; ?>><a href="#"><i class="fa fa-comments"></i> <span>Comments</span></a></li>
    <li <?php echo $active_menu=='newsticker'?'class="active"':''; ?>><a href="<?php echo site_url('cms/newsticker'); ?>"><i class="fa fa-link"></i> <span>Newsticker</span></a></li>
    <li class="treeview">
        <a href="#"><i class="fa fa-adn"></i> <span>Adverts</span>  <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="#">Ads list</a></li>
            <li><a href="#">Ads configuration</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-envelope"></i> <span>Email</span>  <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="#">Email list</a></li>
            <li><a href="#">Email configuration</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-users"></i> <span>User Managements</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="<?php echo site_url('cms/users'); ?>">User list</a></li>
            <li><a href="<?php echo site_url('cms/usergroups'); ?>">User groups</a></li>
            <li><a href="<?php echo site_url('cms/useraccess'); ?>">Group Access</a></li>
            <li><a href="<?php echo site_url('cms/userroles'); ?>">Access roles</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-cogs"></i> <span>Configuration</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="<?php echo site_url('cms/sysconf'); ?>">System configuration</a></li>
            <li><a href="#">System log</a></li>
            <li><a href="<?php echo site_url('cms/database'); ?>">Database Backup</a></li>
        </ul>
    </li>
</ul>