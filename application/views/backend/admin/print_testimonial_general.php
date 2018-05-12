<?php  
	$genFormat = $this->db->get_where('settings',['type'=>'general_testimonial'])->row()->description; 
	$genFormat = explode('|',$genFormat);

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

<!DOCTYPE html>
<html>
<head>
    
<meta http-equiv="Content-Type" content="charset=UTF-8" />
<link rel="stylesheet" media="all" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<style>
	body {
        width: 100%;
        height: 100%;
    }
	.col-md-12.testimonial-body {
	    min-height: 270px !important;
	}
	.testimonial-wrapper{
		font-family: 'Lobster', cursive;
	    line-height: 27px;
	    text-align: center;
	    padding: 0px !important;
		margin: 0px !important;
	    
	    border-style: solid;
		border-width: 55px 60px 60px 55px;
		-moz-border-image: url(<?php echo base_url(); ?>assets/images/border-img.gif) 55 60 60 55 repeat;
		-webkit-border-image: url(<?php echo base_url(); ?>assets/images/border-img.gif) 55 60 60 55 repeat;
		-o-border-image: url(<?php echo base_url(); ?>assets/images/border-img.gif) 55 60 60 55 repeat;
		border-image: url(<?php echo base_url(); ?>assets/images/border-img.gif) 55 60 60 55 fill repeat;

		color: #000;
		width: 100%;
		height: 100%;
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
		/* float: right; */
	}
	.testimonial-wrapper:after {
 	  content: "";
	  background: url(<?php echo base_url(); ?>uploads/school_logo.png) !important;
	  opacity: 0.1 !important;
	  top: 100px !important;
	  left: 0 !important;
	  bottom: 0 !important;
	  right: 0 !important;
	  position: absolute !important;
	  background-size: 550px 400px !important;
	  background-repeat: no-repeat !important;
	  background-position: center center !important;
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
		@page {
			size: A4 landscape;
		}
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
		    background-size: 400px 400px !important;
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
		<div class="col-xs-3">
			<img src="<?php echo base_url(); ?>uploads/school_logo.png" width="100px" height="100px" alt="">
		</div>
		<div class="col-xs-6">
				<h2><?php echo $schoolName; ?></h2>
				<p>EIIN: <?php echo $eiin; ?></p>
				<p><?php echo $schoolAddress; ?></p>	
		</div>
		<div class="col-xs-3">
			
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-4">
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

<br>

	<div class="row">
		<div class="col-md-12 testimonial-body">
		<span><?php echo $genFormat[0];?></span><span class="border_bottom"><?php echo $student_name; ?></span>
		<span><?php echo $genFormat[1];?></span><span class="border_bottom"><?php echo $father_name; ?></span>
		<span><?php echo $genFormat[2];?></span><span class="border_bottom"><?php echo $mother_name; ?></span>
		<span><?php echo $genFormat[3];?></span><span class="border_bottom"><?php echo $eachAdd[0]; ?></span>
		<span><?php echo $genFormat[4];?></span><span class="border_bottom"><?php echo $eachAdd[1]; ?></span>
		<span><?php echo $genFormat[5];?></span><span class="border_bottom"><?php echo $eachAdd[2]; ?></span>
		<span><?php echo $genFormat[6];?></span><span class="border_bottom"><?php echo $eachAdd[3]; ?></span>
		<span><?php echo $genFormat[7];?> <?php echo $course; ?> <?php echo $genFormat[8];?></span><span class="border_bottom"><?php echo $pass_year; ?></span>
		<span> <?php echo $genFormat[9];?> </span><span class="border_bottom"><?php echo $genFormat[10]; ?></span>
		<span><?php echo $genFormat[11];?></span><span class="border_bottom"><?php echo $pass_roll; ?></span>
		<span><?php echo $genFormat[12];?></span><span class="border_bottom"><?php echo $pass_regis_no; ?></span>
		<span><?php echo $genFormat[13];?></span><span class="border_bottom"><?php echo $pass_session; ?></span>
		<span><?php echo $genFormat[14];?></span><span class="border_bottom"><?php echo $gpa; ?></span>
		<span> <?php echo $genFormat[15];?></span><span class="border_bottom"><?php echo ucwords(str_replace('-', ' ', $trade_name)); ?></span>
		<span><?php echo $genFormat[16];?></span>
			
		<br>
		<span><?php echo $genFormat[17];?></span><span class="border_bottom"><?php echo $eachBirth[0]; ?></span>
		<span>/</span><span class="border_bottom"><?php echo $eachBirth[1]; ?></span>
		<span>/</span><span class="border_bottom"><?php echo $eachBirth[2]; ?></span>
		<span><?php echo $genFormat[18];?></span>
			
		<br> 

		<span><?php echo $genFormat[19];?></span>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-xs-4 text-center office-asse-sign">				
			<hr>
			<span><?php echo $genFormat[20];?></span>
		</div>
		<div class="col-xs-4 blank-space">
			
		</div>
		<div class="col-xs-4 text-center headmaster-sign">
			<hr>
			<span><?php echo $genFormat[21];?></span>
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