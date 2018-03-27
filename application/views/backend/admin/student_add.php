<style>
span.mendatory {
    color: red !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('addmission_form'); ?>
                </div>
            </div>
            <div class="panel-body">

    
                <form id="addStudentInfo" action="<?php echo base_url() .'index.php?admin/ajax_student_create'; ?>" class="form-horizontal form-groups-bordered validate" method="post" enctype='multipart/form-data'>   

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('name'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" id="focusField" class="form-control" name="name" data-validation="required" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('name_bangla'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control bangla" name="namebn" data-validation="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('father_name'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="fname" data-validation="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('father_name_bangla'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control bangla" name="fnamebn" data-validation="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('mother_name'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="mname" data-validation="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('mother_name_bangla'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control bangla" name="mnamebn" data-validation="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('father_anual_income'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="faincome">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('permanent_address'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="paadress" data-validation="required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('present_address'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="praddress" data-validation="required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('legal_guardian_name'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="lguaridan" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('relation_with_guardian'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="relaguardian" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('Religion'); ?>
                        </label>

                        <div class="col-sm-8">
                            <select class="form-control" name="religion">
                                <option>Islam</option>
                                <option>Hindu</option>
                                <option>Chirstian</option>
                                <option>Buddhist</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('nationality'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nationality" value="Bangladeshi" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('previous_school_name'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="preschoolname" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('previous_school_address'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="preschooladd"/>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">
                            <?php echo get_phrase('birthday'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control datepicker" name="birthday" data-start-view="2"  data-validation="required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">
                            <?php echo get_phrase('gender'); ?>
                        </label>

                        <div class="col-sm-8">
                            <select name="sex" class="form-control">
                                <option value="">
                                    <?php echo get_phrase('select'); ?>
                                </option>
                                <option value="male" selected="selected">
                                    <?php echo get_phrase('male'); ?>
                                </option>
                                <option value="female">
                                    <?php echo get_phrase('female'); ?>
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('email'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('guardian_mobile_no'); ?> 
                            <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="mobile" data-validation="required number length" data-validation-length="min11" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('last_studied_class'); ?>
                        </label>

                        <div class="col-sm-8">

                            <select name="lastsclass" class="form-control">
                                <option value="">
                                    <?php echo get_phrase('select'); ?>
                                </option>
                                <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                ?>
                                    <option value="<?php echo strtolower($row['name']); ?>">
                                        <?php echo $row['name']; ?>
                                    </option>
                                    <?php
                            endforeach;
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('if_your_brother/_sister_reading_this_school_write_name'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="siblingname" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('brother/_sister_info'); ?>
                        </label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="siblinginfo[]" placeholder="Class">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="siblinginfo[]" placeholder="Roll">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="siblinginfo[]" placeholder="Shift">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="siblinginfo[]" placeholder="Group">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('want_to_admit_class'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <select name="class_id" class="form-control" id="class_id" onchange="return get_class_sections(this.value)" data-validation="required">
                                <option value="">
                                    <?php echo get_phrase('select'); ?>
                                </option>
                                <?php
                            $classes = $this->db->get('class')->result_array();
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

                    <div class="form-group groupHolder">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('group'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <select class="form-control groupSection" name="group_id" id="group_selector_holder">
                                <option value="">
                                    <?php echo get_phrase('select_group'); ?>
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group sectionHolder">
                        <label for="field-2" class="col-sm-3 control-label">
                            <?php echo get_phrase('section'); ?> <span class="mendatory">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="section_id" class="form-control" id="section_selector_holder" data-validation="required">
                                <option value="">
                                    <?php echo get_phrase('select_section'); ?>
                                </option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">
                            <?php echo get_phrase('shift'); ?> <span class="mendatory">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="shift_id" class="form-control" id="shift_selector_holder" data-validation="required">
                                <option value="">
                                    <?php echo get_phrase('select_shift'); ?>
                                </option>
                                <?php $shiftList = $this->db->get('shift')->result_array();
                                foreach($shiftList as $list):
                            ?>
                                <option value="<?php echo $list['shift_id'];?>">
                                    <?php echo $list['name'];?>
                                </option>
                                <?php endforeach;?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label">
                            <?php echo get_phrase('Roll'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-6">
                            <select name="roll" class="form-control" id="roll_selector_holder" data-validation="required">
                            </select>
                        </div>
                        <button type="button" class="btn btn-info" onclick="get_std_roll()">Find Roll</button>
                    </div>

                    <div class="form-group jscHolder">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('JSC/PEC_info'); ?>
                        </label>

                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="jscpecinfo[]" placeholder="Year" />
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="jscpecinfo[]" placeholder="Roll No." />
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="jscpecinfo[]" placeholder="Reg. No." />
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="jscpecinfo[]" placeholder="GPA" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('book_no.'); ?>
                        </label>

                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="book_no" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label">
                            <?php echo get_phrase('photo'); ?> <span class="mendatory">*</span>
                        </label>

                        <div class="col-sm-8">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="http://placehold.it/300x300" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="userfile" id="stdImage">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <input type="submit" value="Add Student" id="submit" class="btn btn-info">
                        </div>
                    </div>

                </div>



                <?php echo form_close(); ?>
            </div>
        </div>
    </div>




</div>

<script type="text/javascript">

    $("#focusField").focus();
    $('#addStudentInfo').ajaxForm({
        beforeSend: function() {                
                $('#loading').show();
                $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);

            if(!jData.type) {
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg);
                $('#addStudentInfo').resetForm();
                $("#focusField").focus();
            }
            $('body,html').animate({scrollTop:0},800);
            $('#loading').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');
        }
    }); 




    $('.jscHolder').hide();
    $('.sectionHolder').hide();
    $('.groupHolder').hide();


    function get_std_roll() {

        if (!$('#shift_selector_holder').val() || !$('#section_selector_holder').val() || !$('#class_id').val()) {

            alert('Please Select All Option Properly.');
        } else {

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    groupid: $('#group_selector_holder').val(),
                    shiftid: $('#shift_selector_holder').val(),
                    sectionid: $('#section_selector_holder').val(),
                    classid: $('#class_id').val()
                },
                beforeSend: function () {
                    //  alert("start");
                    $('#loading').show();
                    $('#overlayDiv').show();
                },
                url: '<?php echo base_url(); ?>index.php?admin/get_student_roll',
                success: function (response) {
                    $('#roll_selector_holder').empty();
                    $('#roll_selector_holder').append('<option value="">Available Rolls</option>');
                    jQuery.each(response, function (index, item) {
                        var div_data = "<option value=" + item + ">" + item + "</option>";
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
            url: '<?php echo base_url(); ?>index.php?admin/get_class_group/' + class_id,
            success: function (response) {
                if (response) {
                    if (response == 1) {
                        $('.jscHolder').show();
                        $('.groupHolder').hide();
                    } else {
                        $('.groupHolder').show();
                        $('.jscHolder').show();
                        jQuery('#group_selector_holder').html(response);
                    }
                } else {
                    $('.groupHolder').hide();
                    $('.jscHolder').hide();
                }
            }
        });

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
            success: function (response) {
                if (response) {
                    $('.sectionHolder').show();
                    jQuery('#section_selector_holder').html(response);
                } else {
                    $('.sectionHolder').hide();
                }
            }
        });

    }
</script>