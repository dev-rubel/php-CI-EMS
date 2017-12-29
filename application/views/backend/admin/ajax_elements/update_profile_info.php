<?php foreach($edit_data as $row): ?>
<div class="form-group">
	<label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
	</div>
</div>

<div class="form-group">
	<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
	
	<div class="col-sm-5">
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
				<img src="uploads/admin_image/<?php echo $row['admin_id'];?>.jpg" alt="...">
			</div>
			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
			<div>
				<span class="btn btn-white btn-file">
					<span class="fileinput-new">Select image</span>
					<span class="fileinput-exists">Change</span>
					<input type="file" name="userfile" accept="image/*">
				</span>
				<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
	</div>
</div>

<?php endforeach; ?>