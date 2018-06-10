<?php
	$mainColor = $this->db->get_where('frontpages',['title'=>'main_color'])->row()->description;
	$hoverColor = $this->db->get_where('frontpages',['title'=>'hover_color'])->row()->description;
?>             

<div class="form-group">
	<label for="field-1" class="col-md-3 control-label">Main Color</label>
	<div class="col-md-8">
		<input type="text" class="form-control jscolor" name="main_color" value="<?php echo $mainColor; ?>" required="required">
	</div>
</div>
<br>
<br>
<br>
<div class="form-group">
	<label for="field-1" class="col-md-3 control-label">Hover Color</label>
	<div class="col-md-8">
		<input type="text" class="form-control jscolor" name="hover_color" value="<?php echo $hoverColor; ?>" required="required">
	</div>
</div>
<br>
<br>
<br>
<button type="submit" class="btn btn-info">
	<?php echo lng('Update');?>
</button> 