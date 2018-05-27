<hr />
<div class="row">
    <div class="col-md-12">

        <div class="tabs-vertical-env">

            <ul class="nav tabs-vertical">
                <li class="active">
                    <a href="#v-home" data-toggle="tab">
                        Nihal IT SMS Setting
                    </a>
                </li>
                <li>
                    <a href="#v-sendsms" data-toggle="tab">
                        Nihal IT Send SMS
                    </a>
                </li>
            </ul>

            <div class="tab-content">


                <div class="tab-pane active" id="v-home">
                 
                    <form id="updateSmsSetting" action="<?php echo base_url() .'index.php?admin/ajax_save_sms_setting'; ?>" class="form-horizontal form-groups-bordered validate" method="post">
                    
                        <div class="form-group">
                            <label  class="col-sm-3 control-label"><?php echo get_phrase('nihalit_username'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="sms_user" value="<?php echo $user;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 control-label"><?php echo get_phrase('nihalit_password'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="sms_password" value="<?php echo $pass;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('save'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="v-sendsms">
                    <form id="sendCustomSMS" action="<?php echo base_url() .'index.php?admin/ajax_send_custom_sms'; ?>" class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label  class="col-sm-3 control-label"><?php echo get_phrase('SMS Language'); ?></label>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="sms_lng" value="english" checked>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;English
                              </label>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="sms_lng" value="bangla">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bangla
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 control-label"><?php echo get_phrase('SMS Title'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="sms_title" name="sms_title" value="">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label  class="col-sm-3 control-label"><?php echo get_phrase('SMS Phone Number'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="sms_number" name="sms_number" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 control-label"><?php echo get_phrase('SMS Description'); ?></label>
                            <div class="col-sm-5">
                                <textarea name="sms_description" id="sms_description" class="form-control textarea" rows="15"></textarea>
                            </div>
                            <div id="textarea_feedback"></div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('save'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>	

    </div>
</div>

<script src="assets/js/jquery.word-and-character-counter.min.js"></script>
<script>
$(document).ready(function() {

    $("#sms_description").counter({
        count: 'down',
        goal: 160
	});
	$("#sms_title").counter({
	   count: 'down',
	   goal: 11
	});
	$("#sms_number").counter({
	   count: 'down',
	   goal: 11
	});
    

    // update sms setting    
    $('#updateSmsSetting').ajaxForm({ 
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

    // send custom sms

    $('#sendCustomSMS').ajaxForm({ 
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
                $('#sendCustomSMS').resetForm();   
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 


});
</script>