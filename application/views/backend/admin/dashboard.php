<?php
//	GET SMS REMAING INFO
$info = $this->db->query('SELECT * FROM `admit_std` WHERE DATE(`datetime`) = CURDATE()');
$confirm = $this->db->query('SELECT * FROM `admit_std` WHERE `status`=1');
$pandding = $this->db->query('SELECT * FROM `admit_std` WHERE `status`=0');

?>

<style>
.bg-sms{
	background-color: #9684A3;
    color: #fff;
}
.bg-today-app{
	background-color: #83D6DE;
    color: #fff;
}
.bg-confirm-app{
	background-color: #D1D6A9;
    color: #fff;
}
.bg-padding-app{
	background-color: #FEC606;
    color: #fff;
}
.search-box {
    height: 40px;
    border: 1px solid #f4f4f4;
}
.input-group-addon{
    background-color: #6BAFBD;
    color: #fff;
}
</style>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Search Student ID Wise</span>
            <input type="text" class="form-control search-box" id="studentSearch" placeholder="Search Student ID Wise">            
        </div>
    </div>
    <div class="col-md-12" id="searchStudentList"></div>
</div>

<br>
<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="panel-stat3 bg-danger">
            <h2 class="m-top-none" id="userCount"><?php echo $this->db->count_all_results('enroll'); ?></h2>
            <h5>Total students</h5>
            
            <div class="stat-icon">
                <i class="fa fa-graduation-cap fa-3x"></i>
            </div>
        </div>
    </div><!-- /.col -->
    <div class="col-sm-6 col-md-3">
        <div class="panel-stat3 bg-info">
            <h2 class="m-top-none" id="orderCount"><?php echo $this->db->count_all_results('teacher'); ?></h2>
            <h5>Total teachers</h5>
            
            <div class="stat-icon">
                <i class="fa fa-user fa-3x"></i>
            </div>
        </div>
    </div><!-- /.col -->
    <div class="col-sm-6 col-md-3">
        <div class="panel-stat3 bg-warning">
            <h2 class="m-top-none" id="orderCount"><?php echo $this->db->count_all_results('parent'); ?></h2>
            <h5>Total parents</h5>
            
            <div class="stat-icon">
                <i class="fa fa-users fa-3x"></i>
            </div>
        </div>
    </div><!-- /.col -->
    <div class="col-sm-6 col-md-3">
        <div class="panel-stat3 bg-confirm-app">
            <h2 class="m-top-none"><span id="serverloadCount">80</span>%</h2>
            <h5>Total present student today</h5>
            
            <div class="stat-icon">
                <i class="fa fa-bar-chart-o fa-3x"></i>
            </div>
        </div>
    </div><!-- /.col -->
    
    
</div>

<div class="row">
	<div class="col-sm-6 col-md-3">
        <div class="panel panel-stat3 bg-sms">
            <h2 class="m-top-none"><span id="serverloadCount"><?php echo floor($sms_info)/40; ?></span></h2>
            <h5>SMS Balance</h5>
            
            <div class="stat-icon">
                <i class="fa fa-telegram fa-3x"></i>
            </div>
        </div>
    </div><!-- /.col -->

    <?php 
        $this->db->where('type', 'link_status');
        $admission_status = $this->db->get('settings')->row()->description;
        if($admission_status):
     ?>
	<div class="col-sm-6 col-md-3">
        <div class="panel panel-stat3 bg-today-app">
            <h2 class="m-top-none"><span id="serverloadCount"><?php echo count($info->result_array())?></span></h2>
            <h5>Today Online Application</h5>
            
            <div class="stat-icon">
                <i class="fa fa-file-text fa-3x"></i>
            </div>
        </div>
    </div><!-- /.col -->

	<div class="col-sm-6 col-md-3">
        <div class="panel panel-stat3 bg-success">
            <h2 class="m-top-none"><span id="serverloadCount"><?php echo count($confirm->result_array())?></span></h2>
             <h5>Confim Application</h5>
            
            <div class="stat-icon">
                <i class="fa fa-check-square-o fa-3x"></i>
            </div>
        </div>
    </div><!-- /.col -->

	<div class="col-sm-6 col-md-3">
        <div class="panel panel-stat3 bg-padding-app">
            <h2 class="m-top-none"><span id="serverloadCount"><?php echo count($pandding->result_array())?></span></h2>
             <h5>Pendding Application</h5>
            
            <div class="stat-icon">
                <i class="fa fa-clock-o fa-3x"></i>
            </div>
        </div>
    </div><!-- /.col -->
    <?php endif; ?> 
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule'); ?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
	



</div>



<script>
    $(document).ready(function () {

        $("#studentSearch").keyup(function(){
            var str=  $("#studentSearch").val();
            if(str == "") {
                $( "#searchStudentList" ).html("");  
            }else {
                $.get( "<?php echo base_url();?>index.php?admin/ajaxStudentSearch/"+str, function( data ){
                    $( "#searchStudentList" ).html( data );  
                });
            }
        }); 

        var calendar = $('#notice_calendar');

        $('#notice_calendar').fullCalendar({
            header: {
                left: 'title',
                right: 'today prev,next'
            },
            //defaultView: 'basicWeek',

            editable: false,
            firstDay: 1,
            height: 530,
            droppable: false,
            events: [
<?php
$notices = $this->db->get('noticeboard')->result_array();
foreach ($notices as $row):
    ?>
                    {
                        title: "<?php echo $row['notice_title']; ?>",
                        start: new Date(<?php echo date('Y', $row['create_timestamp']); ?>, <?php echo date('m', $row['create_timestamp']) - 1; ?>, <?php echo date('d', $row['create_timestamp']); ?>),
                        end: new Date(<?php echo date('Y', $row['create_timestamp']); ?>, <?php echo date('m', $row['create_timestamp']) - 1; ?>, <?php echo date('d', $row['create_timestamp']); ?>)
                    },
    <?php
endforeach
?>

            ]
        });
    });
</script>


