<hr />
<?php $month = date('m');?>
<form id="attendanceReportSelector" action="<?php echo base_url() .'index.php?admin/ajax_attendance_report_selector'; ?>" method="post">  
<div class="row">

    <?php
    $query = $this->db->get('class');
    if ($query->num_rows() > 0):
        $class = $query->result_array();        
        ?>

        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>
                <select class="form-control" name="class_id" onchange="select_section(this.value)">
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php foreach ($class as $row): ?>
                    <option value="<?php echo $row['class_id']; ?>" ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>

    <div id="group_holder">
    </div>

    <div id="section_holder">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                <select class="form-control" name="section_id">
                    <option value=""><?php echo get_phrase('select_class_first') ?></option>

                </select>
            </div>
        </div>
    </div>
    <div id="shift_holder">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('shift'); ?></label>
                <select class="form-control" name="shift_id">
                    <option value=""><?php echo get_phrase('select_shift_first') ?></option>
                    <?php $shifts = $this->db->get('shift')->result_array();
                    foreach($shifts as $shift):
                    ?>
                    <option value="<?php echo $shift['shift_id'];?>"><?php echo $shift['name'] ;?></option>                     
                    <?php endforeach;?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-2">
         <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
        <select name="month" class="form-control" id="month">
            <?php
            for ($i = 1; $i <= 12; $i++):
                if ($i == 1)
                    $m = 'January';
                else if ($i == 2)
                    $m = 'February';
                else if ($i == 3)
                    $m = 'March';
                else if ($i == 4)
                    $m = 'April';
                else if ($i == 5)
                    $m = 'May';
                else if ($i == 6)
                    $m = 'June';
                else if ($i == 7)
                    $m = 'July';
                else if ($i == 8)
                    $m = 'August';
                else if ($i == 9)
                    $m = 'September';
                else if ($i == 10)
                    $m = 'October';
                else if ($i == 11)
                    $m = 'November';
                else if ($i == 12)
                    $m = 'December';
                ?>
                <option value="<?php echo $i; ?>"
                      <?php if($month == $i) echo 'selected'; ?>  >
                            <?php echo $m; ?>
                </option>
                <?php
            endfor;
            ?>
        </select>
         </div>
    </div>
    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-1" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>
</div>

<?php echo form_close(); ?>



<div id="attendance_report_section_holder"></div>



<script type="text/javascript">

/* Search Attendance */
$('#attendanceReportSelector').ajaxForm({ 
	beforeSend: function() {                
		$('#loading2').show();
		$('#overlayDiv').show();
	},  
	success: function (data){		
		$( "#attendance_report_section_holder" ).html( data ); 
        $('body,html').animate({scrollTop:400},800);
		$('#loading2').fadeOut('slow');
		$('#overlayDiv').fadeOut('slow');  
						
	}
}); 

function select_section(class_id) {
    $('#group_holder').hide();

    $.ajax({
        url: '<?php echo base_url(); ?>index.php?admin/get_group/' + class_id,
        success:function (response)
        {
            if(response){
                $('#group_holder').show();
                jQuery('#group_holder').html(response); 
            }else{
                $('#group_holder').hide();
            }                
        }
    });

    $.ajax({
        url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id,
        success: function (response)
        {

            jQuery('#section_holder').html(response);
        }
    });
}
</script>