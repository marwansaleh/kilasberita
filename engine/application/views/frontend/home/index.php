<!-- highlight news -->
<div class="row">
    <div class="article-showcase hidden-xs">
        <div class="inner-border">
            <div class="half">
                <?php $rel=1; foreach ($highlight_news as $highlight): ?>
                <div class="big-article <?php echo $rel==1?'active':''; ?>" rel="<?php echo $rel++; ?>">
                    <div class="title">
                        <span><a href="<?php echo site_url('detail/'.$highlight->url_title); ?>"><?php echo $highlight->title ?></a></span>
                    </div>
                    <figure>
                        <img src="<?php echo get_image_thumb($highlight->image_url, IMAGE_THUMB_MEDIUM); ?>" alt="">
                    </figure>
                    <div class="main-text">
                        <div class="inner">
                            <span class="article-info"><?php echo number_format($highlight->comment); ?> comments, <?php echo date('d/m/Y',$highlight->date); ?>, by <?php echo $highlight->created_by_name; ?></span>
                            <p><?php echo $highlight->synopsis; ?><a href="<?php echo site_url('detail/'.$highlight->url_title); ?>">Read more...</a></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="half">
                <div class="inner-left-border">
                    <?php $rel=1; foreach ($highlight_news as $highlight): ?>
                    <article <?php echo $rel==1?'class="first-child active':''; ?>" rel="<?php echo $rel++; ?>">
                        <figure>
                            <img src="<?php echo get_image_thumb($highlight->image_url, IMAGE_THUMB_SQUARE); ?>" alt="">
                        </figure>
                        <div class="text">
                            <h3><?php echo $highlight->title ?></h3>
                            <span class="info"><?php echo date('d/m/Y',$highlight->date); ?>, <?php echo number_format($highlight->comment); ?> comments</span>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- end highlight news -->

<div class="row">
    <!-- Latest news -->
    <div class="col-sm-6 article-box">
        <div class="row">
            <div class="box-title">
                <h2>Latest News </h2>
                <div class="title-line"></div>
            </div>
            <?php $i=1; foreach ($latest_news as $latest): ?>
            <article <?php echo $i==1?'class="first-child"':'';$i++; ?>>
                <figure>
                    <img src="<?php echo get_image_thumb($latest->image_url, IMAGE_THUMB_SQUARE); ?>" alt="">
                </figure>
                <div class="text">
                    <h3><a href="<?php echo site_url('detail/'.$latest->url_title); ?>"><?php echo $latest->title; ?></a></h3>
                    <span class="info"><?php echo date('d/m/Y',$latest->date); ?>, <?php echo number_format($latest->comment); ?> comments</span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- start category -->
    <?php foreach ($categories as $index => $category): ?>
    <div class="col-sm-6 article-box">
        <div class="box-title">
            <h2><?php echo $category->name; ?></h2>
            <div class="title-line"></div>
        </div>
        
        <?php if ($category->articles): ?>
        <div class="articles-slider">
            <div class="flex-viewport">
                <?php $i=1; foreach ($category->articles as $article): ?>
                
                <?php if ($index<2 && $i==1): ?>
                <div class="main-article">
                    <div class="title">
                        <span><a href="<?php echo site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></span>
                    </div>
                    <figure>
                        <img src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_MEDIUM); ?>" alt="">
                    </figure>
                    <div class="main-text">
                        <div class="inner">
                            <span class="article-info"><?php echo number_format($article->comment); ?> comments, <?php echo date('d/m/Y',$article->date); ?>, by <?php echo $article->created_by_name; ?></span>
                            <p><?php echo $article->synopsis; ?> <a href="<?php echo site_url('detail/'.$article->url_title); ?>">Read more...</a></p>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <article>
                    <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                    <div class="text">
                        <h3><a href="<?php echo site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                        <span class="info"><?php echo date('d/m/Y',$article->date); ?>, <?php echo number_format($article->comment); ?> comments</span>
                    </div>
                </article>
                <?php endif; ?>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    
</div>