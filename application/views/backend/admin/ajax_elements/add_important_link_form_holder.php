<form id="addImportantLink" action="<?php echo base_url() .'index.php?homemanage/ajax_add_important_link'; ?>" class="form-horizontal form-groups-bordered" method="post">

  <div class="form-group">
	<label>
	  <?php echo lng('Link Title');?>
	</label>
	<input class="form-control" placeholder="" name="title" data-validation="required">
	<input type="hidden" class="form-control" value="" name="description">
  </div>
  <div class="form-group">
	<label>
	  <?php echo lng('Link');?>
	</label>
	<input class="form-control" placeholder="" name="title_link" data-validation="required">
  </div>
  <button type="submit" class="btn btn-info">
	<?php echo lng('Add');?>
  </button>
</form>