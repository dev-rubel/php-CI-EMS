
<hr />
<div class="row" style="text-align: center;">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<div class="tile-stats tile-gray">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			
			<h3 style="color: #696969;"><?php echo get_phrase('marks_for');?> <?php echo $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;?></h3>
			<h4 style="color: #696969;">
				<?php echo get_phrase('class: ');?> <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?> | 
				<?php echo get_phrase('section: ');?> <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?> 
			</h4>
			<h4 style="color: #696969;">
				<?php echo get_phrase('subject');?> : <?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->name;?>
			</h4>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<?php echo form_open(base_url() . 'index.php?admin/marks_update/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id.'/'.$group_id);?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo get_phrase('roll');?></th>
						<th><?php echo get_phrase('name');?></th>
						<th><?php echo get_phrase('marks_obtained');?></th>
						<th><?php echo get_phrase('comment');?></th>
					</tr>
				</thead>
				<tbody>
				<?php
					
					foreach($foundRolls as $k=>$each):
					$marks_of_students = $this->db->get_where('mark' , array(
						'class_id' => $class_id, 
							'student_id' => $each, 
								'group_id' => $group_id,
									'section_id' => $section_id ,
										'year' => $running_year,
											'subject_id' => $subject_id,
												'exam_id' => $exam_id
					))->result_array();
					foreach($marks_of_students as $row):
				?>
					<tr>
						<td><?php echo $k+1;?></td>
						<td>
							<?php echo $this->db->get_where('enroll', array('student_id'=>$row['student_id']))->row()->roll;?>
						</td>
						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
						</td>
						<td>
							<input type="text" class="form-control" name="marks_obtained_<?php echo $row['mark_id'];?>"
								value="<?php echo $row['mark_obtained'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="comment_<?php echo $row['mark_id'];?>"
								value="<?php echo $row['comment'];?>">
						</td>
					</tr>
				<?php endforeach;endforeach;?>
				</tbody>
			</table>

		<center>
			<button type="submit" class="btn btn-success" id="submit_button">
				<i class="entypo-check"></i> <?php echo get_phrase('save_changes');?>
			</button>
		</center>
		<?php echo form_close();?>
		
	</div>
	<div class="col-md-2"></div>
</div>

