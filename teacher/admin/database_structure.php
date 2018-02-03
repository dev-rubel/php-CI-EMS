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
	$('#table_name').on('change', function(e){
		//alert(e.target.value);
		$.ajax({
			beforeSend: function() { 
                $('#loading2').show();
                $('#overlayDiv').show();
            }, 
			url: '<?php echo base('admin', 'get_database_table').'/'; ?>' + e.target.value,
			success: function(responce){
				$('#dataHolder').html(responce);
				$('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
			}
		});
	});
</script>