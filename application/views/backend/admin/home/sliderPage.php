<div class="row">

  <div class="col-md-offset-1 col-md-10">
    <div class="row">      
    <div class="col-md-4" id="sliderFormSection">

      <form id="addSlider" action="<?php echo base_url() .'index.php?homemanage/ajax_add_slider'; ?>" class="form-horizontal form-groups-bordered" method="post" enctype="multipart/form-data">
  
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
          <div class="form-group">
            <div id="image-preview">
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


      <div class="col-md-8" id="sliderImageHolder">      
        <?php 
          $this->db->where('track_name', 'slider');
          $slider = $this->db->get('images')->result_array();
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
      if(!empty($slider)):
      foreach($slider as $key=>$list): $info = explode('+', $list['info']); $id = $list['id']; $name = $list['img_name'];?>
            <tr id="slider<?php echo $key;?>">
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
                <img src="<?php echo base_url().'assets/images/slider_image/'.$list['img_name'];?>" width="150px" height="100px"
                />
              </td>
              <td>
                <a href="#" class="btn btn-info btn-xs" onclick="editSlider('<?php echo $id;?>')">Edit</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="confDelete('homemanage','ajax_delete_slider','<?php echo $id.'-'.$list['img_name'];?>','slider<?php echo $key;?>')">
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

</div>
<!--/.row-->



<script>
$(document).ready(function () {

  $('#addSlider').ajaxForm({
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
              $("#sliderImageHolder").html(jData.html);
              $('#addSlider').resetForm();
          }
          $('body,html').animate({
              scrollTop: 0
          }, 800);
          $('#loading2').fadeOut('slow');
          $('#overlayDiv').fadeOut('slow');
      }
  });
});

function editSlider(sliderID) {
    $.ajax({
        type: 'GET',
        url: '<?php echo base_url();?>index.php?homemanage/ajax_edit_slider/' + sliderID,
        beforeSend: function () {
            $('#loading2').show();
            $('#overlayDiv').show();
        },
        success: function (data) {
            var jData = JSON.parse(data);

            toastr.success(jData.msg);
            $("#sliderFormSection").html(jData.html);
            $('body,html').animate({
                scrollTop: 350
            }, 800);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');
        }
    });
}


</script>