<?php 
$current_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
$edit_data      =   $this->db->get_where('enroll' , array(
    'student_id' => $param2 , 'year' => $current_year))->result_array();

$nClass_id	=	$this->db->get_where('enroll' , array(
    'student_id' => $param2 , 'year' => $current_year))->row()->class_id;
$nClass_numaric = $this->db->get_where('class', array('class_id'=>$nClass_id))->row()->name_numeric;

// available roll numbers //
$this->db->where('class_id',$edit_data[0]['class_id']);
$this->db->where('section_id',$edit_data[0]['section_id']);
$this->db->where('shift_id',$edit_data[0]['shift_id']);
if($edit_data[0]['group_id']){
    $this->db->where('group_id',$edit_data[0]['group_id']);
}
$this->db->where('year',$current_year);
$result = $this->db->get('enroll')->result_array();
$databaseRoll = array_column($result,'roll');
$oneTohundred = range(1,300);
foreach($oneTohundred as $k=>$list){
    foreach($databaseRoll as $list2){
        if($list==$list2){
            unset($oneTohundred[$k]);
        }
    }
}
// end available roll numbers //
foreach ($edit_data as $row):
	$stdInfo = $this->db->get_where('student' , array('student_id' => $row['student_id']))->result_array();
	extract($stdInfo[0]);
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/student/do_update/'.$row['student_id'].'/'.$row['class_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-7">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="...">
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
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('change_roll_to'); ?></label>

                    <div class="col-sm-7">
                        <select name="change_roll" class="form-control">
                        <option value="noChange">Current Roll: <?php echo '<b>'.$edit_data[0]['roll'].'</b>';  ?></option>
                        <?php foreach($oneTohundred as $rollKey=>$eachRoll): ?>
                            <option value="<?php echo $eachRoll; ?>"><?php echo $eachRoll; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
	
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="name" value="<?php echo $name;?>" data-validation="custom" data-validation-regexp="^([A-Za-z. ]+)$">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name_bangla'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="namebn" value="<?php echo $namebn;?>" data-validation="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_name'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="fname" value="<?php echo $fname;?>" data-validation="custom" data-validation-regexp="^([A-Za-z. ]+)$">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_name_bangla'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="fnamebn" value="<?php echo $fnamebn;?>" data-validation="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_name'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="mname" value="<?php echo $mname;?>" data-validation="custom" data-validation-regexp="^([A-Za-z. ]+)$">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('mother_name_bangla'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="mnamebn" value="<?php echo $mnamebn;?>" data-validation="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('father_anual_income'); ?></label>

                    <div class="col-sm-7">
                        <input type="number" class="form-control" name="faincome" value="<?php echo $faincome;?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('permanent_address'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="paadress" value="<?php echo $paadress;?>" data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('present_address'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="praddress" value="<?php echo $praddress;?>" data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('legal_guardian_name'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="lguaridan" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $lguaridan;?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('relation_with_guardian'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="relaguardian" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $relaguardian;?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Religion'); ?></label>

                    <div class="col-sm-7">
                        <select class="form-control" name="religion">
                            <option <?php echo selected($religion,'Islam');?>>Islam</option>
                            <option <?php echo selected($religion,'Hindu');?>>Hindu</option>
                            <option <?php echo selected($religion,'Chirstian');?>>Chirstian</option>
                            <option <?php echo selected($religion,'Buddhist');?>>Buddhist</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('nationality'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="nationality" value="Bangladeshi"  readonly="readonly">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('previous_school_name'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="preschoolname" value="<?php echo $preschoolname;?>" data-validation="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('previous_school_address'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="preschooladd" value="<?php echo $preschooladd;?>" data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                    </div>
                </div>


                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control datepicker" name="birthday" value="<?php echo $birthday;?>" data-start-view="2" required="required">
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender'); ?></label>

                    <div class="col-sm-7">
                        <select name="sex" class="form-control">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <option value="male" <?php echo selected($sex,'male');?>><?php echo get_phrase('male'); ?></option>
                            <option value="female" <?php echo selected($sex,'female');?>><?php echo get_phrase('female'); ?></option>
                        </select>
                    </div> 
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" value="<?php echo $email;?>" name="email" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="password" value="<?php echo $password;?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('guardian_mobile_no'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="mobile" value="<?php echo $mobile;?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('last_studied_class'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="lastsclass" value="<?php echo $lastsclass;?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('if_your_brother/_sister_reading_this_school_write_name'); ?></label>

                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="siblingname" value="<?php echo $siblingname;?>">
                    </div>
                </div>

                <div class="form-group">
                <?php $siblinginfo = explode('|', $siblinginfo); ?>
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('brother/_sister_info'); ?></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="siblinginfo[]" value="<?php echo $siblinginfo[0];?>" placeholder="Class">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="siblinginfo[]" value="<?php echo $siblinginfo[1];?>" placeholder="Roll">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="siblinginfo[]" value="<?php echo $siblinginfo[2];?>" placeholder="Shift">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="siblinginfo[]" value="<?php echo $siblinginfo[3];?>" placeholder="Group">
                    </div>
                </div>

                <?php if($nClass_numaric==6 || $nClass_numaric==9): 
                        $jscpecinfo = explode(',', $jscpecinfo);
                    ?>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('JSC/PEC_info'); ?></label>

                    <div class="col-sm-2">
                       <input type="text" class="form-control" name="jscpecinfo[]" value="<?php echo $jscpecinfo[0];?>" placeholder="Year" data-validation="required"/> 
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="jscpecinfo[]" value="<?php echo $jscpecinfo[1];?>" placeholder="Roll No." data-validation="required"/>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="jscpecinfo[]" value="<?php echo $jscpecinfo[2];?>" placeholder="Reg. No." data-validation="required"/>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="jscpecinfo[]" value="<?php echo $jscpecinfo[3];?>" placeholder="GPA" data-validation="required"/>  
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('book_no'); ?></label>

                    <div class="col-sm-7">
                        <input type="number" class="form-control" name="book_no" value="<?php echo $this->db->get_where('enroll', array('student_id'=>$student_id))->row()->book_no; ?>">
                    </div>
                </div>

					<!-- <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>
                        
						<div class="col-sm-7">
							<select name="parent_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$parents = $this->db->get('parent')->result_array();
									foreach($parents as $row3):
										?>
                                		<option value="<?php echo $row3['parent_id'];?>"
                                        	<?php if($row3['parent_id'] == $parent_id)echo 'selected';?>>
													<?php echo $row3['name'];?>
                                                </option>
	                                <?php
									endforeach;
								  ?>
                          </select>
						</div> 
					</div> -->

					
					
					

					<!-- <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('dormitory');?></label>
                        
						<div class="col-sm-7">
							<select name="dormitory_id" class="form-control">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$dorm_id = $dormitory_id;
	                              	$dormitories = $this->db->get('dormitory')->result_array();
	                              	foreach($dormitories as $row2):
	                              ?>
                              		<option value="<?php echo $row2['dormitory_id'];?>"
                              			<?php if($dorm_id == $row2['dormitory_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('transport_route');?></label>
                        
						<div class="col-sm-7">
							<select name="transport_id" class="form-control">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php
	                              	$trans_id = $transport_id; 
	                              	$transports = $this->db->get('transport')->result_array();
	                              	foreach($transports as $row2):
	                              ?>
                              		<option value="<?php echo $row2['transport_id'];?>"
                              			<?php if($trans_id == $row2['transport_id']) echo 'selected';?>><?php echo $row2['route_name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div> -->
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-7">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_student');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>


<?php
endforeach;
?>
