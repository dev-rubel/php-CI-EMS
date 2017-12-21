<?php  
	$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
	list($schoolName,$schoolAddress,$eiin,$email,$phone) = explode('+', $schoolInfo);

	if(isset($std_info) && !empty($std_info)){
		extract($std_info[0]);
		$eachAdd = explode('_', $address);
		$eachBirth = explode('-', $birth);
	}else{
		$arr = array(
			'testimonial_id' => '',
			'student_id' => '',
			'student_name' => '',
			'father_name' => '',
			'mother_name' => '',
			'address' => '____',
			'pass_year' => '',
			'pass_roll' => '',
			'pass_no' => '',
			'pass_regis_no' => '',
			'pass_session' => '',
			'trade' => '',
			'birth' => '---',
			'asset_sign' => '',
			'headmaster_sign' => ''
			);
		extract($arr);
		$eachAdd = explode('_', $address);
		$eachBirth = explode('-', $birth);
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    
<meta http-equiv="Content-Type" content="charset=UTF-8" />
<link rel="stylesheet" href="assets/css/bootstrap.css">

<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<style>
	.col-md-12.testimonial-body {
	    min-height: 230px !important;
	}
	.testimonial-wrapper{
		font-family: 'Lobster', cursive;
	    line-height: 27px;
	    text-align: center;
	    padding: 0;
	    
	    border-style: solid;
		border-width: 60px 63px 63px 60px;
		-moz-border-image: url(<?php echo base_url(); ?>assets/images/border-img.gif) 60 63 63 60 repeat;
		-webkit-border-image: url(<?php echo base_url(); ?>assets/images/border-img.gif) 60 63 63 60 repeat;
		-o-border-image: url(<?php echo base_url(); ?>assets/images/border-img.gif) 60 63 63 60 repeat;
		border-image: url(<?php echo base_url(); ?>assets/images/border-img.gif) 60 63 63 60 fill repeat;


		    color: #000;
		    width: 100% height: 100%;
		    display: block;
		    position: relative;
	}
	h1, h2{
		color: #000;
	}
	h1{
		display: inline-block !important;
	}
	.testimonial-wrapper span,p{
		font-size: 16px;
	}
	.testimonial-wrapper input[type="text"] {
	    border-bottom: 1px dotted;
	    border-top: 0;
	    border-left: 0;
	    border-right: 0;
	    border-radius: 0;
	    font-size: 18px;	 
	    text-align: center;
        background: transparent;   
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
		max-height: 100px;
		float: right;
	}
	.testimonial-wrapper:after {
 	  content: "";
	  background: url(<?php echo base_url(); ?>uploads/school_logo.png);
	  opacity: 0.1;
	  top: 100px;
	  left: 0;
	  bottom: 0;
	  right: 0;
	  position: absolute;
	  background-size: 550px 400px;
	  background-repeat: no-repeat;
	  background-position: center center;
	}

	span.border_bottom{
		display: inline-block;
    	position: relative;
    	padding: 0px 5px;
	}
	span.border_bottom::after {
	    content: '';
	    position: absolute;
	    left: 0;
	    display: inline-block;
	    height: 1em;
	    width: 96%;
	    border-bottom: 1px dotted !important;
	    margin-top: 12px;
	    margin-left: 3px;
	}

	hr{
		border: 1px solid #000;
		width: 215px;
	}
	
	@media print{
		.logo img{
			width: 100px;
			height: 100px;
		} 
		span.border_bottom{
			display: inline-block !important;
	    	position: relative !important;
	    	padding: 0px 5px !important;
		}
		span.border_bottom::after {
		    content: '';
		    position: absolute !important;
		    left: 0 !important;
		    display: inline-block !important;
		    height: 1em !important;
		    width: 96% !important;
		    border-bottom: 1px dotted !important;
		    margin-top: 12px !important;
		    margin-left: 3px !important;
		}
		.testimonial-wrapper{
	    	padding: 30px 30px;
		}
		.testimonial-wrapper:after{
			color: #000 !important;
		    text-shadow: none !important;
		    background: url(<?php echo base_url(); ?>uploads/school_logo.png) !important;
		    box-shadow: none !important;
		    background-size: 550px 400px !important;
		  	background-repeat: no-repeat !important;
		  	background-position: center center !important;
		}
		@-moz-document url-prefix() {
		    .testimonial-wrapper span,p{
				font-size: 15px;
			}
		}
	}
</style>

</head>
<body onload="window.print()">
		

<div class="testimonial-wrapper" id="printID">

	<div class="row">
		<div class="col-xs-12 text-center">
			<div class="col-xs-3 text-right logo">
				<img src="<?php echo base_url(); ?>uploads/school_logo.png" alt="" class="img-responsive">
			</div>
			<div class="col-xs-6 header-title">
				<div class="text-center">
					<h2><?php echo $schoolName; ?></h2>
					<p>EIIN: <?php echo $eiin; ?></p>
					<p><?php echo $schoolAddress; ?></p>	
				</div>				
			</div>
			<div class="col-xs-3">
				
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 text-center">
			<div class="col-xs-4 sl-no">
				<p>Sl No.
					<span><?php echo $testimonial_id; ?></span>
				</p>
			</div>
			<div class="col-xs-4 title">
				<h1>Testimonial</h1>
			</div>
			<div class="col-xs-4 date">
				<p>Date: <?php echo date('d-m-Y'); ?></p>
			</div>
		</div>
	</div>

<br>

	<div class="row">
		<div class="col-md-12 testimonial-body">
			<span>This is to certify that</span><span class="border_bottom"><?php echo $student_name; ?></span>
			<span>father's name</span><span class="border_bottom"><?php echo $father_name; ?></span>
			<span>mother's name</span><span class="border_bottom"><?php echo $mother_name; ?></span>
			<span>of Village:</span><span class="border_bottom"><?php echo $eachAdd[0]; ?></span>
			<span>P.O:</span><span class="border_bottom"><?php echo $eachAdd[1]; ?></span>
			<span>Upazila:</span><span class="border_bottom"><?php echo $eachAdd[2]; ?></span>
			<span>Dist:</span><span class="border_bottom"><?php echo $eachAdd[3]; ?></span>
			<span>was student of this school. He passed the S.S.C (Vocational) Examination in 20</span><span class="border_bottom"><?php echo $pass_year; ?></span>
			<span> from this school bearing Roll </span><span class="border_bottom"><?php echo $pass_no; ?></span>
			<span>No.</span><span class="border_bottom"><?php echo $pass_roll; ?></span>
			<span>Registration No.</span><span class="border_bottom"><?php echo $pass_regis_no; ?></span>
			<span>Session</span><span class="border_bottom"><?php echo $pass_session; ?></span>
			<span>obtaining GPA</span><span class="border_bottom"><?php echo $gpa; ?></span>
			<span>from</span><span class="border_bottom"><?php echo ucwords(str_replace('-', ' ', $trade_name)); ?></span>
			<span>Trade under Bangladesh Technical Education Board Dhaka.</span>
			<br>
			

			<span>To the best of my knowlege he did not take part in any activities subversive of the state or of discipline. His date of birth as per admission register is</span><span class="border_bottom"><?php echo $eachBirth[0]; ?></span>
			<span>/</span><span class="border_bottom"><?php echo $eachBirth[1]; ?></span>
			<span>/</span><span class="border_bottom"><?php echo $eachBirth[2]; ?></span>
			<span>. He bears a good moral character and amiable dispostion.</span>
				
			<br> <br>

			<span>I wish his bright future and successfull life.</span>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-xs-12">
			<div class="col-xs-4 text-center office-asse-sign">				
				<hr>
				<span>Office Asst:</span>
			</div>
			<div class="col-xs-4 blank-space">
				
			</div>
			<div class="col-xs-4 text-center headmaster-sign">
				<hr>
				<span>Headmaster</span>
			</div>
		</div>
	</div>
</div>

<script>
	function printDiv(divName) {
	     var printContents = document.getElementById(divName).innerHTML;
	     var originalContents = document.body.innerHTML;

	     document.body.innerHTML = printContents;

	     window.print();

	     document.body.innerHTML = originalContents;
	}
</script>

</body>
</html>