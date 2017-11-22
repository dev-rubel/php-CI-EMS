<?php 
$this->db->where('id', $param2);
$info = $this->db->get('images')->row()->info;
$this->db->where('id', $param2);
$image = $this->db->get('images')->row()->img_name;
$infos = explode('+', $info);
?>
<form action="<?php echo base('homemanage', 'update_slider'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label><?php echo lng('Image Title'); ?></label>
        <input class="form-control" placeholder="" name="title" data-validation="required" value="<?php echo $infos[0]; ?>">
        <input type="hidden" name="id" value="<?php echo $param2; ?>">
    </div>
    <div class="form-group">
        <label><?php echo lng('Image Description'); ?></label>
        <input class="form-control" placeholder="" name="description" value="<?php echo $infos[1]; ?>">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label><?php echo lng('Current Image'); ?></label>
                <img src="<?php echo base_url() . 'assets/images/slider_image/' . $image; ?>" alt="" id="image_upload_preview" width="150px" height="100px" />
            </div>
            <div class="col-md-4">
                <input type="file" name="img" id="inputFile" data-validation="dimension mime size" data-validation-allowing="jpg, png, gif" data-validation-max-size="300kb"/>
                <input type="hidden" name="Preimg" value="<?php echo $image; ?>"/>
                <p class="help-block"><?php echo lng('Max file size 300 KB.'); ?></p>  
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-default"><?php echo lng('Update'); ?></button>
</form>