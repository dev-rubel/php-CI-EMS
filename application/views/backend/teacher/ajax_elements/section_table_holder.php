<table class="table table-bordered datatable" id="table_export">
<thead>
	<tr>
		<th><div>#</div></th>
		<th><?php echo get_phrase('class'); ?></th>
		<th><?php echo get_phrase('section_name'); ?></th>
		<th><?php echo get_phrase('nick_name'); ?></th>
		<th><?php echo get_phrase('teacher'); ?></th>
		<th><?php echo get_phrase('options'); ?></th>
	</tr>
</thead>
<tbody>
<?php
		$count = 1;
		$sections = $this->db->get_where('section')->result_array();
		foreach ($sections as $row):
			?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo $this->db->get_where('class',['class_id'=>$row['class_id']])->row()->name; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['nick_name']; ?></td>
			<td>
				<?php
				if ($row['teacher_id'] != '' || $row['teacher_id'] != 0)
					echo $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']))->row()->name;
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
							<a href="#" onclick="editSection('<?php echo $row['section_id'];?>')">
								<i class="entypo-pencil"></i>
<?php echo get_phrase('edit'); ?>
							</a>
						</li>
						<li class="divider"></li>

						<!-- DELETION LINK -->
						<li>
							<a href="#" onclick="confDelete('admin','ajax_delete_section','<?php echo $row['section_id'];?>','section<?php echo $row['section_id'];?>')">
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


function editSection(sectionID)
    {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url();?>index.php?teacher/ajax_edit_section/'+sectionID,
            beforeSend: function(){
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function(data){
                var jData = JSON.parse(data); 
                
                toastr.success(jData.msg);  
                $( "#editSectionHolder" ).html( jData.html );
                $('body,html').animate({scrollTop:350},800);         
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }

</script>