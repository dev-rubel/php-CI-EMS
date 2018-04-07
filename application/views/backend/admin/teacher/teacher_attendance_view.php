<div id="attendanceUpdate">
    <hr />
    <div class="row" style="text-align: center;">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-chart-area"></i></div>
                <h3 style="color: #696969;">Teacher Attendance</h3>
                <h4 style="color: #696969;">
                    <?php echo date("d M Y", $timestamp); ?>
                </h4>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>

    <center>
        <a class="btn btn-default" onclick="mark_all_present()">
            <i class="entypo-check"></i> <?php echo get_phrase('mark_all_present'); ?>
        </a>
        <a class="btn btn-default"  onclick="mark_all_absent()">
            <i class="entypo-cancel"></i> <?php echo get_phrase('mark_all_absent'); ?>
        </a>
    </center>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <!-- teacherAttendanceUpdate -->
            <form id="teacherAttendanceUpdate" action="<?php echo base_url() .'index.php?admin/teacher_attendance_update/'.$timestamp; ?>" class="form-horizontal form-groups-bordered" method="post">     
            <div id="attendance_update">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('name'); ?></th>
                            <th><?php echo get_phrase('status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select_id = 0;
                        $attendance_of_teacher = $this->db->get_where('teacher_attendance',[
                            'year' => $running_year,
                            'timestamp' => $timestamp
                        ])->result_array();                    
                        foreach ($attendance_of_teacher as $k=>$row):
                            ?>
                            <tr>
                                <td><?php echo $k+1; ?></td>
                                <td>
                                    <?php echo $this->db->get_where('teacher',['teacher_id'=>$row['teacher_id']])->row()->name; ; ?>
                                </td>
                                <td>
                                    <select class="form-control" name="status_<?php echo $row['attendance_id']; ?>" id="status_<?php echo $select_id; ?>">
                                        <option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>><?php echo get_phrase('undefined'); ?></option>
                                        <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>><?php echo get_phrase('present'); ?></option>
                                        <option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>><?php echo get_phrase('absent'); ?></option>
                                        <option value="3" <?php if ($row['status'] == 3) echo 'selected'; ?>><?php echo get_phrase('escaped'); ?></option>
                                    </select>	
                                </td>
                            </tr>
                        <?php $select_id++; endforeach; ?>
                    </tbody>
                </table>
            </div>

            <center>
                <button type="submit" class="btn btn-success" id="submit_button">
                    <i class="entypo-thumbs-up"></i> <?php echo get_phrase('save_changes'); ?>
                </button>
            </center>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script type="text/javascript">
        /* Update Attendance */
        $('#teacherAttendanceUpdate').ajaxForm({
            beforeSend: function() {
                $('#loading').show();
                $('#overlayDiv').show();
            },
            success: function (data){
                $( "#teacher_attendance_section_holder" ).html( data );
                $('body,html').animate({scrollTop:0},800);
                toastr.success('Attendance Updated');
                $('#loading').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        }); 
        function mark_all_present() {
            var count = <?php echo count($attendance_of_teacher); ?>;
            for(var i = 0; i < count; i++)
                $('#status_' + i).val("1");
        }
        function mark_all_absent() {
            var count = <?php echo count($attendance_of_teacher); ?>;
            for(var i = 0; i < count; i++)
                $('#status_' + i).val("2");
        }
    </script>
</div>