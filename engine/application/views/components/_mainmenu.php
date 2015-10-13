    <nav class="navbar navbar-default">
    <ul class="nav nav-justified">
        <li <?php echo $active_menu=='home'?'class="active"':''; ?>><a href="<?php echo site_url(); ?>">Home</a></li>
        <?php if (isset($mainmenus)): ?>
        <?php foreach ($mainmenus as $menu): ?>
        <li <?php echo $active_menu==$menu->slug?'class="active"':''; ?>><a href="<?php echo site_url('category/'.$menu->slug); ?>"><?php echo $menu->name; ?></a></li>
        <?php endforeach; ?>
        <?php endif; ?>
        <li <?php echo $active_menu=='contact'?'class="active"':''; ?>><a href="<?php echo site_url('contact'); ?>">Kontak</a></li>
    </ul>
</nav>
