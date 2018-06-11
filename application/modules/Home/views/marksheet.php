<style>

.container{padding: 0px;}
.widget-item.maxClass img {
    max-width: 700px;
}
</style>
<?php
$Dmsg = $this->db->get_where('frontpages',array('track_name'=>$this->uri->segment(3)))->row();

?>
<div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class = "panel notice-panel panel-default wow flipInY text-center" data-wow-duration="3s">
                   <div class = "panel-body">
                      Marksheet
                   </div>
                   <!-- end panel body -->
                </div>
                
                <div class="wow slideIn" data-wow-duration="2s">
                    <div class="widget-item maxClass">                            
                        
                    <form action="<?php echo base('admin', 'download_marksheet');?>" method="post" class="form-horizontal form-groups-bordered validate" target="_blank">
                       
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">
                                <?php echo get_phrase('exam'); ?>
                            </label>
                            <div class="col-sm-6">
                                <select name="exam_id" class="form-control" id="exam_selector_holder">
                                    <option value="">
                                        <?php echo get_phrase('select_exam'); ?>
                                    </option>
                                    <?php $examList = $this->db->get('exam')->result_array();
                        foreach($examList as $list):
                        ?>
                                    <option value="<?php echo $list['exam_id'];?>">
                                        <?php echo $list['name'];?>
                                    </option>
                                    <?php endforeach;?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">
                                <?php echo get_phrase('student_id'); ?>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="student_code" placeholder="Student ID" required="required">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <input type="submit" value="Download" id="submit" class="btn btn-info">
                            </div>
                        </div>
                        <?php echo form_close(); ?>


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
                                $link = base('Home', 'noticeView/' . $list['id']);
                              ?>
                            <div class="box text-center">
                                <h4><a href="<?php echo base('Home', 'noticeView/'.$list['id']);?>"><?php echo $list['title'];?></a></h4>
                                <p><?php echo mb_substr($list['description'],0,200, "utf-8").".....<a href='$link'>বিস্তারিত</a>"; ?></p>
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


<script type="text/javascript">
    $('.jscHolder').hide();
    $('.sectionHolder').hide();
    $('.groupHolder').hide();


    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_group/' + class_id,
            success: function (response) {
                if (response) {
                    if (response == 1) {
                        $('.jscHolder').show();
                        $('.groupHolder').hide();
                    } else {
                        $('.groupHolder').show();
                        $('.jscHolder').show();
                        console.log(response);
                        jQuery('#group_selector_holder').html(response);
                    }
                } else {
                    $('.groupHolder').hide();
                    $('.jscHolder').hide();
                }
            }
        });

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
            success: function (response) {
                if (response) {
                    $('.sectionHolder').show();
                    jQuery('#section_selector_holder').html(response);
                } else {
                    $('.sectionHolder').hide();
                }
            }
        });

    }
</script>