<?php 
	!empty($group_id)?$group_id=$group_id:$group_id='';
	if($group_id !== ''):
		$group_name       = $this->db->get_where('group' , array('group_id' => $group_id))->row()->name;
	endif;
		$class_name		= $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
		$section_name       = $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
		$shift_name  		= $this->db->get_where('shift' , array('shift_id' => $shift_id))->row()->name;
		$running_year       =	$this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;

	$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
	list($schoolName,$schoolAddress,$eiin,$email,$phone) = explode('+', $schoolInfo);
?>
<div id="print">
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<style type="text/css">
		td {
			padding: 5px;
		}
	</style>

	<center>
		<!-- <img src="uploads/school_logo.png" style="max-height : 60px;"><br> -->
		<h3><?php echo $schoolName;?> | <?php echo get_phrase('tabulation_sheet');?></h3>
		<?php echo '<b>Exam: </b>'.$this->db->get_where('exam',['exam_id'=>$exam_id])->row()->name;?> |
		<?php echo '<b>'.get_phrase('class') . ':</b> ' . $class_name;?> |
        <?php echo '<b>'.get_phrase('section').':</b> '.$section_name;?> |
        <?php echo '<b>'.get_phrase('shift').':</b> '.$shift_name;?> 
		<?php echo !empty($group_name)?'| <b>Group:</b> '.ucwords($group_name).'<br>':'';?>
		
	</center>

	
	<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
		<thead>
			<tr>
			<td style="text-align: center;">
				<?php echo get_phrase('students');?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('subjects');?> <i class="entypo-right-thin"></i>
			</td>
			<?php 
				$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
				foreach($subjects as $row):
			?>
				<td style="text-align: center;"><?php echo $row['name'];?></td>
			<?php endforeach;?>
			<td style="text-align: center;"><?php echo get_phrase('total');?></td>
			<td style="text-align: center;"><?php echo get_phrase('average_grade_point');?></td>
			</tr>
		</thead>
		<tbody>
		<?php
			
			$student = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
			foreach($student as $key=>$row):
		?>
			<tr>
				<td class="text-center">
					<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
				</td>

				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $key2=>$row2):
						$marks = $students['mark_info'][$key][$row['student_id']];
							if($marks):
								$marks = $students['mark_info'][$key][$row['student_id']]['obtain_mark'][$row2['subject_id']];
									$marks = array_sum(explode('|',$marks));
										if($marks > 33):
				?>
					<td class="text-center"><?php echo $marks; ?></td>										
				<?php else: ?>
					<td class="text-center" style="color: red;"><?php echo $marks; ?></td>
				<?php endif; else: ?>					
					<td class="text-center">Fail</td>
				<?php endif; endforeach;?>

				<?php $color = $students['mark_info'][$key][$row['student_id']]['failCount'] > 0 ? 'color: red;': '' ?>
				<td class="text-center" style="<?php echo $color == true? $color:'';?>"><?php echo $students['mark_info'][$key][$row['student_id']]['total_grade']; ?></td>
				<td class="text-center" style="<?php echo $color == true? $color:'';?>"><?php echo $students['mark_info'][$key][$row['student_id']]['total_point_with_4th']; ?></td>
			
			</tr>

		<?php endforeach;?>

		</tbody>
	</table>
</div>



<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var elem = $('#print');
		PrintElem(elem);
		Popup(data);

	});

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        //mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        //mywindow.document.write('<style>.print{border : 1px;}</style>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>