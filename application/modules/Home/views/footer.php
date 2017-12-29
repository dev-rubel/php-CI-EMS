<?php
//pd($footerInfo);
$socialLink = explode('+', $footerInfo['textInfo']['social_links']);
$school_name = $this->db->get_where('settings', array('type'=>'system_title'))->row()->description;
$school_address = $this->db->get_where('settings', array('type'=>'address'))->row()->description;
$school_phone = $this->db->get_where('settings', array('type'=>'phone'))->row()->description;

?>

    <div class="container Pagefooter">
        <br/>
        <div class="row">
            <div class="col-md-offset-1 col-md-3">
                <div class="footer-widget">
                    <h4 class="footer-widget-title">যোগাযোগ</h4>
                    <!-- যোগাযোগ -->
                    <p style="font-size: 15px; font-weight: bold;">
                        <?php echo $school_name; ?>
                    </p>
                    <p>
                        <?php echo $school_address; ?>
                        </br>Phone:
                        <?php echo $school_phone;?>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-widget">
                    <h4 class="footer-widget-title">অবস্থান</h4>
                    <?php 
                    if($footerInfo['textInfo']['location']):?>
                    <div class="iframe-container">
                        <?php echo $footerInfo['textInfo']['location'];?>
                    </div>
                    <?php else:?>
                    <div class="iframe-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.866519480015!2d90.78217501488756!3d23.680730997351347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37544664f91b29b9%3A0x84bf39df0ef9b9e1!2sHomna+Adarsha+High+School!5e0!3m2!1sen!2sbd!4v1479159432456"
                            width="320" height="245" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-widget">
                    <h4 class="footer-widget-title">সামাজিক যোগাযোগ</h4>
                    <ul class="footer-media-icons">
                        <li>
                            <a href="<?php echo $socialLink[0];?>" class="fa fa-facebook"></a>
                        </li>
                        <li>
                            <a href="<?php echo $socialLink[1];?>" class="fa fa-twitter"></a>
                        </li>
                        <li>
                            <a href="<?php echo $socialLink[2];?>" class="fa fa-linkedin"></a>
                        </li>
                        <li>
                            <a href="<?php echo $socialLink[3];?>" class="fa fa-google-plus"></a>
                        </li>
                        <!--<li>
                        <a href="#" class="fa fa-apple"></a>
                    </li>
                    <li>
                        <a href="#" class="fa fa-rss"></a>
                    </li>-->
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="bottom-footer">
            <div class="row">
                <div class="col-md-12">
                    <p class="small-text text-center">&copy; <?php echo date('Y');?> Bidyapith. Developed by
                        <a href="https://www.nihalit.com">Nihal IT</a>
                    </p>
                </div>
                <!-- /.col-md-7 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.bottom-footer -->
    </div>
    <!-- /.container -->