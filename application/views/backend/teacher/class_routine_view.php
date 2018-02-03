<hr />


<div class="row">
    <div class="col-md-12">
        <?php echo form_open(base_url() . 'index.php?admin/attendance_selector/');?>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">
                    <?php echo get_phrase('class');?>
                </label>
                <select id="class_id" name="class_id" class="form-control selectboxit" onchange="select_section(this.value)">
                    <option value="">
                        <?php echo get_phrase('select_class');?>
                    </option>
                    <?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
                                            
				?>

                        <option value="<?php echo $row['class_id'];?>">
                            <?php echo $row['name'];?>
                        </option>

                        <?php endforeach;?>
                </select>
            </div>
        </div>

        <div id="group_holder">
        </div>

        <div id="section_holder">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;">
                        <?php echo get_phrase('section');?>
                    </label>
                    <select id="section_id" class="form-control selectboxit" name="section_id">
                        <option value="">
                            <?php echo get_phrase('select_section_first') ?>
                        </option>

                    </select>
                </div>
            </div>
        </div>

        <div id="shift_holder">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" style="margin-bottom: 5px;">
                        <?php echo get_phrase('shift');?>
                    </label>
                    <select id="shift_id" class="form-control selectboxit" name="shift_id">
                        <option value="">
                            <?php echo get_phrase('select_shift_first') ?>
                        </option>
                        <?php $shifts = $this->db->get('shift')->result_array();
                            	foreach($shifts as $shift):
                            ?>
                        <option value="<?php echo $shift['shift_id'];?>">
                            <?php echo $shift['name'] ;?>
                        </option>
                        <?php endforeach;?>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2" style="margin-top: 20px;">
            <div class="form-group">
                <button class="btn btn-info" type="button" onclick="get_students_class_routine()">
                    <?php echo get_phrase('search_routine');?>
                </button>
            </div>
        </div>
        <?php echo form_close();?>

        <div class="col-md-2" style="margin-top: 20px;">
            <div class="form-group">
                <button class="btn btn-primary" onclick="add_students_class_routine()">
                    <?php echo get_phrase('add_class_routine');?>
                </button>
            </div>
        </div>

    </div>
</div>


<div id="routine_holder"></div>

<script type="text/javascript">
    function get_students_class_routine() {
        var classID = $('#class_id').val();
        var sectionID = $('#section_id').val();
        var shiftID = $('#shift_id').val();
        var groupID = $('#group_id').val();
        if (groupID) {
            groupID = $('#group_id').val();
        } else {
            groupID = '';
        }
        if (classID == "" || sectionID == "" || shiftID == "") {
            toastr.error("<?php echo get_phrase('select_all_field_properly');?>")
            return false;
        }
        $.ajax({
            type: 'GET',
            url: "<?php echo base_url();?>index.php?teacher/ajaxClassRoutine/" + classID + "/" + sectionID + "/" +
                shiftID + "/" + groupID,
            beforeSend: function () {
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function (response) {
                toastr.success('Found');
                jQuery('#routine_holder').html(response);
                $('body,html').animate({
                    scrollTop: 270
                }, 800);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }

    function add_students_class_routine() {
        $.ajax({
            url: "<?php echo base_url();?>index.php?teacher/ajax_class_routine_add/",
            beforeSend: function () {
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function (response) {
                toastr.success('Success');
                jQuery('#routine_holder').html(response);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }

    $('#group_holder').hide();

    function select_section(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?teacher/get_group/' + class_id,
            success: function (response) {
                if (response) {
                    $('#group_holder').show();
                    jQuery('#group_holder').html(response);
                } else {
                    $('#group_holder').hide();
                }
            }
        });

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?teacher/get_section/' + class_id,
            success: function (response) {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>