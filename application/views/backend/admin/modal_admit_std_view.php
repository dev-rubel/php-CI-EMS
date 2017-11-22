<?php

$result = oneDim($this->db->get_where('admit_std',array('id'=>$param2))->result_array());
extract($result);
//pd($result);
?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-3">
			
			<a href="#" class="profile-picture">
				<img src="<?php echo base_url().'assets/'.$img;?>" 
                	class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
							<h3><?php echo $name;?></h3>
							<h3><?php echo $namebn;?></h3>
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
                    <?php if(!empty($lguaridan)):?>
                    <tr>
                        <td><?php echo get_phrase('legal_guardian');?></td>
                        <td><b><?php echo $lguaridan;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('relation_with_guardian');?></td>
                        <td><b><?php echo $relaguardian;?></b></td>
                    </tr>
                    <?php endif;?>
                    <tr>
                        <td><?php echo get_phrase('previous_school_name');?></td>
                        <td><b><?php echo $preschoolname;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('previous_school_adress');?></td>
                        <td><b><?php echo $preschooladd;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('email');?></td>
                        <td><b><?php echo $email;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('class');?></td>
                        <td><b><?php echo $class;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('submission_date');?></td>
                        <td><b><?php echo $date;?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo get_phrase('mobile');?></td>
                        <td><b><?php echo $mobile;?></b></td>
                    </tr>
                    
                </table>
			</div>
		</div>		
	</section>
	
	
	
</div>

