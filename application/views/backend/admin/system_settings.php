<hr />

    <div class="row">
    <?php echo form_open(base_url() . 'index.php?admin/system_settings/do_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-6">
            
            <div class="panel panel-primary" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('system_settings');?>
                    </div>
                </div>
                
                <div class="panel-body">
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('system_name');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_name" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('system_title_english');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_title_english" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title_english'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('system_title');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_title" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="address" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="phone" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?>">
                      </div>
                  </div>
                    
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('currency');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="currency" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('system_email');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_email" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>">
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('running_session');?></label>
                      <div class="col-sm-9">
                          <select name="running_year" class="form-control selectboxit">
                          <?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;?>
                          <option value=""><?php echo get_phrase('select_running_session');?></option>
                          <?php for($i = 0; $i < 10; $i++):?>
                              <option value="<?php echo (2016+$i).'-'.(2016+$i+1);?>"
                                <?php if($running_year == (2016+$i).'-'.(2016+$i+1)) echo 'selected';?>>
                                  <?php echo substr((2016+$i).'-'.(2016+$i+1), 0, -5);?>
                              </option>
                          <?php endfor;?>
                          </select>
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('language');?></label>
                      <div class="col-sm-9">
                          <select name="language" class="form-control selectboxit">
                                <?php
									$fields = $this->db->list_fields('language');
									foreach ($fields as $field)
									{
										
											if ($field == 'phrase_id' || $field == 'phrase')continue;
										if($field=='english' || $field=='bengali'){
										$current_default_language	=	$this->db->get_where('settings' , array('type'=>'language'))->row()->description;
										?>
                                		<option value="<?php echo $field;?>"
                                        	<?php if ($current_default_language == $field)echo 'selected';?>> <?php echo $field;?> </option>
                                        <?php
										}
										
									}
									?>
                           </select>
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('text_align');?></label>
                      <div class="col-sm-9">
                          <select name="text_align" class="form-control selectboxit">
                          	  <?php $text_align	=	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;?>
                              <option value="left-to-right" <?php if ($text_align == 'left-to-right')echo 'selected';?>> left-to-right</option>
                              <option value="right-to-left" <?php if ($text_align == 'right-to-left')echo 'selected';?>> right-to-left</option>
                          </select>
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('save');?></button>
                    </div>
                  </div>
                    <?php echo form_close();?>
                    
                </div>
            
            </div>

            <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_favicon' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-primary" >
              
                  <div class="panel-heading">
                      <div class="panel-title">
                          <?php echo get_phrase('upload_favicon');?>
                      </div>
                  </div>
                  
                  <div class="panel-body">
                      
                    
                      <div class="form-group">
                          <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                          
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
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('upload');?></button>
                      </div>
                    </div>
                      
                  </div>
              
              </div>

            <?php echo form_close();?>

            <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_school_info' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-primary" >
              
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
                    
                  <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo get_phrase('school_name');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="school_name" 
                                value="<?php echo $schoolName;?>">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo get_phrase('school_address');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="school_address" 
                                value="<?php echo $schoolAddress;?>">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo get_phrase('EIIN');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="eiin" 
                                value="<?php echo $eiin;?>">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" 
                                value="<?php echo $email;?>">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label  class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" 
                                value="<?php echo $phone;?>">
                        </div>
                    </div>
                        
                        
                    <div class="form-group">
                          <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('logo');?></label>
                          
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/school_logo.png" alt="...">
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
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('update');?></button>
                      </div>
                    </div>
                      
                  </div>
              
              </div>

            <?php echo form_close();?>
			
			<!--<div class="panel panel-primary" data-collapsed="0">
            
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('update_product');?>
                </div>
            </div>

            
            <div class="panel-body form-horizontal form-groups-bordered">
                <?php echo form_open(base_url().'index.php?updater/update' , array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));?>
                
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>

                        <div class="col-sm-5">

                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <input type="submit" class="btn btn-info" value="<?php echo get_phrase('install_update'); ?>" />
                        </div>
                    </div>
                        
                <?php echo form_close(); ?>
            </div>

        </div>-->
        
        </div>

      <?php 
        $skin = $this->db->get_where('settings' , array(
          'type' => 'skin_colour'
        ))->row()->description;
      ?>
    
        <div class="col-md-6">
            
            <!--<div class="panel panel-primary" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('theme_settings');?>
                    </div>
                </div>
                
                <div class="panel-body">

                <div class="gallery-env">

                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="default">
                                    <img src="assets/images/skins/default.png"
                                    <?php if ($skin == 'default') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="default">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('default');?>
                                </a>
                            </header>
                        </article>
                    </div>

                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="black">
                                    <img src="assets/images/skins/black.png" 
                                      <?php if ($skin == 'black') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="black">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="blue">
                                    <img src="assets/images/skins/blue.png"
                                    <?php if ($skin == 'blue') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="blue">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="cafe">
                                    <img src="assets/images/skins/cafe.png"
                                    <?php if ($skin == 'cafe') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="cafe">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="green">
                                    <img src="assets/images/skins/green.png"
                                    <?php if ($skin == 'green') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="green">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="purple">
                                    <img src="assets/images/skins/purple.png"
                                    <?php if ($skin == 'purple') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="purple">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="red">
                                    <img src="assets/images/skins/red.png"
                                    <?php if ($skin == 'red') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="red">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="white">
                                    <img src="assets/images/skins/white.png"
                                    <?php if ($skin == 'white') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="white">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a href="#" id="yellow">
                                    <img src="assets/images/skins/yellow.png"
                                    <?php if ($skin == 'yellow') echo 'style="background-color: black; opacity: 0.3;"';?> />
                                </a>
                                <a href="#" class="album-options" id="yellow">
                                    <i class="entypo-check"></i>
                                    <?php echo get_phrase('select_theme');?>
                                </a>
                            </header>
                        </article>
                    </div>

                </div>
                <center>
                  <div class="label label-primary" style="font-size: 12px;">
                    <i class="entypo-check"></i> <?php echo get_phrase('select_a_theme_to_make_changes');?>
                  </div>
                </center>
                </div>
            
            </div>-->

            <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_logo' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-primary" >
              
                  <div class="panel-heading">
                      <div class="panel-title">
                          <?php echo get_phrase('upload_logo');?>
                      </div>
                  </div>
                  
                  <div class="panel-body">
                      
                    
                      <div class="form-group">
                          <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                          
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
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('upload');?></button>
                      </div>
                    </div>
                      
                  </div>
              
              </div>

            <?php echo form_close();?>
			
			<?php if($_SESSION['name']=='NihalIT'): $all_tables = $this->db->list_tables();?>
        <div class="panel-primary" style="border: 1px solid; border-radius: 2px;">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('Truncate Table'); ?>
                </div>
            </div>
            <div class="panel-body">
               
            <form action="<?php echo base('homemanage', 'truncate_table_data'); ?>" method="post" onsubmit="return confirm('Do you really want to submit the form?')">
            
                <div class="col-md-8">
                    <select name="truncate_table" class="form-control">
                        <option value="">Select Table</option>
                    <?php foreach($all_tables as $each):?>
                        <option value="<?php echo $each; ?>"><?php echo ucwords(str_replace('_', ' ',$each)); ?></option>
                    <?php endforeach;?>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info">Truncate Table</button>
                </div>

            </form>
            
            </div>
        </div><br/>
        
        <div class="panel-primary" style="border: 1px solid; border-radius: 2px;">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('site_status'); ?>
                </div>
            </div>
            <div class="panel-body">
        <?php $siteStatus = $this->db->get_where('settings',array('type'=>'webAppStatus'))->row()->description;?>
        <form action="<?php echo base('homemanage', 'updateSiteStatus');?>" method="post">

                <div class="col-md-6">
                    <input type="text" class="form-control datepicker" name="siteStatusTime" data-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', strtotime(date('d-m-Y'). ' + 2 days'));?>" />                    
                </div>
                
                <div class="col-md-6">
                <input type="checkbox" name="status" data-toggle="toggle"<?php echo $siteStatus==1?'checked':''?>/>
                    <button type="submit" class="btn btn-info"><?php echo lng('Update');?></button>     
                </div>
		       
		 </form>
            </div>
        </div>

        <br>

        <!-- HEADER IMAGE SECTION -->
        <div class="panel-primary" style="border: 1px solid; border-radius: 2px;">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('header_image_change'); ?>
                </div>
            </div>
            <div class="panel-body text-center">
              <form action="<?php echo base('homemanage', 'updateHeaderImg');?>" method="post" enctype="multipart/form-data">
                  
                  <input type="file" class="form-control-file" name="header_img">
                <button type="submit" class="btn btn-info"><?php echo lng('Update');?></button>
              </form>
            </div>
        </div>
        <br>

        <!-- SITE COLOR SECTION -->
        <?php
            $mainColor = $this->db->get_where('frontpages',['title'=>'main_color'])->row()->description;
            $hoverColor = $this->db->get_where('frontpages',['title'=>'hover_color'])->row()->description;
        ?>
        <div class="panel-primary" style="border: 1px solid; border-radius: 2px;">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('site_color'); ?>
                </div>
            </div>
            <div class="panel-body text-center">
              <form action="<?php echo base('homemanage', 'change_site_color');?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="field-1" class="col-md-3 control-label">Main Color</label>
                    <div class="col-md-8">
                        <input type="test" class="form-control jscolor" name="main_color" value="<?php echo $mainColor; ?>" required="required">
                    </div>                  
                </div>
                <br><br><br>
                <div class="form-group">
                    <label for="field-1" class="col-md-3 control-label">Hover Color</label>
                    <div class="col-md-8">
                        <input type="test" class="form-control jscolor" name="hover_color" value="<?php echo $hoverColor; ?>" required="required">
                    </div>                  
                </div>
                <br><br><br>
                <button type="submit" class="btn btn-info"><?php echo lng('Update');?></button>
              </form>
            </div>
        </div>
        <?php endif;?>
            
        
        </div>

    </div>

<script type="text/javascript">
    $(".gallery-env").on('click', 'a', function () {
        skin = this.id;
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/system_settings/change_skin/'+ skin,
            success: window.location = '<?php echo base_url();?>index.php?admin/system_settings/'
        });
});
</script>