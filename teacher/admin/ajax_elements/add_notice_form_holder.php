<?php echo flash_msg();?>

<form id="addNotice" action="<?php echo base_url() .'index.php?homemanage/ajax_add_notice'; ?>" class="form-horizontal form-groups-bordered"
	method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label>
			<?php echo lng('Notice Title');?>
		</label>
		<input class="form-control" name="title" placeholder="" data-validation="required">
		<input type="hidden" name="title_link" value="">
	</div>
	<div class="form-group">
		<label>
			<?php echo lng('Notice Description');?>
		</label>
		<textarea class="form-control" name="description" data-validation="required" rows="7"></textarea>
	</div>
	<div class="form-group">
		<label>
			<?php echo lng('Notice File');?>
		</label>
		<input type="file" class="form-control" name="file" data-validation="mime size" data-validation-allowing="pdf" data-validation-max-size="3mb">
		<small>Max file size: 3MB.</small>
	</div>
	<button type="submit" class="btn btn-info">
		<?php echo lng('Add');?>
	</button>
</form>