<?php 
	//pd($table_field[0]->name); 
	$count = 0; 
 ?>
<div class="row">
	<div class="col-md-12">
	<h3 class="text-center"><a href="#" class="btn btn-xs btn-info" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_data_database/<?php echo $table_name;?>');">Add Data</a> Table Name: <?php echo '<b>'.$table_name.' ('.count($table_data).')</b>'; ?> </h3>

		<table class="table table-bordered">
		  <thead>
		    <tr>
	    	<th class="text-center">Action</th>
		    <?php foreach($table_field as $field): $count += 1;?>
		      <th class="text-center"><?php echo $field->name.'<br>'.'(<b>'.$field->type.'</b>)'; ?></th>
		  	<?php endforeach; ?>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(!empty($table_data)): foreach($table_data as $ke=>$each): ?>

		    <tr>
		    	<td>
					<a href="#" class="btn btn-xs btn-danger" onclick="confirm_modal('<?php echo base_url().'index.php?admin/delete_database_entitie/'.
					$table_name.'/'.
					$table_field[0]->name.'/'.
					$table_data[$ke][$table_field[0]->name]; 
					?>')">Delete</a>
					<a href="#" class="btn btn-xs btn-primary" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_data_database/<?php echo $table_name.'/'.$table_data[$ke][$table_field[0]->name];?>');">Edit</a>
		    	</td>
		    	<?php foreach($table_field as $k=>$field): ?>
		      		<th><?php echo $table_data[$ke][$field->name]; ?></th>
		      	<?php endforeach; ?>
		    </tr>

			<?php endforeach; ?>
			<?php else: ?>

				<tr>
					<td class="text-center" colspan="<?php echo $count+1 ?>">No Records Found</td>
				</tr>

			<?php endif; ?>
		  </tbody>
		</table>
	</div>
</div>