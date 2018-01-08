<div class="row">
        <div class="col-md-offset-1 col-md-10">
            
        <div class="col-md-4" id="galleryFormSection">
            <form id="addGallery" action="<?php echo base_url() .'index.php?homemanage/ajax_add_gallery'; ?>" class="form-horizontal form-groups-bordered" method="post" enctype="multipart/form-data">
                
                    <?php echo flash_msg();?>
                    <div class="form-group">
                        <label>
                            <?php echo lng('Image Title');?>
                        </label>
                        <input class="form-control" placeholder="" name="title" data-validation="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <?php echo lng('Image Description');?>
                        </label>
                        <input class="form-control" placeholder="" name="description">
                    </div>
                    <div class="form-group preview-img">
                        <div id="image-preview">
                            <label for="image-upload" id="image-label">
                                <?php echo lng('Choose File');?>
                            </label>
                            <input type="file" name="img" id="image-upload" data-validation="dimension mime size" data-validation-allowing="jpg, png, gif"
                                data-validation-max-size="300kb" />
                        </div>
                        <p class="help-block">
                            <?php echo lng('Max file size 300 KB.');?>
                        </p>
                    </div>
                    <button type="submit" class="btn btn-info">
                        <?php echo lng('Add');?>
                    </button>                
            </form>
            
            </div>
            <div class="col-md-8" id="galleryImageHolder">
            <?php
                $this->db->where('track_name', 'gallery');
                $gallery = $this->db->get('images')->result_array();
            ?>
                <table class="table">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>
                                <?php echo lng('Image Title');?>
                            </th>
                            <th>
                                <?php echo lng('Description');?>
                            </th>
                            <th>
                                <?php echo lng('Images');?>
                            </th>
                            <th>
                                <?php echo lng('Action');?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
      if(!empty($gallery)):
      foreach($gallery as $key=>$list): $info = explode('+', $list['info']); $id = $list['id']; $name = $list['img_name'];?>
                        <tr>
                            <th scope="row">
                                <?php echo $key+1;?>
                            </th>
                            <td>
                                <?php echo $info[0];?>
                            </td>
                            <td>
                                <?php echo $info[1];?>
                            </td>
                            <td>
                                <img src="<?php echo base_url().'assets/images/gallery_image/'.$list['img_name'];?>" width="150px"
                                    height="100px" />
                            </td>
                            <td>
                                <button href="#" class="btn btn-info btn-xs" onclick="editGallery('<?php echo $list['id'];?>')">
                                    <?php echo lng('Edit');?>
                                </button>
                                <a href="<?php echo base('homemanage', 'delete_galleryImg'." /$id/$name ");?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');">
                                    <?php echo lng('Delete this');?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;
    endif;
    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!--/.row-->


<script>
$(document).ready(function () {

  $('#addGallery').ajaxForm({
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
              $("#galleryImageHolder").html(jData.html);
              $('#addGallery').resetForm();
          }
          $('body,html').animate({
              scrollTop: 0
          }, 800);
          $('#loading2').fadeOut('slow');
          $('#overlayDiv').fadeOut('slow');
      }
  });
});

function editGallery(galleryID) {
    $.ajax({
        type: 'GET',
        url: '<?php echo base_url();?>index.php?homemanage/ajax_edit_gallery/'+galleryID,
        beforeSend: function () {
            $('#loading2').show();
            $('#overlayDiv').show();
        },
        success: function (data) {
            var jData = JSON.parse(data);

            toastr.success(jData.msg);
            $("#galleryFormSection").html(jData.html);
            $('body,html').animate({
                scrollTop: 350
            }, 800);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');
        }
    });
}

</script>