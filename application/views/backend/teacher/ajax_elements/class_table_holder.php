<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th><div>#</div></th>
			<th><div><?php echo get_phrase('class_name'); ?></div></th>
			<th><div><?php echo get_phrase('numeric_name'); ?></div></th>
			<th><div><?php echo get_phrase('teacher'); ?></div></th>
			<th><div><?php echo get_phrase('options'); ?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 1;
		foreach ($classes as $row): ?>
			<tr>
				<td><?php echo $count++; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['name_numeric']; ?></td>
				<td>
					<?php
					if ($row['teacher_id'] != '' || $row['teacher_id'] != 0)
						echo $this->crud_model->get_type_name_by_id('teacher', $row['teacher_id']);
					?>
				</td>
				<td>
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
							Action <span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-default pull-right" role="menu">

							<!-- EDITING LINK -->
							<li>
								<a href="#" onclick="editClass('<?php echo $row['class_id'];?>')">
									<i class="entypo-pencil"></i>
<?php echo get_phrase('edit'); ?>
								</a>
							</li>
							<li class="divider"></li>

							<!-- DELETION LINK -->
							<li>
								<a href="#" onclick="confDelete('admin','ajax_delete_classes','<?php echo $row['class_id'];?>','classes<?php echo $row['class_id'];?>')">
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


function editClass(classID)
    {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url();?>index.php?teacher/ajax_edit_class/'+classID,
            beforeSend: function(){
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function(data){
                var jData = JSON.parse(data); 
                
                toastr.success(jData.msg);  
                $( "#editClassHolder" ).html( jData.html );
                $('body,html').animate({scrollTop:350},800);         
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }

</script>