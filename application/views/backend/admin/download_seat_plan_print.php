<?php
extract($std_info);
//pd($info);
$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
list($schoolName,$schoolAddress,$eiin,$schoolEmail,$phone) = explode('+', $schoolInfo);

$base = base_url().'uploads/';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<style media="all">
    @import url('https://fonts.googleapis.com/css?family=Oswald');
    html {
    font-family: 'Oswald', sans-serif !important;
    line-height: 23px;
    }

    .each-card {
        min-height: 250px !important;
        padding-bottom: 25px;
        border-bottom: 2px dashed;
        padding-top: 25px;
    }
    
    .title h5 {
        font-size: 12px !important;
        color: #fff !important;
        padding: 2px 0px;
        margin: 0;
    }
    
    .title h6 {
        font-size: 11px !important;
        color: #fff !important;
        font-weight: bold;
        padding: 2px 0px;
        margin: 0;
    }

    .title.text-center p {
        font-size: 11px !important;
        color: #fff !important;
    }


    .principal-sign, .teacher-sign {
        font-size: 11px;
        border-top: 1px dotted;
        padding: 3px !important;
    }

    .principal-sign p {
        margin: 0px;
        padding: 0px;
    }

    .school-card {
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.7) 100%), url(bg.png) repeat 0 0 !important, url('<?php echo base_url();?>uploads/school_logo.png') repeat 0 0 !important;
        background: -moz-linear-gradient(top, rgba(255,255,255,0.7) 0%, rgba(255,255,255,0.7) 100%), url('<?php echo base_url();?>uploads/school_logo.png') repeat 0 0 !important;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.7)), color-stop(100%,rgba(255,255,255,0.7))), url('<?php echo base_url();?>uploads/school_logo.png') repeat 0 0 !important;
        background: -webkit-linear-gradient(top, rgba(255,255,255,0.7) 0%,rgba(255,255,255,0.7) 100%), url('<?php echo base_url();?>uploads/school_logo.png') repeat 0 0 !important;
        background: -o-linear-gradient(top, rgba(255,255,255,0.7) 0%,rgba(255,255,255,0.7) 100%), url('<?php echo base_url();?>uploads/school_logo.png') repeat 0 0 !important;
        background: -ms-linear-gradient(top, rgba(255,255,255,0.7) 0%,rgba(255,255,255,0.7) 100%), url('<?php echo base_url();?>uploads/school_logo.png') repeat 0 0 !important;
        background: linear-gradient(to bottom, rgba(255,255,255,0.7) 0%,rgba(255,255,255,0.7) 100%), url('<?php echo base_url();?>uploads/school_logo.png') repeat 0 0 !important;
        background-repeat: no-repeat !important;
        background-position: center 70px !important;
        background-size: 80px 80px !important;
        position: relative;
        color: #2e3436;
        /* width: 400px; */
        height: 205px;
        font-size: 20px;
        border-bottom: 2px solid #d3d7df;
        /* margin-top: 5%; */
        letter-spacing: 1px;
    }

    .school-card .title,
    .school-card-back .title {
        background: url('http://www.vector-eps.com/wp-content/gallery/great-solid-textures/great-solid-texture1.jpg') !important;
        color: #fff !important;
        height: 40px;
        padding: 1px;
        font-weight: bold;
        font-size: 11px !important;
        letter-spacing: 0px !important;
    }


    .school-card .avatar {
        float: right;
        width: 90px !important;
        height: 100px !important;
        box-shadow: 0 0 1px 1px #777 !important;
        border-radius: 3px !important;
    }

    .std-info {
        font-size: 12px !important;
        padding: 10px;
    }


    .school-card .footer,
    .school-card-back .footer {
        background: url('http://www.vector-eps.com/wp-content/gallery/great-solid-textures/great-solid-texture1.jpg') !important;
        font-weight: bold;
        color: #fff !important;
        position: absolute;
        text-align: center;
        bottom: 1px;
        font-size: 11px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-top: 1px solid;
        width: 100%;
        letter-spacing: 1px;
    }

    .roll-box {
        text-align: center;
        font-weight: bold;
        font-size: 20px;
    }
    .roll-box p{
        margin: 0;
    }
    .roll-box .roll {
        border: 2px dotted;        
        padding: 5px !important;
        font-size: 28px !important;        
    }
</style>

<div class="row full-page">
<?php 

foreach($std_info as $k=>$each):
?>
    <!-- ADMIT CARD START -->
    <!-- ADMIT CARD FRONT SIDE START -->
    <div class="col-xs-4 each-card">        
        <div class="school-card centered">
            <!-- ADMIT CARD HEADER -->
            <div class="title text-center">
                <h5><?php echo ucwords($schoolName); ?></h5> 
                <h6>Exam: <?php echo $this->db->get_where('exam',['exam_id'=>$exam_id])->row()->name; ?></h6> 
                <!-- <p>Student ID: <?php //echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->student_code; ?></p>                     -->
            </div>
            <!-- STUDENT INFORMATION -->
            <div class="row std-info">
                <div class="col-xs-6">
                    Class: <?php echo $this->db->get_where('class',['class_id'=>$each['class_id']])->row()->name; ?>
                    <br />       
                    Section: <?php echo $this->db->get_where('section',['section_id'=>$each['section_id']])->row()->name; ?>
                    <br />                             
                    Shift: <?php echo $this->db->get_where('shift',['shift_id'=>$each['shift_id']])->row()->name; ?>
                    <br />                             
                    <?php if($each['group_id'] != 0): ?>
                        Group: <?php $groupName = $this->db->get_where('group',['group_id'=>$each['group_id']])->row()->name; echo strtoupper($groupName); ?>
                        <br />
                    <?php endif; ?>
                    Year: <?php echo date('Y'); ?> 
                </div>
                <div class="col-xs-2"></div>
                <div class="col-xs-4">
                    <div class="roll-box">
                        <p>Roll</p>
                        <p class="roll"><?php echo $each['roll']; ?></p>
                    </div>
                </div>
            </div>

            <!-- SIGN SECTION -->
            <div class="row">
                <div class="col-xs-4"></div>
                <div class="col-xs-4"></div>
                <div class="col-xs-4"></div>
            </div>
            
            <!-- ADMIT CARD FOOTER -->
            <div class="footer"><?php //echo $schoolAddress; ?></div>
        </div>
    </div>
    <!-- ADMIT CARD FRONT SIDE END -->

    <!-- ADMIT CARD END -->

<?php endforeach; ?>    
</div>