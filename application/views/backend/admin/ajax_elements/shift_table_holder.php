<table class="table table-bordered datatable" id="table_export">
<thead>
	<tr>
		<th><div>#</div></th>
		<th><div><?php echo get_phrase('shift_name'); ?></div></th>
		<th><div><?php echo get_phrase('options'); ?></div></th>
	</tr>
</thead>
<tbody>
	<?php $count = 1;
	foreach ($shifts as $row): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						Action <span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-default pull-right" role="menu">

						<!-- EDITING LINK -->
						<li>
							<a href="#" onclick="editShift('<?php echo $row['shift_id'];?>')">
								<i class="entypo-pencil"></i>
<?php echo get_phrase('edit'); ?>
							</a>
						</li>
						<li class="divider"></li>

						<!-- DELETION LINK -->
						<li>
							<a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/shifts/delete/<?php echo $row['shift_id']; ?>');">
								<i class="entypo-trash"></i>
<?php echo get_phrase('delete'); ?>
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
</tbody>
</table>


<script>

function editShift(shiftID)
    {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url();?>index.php?admin/ajax_edit_shift/'+shiftID,
            beforeSend: function(){
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function(data){
                var jData = JSON.parse(data); 
                
                toastr.success(jData.msg);  
                $( "#editShiftHolder" ).html( jData.html );
                $('body,html').animate({scrollTop:350},800);         
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }

</script>