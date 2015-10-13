<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 footer-widget">
                <h3>About</h3>
                <p>
                    Sewaktu hidup, co-pilot Germanwings, Andreas Lubitz, 
                    pernah mengatakan bahwa semua orang bakal mengenal 
                    dan mengenangnya. Hal itu dikatakannya kepada 
                    kekasihnya, Maria W. 
                </p>
                <p>
                    Perekam suara pada kotak hitam 
                    menunjukkan bahwa Lubitz (27 tahun) 
                    sengaja mencegah pilot masuk lagi ke dalam kokpit. 
                    Kemudian, dia sengaja menubrukkan pesawat ke tebing gunung.
                </p>
            </div>
            <div class="col-sm-4 footer-widget">
                <h3>PHOTOSTREAM</h3>
                <?php if (isset($photo_news)):?>
                <div class="row flickr-gallery">
                    <?php foreach ($photo_news as $photo):?>
                    <div class="col-xs-2 col-sm-3">
                        <a href="<?php echo get_image_thumb($photo->image_url, IMAGE_THUMB_ORI); ?>" rel="prettyPhoto[newsfoto]" title="<?php echo $photo->description; ?>">
                            <img src="<?php echo get_image_thumb($photo->image_url, IMAGE_THUMB_SQUARE); ?>" alt="<?php echo $photo->title; ?>">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-4 footer-widget">
                <h3>LATEST TWEETS</h3>
                <div class="tweet first-child">
                    <span class="time">about an hour ago</span> Want to learn more about
                    Photoshop Layer Styles? This 12-part series explains
                    everything you need to know. - <a href="http://ow.ly/dfhsJ">ow.ly/dfhsJ</a>
                </div>
                <div class="tweet">
                    <span class="time">about an hour ago</span> Premium: Create a Flying Pig
                    with Poser and Photoshop - <a href="http://ow.ly/dfhsJ">ow.ly/dfhsJ</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--
<div class="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 copyright">
                Copyright &copy; <a href="<?php echo site_url(); ?>">Nasabah.co</a> 2015 - 2016.
            </div>
            
            <div class="col-sm-3 social-links">
                <ul>
                    <li><a href="#" class="facebook">Facebook</a></li>
                    <li><a href="#" class="twitter">Twitter</a></li>
                    <li><a href="#" class="pinterest">Pinterest</a></li>
                    <li><a href="#" class="googleplus">Google+</a></li>
                </ul>
            </div>
        </div>
        <a href="#" class="back-to-top hidden-xs" style="display: inline;">Scroll Top</a>
    </div>
</div>-->