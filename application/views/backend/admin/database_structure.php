 <div id="overlayDiv" style="width: 99%;height: 100%;background-color: white;position: absolute;top: 0;z-index: 11; opacity: .7;"></div>
<img src="<?php echo base_url();?>assets/backend/loader.gif" id="loading" style="position: absolute; top: 20%; left: 40%; z-index: 1111;"/>  

<br>
<div class="row">
	<div class="col-md-offset-2 col-md-2">
		<p>Table Name: </p>
	</div>
	<div class="col-md-4">
		<select name="table_name" id="table_name" class="form-control">
			<option value="">Select Table</option>
		<?php $all_tables = $this->db->list_tables(); foreach($all_tables as $each): ?>
			<option value="<?php echo $each; ?>"><?php echo ucwords(str_replace('_', ' ',$each)); ?></option>
		<?php endforeach; ?>
		</select>
	</div>
	<div class="col-md-2">
		<a href="<?php echo base('admin', 'db_backup'); ?>" class="btn btn-sm btn-primary">Download & Save Database</a>
	</div>
</div>

<br><br>
<div id="dataHolder"></div>



<script>
	$('#loading').hide();
    $('#overlayDiv').hide();

	$('#table_name').on('change', function(e){
		//alert(e.target.value);
		$.ajax({
			beforeSend: function() { 
                $('#loading').show();
                $('#overlayDiv').show();
            }, 
			url: '<?php echo base('admin', 'get_database_table').'/'; ?>' + e.target.value,
			success: function(responce){
				$('#dataHolder').html(responce);
				$('#loading').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
			}
		});
	});
</script>