<?php
$this->db->where('id', $imLink_id);
$title = $this->db->get('linkinfo')->row()->title;
$this->db->where('id', $imLink_id);
$link = $this->db->get('linkinfo')->row()->link;
?>

<form id="editImportantLink" action="<?php echo base_url() .'index.php?homemanage/ajax_update_important_link'; ?>" class="form-horizontal form-groups-bordered" method="post">

    <div class="form-group">
        <label><?php echo lng('Link Title'); ?></label>
        <input class="form-control" placeholder="" name="title" value="<?php echo $title; ?>">
        <input type="hidden" name="id" value="<?php echo $imLink_id; ?>">
    </div>
    <div class="form-group">
		<label><?php echo lng('Link'); ?></label>
		<input class="form-control" placeholder="" name="title_link" value="<?php echo $link; ?>">
		<input type="hidden" name="description" value="link description">
    </div>
    <button type="submit" class="btn btn-info"><?php echo lng('Update'); ?></button>
</form>


<script>
$(document).ready(function () {
    $('#editImportantLink').ajaxForm({
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
              $("#importantLinkFormSection").html(jData.html.addForm);             
              $("#importantLinkTableHolder").html(jData.html.imLinkTable);            
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