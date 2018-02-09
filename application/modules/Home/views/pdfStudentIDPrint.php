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
        margin-top: 3% !important;
    }

    .centered {
    /* margin: 0 auto; */
    }

    .finer-print {
    font-size: 13px;
    }

    .span2 {
    width: 50%;
    padding: 0;
    float: left;
    font-size: 16px;
    }

    .business-card {
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

    .business-card .title {
    background: url('http://www.vector-eps.com/wp-content/gallery/great-solid-textures/great-solid-texture1.jpg') !important;
    color: #fff !important;
    height: 42px;
    padding: 10px;
    font-weight: bold;
    font-size: 18px !important;
    }

    .business-card .content {
    font-weight: bold;
    padding: 15px;
    }

    .business-card .avatar {
    float: right;
    max-width: 100px;
    max-height: 100px;
    box-shadow: 0 0 1px 1px #777 !important;
    border-radius: 3px !important;
    }

    .business-card .footer {
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
    <div class="col-xs-6 each-card">
        <!-- CARD START -->

            <div class="business-card centered">
                <div class="title">
                    <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->name; ?>
                </div>
                <div class="content span2">
                    Class: <?php echo $this->db->get_where('class',['class_id'=>$each['class_id']])->row()->name; ?><br />
                    <span class="finer-print">
                    <?php if($each['group_id'] != 0): ?>
                        Group: <?php $groupName = $this->db->get_where('group',['group_id'=>$each['group_id']])->row()->name; echo strtoupper($groupName); ?><br />
                    <?php endif; ?>
                    Roll: <?php echo $each['roll']; ?><br />
                    Phone: <?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->mobile; ?><br />
                    </span>
                </div>
                <div class="content span2">
                    <img src="<?php echo base_url();?>uploads/student_image/<?php echo $each['student_id']?>.jpg" alt="avatar" class="avatar" />
                </div>
                <div class="footer">
                    <?php echo ucwords($schoolName); ?>
                </div>
            </div>


        <!-- CARD END -->
    </div>

<?php endforeach; ?>    
</div>