<hr />
<style>
    .custom-control-description {
        display: block;
    }

    input.form-control {
        border: 1px solid lightslategray;
    }
    .panel {
        margin: 5px 0px;
    }
</style>




<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#tution" data-toggle="tab">
                    <span class="hidden-xs">
                        <?php echo get_phrase('pendding_tution');?>
                    </span>
                </a>
            </li>
            <li>
                <a href="#sms_setting" data-toggle="tab">
                    <span class="hidden-xs">
                        <?php echo get_phrase('sms_setting');?>
                    </span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <br>
            <div class="tab-pane active" id="tution">   


            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="panel panel-primary" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="entypo-plus-circled"></i>
                                <?php echo get_phrase('tution_pendding'); ?>
                            </div> 
                        </div>
                        <div class="panel-body">


                            <form id="searchPenddingFee" action="<?php echo base('a/accounting', 'search_pendding_fee');?>" method="post" class="form-horizontal form-groups-bordered validate">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">
                                        <?php echo get_phrase('class'); ?>
                                    </label>

                                    <div class="col-sm-6">
                                        <select name="class_id" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required'); ?>"
                                            onchange="return get_class_sections(this.value)">
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
                                                <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group groupHolder">
                                    <label for="field-1" class="col-sm-3 control-label">
                                        <?php echo get_phrase('group'); ?>
                                    </label>

                                    <div class="col-sm-6">
                                        <select class="form-control groupSection" name="group_id" id="group_selector_holder">
                                            <option value="">
                                                <?php echo get_phrase('select_group'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group sectionHolder">
                                    <label for="field-2" class="col-sm-3 control-label">
                                        <?php echo get_phrase('section'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <select name="section_id" class="form-control" id="section_selector_holder">
                                            <option value="">
                                                <?php echo get_phrase('select_section'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-2" class="col-sm-3 control-label">
                                        <?php echo get_phrase('shift'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <select name="shift_id" class="form-control" id="shift_selector_holder">
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
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <input type="submit" value="Search" id="submit" class="btn btn-info">
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

            </div>

            <div id="studentPenddingFeeHistory"></div>

                
            </div>
            <div class="tab-pane" id="sms_setting">

                <form id="updateTutionSmsSetting" action="<?php echo base_url() .'index.php?admin/ajax_tution_fee_sms_setting'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   

                <div class="col-md-offset-2 col-md-8">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('sms_setting');?>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('pendding_fee_sms_status');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="pendding_fee_sms_status" id="toggleButton" data-toggle="toggle" <?php echo $pendding_fee_setting[0]['description']==1?'checked':''?>>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('pendding_fee_sms_description');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="pendding_fee_sms_details" id="" cols="30" rows="10"><?php echo $pendding_fee_setting[1]['description']; ?></textarea>
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
            </div>

        </div>


    </div>
</div>

<script type="text/javascript">
    $('.jscHolder').hide();
    $('.sectionHolder').hide();
    $('.groupHolder').hide();

    $('#searchPenddingFee').ajaxForm({
        beforeSend: function() {
                $('#loading2').show();
                $('#overlayDiv').show();
        },
        success: function (data){
            var jData = JSON.parse(data);
            if(jData.type) {
                toastr.success(jData.msg);
                $('#studentPenddingFeeHistory').html(jData.html);
            } else {
                toastr.error(jData.msg);                
            }   
            $('body,html').animate({scrollTop:0},800);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');
        }
    });


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
                        console.log(response);
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