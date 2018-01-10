  <div class="row">
    <div class="col-md-offset-1 col-md-10">
      <div class="col-md-4" id="importantLinkFormSection">

        <form id="addImportantLink" action="<?php echo base_url() .'index.php?homemanage/ajax_add_important_link'; ?>" class="form-horizontal form-groups-bordered" method="post">

          <div class="form-group">
            <label>
              <?php echo lng('Link Title');?>
            </label>
            <input class="form-control" placeholder="" name="title">
            <input type="hidden" class="form-control" value="link description" name="description">
          </div>
          <div class="form-group">
            <label>
              <?php echo lng('Link');?>
            </label>
            <input class="form-control" placeholder="" name="title_link">
          </div>
          <button type="submit" class="btn btn-info">
            <?php echo lng('Add');?>
          </button>
        </form>

      </div>

      <div class="col-md-8" id="importantLinkTableHolder">
      <?php
        $this->db->where('track_name', 'link');
        $link = $this->db->get('linkinfo')->result_array();
      ?>
        <table class="table">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>
                <?php echo lng('Link Title');?>
              </th>
              <th>
                <?php echo lng('Link');?>
              </th>
              <th>
                <?php echo lng('Actions');?>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php 
      if(!empty($link)):
      foreach ($link as $key=>$list): $id = $list['id'];?>
            <tr>
              <th scope="row">
                <?php echo $key+1;?>
              </th>
              <td>
                <?php echo $list['title'];?>
              </td>
              <td>
                <?php echo $list['link'];?>
              </td>
              <td>
                <a href="#" class="btn btn-info btn-xs" onclick="editImLink('<?php echo $id;?>')">Edit</a>
                <a href="<?php echo base('homemanage', 'delete_link'." /$id ");?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to Remove?');">
                  <?php echo lng('Delete');?>
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
    <!--/.row-->

  </div>


  <script>
$(document).ready(function () {

  $('#addImportantLink').ajaxForm({
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
              $("#importantLinkTableHolder").html(jData.html);
              $('#addImportantLink').resetForm();
          }
          $('body,html').animate({
              scrollTop: 0
          }, 800);
          $('#loading2').fadeOut('slow');
          $('#overlayDiv').fadeOut('slow');
      }
  });
});

function editImLink(imLinkID) {
    $.ajax({
        type: 'GET',
        url: '<?php echo base_url();?>index.php?homemanage/ajax_edit_important_link/' + imLinkID,
        beforeSend: function () {
            $('#loading2').show();
            $('#overlayDiv').show();
        },
        success: function (data) {
            var jData = JSON.parse(data);

            toastr.success(jData.msg);
            $("#importantLinkFormSection").html(jData.html);
            $('body,html').animate({
                scrollTop: 350
            }, 800);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');
        }
    });
}

</script>