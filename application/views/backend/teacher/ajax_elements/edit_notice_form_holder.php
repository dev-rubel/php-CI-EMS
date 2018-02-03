<?php 
$title = $this->db->get_where('linkinfo',array('id'=>$noticeID))->row()->title;
$description = $this->db->get_where('linkinfo',array('id'=>$noticeID))->row()->description;
?>

<form id="updateNotice" action="<?php echo base_url() .'index.php?homemanage/ajax_update_notice'; ?>" class="form-horizontal form-groups-bordered" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label><?php echo lng('Notice Title'); ?></label>
	<input class="form-control" name="title" value="<?php echo $title; ?>" placeholder="" data-validation="required">
	<input type="hidden" name="id" value="<?php echo $noticeID; ?>">
</div>
<div class="form-group">
	<label><?php echo lng('Notice Description'); ?></label>
	<textarea class="form-control" name="description" data-validation="required" rows="7"><?php echo $description; ?></textarea>
</div>
<div class="form-group">
	<h4 style="font-weight: bold;"><?php echo file_exists('assets/otherFiles/' . $noticeID . '_noticepdf.pdf') == true ? 'File already exist' : ''; ?></h4>
	<input type="file" class="form-control" name="file" data-validation="mime size" data-validation-allowing="pdf" data-validation-max-size="3mb">
	<small>Max file size: 3MB.</small>
</div>
<button type="submit" class="btn btn-info"><?php echo lng('Update'); ?></button>
	
</form>


<script>
$(document).ready(function () {

    $('#updateNotice').ajaxForm({
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
              $("#noticeFormSection").html(jData.html.addForm);             
              $("#noticeHolder").html(jData.html.noticeHolder);            
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
