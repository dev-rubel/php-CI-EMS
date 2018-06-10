<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">

            <li class="active">
                <a href="#generalSetting" data-toggle="tab">
                    <i class="entypo-plus"></i>
                    <?php echo get_phrase('general_setting');?>
                </a>
            </li>
            <li>
                <a href="#infoSetting" data-toggle="tab">
                    <i class="entypo-plus"></i>
                    <?php echo get_phrase('information_setting');?>
                </a>
            </li>
            <?php if($_SESSION['name']=='NihalIT'): ?>
            <li>
                <a href="#iconSetting" data-toggle="tab">
                    <i class="entypo-plus"></i>
                    <?php echo get_phrase('icon_setting');?>
                </a>
            </li>
            <li>
                <a href="#colorSetting" data-toggle="tab">
                    <i class="entypo-plus"></i>
                    <?php echo get_phrase('color_setting');?>
                </a>
            </li>
            <li>
                <a href="#advanceSetting" data-toggle="tab">
                    <i class="entypo-plus"></i>
                    <?php echo get_phrase('advance_setting');?>
                </a>
            </li>
            <?php endif;?>
        </ul>
        <!------CONTROL TABS END------>

        <div class="tab-content">
            <br>
            <!----EDITING FORM STARTS---->
            <div class="tab-pane box active" id="generalSetting" style="padding: 5px">
                <div class="box-content">

                
      <form id="updateSystemGeneralInfo" action="<?php echo base_url() .'index.php?admin/ajax_update_system_generalInfo'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   


                    <div class="panel panel-primary" id="SystemGeneralInfoHolder">

                        <div class="panel-heading">
                            <div class="panel-title">
                                <?php echo get_phrase('system_settings');?>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('system_name');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="system_name" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('system_title_english');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="system_title_english" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title_english'))->row()->description;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('system_title');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="system_title" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('address');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address" value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('phone');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="phone" value="<?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('currency');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="currency" value="<?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('system_email');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="system_email" value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('running_session');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="running_year" class="form-control">
                                            <?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;?>
                                            <option value="">
                                                <?php echo get_phrase('select_running_session');?>
                                            </option>
                                            <?php for($i = 0; $i < 10; $i++):?>
                                            <option value="<?php echo (2016+$i).'-'.(2016+$i+1);?>" <?php if($running_year==( 2016+$i). '-'.(2016+$i+1)) echo
                                                'selected';?>>
                                                <?php echo substr((2016+$i).'-'.(2016+$i+1), 0, -5);?>
                                            </option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('language');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="language" class="form-control">
                                            <?php
									$fields = $this->db->list_fields('language');
									foreach ($fields as $field)
									{
										
											if ($field == 'phrase_id' || $field == 'phrase')continue;
										if($field=='english' || $field=='bengali'){
										$current_default_language	=	$this->db->get_where('settings' , array('type'=>'language'))->row()->description;
										?>
                                                <option value="<?php echo $field;?>" <?php if ($current_default_language==$field)echo 'selected';?>>
                                                    <?php echo $field;?> </option>
                                                <?php
										}
										
									}
									?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('text_align');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="text_align" class="form-control">
                                            <?php $text_align	=	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;?>
                                            <option value="left-to-right" <?php if ($text_align=='left-to-right' )echo 'selected';?>> left-to-right</option>
                                            <option value="right-to-left" <?php if ($text_align=='right-to-left' )echo 'selected';?>> right-to-left</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-info">
                                            <?php echo get_phrase('save');?>
                                        </button>
                                    </div>
                                </div>

                            </div>



                            <?php echo form_close();?>

                        </div>

                    </div>
                    <!-- End Form -->

                </div>
            </div>
            <!-- End General Section -->
            <!-- EDITING FORM ENDS -->

            <!----EDITING FORM STARTS---->
            <div class="tab-pane box" id="infoSetting" style="padding: 5px">
                <div class="box-content">

            <form id="updateSchoolGeneralInfo" action="<?php echo base_url() .'index.php?admin/ajax_upload_school_info'; ?>" class="form-horizontal form-groups-bordered validate" method="post" enctype="multipart/form-data">  

                    <div class="panel panel-primary" id="SchoolGeneralInfoHolder">

                        <div class="panel-heading">
                            <div class="panel-title">
                                <?php echo get_phrase('information_setting').' (English)';?>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php 
                  $schoolInfo = $this->db->get_where('settings' , array('type' =>'school_information'))->row()->description;
                  list($schoolName,$schoolAddress,$eiin,$email,$phone) = explode('+', $schoolInfo);
                  ?>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('school_name');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="school_name" value="<?php echo $schoolName;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('school_address');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="school_address" value="<?php echo $schoolAddress;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('EIIN');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="eiin" value="<?php echo $eiin;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('email');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('phone');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">



                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">
                                        <?php echo get_phrase('logo');?>
                                    </label>

                                    <div class="col-sm-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                                <img src="<?php echo base_url();?>uploads/school_logo.png" alt="..." id="SchoolLogo">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                                                <span class="btn btn-white btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="userfile" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-info">
                                            <?php echo get_phrase('update');?>
                                        </button>
                                    </div>
                                </div>
                            </div>





                        </div>

                    </div>

                    <?php echo form_close();?>

                </div>
            </div>
            <!-- End Info Settings -->
            <!-- EDITING FORM ENDS -->

            <?php if($_SESSION['name']=='NihalIT'): ?>
            <!----EDITING FORM STARTS---->
            <div class="tab-pane box" id="iconSetting" style="padding: 5px">
                <div class="box-content">
                    <div class="col-md-6">

         
<form id="updateFavicon" action="<?php echo base_url() .'index.php?admin/ajax_update_favicon'; ?>" class="form-horizontal form-groups-bordered validate" method="post" enctype="multipart/form-data">   

                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('upload_favicon');?>
                                </div>
                            </div>

                            <div class="panel-body">


                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">
                                        <?php echo get_phrase('photo');?>
                                    </label>

                                    <div class="col-sm-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                                <img src="<?php echo base_url();?>uploads/favicon.png" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                                                <span class="btn btn-white btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="userfile" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-info">
                                            <?php echo get_phrase('upload');?>
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- End Favicon Section -->

                        <?php echo form_close();?>
                    </div>
                    <div class="col-md-6">

                     
<form id="updateLogo" action="<?php echo base_url() .'index.php?admin/ajax_upload_logo'; ?>" class="form-horizontal form-groups-bordered validate" method="post" enctype="multipart/form-data">  

                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('upload_logo');?>
                                </div>
                            </div>

                            <div class="panel-body">


                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label">
                                        <?php echo get_phrase('photo');?>
                                    </label>

                                    <div class="col-sm-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                                <img src="<?php echo base_url();?>uploads/logo.png" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                            <div>
                                                <span class="btn btn-white btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="userfile" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-info">
                                            <?php echo get_phrase('upload');?>
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- End Logo Section -->

                        <?php echo form_close();?>
                    </div>




                </div>
            </div>
            <!-- EDITING FORM ENDS -->

            <!----EDITING FORM STARTS---->
            <div class="tab-pane box" id="colorSetting" style="padding: 5px">
                <div class="box-content">

                    <!-- SITE COLOR SECTION -->
                    
                    <div class="panel-primary" style="border: 1px solid; border-radius: 2px;">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('site_color'); ?>
                                </div>
                            </div>
                           
                            <form id="updateSiteColor" action="<?php echo base_url() .'index.php?admin/ajax_change_site_color'; ?>" method="post">   

                                <div class="panel-body text-center" id="siteColorHolder">      <?php
            $mainColor = $this->db->get_where('frontpages',['title'=>'main_color'])->row()->description;
            $hoverColor = $this->db->get_where('frontpages',['title'=>'hover_color'])->row()->description;
        ?>             

                                    <div class="form-group">
                                        <label for="field-1" class="col-md-3 control-label">Main Color</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control jscolor" name="main_color" value="<?php echo $mainColor; ?>" required="required">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label for="field-1" class="col-md-3 control-label">Hover Color</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control jscolor" name="hover_color" value="<?php echo $hoverColor; ?>" required="required">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <button type="submit" class="btn btn-info">
                                        <?php echo lng('Update');?>
                                    </button>                                             
                                </div>
                            </form>
                    </div>
                        <!-- End Color Section -->

                </div>
            </div>
            <!-- EDITING FORM ENDS -->

            <?php $all_tables = $this->db->list_tables();?>
            <!----EDITING FORM STARTS---->
            <div class="tab-pane box" id="advanceSetting" style="padding: 5px">
                <div class="box-content">

                    <div class="col-md-4">
                        <div class="panel-primary" style="border: 1px solid; border-radius: 2px;">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('Truncate Table'); ?>
                                </div>
                            </div>
                            <div class="panel-body">

                                <form id="truncateTableData" action="<?php echo base_url() .'index.php?admin/ajax_truncate_table_data'; ?>" method="post">   

                                    <div class="col-md-8">
                                        <select name="truncate_table" class="form-control">
                                            <option value="">Select Table</option>
                                            <?php foreach($all_tables as $each):?>
                                            <option value="<?php echo $each; ?>">
                                                <?php echo ucwords(str_replace('_', ' ',$each)); ?>
                                            </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-info btn-sm">Truncate Table</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <!-- End Truncate Table -->
                        <br/>

                    </div>
                    <div class="col-md-4">
                        <div class="panel-primary" style="border: 1px solid; border-radius: 2px;">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('site_status'); ?>
                                </div>
                            </div>
                            <form id="updateSiteStatus" action="<?php echo base_url() .'index.php?admin/ajax_update_site_status'; ?>" method="post"> 

                            <div class="panel-body" id="updateSiteStatusHolder">
                                <?php $siteStatus = $this->db->get_where('settings',array('type'=>'webAppStatus'))->row()->description;?>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control datepicker" name="siteStatusTime" data-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', strtotime(date('d-m-Y'). ' + 2 days'));?>"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <input type="checkbox" name="status" id="statusToggle" data-toggle="toggle" <?php echo $siteStatus==1? 'checked': ''?>/>
                                        <button type="submit" class="btn btn-info btn-xs">
                                            <?php echo lng('Update');?>
                                        </button>
                                    </div>                                
                            </div>
                            </form>
                        </div>
                        <!-- End Site Status Section -->
                        <br>

                    </div>
                    <div class="col-md-4">

                        <div class="panel-primary" style="border: 1px solid; border-radius: 2px;">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('header_image_change'); ?>
                                </div>
                            </div>
                            <div class="panel-body text-center">
                                
                                <form id="updateHeaderImage" action="<?php echo base_url() .'index.php?homemanage/ajax_update_header_image'; ?>" method="post" enctype="multipart/form-data"> 

                                    <input type="file" class="form-control-file" name="header_img">
                                    <button type="submit" class="btn btn-info">
                                        <?php echo lng('Update');?>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- End Header Image Section -->
                        <br>
                    </div>






                </div>
            </div>
            <!-- EDITING FORM ENDS -->
            <?php endif;?>

        </div>

    </div>
</div>

<script>
// General Setting Update

$(document).ready(function() { 

    $('#updateSystemGeneralInfo').ajaxForm({ 
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
                $( "#SystemGeneralInfoHolder" ).html( jData.html );
                               
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 


// School Setting Update

    $('#updateSchoolGeneralInfo').ajaxForm({ 
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
                $( "#SchoolGeneralInfoHolder" ).html( jData.html );
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 

// Update Logo

    $('#updateLogo').ajaxForm({ 
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
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 

// Update Favicon

    $('#updateFavicon').ajaxForm({ 
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
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 

// Update Site Color

    $('#updateSiteColor').ajaxForm({ 
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
                $( "#siteColorHolder" ).html( jData.html );
                jscolor.installByClassName("jscolor");
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 

// Truncate Table Data

    $('#truncateTableData').ajaxForm({ 
        beforeSend: function() {
            $('#loading2').show();
            $('#overlayDiv').show();   
            return confirm("Are you sure?");                        
        },  
        success: function (data){
            var jData = JSON.parse(data);  

            if(!jData.type) {    
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg);  
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 

// Update Site Status

    $('#updateSiteStatus').ajaxForm({ 
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
                $( "#updateSiteStatusHolder" ).html( jData.html );
                jscolor.installByClassName("jscolor");
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 

// Update Site Header Image

    $('#updateHeaderImage').ajaxForm({ 
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
                $('#updateHeaderImage').resetForm();
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 


});

</script>