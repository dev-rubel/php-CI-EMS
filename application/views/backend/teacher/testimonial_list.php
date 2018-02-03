<?php
	$lists = $this->db->get('testimonial')->result_array();
?>
<div class="row">
	<div class="col-md-12">
	
		<table class="table table-bordered datatable" id="table_export">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Roll</th>
					<th>Session</th>
					<th>GPA</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($lists as $k=>$each): $course = !empty($each['course'])?'General':'Voc'; ?>
				<tr>
					<td><?php echo $k+1;?></td>
					<td><?php echo $each['student_name'];?></td>
					<td><?php echo $each['pass_roll'];?></td>
					<td><?php echo $each['pass_session'];?></td>
					<td><?php echo $each['gpa'];?></td>
					<td>
						<a href="<?php echo base('admin','print_testimonial/').$each['testimonial_id'].'/'.$course;?>" target="_blank" class="btn btn-info btn-xs">Print</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	
	</div>
</div>