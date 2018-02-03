<hr />

<?php if ($class_id != '' && $section_id != '' && $month != ''): ?>

<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="text-align: center;">
        <div class="tile-stats tile-gray">
            <div class="icon">
                <i class="entypo-docs"></i>
            </div>
            <h3 style="color: #696969;">
                <?php
                    $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
                    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                    if ($month == 1)
                        $m = 'January';
                    else if ($month == 2)
                        $m = 'February';
                    else if ($month == 3)
                        $m = 'March';
                    else if ($month == 4)
                        $m = 'April';
                    else if ($month == 5)
                        $m = 'May';
                    else if ($month == 6)
                        $m = 'June';
                    else if ($month == 7)
                        $m = 'July';
                    else if ($month == 8)
                        $m = 'August';
                    else if ($month == 9)
                        $m = 'Sepetember';
                    else if ($month == 10)
                        $m = 'October';
                    else if ($month == 11)
                        $m = 'November';
                    else if ($month == 12)
                        $m = 'December';
                    echo get_phrase('attendance_sheet');
                    ?>
            </h3>
            <h4 style="color: #696969;">
                <?php echo get_phrase('class') . ' ' . $class_name; ?> :
                <?php echo get_phrase('section');?>
                <?php echo $section_name; ?>
                <br>
                <?php echo $group_id!==''?'Group: '.ucwords($this->db->get_where('group',array('group_id'=>$group_id))->row()->name).'<br>':'';?>
                <?php echo $m;?>
            </h4>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>


<hr />

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="my_table">
            <thead>
                <tr>
                    <td style="text-align: center;">
                        <?php echo get_phrase('students'); ?>
                        <i class="entypo-down-thin"></i> |
                        <?php echo get_phrase('date'); ?>
                        <i class="entypo-right-thin"></i>
                    </td>
                    <?php
    $year = explode('-', $running_year);
    $days = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
   
    for ($i = 1; $i <= $days; $i++) {
        ?>
                        <td style="text-align: center;">
                            <?php echo $i; ?>
                        </td>
                        <?php } ?>

                </tr>
            </thead>

            <tbody>
                <?php
                            $data = array();

                            $students = $this->db->get_where('enroll', array('class_id' => $class_id,'shift_id' => $shift_id,'group_id'=>$group_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
                            foreach ($students as $row):
                                ?>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                        </td>
                        <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . date('Y'));
                                $this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('attendance', array('section_id' => $section_id,'group_id'=>$group_id ,'class_id' => $class_id,'shift_id' => $shift_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();
                                

                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);
                                   
                                    if ($i == $month_dummy)
                                    $status = $row1['status'];
                                   
                                   
                                endforeach;
                                ?>
                            <td style="text-align: center;">
                                <?php if ($status == 1) { ?>
                                <i class="entypo-record" style="color: #00a651;"></i>
                                <?php  } if($status == 2)  { ?>
                                <i class="entypo-record" style="color: #ee4749;"></i>
                                <?php  } if($status == 3)  { ?>
                                <i class="entypo-record" style="color: #ff9933;"></i>
                                <?php  } $status =0;?>


                            </td>

                            <?php } ?>
                            <?php endforeach; ?>

                    </tr>

                    <?php ?>

            </tbody>
        </table>
        <center>
            <a href="<?php echo base_url(); ?>index.php?teacher/attendance_report_print_view/<?php echo $class_id; ?>/<?php echo $shift_id; ?>/<?php echo $section_id; ?>/<?php echo $month; ?>/<?php echo $group_id; ?>"
                class="btn btn-primary" target="_blank">
                <?php echo get_phrase('print_attendance_sheet'); ?>
            </a>
        </center>
    </div>
</div>
<?php endif; ?>

