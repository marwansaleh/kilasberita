<header>
    <div class="container">
        <div class="row menu-line">
            <div class="col-sm-6">
                <nav>
                    <ul>
                        <li class="active"><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li>
                            <?php if ($is_logged_in): ?>
                            <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
                            <?php else: ?>
                            <a href="<?php echo site_url('auth'); ?>">Login</a>
                            <?php endif; ?>
                        </li>
                        <li><a href="<?php echo site_url('contact'); ?>">Contact</a></li>
                    </ul>
                </nav>
            </div>
            
            <div class="col-sm-3 social-links">
                <!--<nav>
                    <ul>
                    <li><a href="#" class="facebook">Facebook</a></li>
                    <li><a href="#" class="twitter">Twitter</a></li>
                    <li><a href="#" class="pinterest">Pinterest</a></li>
                    <li><a href="#" class="googleplus">Google+</a></li>
                </ul>
                </nav>-->
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="pull-right">
                        <form method="post" action="<?php echo site_url('search'); ?>">
                            <div class="input-group input-group-sm">
                                <input class="form-control" type="text" name="search" placeholder="Search...">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row breaking-news">
            <div class="col-sm-2 title">
               <span>Breaking News</span>
            </div>
            <div class="col-sm-10 header-news">
                <?php if (isset($newstickers)): ?>
                <div class="ticker">
                    <ul>
                        <?php foreach ($newstickers as $ticker): ?>
                        <li><?php echo $ticker->news_text; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row logo-line">
            <div class="col-sm-4 logo">
                <a href="#">
                    <figure>
                        <img class="img-responsive" src="<?php echo site_url(config_item('path_assets').'img/logo-full.png'); ?>">
                    </figure>
                </a>
            </div>
            <div class="col-sm-8">
                <a href="#">
                    <figure>
                        <img class="img-responsive" src="<?php echo site_url(config_item('images').'ads-here.png'); ?>">
                    </figure>
                </a>
            </div>
        </div>
        <div class="row main-nav">
            <div class="col-sm-12"><?php $this->load->view('components/_mainmenu'); ?></div>
        </div>
    </div>
</header>