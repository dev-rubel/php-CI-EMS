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
        min-height: 230px !important;
        margin-bottom: 25px;
    }

    .title.text-center p {
        font-size: 11px;
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

    .span2 {
        width: 30%;
        padding: 0;
        float: left;
        font-size: 13px;
    }

    .span3 {
        width: 70%;
        margin: 0 auto;
    }

    .principal-sign {
        font-size: 11px;
        border-top: 1px dotted;
        padding: 3px !important;
        margin-top: 8px !important;
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
        background-position: center 60px !important;
        background-size: 130px 130px !important;
        position: relative;
        color: #2e3436;
        /* width: 400px; */
        height: 230px;
        font-size: 20px;
        border-bottom: 2px solid #d3d7df;
        /* margin-top: 5%; */
        letter-spacing: 1px;
    }

    .school-card .title,
    .school-card-back .title {
        background: url('http://www.vector-eps.com/wp-content/gallery/great-solid-textures/great-solid-texture1.jpg') !important;
        color: #fff !important;
        height: 42px;
        padding: 1px;
        font-weight: bold;
        font-size: 12px !important;
    }

    .school-card .content,
    .school-card-back .content {
        font-weight: bold;
        padding: 15px;
    }

    .school-card .avatar {
        float: right;
        max-width: 100px;
        max-height: 100px;
        box-shadow: 0 0 1px 1px #777 !important;
        border-radius: 3px !important;
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
    <!-- CARD START -->
    <!-- CARD FRONT SIDE START -->
    <div class="col-xs-6 each-card">        
        <div class="school-card centered">
            <!-- CARD HEADER -->
            <div class="title text-center">
                <?php echo ucwords($schoolName); ?><br> 
                <p><?php echo $schoolAddress; ?></p>                    
            </div>
            <!-- STUDENT INFORMATION -->
            <div class="content span1">
                Name: <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->name; ?>
                <br>
                Father: <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->fname; ?>
                <br>
                Class: <?php echo $this->db->get_where('class',['class_id'=>$each['class_id']])->row()->name; ?><br />
                <span class="finer-print">
                <?php if($each['group_id'] != 0): ?>
                    Group: <?php $groupName = $this->db->get_where('group',['group_id'=>$each['group_id']])->row()->name; echo strtoupper($groupName); ?><br />
                <?php endif; ?>
                Roll: <?php echo $each['roll']; ?><br />
                Phone: <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->mobile; ?><br />                
                Student ID: <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->student_code; ?><br />                
                </span>
            </div>
            <!-- STUDENT IMAGE -->
            <div class="content span2">
                <img src="<?php echo $this->crud_model->get_image_url('student',$student_id); ?>" alt="avatar" class="avatar" />                    
            </div>
            <!-- BOTTOM LEFT BLANK -->
            <div class="content span1"></div>
            <!-- SIGN SECTION -->
            <div class="content text-right principal-sign span2">
                <p>Principal Sign</p>
            </div>
            <!-- CARD FOOTER -->
            <div class="footer"></div>
        </div>
    </div>
    <!-- CARD FRONT SIDE END -->

    <!-- CARD BACK SIDE START -->
    <div class="col-xs-6 each-card">        
        <div class="school-card-back centered">
            <!-- CARD HEADER -->
            <div class="title text-center">
                <br><br>                 
            </div>
            <div class="content span3 text-center">
                <h5>Don’t say you don’t have enough time. You have exactly the same number of hours per day that were given to Helen Keller, Pasteur, Michelangelo, Mother Teresea, Leonardo da Vinci, Thomas Jefferson, and Albert Einstein. <br> – H. Jackson Brown Jr.</h5>
            </div>
            <!-- CARD FOOTER -->
            <div class="footer"></div>
        </div>
    </div>
    <!-- CARD BACK SIDE END -->
    <!-- CARD END -->

<?php endforeach; ?>    
</div>