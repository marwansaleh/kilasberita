<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nasabah-navbar">
                <span class="sr-only">Mainmenu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('home'); ?>">
                NASABAH.CO
            </a>
        </div>
        <div class="collapse navbar-collapse" id="nasabah-navbar">
            <ul class="nav navbar-nav">
                <li <?php echo $active_menu=='home'?'class="active"':''; ?>><a href="<?php echo site_url(); ?>">Home</a></li>
                <?php if (isset($mainmenus)): ?>
                <?php foreach ($mainmenus as $menu): ?>
                <li <?php echo $active_menu==$menu->slug?'class="active"':''; ?>><a href="<?php echo site_url('category/'.$menu->slug); ?>"><?php echo $menu->name; ?></a></li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>