<?php 
$title = $this->db->get_where('linkinfo',array('id'=>$imNoticeId))->row()->title;
$description = $this->db->get_where('linkinfo',array('id'=>$imNoticeId))->row()->description;
?>

<form id="updateImportantNotice" action="<?php echo base_url() .'index.php?homemanage/ajax_update_important_notice'; ?>" class="form-horizontal form-groups-bordered" method="post">

<div class="form-group">
	<label><?php echo lng('Notice Title'); ?></label>
	<input class="form-control" name="title" value="<?php echo $title; ?>" placeholder="" data-validation="required">
	<input type="hidden" name="id" value="<?php echo $imNoticeId; ?>">
</div>
<div class="form-group">
	<label><?php echo lng('Notice Description'); ?></label>
	<textarea class="form-control" name="description" data-validation="required" rows="7"><?php echo $description; ?></textarea>
</div>
<button type="submit" class="btn btn-info"><?php echo lng('Update'); ?></button>
	
</form>


<script>
$(document).ready(function () {

    $('#updateImportantNotice').ajaxForm({
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
              $("#ImportantNoticeFormSection").html(jData.html.addForm);             
              $("#ImportantNoticeHolder").html(jData.html.noticeHolder);            
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
