<style>

.container{padding: 0px;}
</style>
<?php
//$Dmsg = $this->db->get_where('frontpages',array('track_name'=>$this->uri->segment(3)))->row();

?>
<div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class = "panel notice-panel panel-default wow flipInY text-center" data-wow-duration="3s">
                   <div class = "panel-body">
                      সকল নোটিস
                   </div>
                </div>
                
                <div class="wow slideIn" data-wow-duration="2s">
                        <div class="widget-item">                            
                           <?php 
                            if(!empty($contentInfo['noticeInfo'])):
                            foreach($contentInfo['noticeInfo'] as $list):?>
                            <div class="box text-center">
                                <h4><?php echo $list['title'];?></h4>
                                <p><?php 
								$link = base('Home', 'noticeView/'.$list['id']);
								echo mb_substr($list['description'],0,200, "utf-8").".....<a href='$link'>বিস্তারিত</a>";?></p>
                                <hr>
                            </div>
                            <?php 
                            endforeach;
                            else:?>
                            <div class="box text-center">
                                <h4><a href="#">Title</a></h4>
                                <p>Description</p>
                                <hr>
                            </div>
                            <?php endif;?>
                        </div>
                    
                    </div>
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
                            if(!empty($contentInfo['noticeInfo'])):
                            foreach($contentInfo['noticeInfo'] as $list):
                                $link = base('Home', 'noticeView/'.$list['id']);
                                ?>
                            <div class="box text-center">
                                <h4><a href="<?php echo base('Home', 'noticeView/'.$list['id']);?>"><?php echo $list['title'];?></a></h4>
                                <p><?php echo mb_substr($list['description'],0,200, "utf-8").".....<a href='$link'>বিস্তারিত</a>";?></p>
                                <hr>
                            </div>
                            <?php 
                            endforeach;
                            else:?>
                            <div class="box text-center">
                                <h4><a href="#">Title</a></h4>
                                <p>Description</p>
                                <hr>
                            </div>
                            <?php endif;?>
                        </marquee>
                    </div>
                </div>
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
                                    if(!empty($contentInfo['linkInfo'])):
                                    foreach($contentInfo['linkInfo'] as $list):?>
                              <a href="<?php echo $list['link'];?>" class="hvr-bounce-to-right"><?php echo $list['title'];?></a>
                               <?php 
                                    endforeach;
                                    else:?>
                              <a href="#" class="hvr-bounce-to-right">Important Link</a>
                              <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.col-md-4 -->
        </div>
    </div>