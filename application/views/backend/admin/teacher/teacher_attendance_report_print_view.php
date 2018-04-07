<?php 
    $schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
    list($schoolName,$schoolAddress,$eiin,$email,$phone) = explode('+', $schoolInfo);

    $running_year       =	$this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
    if($month == 1) $m = 'January';
    else if($month == 2) $m='February';
    else if($month == 3) $m='March';
    else if($month == 4) $m='April';
    else if($month == 5) $m='May';
    else if($month == 6) $m='June';
    else if($month == 7) $m='July';
    else if($month == 8) $m='August';
    else if($month == 9) $m='Sepetember';
    else if($month == 10) $m='October';
    else if($month == 11) $m='November';
    else if($month == 12) $m='December';

?>
<div id="print">
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<style type="text/css">
		td {
			padding: 5px;
		}
	</style>

	<center>
		<img src="uploads/school_logo.png" style="max-height : 60px;"><br>
		<h3 style="font-weight: 100;"><?php echo $schoolName;?></h3>
		<?php echo get_phrase('teacher_attendance_sheet');?><br>
        <?php echo '<b>'.get_phrase('month').':</b> '.$m;?>		
	</center>        
    <table border="1" style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;">
        <thead>
            <tr>
                <td style="text-align: center;">
                    <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | 
                    <?php echo get_phrase('date'); ?> 
                    <i class="entypo-right-thin"></i>
                </td>
            <?php
            $year = explode('-', $running_year);
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year[0]);
            for ($i = 1; $i <= $days; $i++) {
                ?>
                    <td style="text-align: center;"><?php echo $i; ?></td>
            <?php } ?>

            </tr>
        </thead>
        <tbody>
            <?php $teachers = $this->db->get('teacher')->result_array();
                foreach ($teachers as $row): ?>
                <tr>
                    <td style="text-align: center;">
                    <?php echo $row['name']; ?>
                    </td>
                    <?php
                    $status = 0;
                    for ($i = 1; $i <= $days; $i++) {
                        $timestamp = strtotime($i . '-' . $month . '-' . date('Y'));
                        $this->db->group_by('timestamp');
                        $attendance = $this->db->get_where('teacher_attendance', ['year' => $running_year, 'timestamp' => $timestamp, 'teacher_id' => $row['teacher_id']])->result_array();


                        foreach ($attendance as $row1):
                            $month_dummy = date('m', $row1['timestamp']);
                            if ($i == $month_dummy)
                                ;
                            $status = $row1['status'];
                        endforeach;
                        ?>
                        <td style="text-align: center;" data-class="">
                            <?php if ($status == 1) { ?>
                                <div style="color: green; font-weight: bold;">P</div>
                            <?php } else if ($status == 2) { ?>
                                <div style="color: red; font-weight: bold;">A</div>
                            <?php } else if ($status == 3) { ?>
                                <div style="color: orange; font-weight: bold;">E</div>
                            <?php }$status=0; ?>
                        </td>

                    <?php } ?>
                
                </tr>
            <?php endforeach; ?>
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