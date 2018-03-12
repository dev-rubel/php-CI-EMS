<style media="all">
    table.paleBlueRows {
    border: 1px solid #FFFFFF !important;
    width: 450px !important;
    height: 200px !important;
    text-align: left !important;
    border-collapse: collapse !important;
	/* margin-left: 10% !important; */
    }
    table.paleBlueRows td, table.paleBlueRows th {
    border: 1px solid #000 !important;
    padding: 3px 2px !important;
    }
    table.paleBlueRows tbody td {
    font-size: 13px !important;
	padding-left: 10px; 
    }
    table.paleBlueRows tr:nth-child(even) {
    background: #D0E4F5 !important;
    }
    table.paleBlueRows thead {
    background: #0B6FA4 !important;
    border-bottom: 5px solid #FFFFFF !important;
    }
    table.paleBlueRows thead th {
    font-size: 17px !important;
    font-weight: bold !important;
    color: #FFFFFF !important;
    text-align: center !important;
    border-left: 2px solid #FFFFFF !important;
    }
    table.paleBlueRows thead th:first-child {
    border-left: none !important;
    }

    table.paleBlueRows tfoot {
    font-size: 13px !important;
    font-weight: bold !important;
    color: #333333 !important;
    background: #D0E4F5 !important;
    border-top: 3px solid #444444 !important;
    }
    table.paleBlueRows tfoot td {
    font-size: 13px !important;
	padding-left: 10px; 
    }
</style>
<?php
extract($std_info);
//pd($info);
$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
list($schoolName,$schoolAddress,$eiin,$schoolEmail,$phone) = explode('+', $schoolInfo);

$this->db->order_by('creation_timestamp','asc');
$this->db->limit(1);
$tution_info = $this->db->get_where('invoice',['acc_code'=>$std_info['student_code']])->result_array();

if($group_id > 0) {
    $group_name = $this->db->get_where('group',['group_id'=>$group_id])->row()->name;
    $condition3 = '
    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Group : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: normal; color: black; font-size: 13px">'.ucfirst($group_name).'</span></p> </div>
    </div>
    ';
}
if(strlen($jscpecinfo) > 4) {
    $jsc = explode(',', $jscinfo);
    $condition2 = '
    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 650px;display:inline-block;margin: 2px 0;color: green;">JSC Information : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:normal; font-style: italic; font-size: 13px">GPA: '.$jsc[3].', Reg No: '.$jsc[1].', Roll No: '.$jsc[2].', Year: '.$jsc[0].'</span></p></div>
    </div>
    ';
} else {
$jsc = '';
};
if($class==91) {
	$class = '9 Vocational';
} else {
	$class = $class;
}
$base = base_url().'uploads/';
// $stdImg2 = base_url().'uploads/student_image/'.$student_id.'.jpg';
// For Loacl User (REMOVE IT WHENE USE IN SERVER)
// $stdImg = $_SERVER['DOCUMENT_ROOT'].'/nihalit-ems/uploads/student_image/'.$student_id.'.jpg';
if(!empty($lguaridan)):
$condition1 = '
<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
		<div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Legal Guardian : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: normal; color: black; font-size: 13px">'.$lguaridan.'</span></p> </div></div>
		<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Relation : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: normal; color: black; font-size: 13px">'.$relaguardian.'</span></p> </div></div>
		';
		
		endif;
	?>
	<html>
		<head>
		</head>
		<body style="font-size: 13px">
			<div style="width: 100%;">
				<!--<div class="blnk-space"></div>-->
				<div class="hdr">
					<div style="width: 100%; height: 150px">
						<div style="float: left; width: 15%; text-align: center">
							<img src="<?php echo $base.'school_logo.png';?>" width="100px" height="100px">
						</div>
						<div style="float: left; width: 65%; text-align: center; line-height: 15px">
							<h2 class="ex" style="color: green;">
							<?php echo $schoolName; ?>
							</h2>
							<h3 style="color: green;">
							<?php echo $schoolAddress; ?>
							</h3>
							<p>EIIN:
								<?php echo $eiin; ?>, Email:
								<?php echo $schoolEmail; ?>
							</p>
							<p style="margin-bottom:10px;">Phone:
								<?php echo $phone; ?>
							</p>
							<p style="font-size: 13px; width: 150px; padding: 10px; background-color: green; text-align: center; margin: 0 auto; color: white; border: 1px solid black;">Student Information</p>
						</div>
						<div style="float: right; width: 20%; text-align: center">
							<?php
								$img_url = $this->crud_model->get_image_url2('student',$student_id);
							if(!empty($img_url)):?>
								<img src="<?php echo $img_url;?>" width="115px" height="125px" style="border: 1px solid;padding: 2px">
							<?php else: ?>		
								<img src="https://dummyimage.com/115x125/efedf5/000000.png&text=Attach+Photo" style="border: 1px solid;padding: 2px">
							<?php endif;?>
						</div>
					</div>
					<div class="office-part" style="position: relative; line-height: 10px;">
						<img src="<?php echo $base.'school_logo.png';?>" style="
						opacity: .1;
						margin-left: 210px;
						margin-top: 125px;
						width: 220px;
						height: 225px;
						" />
						<div style="margin-top: -330px;border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Student Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 13px">
										<?php echo $name; ?>
									</span>
								</p>
							</div>
						</div>
						<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Student Name (Bangla): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 17px">
										<?php echo $namebn;?>
									</span>
								</p>
							</div>
						</div>
						<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Fathers Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 13px">
										<?php echo $fname;?>
									</span>
								</p>
							</div>
						</div>
						<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Fathers Name (Bangla): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 17px">
										<?php echo $fnamebn;?>
									</span>
								</p>
							</div>
						</div>
						<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Mothers Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 13px">
										<?php echo $mname;?>
									</span>
								</p>
							</div>
						</div>
						<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Mothers Name (Bangla):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 17px">
										<?php echo $mnamebn;?>
									</span>
								</p>
							</div>
						</div>
						<div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Present Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 13px">
										<?php echo $paadress;?>
									</span>
								</p>
							</div>
						</div>
						<div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Permanent Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 13px">
										<?php echo $praddress;?>
									</span>
								</p>
							</div>
						</div>
						<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Religion : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 13px">
										<?php echo $religion;?>
									</span>
								</p>
							</div>
						</div>
						<?php echo $condition1;?>
                        <?php if(!empty($email)): ?>
                            <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                                <div style="margin-bottom: 4px; font-weight: bold;">
                                    <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span style="font-weight: normal; color: black; font-size: 13px">
                                            <?php echo $email;?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
						<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Class : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 13px">
										<?php echo $this->db->get_where('class',['class_id'=>$class_id])->row()->name;?>
									</span>
								</p>
							</div>
						</div>
                        <?php echo $condition3;?>
						<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
							<div style="margin-bottom: 4px; font-weight: bold;">
								<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Section : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="font-weight: normal; color: black; font-size: 13px">
										<?php echo $this->db->get_where('section',['section_id'=>$section_id])->row()->name;?>
									</span>
								</p>
							</div>
						</div>
					</div>
					<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
						<div style="margin-bottom: 4px; font-weight: bold;">
							<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Shift : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span style="font-weight: normal; color: black; font-size: 13px">
									<?php echo $this->db->get_where('shift',['shift_id'=>$shift_id])->row()->name;?>
								</span>
							</p>
						</div>
					</div>
					<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
						<div style="margin-bottom: 4px; font-weight: bold;">
							<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Roll : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span style="font-weight: normal; color: black; font-size: 13px">
									<?php echo $roll;?>
								</span>
							</p>
						</div>
					</div>					
					<?php echo $condition2;?>
                    <?php if(!empty($preschoolname)): ?>
                        <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Previous School Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 13px">
                                        <?php echo $preschoolname;?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($preschooladd)): ?>
                        <div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Previous School Address : &nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 13px">
                                        <?php echo $preschooladd;?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
					<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
						<div style="margin-bottom: 4px; font-weight: bold;">
							<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Date of Birth : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span style="font-weight: normal; color: black; font-size: 13px">
									<?php echo $birthday;?>
								</span>
							</p>
						</div>
					</div>
					<div style="font-size: 13px; margin-bottom: 5px;">
						<div style="margin-bottom: 4px; font-weight: bold;">
							<p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Guardian Mobile No : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span style="font-weight: normal; color: black; font-size: 13px">
									<?php echo $mobile;?>
								</span>
							</p>
						</div>
					</div>
				</div>
				
                <div style="width: 100%; height: 100px; margin-top: 10px;">
                    <div style="float: left; width: 15%; text-align: center">
                        <div style="width: 100px; height: 50px;"></div>
                    </div>
                    <div style="float: left; width: 65%; text-align: center; line-height: 15px">
                        <p style="font-size: 13px; width: 150px; padding: 10px; background-color: green; text-align: center; margin: 0 auto; color: white; border: 1px solid black;">Admission Payment</p>
                    </div>
                </div>
                <?php
                $tution_info_names = explode(',',$tution_info[0]['fee_name']);
                $tution_info_amounts = explode(',',$tution_info[0]['fee_amount']);
                 ?>
                                     
                        <table class="paleBlueRows">
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo array_sum($tution_info_amounts); ?> TK.</td>
                                </tr>
                            </tfoot>
                            <tbody>
							<tr>
								<td><b>Type</b></td>
								<td><b>Amount</b></td>
							</tr>
                            <?php foreach($tution_info_names as $k=>$each): ?>
                                <tr>
                                    <td><?php echo ucwords(str_replace('_',' ',$each)); ?></td>
                                    <td><?php echo $tution_info_amounts[$k];?> TK.</td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
						</table>              
                
                
			</div>
		</body>
	</html>