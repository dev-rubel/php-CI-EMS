<form id="updateAttendanceSmsSetting" action="<?php echo base_url() .'index.php?admin/ajax_update_attendance_sms_setting'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('attendance_sms_setting');?>
                </div>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <?php echo get_phrase('attendance_sms_status');?>
                    </label>
                    <div class="col-sm-9">
                        <input type="checkbox" name="attendance_sms_status" id="toggleButton" data-toggle="toggle" <?php $status = $this->db->get_where('settings',['type'=>'attendance_sms_status'])->row()->description;  echo $status =='on'?'checked':''?>>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        <?php echo get_phrase('attendance_sms_description');?>
                    </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="attendance_sms_description" id="" cols="30" rows="10" required="required"><?php echo $this->db->get_where('settings',['type'=>'attendance_sms_description'])->row()->description; ?></textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 text-center">
                <button type="submit" class="btn btn-info">
                    <?php echo get_phrase('save_setting');?>
                </button>
            </div>
        </div>
    </div>
<?php echo form_close();?>

<script>
$('#updateAttendanceSmsSetting').ajaxForm({
    beforeSend: function() {
            $('#loading2').show();
            $('#overlayDiv').show();
    },
    success: function (data){
        var jData = JSON.parse(data);
        if(jData.type) {
            toastr.success(jData.msg);
        } else {
            toastr.error(jData.msg);                
        }   
        $('body,html').animate({scrollTop:0},800);
        $('#loading2').fadeOut('slow');
        $('#overlayDiv').fadeOut('slow');
    }
});
</script>