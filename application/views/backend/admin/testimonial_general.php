<?php //pd($std_info); ?>

<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<style>
	.testimonial-wrapper{
		font-family: 'Lobster', cursive;
		line-height: 25px;
		text-align: center;
    	padding: 40px 55px;
    	border: 1px dashed;
    	color: #000;
	}
	h1, h2{
		color: #000;
	}
	.testimonial-wrapper span,p{
		font-size: 20px;
	}
	.testimonial-wrapper input[type="text"] {
	    border-bottom: 1px dotted;
	    border-top: 0;
	    border-left: 0;
	    border-right: 0;
	    border-radius: 0;
	    font-size: 20px;	 
	    text-align: center;
        background: transparent;   
        color: red;
	}
	.testimonial-wrapper input[type="text"]:focus{
		border-bottom: 1px dotted;
	    border-top: 0;
	    border-left: 0;
	    border-right: 0;
	    border-radius: 0;
	}
	.logo img{
		max-width: 100px;
		float: right;
	}
	.testimonial-wrapper::after {
	    content: "";
	    background: url(<?php echo base_url(); ?>assets/images/logo_testimonial.jpg);
	    opacity: 0.1;
	    top: 300px;
	    left: 0;
	    bottom: 0;
	    right: 0;
	    position: absolute;
	    z-index: -1;
	    background-size: 550px 400px;
	    background-repeat: no-repeat;
	    background-position: center center;
	}
</style>

<div class="search-section">
<div class="row">
	<div class="col-md-4">
		
	</div>
	<div class="col-md-8">
		<form action="<?php echo base('admin', 'search_testimonial'); ?>" method="post">
			<div class="col-md-6">
				<div class="col-md-8">
					<select name="group_id" class="form-control">
						<option value="">Select Group</option>
						<?php foreach($group_name as $eachGro): ?>
							<option value="<?php echo $eachGro['group_id']; ?>"><?php echo ucwords(str_replace('-', ' ', $eachGro['name'])); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" placeholder="Roll No." name="roll">	
				</div>				
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary">Search</button>
			</div>
		</form>
			<div class="col-md-2">
				<a href="?admin/testimonial_general" class="btn btn-primary">Add Manualy</a>
			</div>
		
	</div>
	</div>
</div>


<br><br><br><br><br>

<form action="<?php echo base('admin', 'add_testimonial') ?>" id="textimonialId" method="post">
<div class="testimonial-wrapper" id="printID">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3 text-right logo">
				<img src="<?php echo base_url(); ?>assets/images/logo_testimonial.jpg" alt="" class="img-responsive">
			</div>
			<div class="col-md-6 header-title">
				<div class="text-center">
					<h2>HOMNA ADARSHA HIGH SCHOOL</h2>
					<p>Established: 1989</p>
					<p>P.O: Homna, Upazila: Homna, Dist: Comilla</p>	
				</div>				
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
	</div>
	
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4 text-left sl-no">
				<p>Sl No.
				<?php if(isset($found_test)){
						echo $std_info['testimonial_id'];
					}else{
						echo '';
					} ?>
				</p>
			</div>
			<div class="col-md-4 text-center title">
				<h1>Testimonial</h1>
			</div>
			<div class="col-md-4 text-right date">
				<p>Date: <?php echo date('d-m-Y'); ?></p>
			</div>
		</div>
	</div>

	<br><br>

<?php if(isset($found_test)): $eachAddress = explode('_', $std_info['address']); ?>
	
	<div class="row">
		<div class="col-md-12 testimonial-body">
		<input type="hidden" name="testimonial_id" value="<?php echo $std_info['testimonial_id']; ?>">
		<input type="hidden" name="student_id" value="<?php echo $std_info['student_id']; ?>">
			<span>This is to certify that</span><input type="text" name="student_name" value="<?php echo $std_info['student_name']; ?>" style="width: 400px;">
			<span>father's name</span><input type="text" name="father_name" value="<?php echo $std_info['father_name']; ?>" style="width: 350px;">
			<span>mother's name</span><input type="text" name="mother_name" value="<?php echo $std_info['mother_name']; ?>" style="width: 350px;">
			<span>of Village:</span><input type="text" name="address[]" value="<?php echo $eachAddress[0]; ?>" style="width: 200px;">
			<span>P.O:</span><input type="text" name="address[]" value="<?php echo $eachAddress[1]; ?>" style="width: 200px;">
			<span>Upazila:</span><input type="text" name="address[]" value="<?php echo $eachAddress[2]; ?>" style="width: 200px;">
			<span>Dist:</span><input type="text" name="address[]" value="<?php echo $eachAddress[3]; ?>" style="width: 200px;">
			<span>was student of this school. He passed the

			<select name="course" style="font-size: 15px;">
			 	<option value="S.S.C" <?php echo selected('S.S.C', $std_info['course']) ?>>S.S.C</option>
			 	<option value="H.H.C" <?php echo selected('H.H.C', $std_info['course']) ?>>H.H.C</option>
			 	<option value="P.E.C" <?php echo selected('P.E.C', $std_info['course']) ?>>P.E.C</option>
			 	<option value="J.S.C" <?php echo selected('J.S.C', $std_info['course']) ?>>J.S.C</option>
			 </select>

			 Examination in 20</span><input type="text" name="pass_year" value="<?php echo $std_info['pass_year']; ?>" style="width: 30px;">
			<span> from this school bearing Roll </span><input type="text" value="Homna-1" name="pass_no" readonly>			
			<span>No.</span><input type="text" value="<?php echo $std_info['pass_roll']; ?>" name="pass_roll">
			<span>Registration No.</span><input type="text" value="<?php echo $std_info['pass_regis_no']; ?>" name="pass_regis_no">
			<span>Session</span><input type="text" name="pass_session" value="<?php echo $std_info['pass_session']; ?>" style="width: 60px;">
			<span>obtaining GPA</span><input type="text" name="gpa" value="<?php echo $std_info['gpa'] ?>" style="width: 60px;">
			<span>from</span>
	
			<select name="trade" style="font-size: 15px;">
			<option value="">Select One</option>
			<?php foreach($group_name as $eachGro): ?>
				<option value="<?php echo $eachGro['group_id']; ?>" <?php echo selected($eachGro['group_id'], $std_info['trade']) ?>><?php echo ucwords(str_replace('-', ' ', $eachGro['name'])); ?></option>
			<?php endforeach; ?>
			</select>

			<span>Trade under Board of Intermediate and Secondary Education, Comilla.</span>

			<br><br>
			
			<?php $date_of_birth = explode('-', $std_info['birth']); ?>
			<span>To the best of my knowlege he did not take part in any activities subversive of the state or of discipline. His date of birth as per admission register is</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[0]; ?>" style="width: 60px;">
			<span>/</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[1]; ?>" style="width: 60px;">
			<span>/</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[2]; ?>" style="width: 60px;">
			<span>. He bears a good moral character and amiable dispostion.</span>
				
			<br><br>

			<span>I wish his bright future and successfull life.</span>
		</div>
	</div>

	<br><br><br>

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4 text-center office-asse-sign">				
				<input type="text" value="<?php echo $std_info['asset_sign']; ?>" name="asset_sign">
				<br>
				<span>Office Asst:</span>
			</div>
			<div class="col-md-4 blank-space">
				
			</div>
			<div class="col-md-4 text-center headmaster-sign">
				<input type="text" value="<?php echo $std_info['headmaster_sign']; ?>" name="headmaster_sign">
				<br>
				<span>Headmaster</span>
			</div>
		</div>
	</div>


<?php else: $paadress = explode('_', $std_info['paadress']);?>
	

	<div class="row">
		<div class="col-md-12 testimonial-body">
		<input type="hidden" name="student_id" value="<?php echo $std_info['student_id']; ?>">
			<span>This is to certify that</span><input type="text" name="student_name" value="<?php echo $std_info['name']; ?>" style="width: 400px;">
			<span>father's name</span><input type="text" name="father_name" value="<?php echo $std_info['fname']; ?>" style="width: 350px;">
			<span>mother's name</span><input type="text" name="mother_name" value="<?php echo $std_info['mname']; ?>" style="width: 350px;">
			<span>of Village:</span><input type="text" name="address[]" value="<?php echo $paadress[0]; ?>" style="width: 200px;">
			<span>P.O:</span><input type="text" name="address[]" value="<?php echo $paadress[1]; ?>" style="width: 200px;">
			<span>Upazila:</span><input type="text" name="address[]" value="<?php echo $paadress[2]; ?>" style="width: 200px;">
			<span>Dist:</span><input type="text" name="address[]" value="<?php echo $paadress[3]; ?>" style="width: 200px;">
			<span>was student of this school. He passed the 

			<select name="course" style="font-size: 15px;">
			 	<option value="S.S.C">S.S.C</option>
			 	<option value="H.H.C">H.H.C</option>
			 	<option value="P.E.C">P.E.C</option>
			 	<option value="J.S.C">J.S.C</option>
			 </select> 

			 Examination in 20</span><input type="text" name="pass_year" value="<?php echo date('y'); ?>" style="width: 30px;">
			<span> from this school bearing Roll </span><input type="text" value="Homna-1" name="pass_no" readonly>
			<span>No.</span><input type="text" value="<?php echo $enroll_info['roll']; ?>" name="pass_roll">
			<span>Registration No.</span><input type="text" value="<?php echo $std_info['pass_regis_no']; ?>" name="pass_regis_no">
			<span>Session</span><input type="text" name="pass_session" style="width: 60px;">
			<span>obtaining GPA</span><input type="text" name="gpa" style="width: 60px;">
			<span>from</span>

			<?php if(isset($std_group_id)): ?>	
				<select name="trade" style="font-size: 15px;">
				<option value="">Select Group</option>
				<?php foreach($group_name as $eachGro): ?>
					<option value="<?php echo $eachGro['group_id']; ?>" <?php echo selected($eachGro['group_id'], $std_group_id) ?>><?php echo ucwords(str_replace('-', ' ', $eachGro['name'])); ?></option>
				<?php endforeach; ?>
				</select>
			<?php else: ?>
				<select name="trade" style="font-size: 15px;">
					<option value="">Select Group</option>
					<?php foreach($group_name as $eachGro): ?>
						<option value="<?php echo $eachGro['group_id']; ?>"><?php echo ucwords(str_replace('-', ' ', $eachGro['name'])); ?></option>
					<?php endforeach; ?>
				</select>
			<?php endif; ?>

			<span>under Bangladesh Education Board Comilla.</span>

			<br><br>
			
			<?php $date_of_birth = explode('-', $std_info['birthday']); ?>
			<span>To th best of my knowlege he did not take part in any activities subversive of the state or of discipline. His date of birth as per admission register is</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[0]; ?>" style="width: 60px;">
			<span>/</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[1]; ?>" style="width: 60px;">
			<span>/</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[2]; ?>" style="width: 60px;">
			<span>. He bears a good moral character and amiable dispostion.</span>
				
			<br><br>

			<span>I wish his bright future and successfull life.</span>
		</div>
	</div>

	<br><br><br>

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4 text-center office-asse-sign">				
				<input type="text" name="asset_sign">
				<br>
				<span>Office Asst:</span>
			</div>
			<div class="col-md-4 blank-space">
				
			</div>
			<div class="col-md-4 text-center headmaster-sign">
				<input type="text" name="headmaster_sign">
				<br>
				<span>Headmaster</span>
			</div>
		</div>
	</div>

<?php endif; ?>


	





</div>

<br><br>

<div class="row text-center">
	<div class="col-md-12">
		<div class="col-md-4"></div>
		<div class="col-md-4">
	
	<?php if(isset($found_test)): ?>
			<div class="col-md-6">
				<button class="btn btn-primary" name="update_new" type="submit">Update & New</button>
			</div>
			<div class="col-md-6">
				<button class="btn btn-info" name="update_print" type="submit" formtarget="_blank">Update & Print</button>
			</div>
	<?php else: ?>
			<div class="col-md-6">
				<button class="btn btn-primary" name="save_new" type="submit">Save & New</button>
			</div>
			<div class="col-md-6">
				<button class="btn btn-info" name="save_print" type="submit" formtarget="_blank">Save & Print</button>
			</div>
	<?php endif; ?>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>

</form>

<script>
	function printDiv(divName) {
	     var printContents = document.getElementById(divName).innerHTML;
	     var originalContents = document.body.innerHTML;

	     document.body.innerHTML = printContents;

	     window.print();

	     document.body.innerHTML = originalContents;
	}
</script>
