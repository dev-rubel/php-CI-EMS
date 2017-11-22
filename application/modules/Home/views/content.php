<?php
//pd($contentInfo);
$Hmsg = $this->db->get_where('frontpages', array('track_name' => 'headmasterMsg'))->row();
$Cmsg = $this->db->get_where('frontpages', array('track_name' => 'chairmanMsg'))->row();
$Shistory = $this->db->get_where('frontpages', array('track_name' => 'schoolHistory'))->row();

// $sHistory = explode('+', $contentInfo['textInfo']['school_history']);
// $msg1History = explode('+', $contentInfo['textInfo']['msg1']);
// $msg2History = explode('+', $contentInfo['textInfo']['msg2']);
?>
<style>

    .container{padding: 0px;}
	.mu-ourteacher-single-content img{
		max-width: 200px;
		max-height: 200px;
	}
</style>
<div class="container" style="border: 1px solid white;border-bottom: 0px; border-top: 0px;box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75); padding-left: 5px;padding-right: 5px;">
    <div class="row">
        <div class="col-md-8">
		<?php echo flash_msg();?>
            <div class="main-slideshow wow rollIn" data-wow-duration="3s">
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                        if (!empty($contentInfo['sliderInfo'])):
                            foreach ($contentInfo['sliderInfo'] as $list): $info = explode('+', $list['info']);
                                ?>
                                <li> <img src="assets/images/slider_image/<?php echo $list['img_name']; ?>" />
                                    <div class="slider-caption">
                                        <h2><a href="blog-single.html"><?php echo $info[0]; ?></a></h2>
                                        <!--<p><?php //echo $info[1]; ?></p>-->
                                    </div>
                                </li>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <li> <img src="assets/images/dummyIMG/slider_img.png" />
                                <div class="slider-caption">
                                    <h2><a href="blog-single.html">Slider</a></h2>
                                    <p>Slider1</p>
                                </div>
                            </li>
<?php endif; ?>
                    </ul>
                    <!-- /.slides -->
                </div>
                <!-- /.flexslider -->
            </div>
            <!-- /.main-slideshow -->

        </div>
        <!-- /.col-md-12 -->
        <div class="col-md-4">

            <div class = "panel notice-panel panel-default wow flipInY text-center" data-wow-duration="3s">
                <div class = "panel-body">
                    নোটিস
                </div>
            </div>
            <div class="notice widget-item wow flipInY" data-wow-duration="3s">
                <div class="notice-inner widget-inner">
                    <marquee direction="up" scrollamount="1" height="325" height="300" onmouseover="this.stop();" onmouseout="this.start();">
<?php
if (!empty($contentInfo['noticeInfo'])):
    foreach ($contentInfo['noticeInfo'] as $list):
        $link = base('Home', 'noticeView/' . $list['id']);
        ?>
                                <div class="box text-center">
                                    <h4><a href="<?php echo base('Home', 'noticeView/' . $list['id']); ?>"><?php echo $list['title']; ?></a></h4>
                                    <p><?php echo mb_substr($list['description'],0,200, "utf-8").".....<a href='$link'>বিস্তারিত</a>"; ?></p>
                                    <hr>
                                </div>
        <?php
    endforeach;
else:
    ?>
                            <div class="box text-center">
                                <h4><a href="#"><?php echo lnguag('Academic'); ?>Title</a></h4>
                                <p><?php echo lnguag('Academic'); ?>Description</p>
                                <hr>
                            </div>
<?php endif; ?>
                    </marquee>
                </div>
            </div>
        </div>
        <!-- /.col-md-4 -->
    </div>
</div>

<div class="container" style="border: 1px solid white;border-top: 0px;border-bottom: 0px;box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.75);padding-left: 5px;padding-right: 5px;padding-bottom: 25px;">
    <div class="row">
        <div class="col-md-4">
            <div class = "panel panel-default text-center wow flipInY" data-wow-duration="3s">
                <div class = "panel-body">
<?php echo lnguag($Cmsg->title); ?>
                </div>
            </div>
            <div class="widget-item wow flipInY" data-wow-duration="3s">
                <div class="mu-our-teacher-single" style="text-align:center;">
                    <div class="mu-ourteacher-single-content">
                        <p>
<?php
//$string = (strlen($msg1History[1]) > 150) ? substr($msg1History[1],0,120)."<a href='index.php?Home/massageDetails/msg1'>... See More</a>" : $msg1History[1]; echo $string;      
$CPagename = $Cmsg->track_name;
echo strtok($Cmsg->description, '@@') . '<a href="index.php?Home/massageDetails/' . $CPagename . '"' . '>See More</a>';
?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class = "panel panel-default wow flipInY text-center" data-wow-duration="3s">
                <div class = "panel-body">
                        <?php echo lnguag($Hmsg->title); ?>
                </div>
            </div>
            <div class="widget-item wow flipInY" data-wow-duration="3s">
                <div class="mu-our-teacher-single" style="text-align:center;">

                    <div class="mu-ourteacher-single-content">
<?php
//$string = (strlen($Hmsg->description) > 300) ? substr($Hmsg->description,0,280)."<a href='index.php?Home/massageDetails/msg1'>... See More</a>" : $Hmsg->description; echo $string;
$HPagename = $Hmsg->track_name;
echo strtok($Hmsg->description, '@@') . '<a href="index.php?Home/massageDetails/' . $HPagename . '"' . '>See More</a>';
?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class = "panel panel-default wow flipInY text-center" data-wow-duration="3s">
                <div class = "panel-body">
                    গুরুত্বপূর্ন লিংক
                </div>
            </div>
            <div class="widget-item wow flipInY" data-wow-duration="3s">
                <div class="mu-our-teacher-single" style="text-align:left;">
                    <div class="mu-ourteacher-single-content">
                        <div class="list-group">
                            <?php
                            if (!empty($contentInfo['linkInfo'])):
                                foreach ($contentInfo['linkInfo'] as $list):
                                    ?>
                                    <a href="<?php echo $list['link']; ?>" class="hvr-bounce-to-right" target="_blank"><?php echo $list['title']; ?></a>
        <?php
    endforeach;
else:
    ?>
                                <a href="#" class="hvr-bounce-to-right">Important Link</a>
<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Here begin Main Content -->
        <div class="col-md-8">
            <div class = "panel panel-default wow flipInY text-center" data-wow-duration="3s">
                <div class = "panel-body">
                        <?php echo lnguag($Shistory->title); ?>
                </div>
            </div>
            <div class="row wow flipInY" data-wow-duration="3s">
                <div class="col-md-12">
                    <div class="widget-item">        
<?php
//$string2 = (strlen($sHistory[1]) > 3100) ? substr($sHistory[1],0,2800)."<a href='index.php?Home/massageDetails/school_history'>... See More</a>" : $sHistory[1]; echo $string2;
$SPagename = $Shistory->track_name;
echo strtok($Shistory->description, '@@') . '<a href="index.php?Home/massageDetails/' . $SPagename . '"' . '>See More</a>';
?>
                    </div>
                    <!-- /.widget-item -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col-md-8 -->
        <!-- Here begin Sidebar -->
        <div class="col-md-4">
            <div class = "panel panel-default wow flipInY text-center" data-wow-duration="3s">
                <div class = "panel-body">
                    দ্রুত যোগাযোগ
                </div>
            </div>
            <div class="widget-item wow flipInY" data-wow-duration="3s">
                <form action="<?php echo base('Home', 'contact_mail') ?>" method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="description" placeholder="Your Message" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.widget-main -->
        </div>
    </div>
</div>

<?php if ($contentInfo['textInfo']['present'] == 1): ?>
    <div class="container counter-bg" data-stellar-background-ratio="0.5" style="border: 1px solid white;border-top: 0px;border-bottom: 0px;box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);padding-left: 5px;padding-right: 5px;">
        <div class="col-md-12">
            <!--        <h4 class="text-center" style="color: white;
                font-size: 40px;
                font-weight: bold;
                border: 1px solid #F7C221;
                width: 50%;
                margin: 0 auto;
                padding-top: 0;"><?php //echo lnguag('School Status'); ?></h4>-->
            <div class="bottom-counter" style="min-height: 180px;">
                <div class="stat wow flipInY" data-wow-duration="3s" style="/*padding-top: 26px;*/">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-8">
                        <div class="milestone-counter"> <i class="fa fa-users fa-3x"></i> <span class="stat-count highlight"><?php
                        echo $count_std = $this->db->count_all('enroll'); 
                        ?></span>
                            <div class="milestone-details">মোট ছাত্র</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-8">
                        <div class="milestone-counter"> <i class="fa fa-user fa-3x"></i> <span class="stat-count highlight"><?php 
                        $today_present = $this->db->get_where('attendance', array('timestamp', strtotime(date('d-m-Y'))))->result_array();
                        echo count($today_present);
                         ?></span>
                            <div class="milestone-details">আজকে উপস্থিত</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-8">
                        <div class="milestone-counter"> <i class="fa fa-user-times fa-3x"></i> <span class="stat-count highlight"><?php 
                        echo $count_std - count($today_present);
                        ?></span>
                            <div class="milestone-details">আজকে অনুপস্থিত</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-8">
                        <div class="milestone-counter"> <i class="fa fa-percent fa-3x"></i> <span class="stat-count highlight"><?php 
                        echo round((count($today_present) / $count_std) * 100);
                        echo '0';
                        ?></span>
                            <div class="milestone-details">পার্সেন্টিজ</div>
                        </div>
                    </div>
                </div>
                <!-- stat -->
                <!-- stat -->
            </div>
        </div>
    </div>
        <?php endif; ?>

<div class="container" style="border: 1px solid white;border-top: 0px;border-bottom: 0px;box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75); padding-left: 5px;padding-right: 5px;">
    <div class = "panel panel-default text-center wow flipInY" data-wow-duration="3s">
        <div class = "panel-body">
            গ্যলারি
        </div>
    </div>
    <div id="owl-all" class="owl-carousel" style="margin-top: 10px; margin-bottom: 10px;margin-left:15px;">
            <?php
            if (!empty($contentInfo['galleryInfo'])):
                foreach ($contentInfo['galleryInfo'] as $list): $info = explode('+', $list['info']);
                    ?>
                <div class="item">

                <a href="assets/images/gallery_image/<?php echo $list['img_name']; ?>" data-lightbox="roadtrip" data-title="<?php echo $info[0]; ?>">
                    <img src="assets/images/gallery_image/<?php echo $list['img_name']; ?>" alt="<?php echo $info[0]; ?>" style="border: 2px solid #1B9ABA; width: 186px; height: 140px">
                 </a>

                </div>
        <?php
    endforeach;
else:
    ?>
            <div class="item"><img src="assets/images/dummyIMG/gallery_img.png" alt="Gallery Image"></div>
<?php endif; ?>
    </div>
</div>