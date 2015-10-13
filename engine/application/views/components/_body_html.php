<?php $this->load->view('components/_body_header'); ?>
<?php if (isset($main_slider)&& $main_slider) { $this->load->view('frontend/slider/main_slider'); }?>
<div id="main">
    <div class="container">
        <div class="content col-sm-8">
            <?php $this->load->view($subview);?>
        </div>
        <?php $this->load->view('components/_side_right'); ?>
    </div>
</div>
<?php $this->load->view('components/_body_footer');