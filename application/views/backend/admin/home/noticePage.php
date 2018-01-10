<div class="row">

    <div class="col-md-offset-1 col-md-10">
        <div class="row">
            <div class="col-md-4" id="noticeFormSection">
                <?php echo flash_msg();?>

                <form id="addNotice" action="<?php echo base_url() .'index.php?homemanage/ajax_add_notice'; ?>" class="form-horizontal form-groups-bordered" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>
                            <?php echo lng('Notice Title');?>
                        </label>
                        <input class="form-control" name="title" placeholder="" data-validation="required">
                        <input type="hidden" name="title_link" value="notice link">
                    </div>
                    <div class="form-group">
                        <label>
                            <?php echo lng('Notice Description');?>
                        </label>
                        <textarea class="form-control" name="description" data-validation="required" rows="7"></textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            <?php echo lng('Notice File');?>
                        </label>
                        <input type="file" class="form-control" name="file" data-validation="mime size" data-validation-allowing="pdf" data-validation-max-size="3mb">
                        <small>Max file size: 3MB.</small>
                    </div>
                    <button type="submit" class="btn btn-info">
                        <?php echo lng('Add');?>
                    </button>
                </form>
            </div>
            <div class="col-md-8" id="noticeHolder">
                <?php 
  $this->db->where('track_name', 'notice');
  $notice = $this->db->get('linkinfo')->result_array();
  ?>
                <table class="table">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>
                                <?php echo lng('Notice Title');?>
                            </th>
                            <th>
                                <?php echo lng('Description');?>
                            </th>
                            <th>
                                <?php echo lng('Action');?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
      if(!empty($notice)):
      foreach($notice as $key=>$list): $id = $list['id'];?>
                        <tr id="reguNotice<?php echo $key;?>">
                            <th scope="row">
                                <?php echo $key+1;?>
                            </th>
                            <td>
                                <?php echo $list['title'];?>
                            </td>
                            <td>
                                <?php echo mb_substr($list['description'],0,200, "utf-8").'....';?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs" onclick="editNotice('<?php echo $id;?>')">Edit</a>
                                <a href="#" class="btn btn-danger btn-xs" onclick="confDelete('homemanage','ajax_delete_notice','<?php echo $id;?>','reguNotice<?php echo $key;?>')">
                                    <?php echo lng('Delete');?>
                                </a>
                                <?php if($list['status']==1):?>
                                <a href="#" class="btn btn-success btn-xs" onclick="statusNotice('<?php echo $id;?>','0')">
                                    <?php echo lng('Published');?>
                                </a>
                                <?php else:?>
                                <a href="#" class="btn btn-warning btn-xs" onclick="statusNotice('<?php echo $id;?>','1')">
                                    <?php echo lng('Draft');?>
                                </a>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php endforeach;
    endif;
    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



<script>
    $(document).ready(function () {

        $('#addNotice').ajaxForm({
            beforeSend: function () {
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function (data) {
                var jData = JSON.parse(data);

                if (!jData.type) {
                    toastr.error(jData.msg);
                } else {
                    toastr.success(jData.msg);
                    $("#noticeHolder").html(jData.html);
                    $('#addNotice').resetForm();
                }
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    });


    function editNotice(noticeID) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url();?>index.php?homemanage/ajax_edit_notice/' + noticeID,
            beforeSend: function () {
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function (data) {
                var jData = JSON.parse(data);
                toastr.success(jData.msg);
                $("#noticeFormSection").html(jData.html);
                $('body,html').animate({
                    scrollTop: 350
                }, 800);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }

    function statusNotice(noticeID, status) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url();?>index.php?homemanage/ajax_status_notice/' + noticeID + '/' + status,
            beforeSend: function () {
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function (data) {
                var jData = JSON.parse(data);
                toastr.success(jData.msg);
                $("#noticeHolder").html(jData.html);
                $('body,html').animate({
                    scrollTop: 350
                }, 800);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }
</script>