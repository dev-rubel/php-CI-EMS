<hr />
<?php $month = date('m');?>
<form id="attendanceReportSelector" action="<?php echo base_url() .'index.php?admin/ajax_teacher_attendance_report_selector'; ?>" method="post">  
<div class="row">

    <div class="col-md-offset-3 col-md-4">
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
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-1" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>
</div>

<?php echo form_close(); ?>



<div id="teacher_attendance_report_section_holder"></div>



<script type="text/javascript">

/* Search Attendance */
$('#attendanceReportSelector').ajaxForm({ 
	beforeSend: function() {                
		$('#loading2').show();
		$('#overlayDiv').show();
	},  
	success: function (data){		
		$( "#teacher_attendance_report_section_holder" ).html( data ); 
        $('body,html').animate({scrollTop:400},800);
		$('#loading2').fadeOut('slow');
		$('#overlayDiv').fadeOut('slow');  
						
	}
}); 

</script>