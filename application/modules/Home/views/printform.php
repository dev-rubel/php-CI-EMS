<?php

if (empty($std_info)):
    redirect(base('Home', ''));
endif;
$info = oneDim($std_info);
extract($info);
//pd($info);
$examdate = $this->db->get_where('settings',array('type'=>'exam_date'))->row()->description;
$time = $this->db->get_where('settings',array('type'=>'exam_time'))->row()->description;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
    
        <meta http-equiv="Content-Type" content="charset=UTF-8" />
        <style>
		.admitCard:after {
                content: '';
                z-index: -1;
                opacity: 0.2;
                background-size: 220px 225px;
                background-repeat: no-repeat;
                background-image: url("assets/images/logo.jpg");
                width: 220px;
                height: 225px;
                position: absolute;
                margin-top: -280px;
                display: inline-block;
                left: 320px;
            }
            
		</style>
        

    </head><body onload="window.print()" style="margin: auto 5%;"><div style="">
            <div style="width: 100%; padding-top: 50px;">
                <!--<div class="blnk-space"></div>-->
                <div class="hdr">
                    <div style="width: 100%; height: 200px">
                        <div style="float: left; width: 15%; text-align: center">
                            <img src="assets/images/logo.jpg" width="100px" height="115px">
                            <div style="margin-top: 15px;"> Serial No: <?php echo $id;?></div>
                        </div>
                        <div style="float: left; width: 65%; text-align: center; line-height: 15px">
                            <h2 class="ex" style='color: green;'>Homna Adarsha High School</h2>
                            <h3 style='color: green;'>Homna, Comilla</h3>
                            <p>EIIN: 105673, Email: hahs105673@gmail.com</p>
                            <p style="margin-bottom:10px;">Phone: 08025-54244 / 01705 100106</p>
                            <p style="font-size: 18px; width: 150px; padding: 10px; background-color: green; text-align: center; margin: 0 auto; color: white; border: 1px solid black;">Admission Form</p>
                        </div>
                        <div style="float: right; width: 20%; text-align: center">
                            <img src="assets/<?php echo $img;?>" width="115px" height="125px" style="border: 1px solid;padding: 2px">
                        </div>
                    </div>
                    <div class="office-part" style="position: relative; line-height: 16px;">
                        <img src="assets/images/logo.jpg" style="
                             position: absolute;
                             overflow: hidden;
                             z-index: -1;
                             opacity: .2;
                             left: 320px;
                             top: 125px;
                             width: 220px;
                             height: 225px;
                             ">
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Student Name : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $name;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Student Name (Bangla): </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $namebn;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Father's Name : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $fname;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Father's Name (Bangla): </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $fnamebn;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Mother's Name : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $mname;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Mother's Name (Bangla): </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $mnamebn;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Present Address : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $paadress;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Permanent Address : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $praddress;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Religion : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $religion;?></p></div>
                        </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Nationality : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $nationality;?></p></div>
                        </div>
                        <?php if(!empty($lguaridan)):?>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Legal Guardian : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $lguaridan;?></p></div>
                    </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Relation : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $relaguardian;?></p></div>
                    </div>
                        <?php endif;?>
                        <?php if(!empty($email)):?>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Email : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $email;?></p></div>
                    </div>
                        <?php endif;?>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Applied Class : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $class==91?'9 Vocational': $class;?></p></div>
                    </div>
                        <?php if(!empty($group)): $jsc = explode(',', $jscinfo);?>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Group : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo ucfirst($group);?></p></div>
                    </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">JSC Information : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><span style="font-weight: bold;">GPA: </span><?php echo $jsc[3]?>, <span style="font-weight: bold;">Reg No: </span><?php echo $jsc[1]?>, <span style="font-weight: bold;">Roll No:</span> <?php echo $jsc[2]?>, <span style="font-weight: bold;">Year: </span><?php echo $jsc[0]?></p></div>
                    </div>
                        <?php endif;?>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Previous School Name: </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $preschoolname;?></p></div>
                    </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Previous School Address : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $preschooladd;?></p></div>
                    </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Date of Birth : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo date("d-m-Y", strtotime($date));?></p></div>
                    </div>
                        <div style="border-bottom: 1px solid; border-bottom-style:dashed; font-size: 20px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Guardian Mobile No : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $mobile;?></p></div>
                    </div>


                    </div>
                    <div class="commitment-container" style="margin-top: 40px;width: 100%;border-bottom: 1px solid gray;font-size: 20px;line-height: 10px;height: 230px;">
                        <h3 style="width: 30%; text-align: center; border-bottom: 1px solid; margin: 0 auto; padding: 10px 0px; font-size: 22px; margin-top: 10px;color: green;">Commitment Letter</h3>
                        <p style="text-align: center; margin: 10px 0px">I am committed to that, I will obey this school rules. Otherwise school authority's decision shall be deemed final.</p>
                        <p style="width: 70%; display: inline-block; margin-top: 30px;">Guardian sign: <br><br><br>Date:</p>
                        <p style="display: inline-block;margin-top: 30px">Student Sign: <br><br><br>Date: </p>

                    </div>
                    <div style="line-height: 10px; font-size: 20px; height: 350px;">
                        <h3 style="width: 30%;text-align: center;border-bottom: 1px solid;margin: 0 auto;padding-bottom: 10px;padding-top: 5px;font-size: 22px;margin-top: 10px;color: green;">For Office Use</h3>
                        <p style="margin-left: 15px">After taking exam this student considered fit for class ....................... </p>
                        <p style="margin-left: 15px">Information Checker teacher's name ......................................................... , Date ..........................................</p>
                        <p style="margin-left: 15px">The Head Teacher's orders to admit .......................................................... in class ..........................................</p>
                        <p style="margin-left: 15px">Admission No in Register : </p>
                        <p style="margin-left: 15px">Class Roll No : </p>
                    </div>
                    
					
					
					<!-- ADMIT CARD PORTION -->
					
                    <div style="padding-top: 50px; height: 700px;">
                        <div style="width: 100%; padding-top: 50px;">
                        <div style="float: left; width: 15%; text-align: center">
                            <img src="assets/images/logo.jpg" width="100px" height="115px">
                            <div style="margin-top: 15px;"> Serial No: <?php echo $id;?></div>
                        </div>
                        <div style="float: left; width: 65%; text-align: center; line-height: 15px">
                            <h2 class="ex" style='color: green;'>Homna Adarsha High School</h2>
                            <h3 style='color: green;'>Homna, Comilla</h3>
                            <p>EIIN: 105673, Email: hahs105673@gmail.com</p>
                            <p style="margin-bottom:10px;">Phone: 08025-54244 / 01705 100106</p>
                            <p style="font-size: 18px; width: 240px; padding: 10px; background-color: green; text-align: center; margin: 0 auto; color: white; border: 1px solid black;">Admit Card of Admission Exam</p>
                        </div>
                        <div style="float: right; width: 20%; text-align: center">
                            <img src="assets/<?php echo $img;?>" width="115px" height="125px" style="border: 1px solid;padding: 2px">
                        </div>
                    </div><br/>
                    <br/>
                    <br/>
                    
                        
                    <div class="admitCard" style="height: 350px; margin-top: 145px !important;">
					
                        <div style="border-bottom: 1px dashed !important; font-size: 20px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Student Name : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $name;?></p></div></div>
                        <div style="border-bottom: 1px dashed !important; font-size: 20px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Father's Name : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $fname;?></p></div></div>
                        <div style="border-bottom: 1px dashed !important; font-size: 20px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Applied For Class : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $class==91?'9 Vocational': $class;?></p></div></div>
                        <div style="border-bottom: 1px dashed !important; font-size: 20px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Group : </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo ucfirst($group);?></p></div></div>
                        <div style="border-bottom: 1px dashed !important; font-size: 20px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Admission Exam Date: </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $examdate.' '.!empty($examdate)?date("Y"):'';?></p></div></div>
                        <div style="border-bottom: 1px dashed !important; font-size: 20px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Admission Exam Time: </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $time;?></p></div></div>
                        <div style="border-bottom: 1px dashed !important; font-size: 20px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Admission Exam Marks: </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo 'Bangla 30 + English 30 + Math 40 = 100.';?></p></div></div>
                        <div style="border-bottom: 1px dashed !important; font-size: 20px; margin-bottom: 5px;"><div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 250px;display:inline-block;margin: 2px 0;color: green;">Admission Exam Roll: </p> <p style="font-weight: normal; margin: 2px 0; display: inline-block; width: 650px;"><?php echo $id;?></p></div></div>
                    </div>
                    <div style="width: 100%; height: 230px; margin-top: 45px;">
                        <div style="float: left; width: 15%; text-align: center">
                          <p style="border-top: 1px solid gray; border-width: 2px;">Office Seal</p>
                        </div>
                        <div style="float: left; width: 65%; text-align: center; line-height: 15px">
                        </div>
                        <div style="float: right; width: 20%; text-align: center">
                            <p style="border-top: 1px solid gray; border-width: 2px;">Headteacher Sign</p>
                        </div>
                    </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </body></html>