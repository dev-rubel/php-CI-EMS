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