<?php
extract($std_info);
//pd($info);
$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
list($schoolName,$schoolAddress,$eiin,$schoolEmail,$phone) = explode('+', $schoolInfo);


if(!empty($group)) {
    $condition3 = '
     <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
  <div style="margin-bottom: 8px; font-weight: bold;"><p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Group : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: normal; color: black; font-size: 12px;">'.ucfirst($group).'</span></p> </div>
    </div>   
    ';
    $jsc = explode(',', $jscinfo);
    $condition2 = '
        <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
        <div style="margin-bottom: 8px; font-weight: bold;"><p style="width: 650px;display:inline-block;margin: 2px 0;color: green;">JSC Information : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:normal; font-style: italic; font-size: 12px;">GPA: '.$jsc[3].', Reg No: '.$jsc[1].', Roll No: '.$jsc[2].', Year: '.$jsc[0].'</span></p>  </div>
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
$stdImg = base_url().'assets/images/admission_student/'.$admission_session.'/'.$img;

if(!empty($lguaridan)):
    $condition1 = '
          <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
      <div style="margin-bottom: 8px; font-weight: bold;"><p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Legal Guardian : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: normal; color: black; font-size: 12px;">'.$lguaridan.'</span></p> </div></div>

<div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;"><div style="margin-bottom: 8px; font-weight: bold;"><p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Relation : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: normal; color: black; font-size: 12px;">'.$relaguardian.'</span></p> </div></div>  
    ';
    
endif;
?>
    <html>

    <head>
    </head>

    <body style="font-size: 12px;">

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
                        <?php if(file_exists($stdImg)):?>
                            <img src="<?php echo $stdImg;?>" width="115px" height="125px" style="border: 1px solid;padding: 2px">
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
                    <div style="margin-top: -330px;border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Student Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $name; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Student Name (Bangla): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 14px;">
                                    <?php echo $namebn;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Fathers Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $fname;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Fathers Name (Bangla): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 14px;">
                                    <?php echo $fnamebn;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Mothers Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $mname;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Mothers Name (Bangla):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 14px;">
                                    <?php echo $mnamebn;?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Present Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $paadress;?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Permanent Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $praddress;?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Religion : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $religion;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Nationality : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $nationality;?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <?php echo $condition1;?>

                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $email;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Class : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $this->db->get_where('class',['class_id'=>$class_id])->row()->name;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Section : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $this->db->get_where('section',['section_id'=>$section_id])->row()->name;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Shift : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $this->db->get_where('shift',['shift_id'=>$shift_id])->row()->name;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Roll : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $roll;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <?php echo $condition3;?>
                    <?php echo $condition2;?>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Previous School Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $preschoolname;?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Previous School Address : &nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $preschooladd;?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Date of Birth : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $birthday;?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="font-size: 13px; margin-bottom: 10px;">
                        <div style="margin-bottom: 8px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Guardian Mobile No : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    <?php echo $mobile;?>
                                </span>
                            </p>
                        </div>
                    </div>


                </div>
             
            </div>
        </div>
        </div>
    </body>

    </html>