<hr />

<?php if ($month != ''): ?>

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
                Teacher Attendance Report
                <br>                
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
                        <?php echo get_phrase('teacher'); ?>
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
                            $teachers = $this->db->get('teacher')->result_array();
                            foreach ($teachers as $row):
                                ?>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo $row['name'];; ?>
                        </td>
                        <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . date('Y'));
                                $this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('teacher_attendance', array('year' => $running_year, 'timestamp' => $timestamp, 'teacher_id' => $row['teacher_id']))->result_array();
                                

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
            <a href="<?php echo base_url(); ?>index.php?admin/teacher_attendance_report_print_view/<?php echo $month; ?>"
                class="btn btn-primary" target="_blank">
                <?php echo get_phrase('print_attendance_sheet'); ?>
            </a>
        </center>
    </div>
</div>
<?php endif; ?>

