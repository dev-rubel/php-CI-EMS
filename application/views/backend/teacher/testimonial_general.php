<?php //pd($std_info); 
$genFormat = $this->db->get_where('settings',['type'=>'general_testimonial'])->row()->description; 
$genFormat = explode('|',$genFormat);

$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
list($schoolName,$schoolAddress,$eiin,$email,$phone) = explode('+', $schoolInfo);
?>

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
	    background: url(<?php echo base_url(); ?>uploads/school_logo.png);
	    opacity: 0.1;
	    top: 300px;
	    left: 0;
	    bottom: 0;
	    right: 0;
	    position: absolute;
	    z-index: -1;
	    background-size: 400px 400px;
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
				<img src="<?php echo base_url(); ?>uploads/school_logo.png" alt="" class="img-responsive">
			</div>
			<div class="col-md-6 header-title">
				<div class="text-center">
					<h2><?php echo $schoolName; ?></h2>
					<p>EIIN: <?php echo $eiin; ?></p>
					<p><?php echo $schoolAddress; ?></p>	
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
			<span><?php echo $genFormat[0];?></span><input type="text" name="student_name" value="<?php echo $std_info['student_name']; ?>" style="width: 400px;" required>
			<span><?php echo $genFormat[1];?></span><input type="text" name="father_name" value="<?php echo $std_info['father_name']; ?>" style="width: 350px;">
			<span><?php echo $genFormat[2];?></span><input type="text" name="mother_name" value="<?php echo $std_info['mother_name']; ?>" style="width: 350px;">
			<span><?php echo $genFormat[3];?></span><input type="text" name="address[]" value="<?php echo $eachAddress[0]; ?>" style="width: 200px;">
			<span><?php echo $genFormat[4];?></span><input type="text" name="address[]" value="<?php echo $eachAddress[1]; ?>" style="width: 200px;">
			<span><?php echo $genFormat[5];?></span><input type="text" name="address[]" value="<?php echo $eachAddress[2]; ?>" style="width: 200px;">
			<span><?php echo $genFormat[6];?></span><input type="text" name="address[]" value="<?php echo $eachAddress[3]; ?>" style="width: 200px;">
			<span><?php echo $genFormat[7];?> 

			<select name="course" style="font-size: 15px;">
			 	<option value="S.S.C" <?php echo selected('S.S.C', $std_info['course']) ?>>S.S.C</option>
			 	<option value="H.H.C" <?php echo selected('H.H.C', $std_info['course']) ?>>H.H.C</option>
			 	<option value="P.E.C" <?php echo selected('P.E.C', $std_info['course']) ?>>P.E.C</option>
			 	<option value="J.S.C" <?php echo selected('J.S.C', $std_info['course']) ?>>J.S.C</option>
			 </select>

			 <?php echo $genFormat[8];?></span><input type="text" name="pass_year" value="<?php echo $std_info['pass_year']; ?>" style="width: 30px;">
			<span> <?php echo $genFormat[9];?> </span><input type="text" value="<?php echo $genFormat[10];?>" name="pass_no" readonly>			
			<span><?php echo $genFormat[11];?></span><input type="text" value="<?php echo $std_info['pass_roll']; ?>" name="pass_roll">
			<span><?php echo $genFormat[12];?></span><input type="text" value="<?php echo $std_info['pass_regis_no']; ?>" name="pass_regis_no">
			<span><?php echo $genFormat[13];?></span><input type="text" name="pass_session" value="<?php echo $std_info['pass_session']; ?>" style="width: 60px;">
			<span><?php echo $genFormat[14];?></span><input type="text" name="gpa" value="<?php echo $std_info['gpa'] ?>" style="width: 60px;">
			<span><?php echo $genFormat[15];?></span>
	
			<select name="trade" style="font-size: 15px;">
			<option value="">Select One</option>
			<?php foreach($group_name as $eachGro): ?>
				<option value="<?php echo $eachGro['group_id']; ?>" <?php echo selected($eachGro['group_id'], $std_info['trade']) ?>><?php echo ucwords(str_replace('-', ' ', $eachGro['name'])); ?></option>
			<?php endforeach; ?>
			</select>

			<span><?php echo $genFormat[16];?></span>

			<br><br>
			
			<?php $date_of_birth = explode('-', $std_info['birth']); ?>
			<span><?php echo $genFormat[17];?></span><input type="text" name="birth[]" value="<?php echo $date_of_birth[0]; ?>" style="width: 60px;">
			<span>/</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[1]; ?>" style="width: 60px;">
			<span>/</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[2]; ?>" style="width: 60px;">
			<span><?php echo $genFormat[18];?></span>
				
			<br><br>

			<span><?php echo $genFormat[19];?></span>
		</div>
	</div>

	<br><br><br>

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4 text-center office-asse-sign">				
				<input type="text" value="<?php echo $std_info['asset_sign']; ?>" name="asset_sign">
				<br>
				<span><?php echo $genFormat[20];?></span>
			</div>
			<div class="col-md-4 blank-space">
				
			</div>
			<div class="col-md-4 text-center headmaster-sign">
				<input type="text" value="<?php echo $std_info['headmaster_sign']; ?>" name="headmaster_sign">
				<br>
				<span><?php echo $genFormat[21];?></span>
			</div>
		</div>
	</div>


<?php else: $paadress = explode('_', $std_info['paadress']);?>
	
	<div class="row">
		<div class="col-md-12 testimonial-body">
		<input type="hidden" name="student_id" value="<?php echo $std_info['student_id']; ?>">
			<span><?php echo $genFormat[0];?></span><input type="text" name="student_name" value="<?php echo $std_info['name']; ?>" style="width: 400px;">
			<span><?php echo $genFormat[1];?></span><input type="text" name="father_name" value="<?php echo $std_info['fname']; ?>" style="width: 350px;">
			<span><?php echo $genFormat[2];?></span><input type="text" name="mother_name" value="<?php echo $std_info['mname']; ?>" style="width: 350px;">
			<span><?php echo $genFormat[3];?></span><input type="text" name="address[]" value="<?php echo $paadress[0]; ?>" style="width: 200px;">
			<span><?php echo $genFormat[4];?></span><input type="text" name="address[]" value="<?php echo $paadress[1]; ?>" style="width: 200px;">
			<span><?php echo $genFormat[5];?></span><input type="text" name="address[]" value="<?php echo $paadress[2]; ?>" style="width: 200px;">
			<span><?php echo $genFormat[6];?></span><input type="text" name="address[]" value="<?php echo $paadress[3]; ?>" style="width: 200px;">
			<span><?php echo $genFormat[7];?> 

			<select name="course" style="font-size: 15px;">
			 	<option value="S.S.C">S.S.C</option>
			 	<option value="H.H.C">H.H.C</option>
			 	<option value="P.E.C">P.E.C</option>
			 	<option value="J.S.C">J.S.C</option>
			 </select> 

			 <?php echo $genFormat[8];?></span><input type="text" name="pass_year" value="<?php echo date('y'); ?>" style="width: 30px;">
			<span> <?php echo $genFormat[9];?> </span><input type="text" value="<?php echo $genFormat[10];?>" name="pass_no" readonly>
			<span><?php echo $genFormat[11];?></span><input type="text" value="<?php echo $enroll_info['roll']; ?>" name="pass_roll">
			<span><?php echo $genFormat[12];?></span><input type="text" value="<?php echo $std_info['pass_regis_no']; ?>" name="pass_regis_no">
			<span><?php echo $genFormat[13];?></span><input type="text" name="pass_session" style="width: 60px;">
			<span><?php echo $genFormat[14];?></span><input type="text" name="gpa" style="width: 60px;">
			<span><?php echo $genFormat[15];?></span>

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

			<span><?php echo $genFormat[16];?></span>

			<br><br>
			
			<?php $date_of_birth = explode('-', $std_info['birthday']); ?>
			<span><?php echo $genFormat[17];?></span><input type="text" name="birth[]" value="<?php echo $date_of_birth[0]; ?>" style="width: 60px;">
			<span>/</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[1]; ?>" style="width: 60px;">
			<span>/</span><input type="text" name="birth[]" value="<?php echo $date_of_birth[2]; ?>" style="width: 60px;">
			<span><?php echo $genFormat[18];?></span>
				
			<br><br>

			<span><?php echo $genFormat[19];?></span>
		</div>
	</div>

	<br><br><br>

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4 text-center office-asse-sign">				
				<input type="text" name="asset_sign">
				<br>
				<span><?php echo $genFormat[20];?></span>
			</div>
			<div class="col-md-4 blank-space">
				
			</div>
			<div class="col-md-4 text-center headmaster-sign">
				<input type="text" name="headmaster_sign">
				<br>
				<span><?php echo $genFormat[21];?></span>
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
