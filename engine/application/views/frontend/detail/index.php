<div class="row">
    <div class="blog-page">
        <article>
            <h1 class="title"><?php echo $article->title; ?></h1>
            <?php if ($article->image_type==IMAGE_TYPE_MULTI): ?>
            <?php $this->load->view('frontend/slider/detail_slider', array('images'=>$article->images)); ?>
            <?php else: ?>
            <figure>
                <img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_LARGE); ?>" alt="Article image">
            </figure>
            <?php endif; ?>
            <div class="blog-content">
                <div class="info">
                    <a href="#"><?php echo number_format($article->comment); ?> comments</a>,
                    <span class="date"><?php echo date('d/m/Y',$article->date); ?></span>, by
                    <a href="#"><?php echo $article->created_by_name; ?></a>
                </div>
                <?php echo $article->content; ?>
                <?php if ($article->tags): ?>
                <div class="tag-container">
                    <div class="tag-title">Tags: </div>
                    <?php $tags = explode(',', $article->tags);?>
                    <?php foreach ($tags as $tag): ?>
                    <a class="tag" href="<?php echo site_url('category/tags?q='. urlencode($tag)); ?>"><?php echo $tag; ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <!--
            <div class="blog-bottom">
                <div class="share-title">Share</div>
                <div class="share-content">
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like at300b" fb:like:layout="button_count"><div class="fb-like fb_iframe_widget" data-ref=".VRbpIF-htIw.like" data-layout="button_count" data-show_faces="false" data-action="like" data-width="90" data-font="arial" data-href="http://teothemes.com/html/Voxis/blog.html" data-send="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=172525162793917&amp;container_width=77&amp;font=arial&amp;href=http%3A%2F%2Fteothemes.com%2Fhtml%2FVoxis%2Fblog.html&amp;layout=button_count&amp;locale=en_US&amp;ref=.VRbpIF-htIw.like&amp;sdk=joey&amp;send=false&amp;show_faces=false&amp;width=90"><span style="vertical-align: bottom; width: 77px; height: 20px;"><iframe name="f39399c624" width="90px" height="1000px" frameborder="0" allowtransparency="true" scrolling="no" title="fb:like Facebook Social Plugin" src="http://www.facebook.com/plugins/like.php?action=like&amp;app_id=172525162793917&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2F6Dg4oLkBbYq.js%3Fversion%3D41%23cb%3Df1c4a787f4%26domain%3Dteothemes.com%26origin%3Dhttp%253A%252F%252Fteothemes.com%252Ffe901047%26relation%3Dparent.parent&amp;container_width=77&amp;font=arial&amp;href=http%3A%2F%2Fteothemes.com%2Fhtml%2FVoxis%2Fblog.html&amp;layout=button_count&amp;locale=en_US&amp;ref=.VRbpIF-htIw.like&amp;sdk=joey&amp;send=false&amp;show_faces=false&amp;width=90" style="border: none; visibility: visible; width: 77px; height: 20px;" class=""></iframe></span></div></a>
                    <a class="addthis_button_tweet at300b"><iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/tweet_button.7d9dd43d4f18b1bb51cc9d8f0997995e.en.html#_=1427564835114&amp;count=horizontal&amp;counturl=http%3A%2F%2Fteothemes.com%2Fhtml%2FVoxis%2Fblog.html&amp;dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fteothemes.com%2Fhtml%2FVoxis%2Fblog.html&amp;size=m&amp;text=Voxis%20Magazine%3A&amp;url=http%3A%2F%2Fteothemes.com%2Fhtml%2FVoxis%2Fblog.html%23.VRbpIDQ81TE.twitter" class="twitter-share-button twitter-tweet-button twitter-share-button twitter-count-horizontal" title="Twitter Tweet Button" data-twttr-rendered="true" style="width: 109px; height: 20px;"></iframe></a>
                    <a class="addthis_button_pinterest_pinit at300b"><span class="at_PinItButton"></span></a>
                    <a class="addthis_counter addthis_pill_style addthis_nonzero" href="#" style="display: inline-block;"><a class="atc_s addthis_button_compact"><span></span></a><a class="addthis_button_expanded" target="_blank" title="View more services" href="#">23</a></a>
                    <div class="atclear"></div></div>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5133cbfc3c9054b8"></script>
                    
                </div>
            </div>-->
        </article>
    </div>
</div>

<!-- related news -->
<?php if ($related_news): ?>
<div class="row">
    <div class="related-news">
        <div class="inner-box">
            <h1 class="title">Related News</h1>
            <?php foreach ($related_news as $related): ?>
            <div class="column">
                <div class="inner">
                    <a href="<?php echo site_url('detail/'.$related->url_title); ?>">
                        <figure style="height: 105px; overflow: hidden;">
                            <img src="<?php echo get_image_thumb($related->image_url, IMAGE_THUMB_SMALL); ?>" alt="">
                        </figure>
                        <div class="title"><?php echo $related->title; ?></div>
                        <div class="date"><?php echo date('D d M Y', $related->date); ?></div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; 