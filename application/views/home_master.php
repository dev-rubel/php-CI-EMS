<?php
//$head = $this->home_model->get_headerInfo();
//print_r($head['colors']);
$socialLink = explode('+', $head['textInfo']['social_links']);
?>
    <!DOCTYPE html>
    <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> 
<![endif]-->
    <!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> 
<![endif]-->
    <!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js" lang="en">
    <!--<![endif]-->

    <head>
        <title>
            <?php echo $title; ?>
        </title>
        <base href="<?php echo base_url(); ?>" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo implode(', ',$meta);?>">
        <meta name="keywords" content="<?php echo $meta['schoolName']?>">
        <meta name="author" content="Nihal-IT">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800' rel='stylesheet' type='text/css'>
        <!-- CSS Bootstrap & Custom -->
        <link href="assets/css/allcss.min.css" rel="stylesheet" media="all">
        <link href="assets/css/banglafont.min.css" rel="stylesheet" media="all">
        <!-- LIGHTBOX 2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css" rel="stylesheet" media="all">
        <!-- Favicons -->
        <link rel="shortcut icon" href="uploads/favicon.png">
        <!-- JavaScripts -->
        <script src="assets/js/alljs.min.js"></script>
        <link rel="stylesheet" href="assets/siteColor.php"> 

        <!--[if lt IE 8]>
            <div style=' clear: both; text-align:center; position: relative;'>
                <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/front/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
            </div>
        <![endif]-->

    </head>

    <body style="background: url('assets/images/bodyback.jpg')">
        <div id="preloader" style="z-index: 999999999999999999">
            <div id="status">&nbsp;</div>
        </div>

        <!-- This one in here is responsive menu for tablet and mobiles -->
        <div class="responsive-navigation visible-sm visible-xs">
            <a href="#" class="menu-toggle-btn">
                <i class="fa fa-bars"></i>
            </a>
            <div class="responsive_menu">
                <ul class="main_menu">
                    <li>
                        <a href="<?php echo base_url(); ?>">প্রথম পাতা</a>
                    </li>
                    <li>
                        <a href="#">আমাদের তথ্য</a>
                        <ul>
                            <li>
                                <a href="index.php?Home/massageDetails/schoolHistory">বিদ্যালয়ের ইতিহাস</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/headmasterMsg">প্রধান শিক্ষকের বাণী</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/teachers">শিক্ষকবৃন্দ</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/comity">কমিটি</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/manPower">জনবল</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/assets">সম্পদ</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/PTA">PTA</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">কার্যাবলী</a>
                        <ul>
                            <li>
                                <a href="#">পরীক্ষার রুটিন</a>
                                <ul>
                                    <li>
                                        <a href="index.php?Home/massageDetails/studentExamRecord">ছাত্র-ছাত্রীর পরীক্ষার রেকর্ড</a>
                                    </li>
                                    <li>
                                        <a href="index.php?Home/massageDetails/academyPerfomence">একাডেমিক পারফরম্যান্স</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/classRoutine">ক্লাস রুটিন</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/pathTica">পাঠ টীকা</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/studentPresent">উপস্থিতি</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/publisher">প্রকাশনা</a>
                            </li>
                            <li>
                                <a href="#">সহপাঠ ক্রমিক কার্যাবলী</a>
                                <ul>
                                    <li>
                                        <a href="index.php?Home/massageDetails/acadamic">একাডেমিক</a>
                                    </li>
                                    <li>
                                        <a href="index.php?Home/massageDetails/publicExam">পাবলিক পরীক্ষা</a>
                                    </li>
                                    <li>
                                        <a href="index.php?Home/massageDetails/admissionExam">ভর্তি পরীক্ষা</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">একাডেমিক রেকর্ড</a>
                        <ul>
                            <li>
                                <a href="index.php?Home/massageDetails/midExam">সাময়িক পরীক্ষা</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/classExam">টিউটরিয়াল পরীক্ষা</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/qtest">কুইজ টেস্ট</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/publicExam">পাবলিক পরীক্ষা</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/admissionExam">ভর্তি পরীক্ষা</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">ক্রিয়াকলাপ</a>
                        <ul>
                            <li>
                                <a href="index.php?Home/massageDetails/finalExam">বার্ষিক অনুষ্ঠান</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/stydyTour">শিক্ষা সফর</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/play">ক্রীড়া</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/club">ক্লাব</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/offDay">ছুটি</a>
                            </li>
                            <li>
                                <a href="index.php?Home/massageDetails/stydyCalender">শিক্ষা পঞ্জিকা</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php?Home/massageDetails/contact">যোগাযোগ</a>
                    </li>
                    <li id="onlineAdmisson">
                        <a href="index.php?Home/registration_online">ভর্তি আবেদন</a>
                    </li>
                </ul>
                <!-- /.main_menu -->
                <ul class="social_icons">
                    <li>
                        <a href="<?php echo $socialLink[0]; ?>" data-toggle="tooltip" title="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $socialLink[1]; ?>" data-toggle="tooltip" title="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $socialLink[2]; ?>" data-toggle="tooltip" title="Pinterest">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $socialLink[3]; ?>" data-toggle="tooltip" title="Google+">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base('login', '') ?>" target="_blank" data-toggle="tooltip" title="Login">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.social_icons -->
            </div>
            <!-- /.responsive_menu -->
        </div>
        <!-- /responsive_navigation -->

        <!-- ========= header  section =========== -->
        <?php echo $header; ?>

        <!-- =========== content section ===== -->
        <?php echo $content; ?>

        <!-- ========= Footer section ========= -->
        <?php echo $footer; ?>

        <!-- Include js plugin -->

        <!-- LIGHTBOX 2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
        <script src="assets/js/frontCustom.js"></script>

    </body>

    </html>