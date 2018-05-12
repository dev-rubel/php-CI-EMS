<style>
	#queryTableSection {
		display: none;
	}
</style>
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

<div class="row" id="queryTableSection">
	<form id="dbQuery" action="<?php echo base('admin','queryDelete');?>" method="post">
		<div class="col-md-offset-1 col-md-2">
			<input type="text" name="table" id="queryTableInput" class="form-control" placeholder="Table Name" disabled>
		</div>
		<div class="col-md-2">
			<select name="type" class="form-control">
				<option value="get">View</option>
				<option value="delete">Delete</option>
			</select>
		</div>
		<div class="col-md-4">
			<input type="text" name="where[]" class="form-control" placeholder="where condition 1 | eg. where=value" required>
			<input type="text" name="where[]" class="form-control" placeholder="where condition 2">
			<input type="text" name="where[]" class="form-control" placeholder="where condition 3">
		</div>
		<div class="col-md-2">
			<input type="submit" id="queryTableButton" value="Submit" class="btn btn-info">
		</div>
	</form>
</div>

<br><br>
<div id="dataHolder"></div>



<script>
 $(document).ready(function () {
	$('#dbQuery').ajaxForm({
		beforeSend: function () {
			$('#loading2').show();
			$('#overlayDiv').show();
		},
		success: function (data) {
			var jData = JSON.parse(data);

			toastr.success(jData.msg);
			$("#dataHolder").html(jData.html);
			$('body,html').animate({
				scrollTop: 350
			}, 800);
			$('#loading2').fadeOut('slow');
			$('#overlayDiv').fadeOut('slow');
		}
	});

});
	$('#table_name').on('change', function(e){
		//alert(e.target.value);
		$('#queryTableInput').val(e.target.value);
		$('#queryTableInput').removeAttr('disabled');
		$('#queryTableInput').attr('readonly','readonly');
		$('#queryTableSection').show();		
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