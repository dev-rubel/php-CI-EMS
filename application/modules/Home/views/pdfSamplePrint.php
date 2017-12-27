<?php

$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
list($schoolName,$schoolAddress,$eiin,$schoolEmail,$phone) = explode('+', $schoolInfo);

$exDate = $this->db->get_where('settings',array('type'=>'admission_exam_date'))->row()->description;
$time = $this->db->get_where('settings',array('type'=>'admission_exam_time'))->row()->description;
$examMark = $this->db->get_where('settings',array('type'=>'admission_exam_mark'))->row()->description;
$admission_session = $this->db->get_where('settings' , array('type' => 'admission_session'))->row()->description;

$base = base_url().'uploads/';

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
                        <div style="margin-top: 15px;"> Serial No:
                            <?php echo substr($uniq_id, -4); ?>
                        </div>
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
                        <p style="font-size: 13px; width: 150px; padding: 10px; background-color: green; text-align: center; margin: 0 auto; color: white; border: 1px solid black;">Admission Form</p>
                    </div>
                    <div style="float: right; width: 20%; text-align: center">
                        
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
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Student Name (Bangla): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 14px;">
                                    
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Fathers Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Fathers Name (Bangla): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 14px;">
                                    
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Mothers Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                   
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Mothers Name (Bangla):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 14px;">
                                   
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Present Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                   
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Permanent Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                  
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Religion : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                   
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Nationality : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                 
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                   
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Applied Class : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                  
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
  <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Group : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: normal; color: black; font-size: 12px;"></span></p> </div>
    </div> 
    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
        <div style="margin-bottom: 4px; font-weight: bold;"><p style="width: 650px;display:inline-block;margin: 2px 0;color: green;">JSC Information : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:normal; font-style: italic; font-size: 12px;">GPA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, Reg No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, Roll No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, Year: </span></p>  </div>
        </div>
                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Previous School Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                   
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px dotted !important; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Previous School Address : &nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                  
                                </span>
                            </p>
                        </div>
                    </div>

                    <div style="border-bottom: 1px solid; border-bottom-style:dotted; font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Date of Birth : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                    
                                </span>
                            </p>
                        </div>
                    </div>
                    <div style="font-size: 13px; margin-bottom: 5px;">
                        <div style="margin-bottom: 4px; font-weight: bold;">
                            <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Guardian Mobile No : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="font-weight: normal; color: black; font-size: 12px;">
                                 
                                </span>
                            </p>
                        </div>
                    </div>


                </div>
                <div class="commitment-container" style="margin-top: 10px;width: 100%;border-bottom: 1px solid gray;font-size: 12px;line-height: 10px;height: 130px;">
                    <h3 style="width: 30%; text-align: center; border-bottom: 1px solid; margin: 0 auto; padding: 10px 0px; font-size: 13px; margin-top: 10px;color: green;">Commitment Letter</h3>
                    <p style="text-align: center; margin: 10px 0px">I am committed to that, I will obey this school rules. Otherwise school authoritys decision shall be
                        deemed final.</p>
                    <p style="width: 100%; display: inline-block; margin-top: 20px;">&nbsp;&nbsp;&nbsp;Guardian sign: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student
                        Sign:
                        <br>
                        <br>
                        <br>&nbsp;&nbsp;&nbsp;Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:</p>

                </div>
                <div style="line-height: 5px; font-size: 12px; height: 150px;">
                    <h3 style="width: 30%;text-align: center;border-bottom: 1px solid;margin: 0 auto;padding-bottom: 10px;padding-top: 5px;font-size: 13px;margin-top: 10px;color: green;">For Office Use</h3>
                    <p style="margin-left: 15px">After taking exam this student considered fit for class ....................... </p>
                    <p style="margin-left: 15px">Information Checker teachers name ......................................................... , Date ..........................................</p>
                    <p style="margin-left: 15px">The Head Teachers orders to admit .......................................................... in class
                        ..........................................
                    </p>
                    <p style="margin-left: 15px">Admission No in Register : </p>
                    <p style="margin-left: 15px">Class Roll No : </p>

                </div>
                <p style="position: absolute; bottom: 0; margin-left: 300px; width: 100%;">Page No:
                    <?php echo 1;?>
                </p>


                <!-- ADMIT CARD PORTION -->

                <div style="padding-top: 10px; height: 500px;">
                    <div style="width: 100%; padding-top: 0px;">
                        <div style="float: left; width: 15%; text-align: center">
                            <img src="<?php echo $base.'school_logo.png' ;?>" width="100px" height="100px">
                            <div style="margin-top: 15px;"> Serial No:
                                <?php echo substr($uniq_id, -4); ?>
                            </div>
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
                            <p style="font-size: 13px; width: 240px; padding: 10px; background-color: green; text-align: center; margin: 0 auto; color: white; border: 1px solid black;">Admit Card of Admission Exam</p>
                        </div>
                        <div style="float: right; width: 20%; text-align: center">
                           
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <br/>


                    <div class="admitCard" style="height: 350px;">
                        <img src="<?php echo $base.'school_logo.png';?>" style="
                             opacity: .1;
                             margin-left: 210px;
                             margin-top: 0px;
                             width: 220px;
                             height: 225px;
                             " />
                        <div style="margin-top: -250px; border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Student Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                    
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Fathers Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                      
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Applied For Class : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                       
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Group : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                        
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Admission Exam Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                        <?php echo !empty($exDate)?$exDate.' '.date("Y"):'';?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Admission Exam Time: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                        <?php echo $time;?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Admission Exam Marks: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                        <?php echo $examMark;?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Admission Exam Roll: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                       
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%; height: 150px; margin-top: 0px;">
                        <div style="float: left; width: 15%; text-align: center">
                            <p style="border-top: 1px solid gray; border-width: 2px;">Office Seal</p>
                        </div>
                        <div style="float: left; width: 65%; text-align: center; line-height: 15px">
                        </div>
                        <div style="float: right; width: 20%; text-align: center">
                            <p style="border-top: 1px solid gray; border-width: 2px;">Headteacher Sign</p>
                        </div>
                    </div>

                    <div class="officeRecord" style="height: 200px;">
                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Form Number : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                       
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                     
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Father's Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                       
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                      
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">Mobile Number : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                       
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div style="border-bottom: 1px dotted !important; font-size: 12px; margin-bottom: 5px;">
                            <div style="margin-bottom: 4px; font-weight: bold;">
                                <p style="width: 100%;display:inline-block;margin: 2px 0;color: green;">ID : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span style="font-weight: normal; color: black; font-size: 12px;">
                                      
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <p style="position: absolute; bottom: 0; margin-left: 300px; width: 100%;">Page No:
                        <?php echo 2;?>
                    </p>

                </div>
            </div>
        </div>
        </div>
    </body>

    </html>