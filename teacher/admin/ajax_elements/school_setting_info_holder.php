<div class="panel-heading">
		<div class="panel-title">
			<?php echo get_phrase('information_setting').' (English)';?>
		</div>
	</div>

	<div class="panel-body">
		<?php 
$schoolInfo = $this->db->get_where('settings' , array('type' =>'school_information'))->row()->description;
list($schoolName,$schoolAddress,$eiin,$email,$phone) = explode('+', $schoolInfo);
?>
		<div class="col-md-6">

			<div class="form-group">
				<label class="col-sm-3 control-label">
					<?php echo get_phrase('school_name');?>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="school_name" value="<?php echo $schoolName;?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					<?php echo get_phrase('school_address');?>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="school_address" value="<?php echo $schoolAddress;?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					<?php echo get_phrase('EIIN');?>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="eiin" value="<?php echo $eiin;?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">
					<?php echo get_phrase('email');?>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="email" value="<?php echo $email;?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					<?php echo get_phrase('phone');?>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
				</div>
			</div>

		</div>
		<div class="col-md-6">



			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">
					<?php echo get_phrase('logo');?>
				</label>

				<div class="col-sm-9">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
							<img src="<?php echo base_url();?>uploads/school_logo.png" alt="...">
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


			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-info">
						<?php echo get_phrase('update');?>
					</button>
				</div>
			</div>
		</div>





	</div>