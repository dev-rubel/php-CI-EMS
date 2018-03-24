<?php //pd($months); ?>
<div class="form-group">
	<label class="col-sm-3 control-label">
		<?php echo get_phrase('months');?>
	</label>
	<div class="col-sm-9">
		<div class="col-sm-3">
			<input type="checkbox" name="months[]" value="january" class="custom-control-input" <?php echo in_array('january',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;January</span>
			<input type="checkbox" name="months[]" value="february" class="custom-control-input" <?php echo in_array('february',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;February</span>
			<input type="checkbox" name="months[]" value="march" class="custom-control-input" <?php echo in_array('march',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;March</span>
			<input type="checkbox" name="months[]" value="april" class="custom-control-input" <?php echo in_array('april',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;April</span>
		</div>
		<div class="col-sm-3">
			<input type="checkbox" name="months[]" value="may" class="custom-control-input" <?php echo in_array('may',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;May</span>
			<input type="checkbox" name="months[]" value="june" class="custom-control-input" <?php echo in_array('june',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;June</span>
			<input type="checkbox" name="months[]" value="july" class="custom-control-input" <?php echo in_array('july',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;July</span>
			<input type="checkbox" name="months[]" value="august" class="custom-control-input" <?php echo in_array('august',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;August</span>
		</div>
		<div class="col-sm-3">
			<input type="checkbox" name="months[]" value="september" class="custom-control-input" <?php echo in_array('september',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;September</span>
			<input type="checkbox" name="months[]" value="october" class="custom-control-input" <?php echo in_array('october',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;October</span>
			<input type="checkbox" name="months[]" value="november" class="custom-control-input" <?php echo in_array('november',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;November</span>
			<input type="checkbox" name="months[]" value="december" class="custom-control-input" <?php echo in_array('december',$months)?'disabled':''?>>
			<span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;December</span>
		</div>
	</div>
</div>