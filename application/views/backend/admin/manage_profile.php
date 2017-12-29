<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
                    <?php echo get_phrase('manage_profile');?>
                </a>
            </li>
            <?php if($_SESSION['name']=='NihalIT'):?>
    			<li>
                	<a href="#addac" data-toggle="tab"><i class="entypo-plus"></i> 
    					<?php echo get_phrase('add_account');?>
                	</a>
                </li>
    			<li>
                	<a href="#aclist" data-toggle="tab"><i class="entypo-list"></i> 
    					<?php echo get_phrase('accounts_list');?>
                	</a>
                </li>
            <?php endif;?>
            <li>
                <a href="#changePassword" data-toggle="tab"><i class="entypo-lock"></i> 
                    <?php echo get_phrase('change_password');?>
                </a>
            </li>
		</ul>
    	<!------CONTROL TABS END------>
        
	
		<div class="tab-content">
            <br>
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					
                        
                        <form id="updateAccount" action="<?php echo base_url() .'index.php?admin/ajax_update_profile'; ?>" class="form-horizontal form-groups-bordered validate" method="post" enctype="multipart/form-data">                            
                            
                            <div id="profile_info">

                            <?php foreach($edit_data as $row): ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                    
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                                <img src="<?php echo $this->crud_model->get_image_url('admin' , $row['admin_id']);?>" alt="...">
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
                                <?php endforeach; ?>

                            </div>

                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						
                </div>
			</div>
            <!-- EDITING FORM ENDS -->

    <?php if($_SESSION['name']=='NihalIT'):?>
    <div class="tab-pane box" id="addac" style="padding: 5px">
        <div class="box-content">
        <form id="addAccount" action="<?php echo base_url() .'index.php?admin/ajax_add_account'; ?>" class="form-horizontal form-groups-bordered validate" method="post" enctype="multipart/form-data">                            
                <div class="form-group">
                <div class="col-md-1"></div>
                    <label class="col-sm-1 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <label class="col-sm-1 control-label"><?php echo get_phrase('email');?></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="email" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                    
                    <div class="col-sm-5">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <img src="<?php echo $this->crud_model->get_image_url('admin' , $row['admin_id']);?>" alt="...">
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
                  <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-info"><?php echo get_phrase('add_account');?></button>
                  </div>
                    </div>
            </form>
        </div>
    </div>
    <?php endif;?>

    <?php if($_SESSION['name']=='NihalIT'):
        $list = $this->db->get('admin')->result_array();    
        
    ?>
    <div class="tab-pane box" id="aclist" style="padding: 5px">
        <div class="box-content">

        <table class="table table-bordered table_export">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Access</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($list as $k=>$each):?>
                <tr>
                    <td><?php echo $k+1;?></td>
                    <td><?php echo $each['name'];?></td>
                    <td><?php echo $each['email'];?></td>
                    <td><?php echo $each['level'];?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        </div>
    </div>
    <?php endif;?>

    
    <div class="tab-pane box" id="changePassword" style="padding: 5px">
        <div class="box-content">

        <?php 
                    foreach($edit_data as $row):
                        ?>
                        <form id="changePassword" action="<?php echo base_url() .'index.php?admin/ajax_change_password'; ?>" class="form-horizontal form-groups-bordered validate" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>

        </div>
    </div>
            
		</div>
	</div>

    



<br>


</div>

<script>
$(document).ready(function() { 
    /* Change Password */
    // toastr.options.positionClass = 'toast-bottom-right';

    $('#changePassword').ajaxForm({ 
        success: function (data){
            var jData = JSON.parse(data);
            if(!jData.type) {    
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg);
                $('#changePassword').clearForm();
            }                
        }
    }); 

    /* Add Account */
    $('#addAccount').ajaxForm({ 
        success: function (data){
            var jData = JSON.parse(data);
            if(!jData.type) {                    
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg);                
                $('#addAccount').resetForm();
            }                
        }
    }); 

    /* Update Account */
    $('#updateAccount').ajaxForm({ 
        success: function (data){
            
            toastr.success('Updated');    
            $( "#profile_info" ).html( data );  
                            
        }
    }); 
 

    
    
}); 

// $('#my-form').submit( function(e) {
//     e.preventDefault();

//     var data = new FormData(this); // <-- 'this' is your form element

//     $.ajax({
//             url: '/my_URL/',
//             data: data,
//             beforeSend: function() {                
//                 $('#loading2').show();
//                 $('#overlayDiv').show();
//             },  
//             cache: false,
//             contentType: false,
//             processData: false,
//             type: 'POST',     
//             success: function(data){
//                 toastr.error("<?php //echo get_phrase('select_class_for_promotion_to_and_from');?>");
//                 return false;
//             }, error: function (e) {
//                 $("#result").text(e.responseText);
//                 console.log("ERROR : ", e);
//                 $("#btnSubmit").prop("disabled", false);
//             }
//     });

</script>