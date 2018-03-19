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
        min-height: 300px !important;
        padding-bottom: 25px;
        border-bottom: 2px dashed;
        padding-top: 25px;
    }

    .school-card {
        min-height: 300px !important;
    }
    
    .title h5 {
        font-size: 22px !important;
        color: #fff !important;
        padding: 2px 0px;
        margin: 0;
    }
    
    .title h6 {
        font-size: 18px !important;
        color: #fff !important;
        font-weight: bold;
        padding: 2px 0px;
        margin: 0;
    }

    .title.text-center p {
        font-size: 11px !important;
        color: #fff !important;
    }

    .finer-print {
        font-size: 13px;
    }

    .span1 {
        width: 70%;
        padding: 0;
        float: left;
        font-size: 13px;
    }

    .span1-1 {
        width: 35%;
    }

    .span1-2 {
        width: 30%;
    }

    .span1-1,
    .span1-2 {
        padding: 0;
        float: left;
        font-size: 13px;
        letter-spacing: 0px;
    }

    .span2 {
        width: 35%;
        padding: 0;
        float: left;
        font-size: 13px;
    }

    .content.span1,
    .content.span1-1,
    .content.span1-2,
     {
        letter-spacing: -0.5px;
        min-height: 68px;
        padding-bottom: 0;
    }

    .span3 {
        width: 80%;
        margin: 0 auto;
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
        background-size: 130px 130px !important;
        position: relative;
        color: #2e3436;
        /* width: 400px; */
        height: 300px;
        font-size: 20px;
        border-bottom: 2px solid #d3d7df;
        /* margin-top: 5%; */
        letter-spacing: 1px;
    }

    .school-card .title,
    .school-card-back .title {
        background: url('http://www.vector-eps.com/wp-content/gallery/great-solid-textures/great-solid-texture1.jpg') !important;
        color: #fff !important;
        height: 55px;
        padding: 1px;
        font-weight: bold;
        font-size: 12px !important;
    }

    .school-card .content,
    .school-card-back .content {
        font-weight: bold;
        padding: 15px;
        height: 175px;
        padding-bottom: 0 !important;
    }

    .school-card .avatar {
        float: right;
        width: 85px !important;
        height: 95px !important;
        box-shadow: 0 0 1px 1px #777 !important;
        border-radius: 3px !important;
    }

    .school-card .qrcode {
        margin-right: 15px !important;
    }

    .school-card .footer,
    .school-card-back .footer {
        background: url('http://www.vector-eps.com/wp-content/gallery/great-solid-textures/great-solid-texture1.jpg') !important;
        font-weight: bold;
        color: #fff !important;
        position: absolute;
        text-align: center;
        bottom: 1px;
        font-size: 12px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-top: 1px solid;
        width: 100%;
        letter-spacing: 1px;
    }
</style>

<div class="row full-page">
<?php 

foreach($std_info as $k=>$each):
?>
    <!-- ADMIT CARD START -->
    <!-- ADMIT CARD FRONT SIDE START -->
    <div class="col-xs-12 each-card">        
        <div class="school-card centered">
            <!-- ADMIT CARD HEADER -->
            <div class="title text-center">
                <h5><?php echo ucwords($schoolName); ?></h5> 
                <h6>Admit Card</h6> 
                <!-- <p>Student ID: <?php //echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->student_code; ?></p>                     -->
            </div>
            <!-- STUDENT INFORMATION -->
            <div class="content span1-1">
                Name: <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->name; ?>
                <br>
                Father: <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->fname; ?>
                <br>
                Roll: <?php echo $each['roll']; ?><br />                
                Section: <?php echo $this->db->get_where('section',['section_id'=>$each['section_id']])->row()->name; ?><br />                
                <span class="finer-print">
                <?php if($each['group_id'] != 0): ?>
                    Group: <?php $groupName = $this->db->get_where('group',['group_id'=>$each['group_id']])->row()->name; echo strtoupper($groupName); ?><br />
                <?php endif; ?>                
                Shift: <?php echo $this->db->get_where('shift',['shift_id'=>$each['shift_id']])->row()->name; ?><br />                
                
                Phone: <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->mobile; ?><br />                
                
                
                </span>
            </div>
            <div class="content span1-2">
                <?php if($each['group_id'] != 0): ?>
                    <br>
                <?php endif; ?>
                <br>
                <br>
                <br>
                Class: <?php echo $this->db->get_where('class',['class_id'=>$each['class_id']])->row()->name; ?>
                <br />
                Year: <?php echo date('Y'); ?>
                <br>
                Exam Name: <?php echo $this->db->get_where('exam',['exam_id'=>$exam_id])->row()->name; ?>                
                </span>
            </div>
            <!-- STUDENT IMAGE -->
            <div class="content span2">
                <img src="<?php echo $this->crud_model->get_image_url('student',$each['student_id']); ?>" alt="qrcode" class="avatar" />                    
                <img src="<?php echo base_url().'uploads/qrcode/'.$each['student_id'].'.png'; ?>" alt="avatar" class="avatar qrcode" />                    
            </div>
            <!-- BOTTOM LEFT BLANK -->
            <!-- SIGN SECTION -->
            <div class="row">
                <div class="col-xs-4">
                    <div class="text-left teacher-sign">
                        <p>Teacher Sign</p>
                    </div>
                </div>
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                    <div class="text-right principal-sign">
                        <p>Principal Sign</p>
                    </div>
                </div>
            </div>
            
            <!-- ADMIT CARD FOOTER -->
            <div class="footer"><?php echo $schoolAddress; ?></div>
        </div>
    </div>
    <!-- ADMIT CARD FRONT SIDE END -->

    <!-- ADMIT CARD END -->

<?php endforeach; ?>    
</div>