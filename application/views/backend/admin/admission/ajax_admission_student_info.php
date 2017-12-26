<?php
$student_info = $this->db->get_where('admit_std',
['uniq_id'=>$student_id, 'status'=>'1', 'session' => $admission_year])->result_array();

if(!empty($student_info)):
?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><b>Student Name:</b> <?php echo $student_info[0]['namebn']?></h3>
        </div>
        <div class="panel-body">
            <p><b>Student ID:</b> <?php echo $student_info[0]['uniq_id']?></p>
            <p><b>Father's Name:</b> <?php echo $student_info[0]['fnamebn']?></p>
            <p><b>Address:</b> <?php echo $student_info[0]['paadress']?></p>
            <p><b>Phone:</b> <?php echo $student_info[0]['mobile']?></p>
        </div>
    </div>

<?php else: ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Student Name: <span style="color: red;">Not Found</span></h3>
        </div>
        <div class="panel-body">
            <p>Student ID: <?php echo $student_id?></p>
            <p>Father's Name: </p>
            <p>Address: </p>
            <p>Phone: </p>
        </div>
    </div>


<?php endif;?>