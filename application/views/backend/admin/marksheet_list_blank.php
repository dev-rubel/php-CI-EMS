<?php
// per page count
$perPageEntity = 20;
// school information
$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
list($schoolName,$schoolAddress,$eiin,$email,$phone) = explode('+', $schoolInfo);
// convert id to name
$className = $this->db->get_where('class',['class_id'=>$class_id])->row()->name;
$sectionName = $this->db->get_where('section',['section_id'=>$section_id])->row()->name;
$shiftName = $this->db->get_where('shift',['shift_id'=>$shift_id])->row()->name;
if(!empty($group_id)) {
	$groupName = $this->db->get_where('group',['group_id'=>$group_id])->row()->name;
	$groupName = ucfirst($groupName);
} else {
	$groupName = '';
}
// search student
$this->db->where('class_id',$class_id);
$this->db->where('section_id',$section_id);
$this->db->where('shift_id',$shift_id);
if(!empty($group_id)){
	$this->db->where('group_id',$group_id);
}
$studentTotal = $this->db->get('enroll')->result_array();
// count total student
$countTotal = count($studentTotal);
// chank student per page
$perPage = array_chunk($studentTotal,$perPageEntity);
// count per page
$countPage = count($perPage);
?>
<!-- bootstrap 4 style sheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" />
<!-- custom style sheet for a4 size page -->
<style>
        body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 240mm;
        min-height: 330mm;
        padding: 10mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
    }
    .subpage {
        /* padding: 1cm; */
        /* border: 2px red solid; */
        height: 330mm;
    }
	.signature-date p {
		border-top: 1px dashed;
	}
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 330mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
<!-- end custom style sheet -->
<?php 
if($countTotal > 1):
for($x = 0; $x < $countPage; $x++): ?>
<div class="page">
	<div class="subpage">
		<!-- header title -->
		<div class="row">
			<div class="col-sm-12 header-title text-center">
				<h3><?php echo $schoolName; ?></h3>
				<h4><?php echo $schoolAddress; ?></h4>
			</div>
		</div>
		<br>
		<!-- header table -->
		<div class="row">
			<div class="table-responsive header-table">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Academic Year</th>
							<th>Class</th>
							<?php if(!empty($group_id)):?>
								<th>Group</th>
							<?php endif; ?>
							<th>Section</th>
							<th>Shift</th>
							<th>Total Student</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo substr($year,0,4); ?></td>
							<td><?php echo $className; ?></td>
							<?php if(!empty($group_id)):?>
								<td><?php echo $groupName ?></td>
							<?php endif; ?>
							<td><?php echo $sectionName ?></td>
							<td><?php echo $shiftName ?></td>
							<td><?php echo $countTotal; ?></td>
						</tr>
						<tr>
							<td><b>Exam</b></td>
							<td colspan="2"></td>
							<td><b>Subject</b></td>
							<td <?php echo !empty($group_id)?'colspan="2"':''; ?>></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- student table -->
		<div class="row">
			<div class="table-responsive header-table">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Student ID</th>
							<th>Name</th>
							<th>Roll</th>
							<th>CR</th>
							<th>MCQ</th>
							<th>PR</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($perPage[$x] as $k=>$each): 
							$student = $this->db->get_where('student',['student_id'=>$each['student_id']])->result_array();
						?>
						<tr>
							<td><?php echo $student[0]['student_code'] ?></td>
							<td><?php echo $student[0]['name'] ?></td>
							<td><?php echo $each['roll'] ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	
	</div>    
	<!-- bottom row -->
	<div class="row">
		<div class="offset-sm-4 col-sm-4 text-center">
			<p>Page: <?php echo $x+1; ?> of <?php echo $countPage; ?></p>
		</div>		
		<div class="col-sm-4 text-center signature-date">
			<p>Signature & Date</p>	 
		</div>
	</div>

</div>
<?php endfor; 
else:
?>

<br>
<br>
<br>
<div class="row">
	<div class="col-sm-12 text-center">
		<h4>No Record Found</h4>
	</div>
</div>

<?php endif; ?>