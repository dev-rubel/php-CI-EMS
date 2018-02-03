<div class="row">

<div id="overlayDiv" style="width: 99%;height: 100%;background-color: white;position: absolute;top: 0;z-index: 11; opacity: .7;"></div>
<img src="<?php echo base_url();?>assets/backend/loader.gif" id="loading" style="position: absolute; top: 70%; left: 40%; z-index: 1111;"/>  

    <div class="col-md-8">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('set_new_student_information'); ?>
                </div>
            </div>
            <div class="panel-body">
            
                
        <form action="<?php echo base('admin', 'update_new_promotion_std_info/').$student_id;?>" method="post" class="form-horizontal form-groups-bordered validate">

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('want_to_admit_class'); ?></label>

                    <div class="col-sm-6">
                        <select name="class_id" class="form-control" data-validate="required" id="class_id" readonly>
                            <?php
                            $classes = $this->db->get_where('class',['class_id' => $class_id])->result_array();
                            foreach ($classes as $row):
                                ?>
                                <option value="<?php echo $row['class_id']; ?>">
                                    <?php echo $row['name']; ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>

                <?php $groups = $this->db->get_where('group', ['class_id'=>$class_id])->result_array();?>
                <?php if(!empty($groups)):?>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('group'); ?></label>

                    <div class="col-sm-6">
                        <select class="form-control groupSection" name="group_id">
                            <?php
                                foreach ($groups as $group):                                   
                            ?>
                            <option value="<?php echo $group['group_id'];?>"><?php echo $group['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <?php endif;?>


                <?php $sections = $this->db->get_where('section', ['class_id'=>$class_id])->result_array();?>
                <?php if(!empty($sections)):?>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section'); ?></label>
                    <div class="col-sm-6">
                        <select name="section_id" class="form-control" id="section_selector_holder">
                        <?php
                                foreach ($sections as $section):                                   
                            ?>
                            <option value="<?php echo $section['section_id'];?>"><?php echo $section['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <?php endif;?>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('shift'); ?></label>
                    <div class="col-sm-6">
                        <select name="shift_id" class="form-control" id="shift_selector_holder">
                            <option value=""><?php echo get_phrase('select_shift'); ?></option>
                            <?php $shiftList = $this->db->get('shift')->result_array();
                                foreach($shiftList as $list):
                            ?>
                            <option value="<?php echo $list['shift_id'];?>"><?php echo $list['name'];?></option>
                            <?php endforeach;?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Roll'); ?></label>

                    <div class="col-sm-6">
                        <select name="roll" class="form-control" id="roll_selector_holder">
                        </select>
                    </div> 
                    <button type="button" class="btn btn-info" onclick="get_std_roll()">Find Roll</button>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                    <input type="submit" value="Add Student" id="submit" class="btn btn-info">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    

</div>

<script type="text/javascript">
$('.jscHolder').hide();
    $('.sectionHolder').hide();
    $('.groupHolder').hide();
    $('#loading').hide();
    $('#overlayDiv').hide();


function get_std_roll(){

    if(!$('#shift_selector_holder').val() || !$('#section_selector_holder').val() || !$('#class_id').val()){

            alert('Please Select All Option Properly.');
    }else{

            $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                groupid : $('#group_selector_holder').val(),
                shiftid : $('#shift_selector_holder').val(),
                sectionid : $('#section_selector_holder').val(),
                classid : $('#class_id').val()
            },
            beforeSend: function() { 
            //  alert("start");
                    $('#loading').show();
                    $('#overlayDiv').show();
            },  
            url: '<?php echo base_url(); ?>index.php?teacher/get_student_roll',
            success: function (response)
            {   
                $('#roll_selector_holder').empty();
                $('#roll_selector_holder').append('<option value="">Available Rolls</option>');
                jQuery.each(response, function(index, item) {
                    var div_data="<option value="+item+">"+item+"</option>";
                    $(div_data).appendTo('#roll_selector_holder'); 
                });
                $('#loading').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }

}
        
    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?teacher/get_class_group/' + class_id,
            success: function (response)
            {   
                if(response){
                    if(response==1){
                        $('.jscHolder').show();  
                        $('.groupHolder').hide();  
                    }else{
                        $('.groupHolder').show();
                        $('.jscHolder').show();
                        console.log(response);
                        jQuery('#group_selector_holder').html(response);                      
                    }  
                }else{
                    $('.groupHolder').hide();
                    $('.jscHolder').hide();
                }
            }
        });

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?teacher/get_class_section/' + class_id,
            success: function (response)
            {
                if(response){
                    $('.sectionHolder').show();
                    jQuery('#section_selector_holder').html(response);                
                }else{
                    $('.sectionHolder').hide();
                }
            }
        });

    }

</script>