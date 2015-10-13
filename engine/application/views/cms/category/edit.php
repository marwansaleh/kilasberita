<div class="row">
    <div class="col-sm-12">
        <?php if ($this->session->flashdata('message')): ?>
        <?php echo create_alert_box($this->session->flashdata('message'),$this->session->flashdata('message_type')); ?>
        <?php endif; ?>
        
        <form role="form" method="post" action="<?php echo $submit_url; ?>">
            <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $item->id?'Update Data':'Create New'; ?></h3>
            </div><!-- /.box-header -->
            
            <div class="box-body">
                <div class="form-group">
                    <label>Category Title</label>
                    <input type="text" name="name" class="form-control" placeholder="Title ..." value="<?php echo $item->name; ?>">
                </div>
                <div class="form-group">
                    <label>Category Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="Short category ..." value="<?php echo $item->slug; ?>">
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Category Parent</label>
                            <select name="parent" class="form-control selectpicker" data-live-search="true" data-size="5">
                                <option value="0">-- No Parent--</option>
                                <?php foreach ($parents as $parent): ?>
                                <option value="<?php echo $parent->id; ?>" <?php echo $parent->id==$item->parent?'selected':''; ?>><?php echo $parent->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Sort / Order</label>
                            <input type="number" name="sort" class="form-control" min="0" step="1" value="<?php echo $item->sort; ?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Is Menu ?</label>
                            <select name="is_menu" class="form-control">
                                <option value="0" <?php echo $item->is_menu==0?'selected':''; ?>>Not menu</option>
                                <option value="1" <?php echo $item->is_menu==1?'selected':''; ?>>Menu</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Is Menu ?</label>
                            <select name="is_menu" class="form-control">
                                <option value="0" <?php echo $item->is_menu==0?'selected':''; ?>>Not menu</option>
                                <option value="1" <?php echo $item->is_menu==1?'selected':''; ?>>Menu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Show in Home ?</label>
                            <select name="is_home" class="form-control">
                                <option value="0" <?php echo $item->is_home==0?'selected':''; ?>>Hidden</option>
                                <option value="1" <?php echo $item->is_home==1?'selected':''; ?>>Display</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix">
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Submit</button>
                <button class="btn btn-warning" type="reset"><i class="fa fa-refresh"></i> Reset</button>
                <a class="btn btn-default" href="<?php echo $back_url; ?>"><i class="fa fa-backward"></i> Cancel</a>
            </div>
        </div>
        </form>
    </div>
</div>

