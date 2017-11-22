<hr />
<?php


?>
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
                    <form class="form-horizontal form-groups-bordered validate" action="<?php echo base('admin', 'save_sms_setting');?>" method="post">
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
                    <form class="form-horizontal form-groups-bordered validate" action="<?php echo base('admin', 'send_custom_sms');?>" method="post">
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
                                <textarea name="sms_description" id="sms_description" class="form-control" rows="15"></textarea>
                            </div>
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