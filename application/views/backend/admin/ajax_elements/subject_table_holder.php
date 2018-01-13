<table class="table table-bordered datatable" id="table_export">
<thead>
	<tr>
		<th><div><?php echo get_phrase('class');?></div></th>
		<th><div><?php echo get_phrase('subject_name');?></div></th>
		<th><div><?php echo get_phrase('mark');?></div></th>
		<th><div><?php echo get_phrase('teacher');?></div></th>
		<th><div><?php echo get_phrase('options');?></div></th>
	</tr>
</thead>
<tbody>
	<?php 
	$count = 1;foreach($subjects as $row):
	$joinOrNot = $this->db->get_where('subject',array('subject_code'=>$row['subject_code']))->result_array();
	$groupName = $this->db->get_where('group',array('group_id'=>$row['group_id']))->row()->name;
	?>
	<tr>
		<td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
		<td><?php echo count($joinOrNot)>1?$row['name'].' | <b>Join</b>':$row['name'].'<b> | '.ucfirst($row['subject_category']).'</b>'; echo '<b> | '.ucwords(notEmpty($groupName)).'</b>';?></td>
		<td><?php echo count($joinOrNot)>1?$row['subject_mark'].' | <b>'.($joinOrNot[0]['subject_mark']+$joinOrNot[1]['subject_mark']).'</b>':$row['subject_mark']; ?></td>
		<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
		<td>
		<div class="btn-group">
			<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu dropdown-default pull-right" role="menu">
				
				<!-- EDITING LINK -->
				<li>
					<a href="#" onclick="editSubject('<?php echo $row['subject_id'];?>')">
						<i class="entypo-pencil"></i>
							<?php echo get_phrase('edit');?>
						</a>
								</li>
				<li class="divider"></li>
				
				<!-- DELETION LINK -->
				<li>
					<a href="#" onclick="confDelete('admin','ajax_delete_subject','<?php echo $row['subject_id'];?>','subject<?php echo $row['subject_id'];?>')">
						<i class="entypo-trash"></i>
							<?php echo get_phrase('delete');?>
						</a>
								</li>
			</ul>
		</div>
		</td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>
