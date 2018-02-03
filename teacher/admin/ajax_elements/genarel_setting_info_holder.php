
<div class="panel-heading">
	<div class="panel-title">
		<?php echo get_phrase('system_settings');?>
	</div>
</div>

<div class="panel-body">
	<div class="col-md-6">
		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('system_name');?>
			</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="system_name" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('system_title_english');?>
			</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="system_title_english" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title_english'))->row()->description;?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('system_title');?>
			</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="system_title" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('address');?>
			</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="address" value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('phone');?>
			</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="phone" value="<?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?>">
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('currency');?>
			</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="currency" value="<?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('system_email');?>
			</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="system_email" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('running_session');?>
			</label>
			<div class="col-sm-9">
				<select name="running_year" class="form-control">
					<?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;?>
					<option value="">
						<?php echo get_phrase('select_running_session');?>
					</option>
					<?php for($i = 0; $i < 10; $i++):?>
					<option value="<?php echo (2016+$i).'-'.(2016+$i+1);?>" <?php if($running_year==( 2016+$i). '-'.(2016+$i+1)) echo
						'selected';?>>
						<?php echo substr((2016+$i).'-'.(2016+$i+1), 0, -5);?>
					</option>
					<?php endfor;?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('language');?>
			</label>
			<div class="col-sm-9">
				<select name="language" class="form-control">
					<?php
			$fields = $this->db->list_fields('language');
			foreach ($fields as $field)
			{
				
					if ($field == 'phrase_id' || $field == 'phrase')continue;
				if($field=='english' || $field=='bengali'){
				$current_default_language	=	$this->db->get_where('settings' , array('type'=>'language'))->row()->description;
				?>
						<option value="<?php echo $field;?>" <?php if ($current_default_language==$field)echo 'selected';?>>
							<?php echo $field;?> </option>
						<?php
				}
				
			}
			?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">
				<?php echo get_phrase('text_align');?>
			</label>
			<div class="col-sm-9">
				<select name="text_align" class="form-control">
					<?php $text_align	=	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;?>
					<option value="left-to-right" <?php if ($text_align=='left-to-right' )echo 'selected';?>> left-to-right</option>
					<option value="right-to-left" <?php if ($text_align=='right-to-left' )echo 'selected';?>> right-to-left</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button type="submit" class="btn btn-info">
					<?php echo get_phrase('save');?>
				</button>
			</div>
		</div>

	</div>




