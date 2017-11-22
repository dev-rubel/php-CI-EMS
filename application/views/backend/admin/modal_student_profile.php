<?php
$student_info	=	$this->db->get_where('enroll' , array(
    'student_id' => $param2 , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
    ))->result_array();
//pd($student_info);
foreach($student_info as $row):
    $singleStudentInfo = $this->db->get_where('student' , array('student_id' => $param2))->result_array();
    extract($singleStudentInfo[0]);
    
    ?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" 
                	class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h3>
                                <?php echo $name;?>                     
                            </h3>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="">
            		<br>
                <table class="table table-bordered">
                    
                    <tr>
                        <td><?php echo get_phrase('name');?></td>
                        <td><b><?php echo $name;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('name_bangla');?></td>
                        <td><b><?php echo $namebn;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('father_name');?></td>
                        <td><b><?php echo $fname;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('father_name_bangla');?></td>
                        <td><b><?php echo $fnamebn;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('mother_name');?></td>
                        <td><b><?php echo $mname;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('mother_name_bangla');?></td>
                        <td><b><?php echo $mnamebn;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('present_address');?></td>
                        <td><b><?php echo $paadress;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('parmanent_address');?></td>
                        <td><b><?php echo $praddress;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('legal_guardian');?></td>
                        <td><b><?php echo $lguaridan;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('relation_with_guardian');?></td>
                        <td><b><?php echo $relaguardian;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('religion');?></td>
                        <td><b><?php echo $religion;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('father_anual_income');?></td>
                        <td><b><?php echo number_format($faincome);?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('nationality');?></td>
                        <td><b><?php echo $nationality;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('pervious_school_name');?></td>
                        <td><b><?php echo $preschoolname;?></b></td>
                    </tr>

                    <tr>
                        <td><?php echo get_phrase('pervious_school_address');?></td>
                        <td><b><?php echo $preschooladd;?></b></td>
                    </tr>

                    <?php if($row['class_id'] != ''):?>
                    <tr>
                        <td><?php echo get_phrase('class');?></td>
                        <td><b><?php echo $this->crud_model->get_class_name($row['class_id']);?></b></td>
                    </tr>
                    <?php endif;?>

                    <?php if($row['group_id'] !== 'NULL'):?>
                    <tr>
                        <td><?php echo get_phrase('group');?></td>
                        <td><b><?php echo ucfirst($this->db->get_where('group',array('group_id'=>$row['group_id']))->row()->name);?></b></td>
                    </tr>
                    <?php endif;?>

                    <?php if($row['section_id'] != '' && $row['section_id'] != 0):?>
                    <tr>
                        <td><?php echo get_phrase('section');?></td>
                        <td><b><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['roll'] != ''):?>
                    <tr>
                        <td><?php echo get_phrase('roll');?></td>
                        <td><b><?php echo $row['roll'];?></b></td>
                    </tr>
                    <?php endif;?>

                    <?php if($jscinfo != ''):?>
                    <tr>
                        <td><?php echo get_phrase('jsc_info');?></td>
                        <td><b><?php echo $jscinfo;?></b></td>
                    </tr>
                    <?php endif;?>

                    <tr>
                        <td><?php echo get_phrase('birthday');?></td>
                        <td><b><?php echo $birthday;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('gender');?></td>
                        <td><b><?php echo ucfirst($sex);?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('phone');?></td>
                        <td><b><?php echo $mobile;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('last_studied_class');?></td>
                        <td><b><?php echo ucfirst($lastsclass);?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('if_your_brother/_sister_reading_this_school');?></td>
                        <td><b><?php echo $siblingname;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('brother/_sister_info');?></td>
                        <td><b><?php $siblinginfo = explode('|', $siblinginfo);
                                echo 'Class: '.$siblinginfo[0].' | '.'Roll: '.$siblinginfo[1].' | '.'Shift: '.$siblinginfo[2].' | '.'Group: '.$siblinginfo[3].' | ';
                        ?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('email');?></td>
                        <td><b><?php echo $email;?></b></td>
                    </tr>
                    <!-- <tr>
                        <td><?php echo get_phrase('password');?></td>
                        <td><b><?php echo $password;?></b></td>
                    </tr> -->
                    <!-- <tr>
                        <td><?php echo get_phrase('parent');?></td>
                        <td>
                            <b>
                                <?php 
                                    echo $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->name;
                                ?>
                            </b>
                        </td>
                    </tr> -->
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>


<?php endforeach;?>