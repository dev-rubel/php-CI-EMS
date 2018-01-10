<?php 
$this->db->where('id', $gallery_id);
$info = $this->db->get('images')->row()->info;
$this->db->where('id', $gallery_id);
$image = $this->db->get('images')->row()->img_name;
$infos = explode('+', $info);
?>

<form id="updateGallery" action="<?php echo base_url() .'index.php?homemanage/ajax_update_gallery'; ?>" class="form-horizontal form-groups-bordered" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label><?php echo lng('Image Title'); ?></label>
        <input class="form-control" placeholder="" name="title" data-validation="required" value="<?php echo $infos[0]; ?>">
        <input type="hidden" name="id" value="<?php echo $gallery_id; ?>">
    </div>
    <div class="form-group">
        <label><?php echo lng('Image Description'); ?></label>
        <input class="form-control" placeholder="" name="description" value="<?php echo $infos[1]; ?>">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label><?php echo lng('Current Image'); ?></label>
                <img src="<?php echo base_url() . 'assets/images/gallery_image/' . $image; ?>" alt="" id="image_upload_preview" width="150px" height="100px" />
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


<script>
$(document).ready(function () {

    $('#updateGallery').ajaxForm({
      beforeSend: function () {
          $('#loading2').show();
          $('#overlayDiv').show();
      },
      success: function (data) {
          var jData = JSON.parse(data);

          if (!jData.type) {
              toastr.error(jData.msg);
          } else {
              toastr.success(jData.msg);
              $("#galleryFormSection").html(jData.html.addForm);             
              $("#galleryImageHolder").html(jData.html.imageHolder);            
          }
          $('body,html').animate({
              scrollTop: 0
          }, 800);
          $('#loading2').fadeOut('slow');
          $('#overlayDiv').fadeOut('slow');
      }
  });
  

});

</script>