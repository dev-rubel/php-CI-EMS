<style type="text/css">
#image-preview {
  width: 200px;
  height: 200px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
  .preview-img input {
    line-height: 200px;
    font-size: 200px;
    position: absolute;
    opacity: 0;
    z-index: 10;
  }
  .preview-img label {
    position: absolute;
    z-index: 5;
    opacity: 0.8;
    cursor: pointer;
    background-color: #bdc3c7;
    width: 200px;
    height: 50px;
    font-size: 20px;
    line-height: 50px;
    text-transform: uppercase;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    text-align: center;
  }
</style>


<script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });
});
</script>


<div class="row">
            
   <?php $logo = $this->db->get_where('images',array('id'=>1))->row()->img_name;?>
    
    <div class="col-md-4 col-md-offset-2">
        <?php echo flash_msg();?>
        <form action="<?php echo base('homemanage', 'add_logo');?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label><?php echo lng('Image Title');?></label>
                <input class="form-control" name="title" value="<?php //echo $logo['info'];?>" placeholder="" data-validation="required">
        </div>
        <div class="form-group preview-img">
                <div id="image-preview">
                    <label for="image-upload" id="image-label"><?php echo lng('Choose File');?></label>
                    <input type="file" name="logo_img" id="image-upload" data-validation="dimension mime size" data-validation-allowing="jpg, png, gif" data-validation-max-size="300kb"/>
                    <input type="hidden" name="preimg" value="<?php echo $logo;?>"/>
                  </div>
                 <p class="help-block"><?php echo lng('Max file size 300 KB.');?></p>
        </div>
            <button type="submit" class="btn btn-info"><?php echo lng('Save');?></button>
        </form>
    </div>
    
    <?php if(!empty($logo)):?>
    <div class="col-md-4">
        <div class="form-group">
                <label><?php echo lng('Current Image');?></label>
                <img src="<?php echo base_url().'assets/'.$logo;?>" alt="<?php echo $logo['info'];?>" title="<?php echo $logo['info'];?>"/>
        </div>
    </div>
    <?php endif;?>
</div><!--/.row-->