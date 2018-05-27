<div class="form-group">
    <div class="row student-list-wrapper">
    <?php if(!empty($student_class) && !empty($student_roll)):
            $class_id = $this->db->get_where('class',['name_numeric'=>$student_class])->row()->class_id;
            if(!empty($class_id)):
                $data = ['class_id'=>$class_id,'roll'=>$student_roll,'year'=>$running_year];
                $students = $this->db->get_where('enroll',$data)->result_array();
                    if(!empty($students)):
                foreach($students as $k=>$each):
                    $stdName = $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->name;
                    $student_code = $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->student_code;                    
        ?>
    <div class="col-md-6">
        <div class="funkyradio">
            <div class="funkyradio-success">
                <input type="radio" name="radio" value="<?php echo $student_code;?>" class="radio" id="radio<?php echo $k?>" />
                <label for="radio<?php echo $k?>"><?php echo $stdName;?></label>
            </div>      
        </div>
    </div>
                <?php endforeach; 
                echo '</row>';
                else: echo '<p class="text-center"><b>No Student Found</b></p>'; endif;
                else: echo '<p class="text-center"><b>No Student Found</b></p>'; endif;
                else: echo '<p class="text-center"><b>No Student Found</b></p>'; endif;?>

</div>

<script>

$('.radio').click(function () {
    var value = $(this).val();
    console.log(value);
    $.ajax({
        url: '<?php echo base_url();?>index.php?a/accounting/getAccStdInfo/' + value,
        success: function (response) {
            var data = $.parseJSON(response);
            if (!data.name) {
                jQuery('#acc_student_info').val('কোন ছাত্র খুজে পাওয়া যায় নি।'); 
            } else {
                $( "#addInvoice" ).show(); 
                $( "#studentInfoBox" ).show();  
                $( "#student_code_value" ).val(value);  
                jQuery('#acc_student_info').val(data.name);
                $.get( "<?php echo base_url();?>index.php?a/accounting/getStudentAccHistory/"+value, function( data ){
                    $( "#studentAccountHistory" ).html( data );  
                });                           
                $.get( "<?php echo base_url();?>index.php?a/accounting/getStudentAccMonthCheckbox/"+value+'/'+<?php echo !empty($student_id)?$student_id:1;?>, function( data ){
                    $( "#accMonthCheckbox" ).html( data ); 
                });
            }
        }
    });
        
});


</script>