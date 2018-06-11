<?php
$headText = explode('+', $head['textInfo']['header_title']);
$socialLink = explode('+', $head['textInfo']['social_links']);

//pd($head); 
?>
    <div class="container Pagehead">
        <div class="row">

            <div class="col-md-12">
                <a href="<?php echo base_url();?>">
                    <div class="col-md-12 wow slideInDown text-center school-head" style="background-image: url('<?php echo base_url().'assets/otherFiles/'.$header_img; ?>');background-size: 100% 100%;background-repeat: no-repeat;background-position: center;height: 200px;">
                    </div>
                </a>
            </div>

        </div>
    </div>
    <!-- /.container -->
    <div class="nav-bar-main" role="navigation">
        <div class="container">
            <nav class="main-navigation clearfix visible-md visible-lg" role="navigation">
                <ul class="main-menu sf-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>">প্রথম পাতা</a>
                    </li>
                    <li>
                        <a href="#">আমাদের তথ্য</a>
                        <ul class="sub-menu">
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
                        <ul class="sub-menu">
                            <li>
                                <a href="#">পরীক্ষার রুটিন</a>
                                <ul>
                                    <li>
                                        <a href="index.php?Home/massageDetails/studentExamRecord">ছাত্র-ছাত্রীর পরীক্ষার রেকর্ড</a>
                                        <li>
                                            <li>
                                                <a href="index.php?Home/massageDetails/academyPerfomence">একাডেমিক পারফরম্যান্স</a>
                                                <li>
                                </ul>
                                </li>
                                <li>
                                    <a href="index.php?Home/massageDetails/classRoutine">ক্লাস রুটিন</a>
                                </li>
                                <li>
                                    <a href="index.php?Home/massageDetails/pathTica">পাঠ টীকা</a>
                                </li>
                                <li>
                                    <a href="index.php?Home/syllabus">সিলেবাস</a>
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
                                            <li>
                                                <li>
                                                    <a href="index.php?Home/massageDetails/publicExam">পাবলিক পরীক্ষা</a>
                                                    <li>
                                                        <li>
                                                            <a href="index.php?Home/massageDetails/admissionExam">ভর্তি পরীক্ষা</a>
                                                            <li>
                                    </ul>
                                    </li>
                        </ul>
                        </li>
                        <li>
                            <a href="#">একাডেমিক রেকর্ড</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="index.php?Home/marksheet">Marksheet</a>
                                </li>
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
                            <ul class="sub-menu">
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
                        <li>
                            <a href="index.php?Home/allNoticePage">সকল নোটিস</a>
                        </li>
                        <li style="background: #e74c3c; box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);">
                            <a href="index.php?Home/registration_online">ভর্তি আবেদন</a>
                        </li>
                </ul>
                <!-- /.main-menu -->
                <ul class="social-icons pull-right">
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
                        <a href="<?php echo base('login', '') ?>" data-toggle="tooltip" title="Login" target="_blank">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.social-icons -->
            </nav>
            <!-- /.main-navigation -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.nav-bar-main -->
    <div class="container">
        <div class="row" style="padding: 0px;">
            <div class="col-md-12">
                <div class="latest_news col-md-8" style="height: 40px;">
                    <marquee scrollamount="3" height="40" style="padding-top:8px;" onmouseover="this.stop();" onmouseout="this.start();">
                        <?php foreach($head['imnoticeInfo'] as $list):?>
                        <i class="fa fa-dot-circle-o" style="font-size: 14px;margin-left:15px;color:#FFE325;"></i>
                        <a href="<?php echo base('Home', 'noticeView/' . $list['id'].'/important'); ?>" target="_blank">
                            <?php echo $list['title'];?>
                        </a>
                        <?php endforeach;?>
                    </marquee>
                </div>
                <div class="col-md-4 datetime-section">
                    <b>Date:</b>
                    <span id="date-part"></span>
                    <b>|</b>
                    <b>Time:</b>
                    <span id="time-part"></span>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            setInterval(function () {
                $("#blink").toggleClass("bkchange");
            }, 300)
        });
    </script>