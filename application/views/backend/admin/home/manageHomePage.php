<?php
$this->db->select('school_history');
$this->db->where('id', 1);
$result = oneDim($this->db->get('taxtinfo')->result_array());
$school_history = explode('+', $result['school_history']);
//pd($page_data);
?>

<div class="row">
    <ul class="nav nav-tabs bordered">
        <li class="">
            <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                <?php echo get_phrase('manage_page'); ?>
            </a>
        </li>
        <li class="active">
            <a href="#list2" data-toggle="tab"><i class="entypo-menu"></i> 
                <?php echo get_phrase('file_&_image_storage'); ?>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <br>
        <!----TABLE LISTING STARTS-->
        <div class="tab-pane box" id="list">         
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <label>Page Name:</label>
                    <select class="form-control" id="pageName">
                        <option>Select</option>
                        <option value="schoolHistory">বিদ্যালয়ের ইতিহাস</option>
                        <option value="headmasterMsg">প্রধান শিক্ষকের বাণী</option>
                        <option value="chairmanMsg">চেয়ারম্যানের বাণী</option>
                        <option value="teachers">শিক্ষকবৃন্দ</option>
                        <option value="comity">কমিটি</option>
                        <option value="manPower">জনবল</option>
                        <option value="assets">সম্পদ</option>
                        <option value="studentExamRecord">ছাত্র-ছাত্রীর পরীক্ষার রেকর্ড</option>
                        <option value="academyPerfomence">একাডেমিক পারফরম্যান্স</option>
                        <option value="classRoutine">ক্লাস রুটিন</option>
                        <option value="pathTica">পাঠ টীকা</option>
                        <option value="studentPresent">উপস্থিতি</option>
                        <option value="publisher">প্রকাশনা</option>
                        <option value="acadamic">একাডেমিক</option>
                        <option value="publicExam">পাবলিক পরীক্ষা</option>
                        <option value="admissionExam">ভর্তি পরীক্ষা</option>
                        <option value="midExam">সাময়িক পরীক্ষা</option>
                        <option value="classExam">টিউটরিয়াল পরীক্ষা</option>
                        <option value="qtest">কুইজ টেস্ট</option>
                        <option value="finalExam">বার্ষিক অনুষ্ঠান</option>
                        <option value="stydyTour">শিক্ষা সফর</option>
                        <option value="play">ক্রীড়া</option>
                        <option value="club">ক্লাব</option>
                        <option value="offDay">ছুটি</option>
                        <option value="stydyCalender">শিক্ষা পঞ্জিকা</option>
                        <option value="contact">যোগাযোগ</option>
                        <option value="PTA">PTA</option>
                    </select>
                </div>
                <form action="<?php echo base('homemanage', 'update_manage_pages'); ?>" method="post">
                    <div class="form-group">
                        <label><?php echo lng('School Title'); ?></label>
                        <input class="form-control" placeholder="" name="title"  data-validation="required">
                        <input type="hidden" id="trackName" name="track_name" value=""/>
                    </div>
                    <div class="form-group">
                        <textarea class="editor" id="tinyDes" name="description" data-validation="required"></textarea>
                    </div>
                    <button type="submit" class="btn btn-info"><?php echo lng('Update'); ?></button>
                </form>
            </div>
        </div>
        <div class="tab-pane box active" id="list2">


            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <?php echo flash_msg(); ?>
                        <form action="<?php echo base('homemanage', 'add_files'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label><?php echo lng('File Title'); ?></label>
                                <input class="form-control" name="filetitle" placeholder="" data-validation="required">
                            </div>
                            <div class="form-group">
                                <label><?php echo lng('File'); ?></label>
                                <input type="file" class="form-control" name="files" data-validation="mime size" data-validation-allowing="pdf jpg png gif" data-validation-max-size="3mb">
                                <small>Support PDF and png,jpg,gif file. Max file size: 3MB.</small>
                            </div>
                            <button type="submit" class="btn btn-info"><?php echo lng('Add'); ?></button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th><?php echo lng('File View'); ?></th>
                                    <th><?php echo lng('File Title'); ?></th>
                                    <th><?php echo lng('Link'); ?></th>
                                    <th><?php echo lng('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($page_data as $key=>$list): $link = $list['link'];$id = $list['id']?>
                                <tr>
                                    <th scope="row"><?php echo $key+1; ?></th>
                                    <th scope="row">
                                    <?php 
                                        $ext = end(explode(".", $link));
                                        if($ext!=='pdf'):
                                    ?>
                                        <img src="<?php echo base_url().'assets/otherFiles/'.$link?>" alt="" width="50px" height="50px"/>
                                        <?php else:?>
                                        <a href="<?php echo base_url().'assets/otherFiles/'.$link?>" target="_blank"><b>PDF File</b></a>
                                        <?php endif;?>
                                        
                                    </th>
                                    <th scope="row"><?php echo $list['title']; ?></th>
                                    <td>
                                        <button class="btn copyLink" data-clipboard-text="<?php echo base_url().'assets/otherFiles/'.$link;?>">
                                        Copy to clipboard
                                    </button></td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-xs" onclick="confirm_modal('<?php echo base('homemanage', 'delete_files'."/$id/$link"); ?>');"><?php echo lng('Delete this'); ?></a>          
                                    </td>
                                </tr>
                                
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>




</div><!--/.row-->
<script src="assets/js/tinymce/tinymce.min.js"></script>
<script src="assets/js/clipboard.min.js"></script>
    <script>
         $(document).ready(function () {
       		new Clipboard('.copyLink');  
            tinyMCE.init({ 
                selector: '#tinyDes',
                height: 500,
                content_css: 'https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css',
                plugins: ["table image code visualblocks"],
                valid_elements : '*[*]',
                toolbar: "undo redo | styleselect | bold italic | fontsizeselect | alignleft aligncenter alignright alignjustify | preview",
                schema: "html5",           
            });     
        });
        
        
        $("#pageName").change(function () {
            var value = $("#pageName option:selected").val();
            //alert(selectValue);
            $('#trackName').val(value);
             $.ajax({
                url: '<?php echo base_url(); ?>index.php?homemanage/getPageInfo/' + value,
                beforeSend: function() { 
           	    //  alert("start");
                        $('#loading').show();
                        $('#overlayDiv').show();
                },  
                success: function (response)
                {
                    var data = $.parseJSON(response);
                    if (data.name) {
                        setTimeout(function() {
                            $('input[name=title]').val(data.name);
                            tinymce.get('tinyDes').setContent(data.mark);
                             $('#loading').fadeOut('slow');
                             $('#overlayDiv').fadeOut('slow');
                        }, 2000);
                    } else {
                        $('input[name=title]').val('');
                        tinymce.get('tinyDes').setContent('');
                        $('#loading').fadeOut('slow');
                        $('#overlayDiv').fadeOut('slow');
                    }
                }
                
            });
            return false;

        });

    </script>

