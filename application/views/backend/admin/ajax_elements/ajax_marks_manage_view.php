<?php
$subject_info = $this->db->get_where('subject',['subject_id'=>$subject_id])->result_array();
$subject_marks = $subject_info[0]['subject_marks'];
 ?>
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
    
    <form id="updateMark" action="<?php echo base_url().'index.php?admin/marks_update/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id.'/'.$group_id; ?>" method="post">
      <?php foreach($foundRolls as $k=>$value): ?>
        <input type="hidden" name="student_rolls[]" value="<?php echo $value;?>">
      <?php endforeach; ?>
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
          $keys = 0;
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
					foreach($marks_of_students as $key=>$row):
				?>
					<tr>
						<td><?php echo $keys += 1;?></td>
						<td>
							<?php echo $this->db->get_where('enroll', array('student_id'=>$row['student_id']))->row()->roll;?>
						</td>
						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
						</td>
						<td>
							<?php
              $marks = explode('|',$row['mark_obtained']);
              foreach (explode('|',$subject_marks) as $key => $value) :
									// if($value != 0):
                    $arr = [0 => 'MT',1 => 'CQ', 2 => 'MCQ', 3 => 'PT'];
								?>
								<input type="text" class="form-control" name="marks_obtained[<?php echo $row['mark_id'];?>][]" value="<?php echo is_array($marks)==true?$marks[$key]:0; ?>" min="1" max="<?php echo $value; ?>" <?php echo $value==0?'readonly':''; ?> placeholder="<?php echo $arr[$key].' ('.$value.')'; ?>">
							<?php endforeach; ?>

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

<script type="text/javascript">

$('#updateMark').ajaxForm({
    beforeSend: function() {
            $('#loading2').show();
            $('#overlayDiv').show();
    },
    success: function (data){
        var jData = JSON.parse(data);
        if(!jData.type) {
            toastr.error(jData.msg);
        } else {
            toastr.success(jData.msg);
            $( "#studentMarkHolder" ).html( jData.html );
        }
        $('body,html').animate({scrollTop:0},800);
        $('#loading2').fadeOut('slow');
        $('#overlayDiv').fadeOut('slow');
    }
});
</script>
