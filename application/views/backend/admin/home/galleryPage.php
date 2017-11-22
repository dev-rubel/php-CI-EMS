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
  
  .modal-backdrop{
    display: none;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label",
  });
});

</script>
<?php
 $this->db->where('track_name', 'gallery');
$gallery = $this->db->get('images')->result_array();

?>



<div class="row">
    

    
    <div class="col-md-12">
            <form action="<?php echo base('homemanage', 'add_gallery');?>" method="post" enctype="multipart/form-data">
            <div class="col-md-4">
                <?php echo flash_msg();?>
        <div class="form-group">
                <label><?php echo lng('Image Title');?></label>
                <input class="form-control" placeholder="" name="title" data-validation="required">
        </div>
        <div class="form-group">
                <label><?php echo lng('Image Description');?></label>
                <input class="form-control" placeholder="" name="description">
        </div>
        <div class="form-group preview-img">
                <div id="image-preview">
                    <label for="image-upload" id="image-label"><?php echo lng('Choose File');?></label>
                    <input type="file" name="img" id="image-upload" data-validation="dimension mime size" data-validation-allowing="jpg, png, gif" data-validation-max-size="300kb"/>
                  </div>
                 <p class="help-block"><?php echo lng('Max file size 300 KB.');?></p>
        </div>
                <button type="submit" class="btn btn-info"><?php echo lng('Add');?></button>
    </div>
            </form>
            <div class="col-md-8">
                <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th><?php echo lng('Image Title');?></th>
      <th><?php echo lng('Description');?></th>
      <th><?php echo lng('Images');?></th>
      <th><?php echo lng('Action');?></th>
    </tr>
  </thead>
  <tbody>
      <?php 
      if(!empty($gallery)):
      foreach($gallery as $key=>$list): $info = explode('+', $list['info']); $id = $list['id']; $name = $list['img_name'];?>
    <tr>
      <th scope="row"><?php echo $key+1;?></th>
      <td><?php echo $info[0];?></td>
      <td><?php echo $info[1];?></td>
      <td><img src="<?php echo base_url().'assets/images/gallery_image/'.$list['img_name'];?>" width="150px" height="100px" /></td>
      <td>
          <button href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#<?php echo $list['id'];?>"><?php echo lng('Edit');?></button>
          <a href="<?php echo base('homemanage', 'delete_galleryImg'."/$id/$name");?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><?php echo lng('Delete this');?></a>
      </td>
    </tr>
    <?php endforeach;
    endif;
    ?>
  </tbody>
</table>
            </div>
    </div>
    
 </div><!--/.row-->   
    



<!-- Modal -->
<?php 
if(!empty($gallery)):
foreach($gallery as $key=>$list): $info = explode('+', $list['info']);?>
<div class="modal fade" id="<?php echo $list['id'];?>" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lng('Image Gallery Info Edit ');?>
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form action="<?php echo base('homemanage', 'update_galleryInfo');?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label><?php echo lng('Image Title');?></label>
                    <input class="form-control" placeholder="" name="title" <?php echo validator('req');?> value="<?php echo $info[0];?>">
                    <input type="hidden" name="id" value="<?php echo $list['id'];?>">
                  </div>
                  <div class="form-group">
                    <label><?php echo lng('Image Description');?></label>
                <input class="form-control" placeholder="" name="description" <?php echo validator('req');?> value="<?php echo $info[1];?>">
                  </div>
                  <div class="form-group">
                      <div class="row">
                          <div class="col-md-4">
                             <label><?php echo lng('Current Image');?></label>
                             <img src="<?php echo base_url().'assets/images/gallery_image/'.$list['img_name'];?>" alt="" id="image_upload_preview" width="150px" height="100px" />
                          </div>
                          <div class="col-md-4">
                              <input type="file" name="img" id="inputFile"/>
                              <input type="hidden" name="Preimg" value="<?php echo $list['img_name'];?>"/>
                 <p class="help-block"><?php echo lng('Max file size 300 KB.');?></p>  
                          </div>
                      </div>
                  </div>
                    <button type="submit" class="btn btn-default"><?php echo lng('Update');?></button>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
        </div>
    </div>
</div>
<?php endforeach;
 endif;
?>
    
<script>
     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });
    
</script>