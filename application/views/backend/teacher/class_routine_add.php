<style>
    .panel{
        margin: 0px 0px !important;
    }
</style>
<hr />
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('teacher_routine_schedule');?>
                </div>
            </div>
            <div class="panel-body">
                <div id="teacher_routine_info"></div>
            </div>
        </div>        
    </div>
	<div class="col-md-8">
	
        <form id="addClassRoutine" action="<?php echo base_url() .'index.php?admin/ajax_add_class_routine'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('class');?></label>
                <div class="col-sm-9">
                    <select name="class_id" class="form-control" style="width:100%;"
                        onchange="return get_class_section_subject(this.value)">
                        <option value=""><?php echo get_phrase('select_class');?></option>
                        <?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('shift');?></label>
                <div class="col-sm-9">
                    <select name="shift_id" class="form-control" style="width:100%;">
                        <option value=""><?php echo get_phrase('select_shift');?></option>
                        <?php 
                        $shifts = $this->db->get('shift')->result_array();
                        foreach($shifts as $row):
                        ?>
                            <option value="<?php echo $row['shift_id'];?>"><?php echo $row['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('teacher');?></label>
                <div class="col-sm-9">
                    <select id="teacher_id" name="teacher_id" onchange="getTeacherRoutine(this)" class="form-control" style="width:100%;">
                        <option value=""><?php echo get_phrase('select_teacher');?></option>
                        <?php 
                        $teachers = $this->db->get('teacher')->result_array();
                        foreach($teachers as $row):
                        ?>
                            <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

            <div id="section_subject_selection_holder"></div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('day');?></label>
                <div class="col-sm-9">
                    <select name="day" class="form-control" style="width:100%;">
                        <option value="">Select Day</option>
                        <option value="sunday">sunday</option>
                        <option value="monday">monday</option>
                        <option value="tuesday">tuesday</option>
                        <option value="wednesday">wednesday</option>
                        <option value="thursday">thursday</option>
                        <option value="friday">friday</option>
                        <option value="saturday">saturday</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('starting_time');?></label>
                <div class="col-sm-9">
                    <div class="col-md-3">
                        <select name="time_start" class="form-control">
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_start_min" class="form-control">
                            <option value=""><?php echo get_phrase('minutes');?></option>
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="starting_ampm" class="form-control">
                            <option value="1">am</option>
                            <option value="2">pm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('ending_time');?></label>
                <div class="col-sm-9">
                    <div class="col-md-3">
                        <select name="time_end" class="form-control">
                            <option value=""><?php echo get_phrase('hour');?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_end_min" class="form-control">
                            <option value=""><?php echo get_phrase('minutes');?></option>  
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="ending_ampm" class="form-control">
                            <option value="1">am</option>
                            <option value="2">pm</option>
                        </select>
                    </div>
                </div>
            </div>
        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_class_routine');?></button>
              </div>
            </div>
    <?php echo form_close();?>

	</div>
</div>


<script type="text/javascript">


$(document).ready(function() { 
    /* Change Password */
    // toastr.options.positionClass = 'toast-bottom-right';

    $('#addClassRoutine').ajaxForm({ 
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);  

            if(!jData.type) {    
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg); 
                $('#addClassRoutine').resetForm();                              
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 


});

    function getTeacherRoutine(data)
    {
        if(data.value) {
            $.get( "<?php echo base_url();?>index.php?admin/ajaxTeacherRoutine/"+data.value, function( data ){
                $( "#teacher_routine_info" ).html( data );  
            });
        }
    }
   
    

    function get_class_section_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#section_subject_selection_holder').html(response);
            }
        });
    }
</script>