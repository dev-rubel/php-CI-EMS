<div id="innerEditShiftHoder">
    <?php 
$edit_data = $this->db->get_where('shift' , array('shift_id' => $shift_id) )->result_array();
foreach ( $edit_data as $row):
?>
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_shift');?>
                </div>
            </div>
            <div class="panel-body">

                <form id="updateShift" action="<?php echo base_url() .'index.php?admin/ajax_update_shift/'.$row['shift_id']; ?>" class="form-horizontal form-groups-bordered" method="post">

                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <?php echo get_phrase('name'); ?>
                        </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info">
                            <?php echo get_phrase('update_shift'); ?>
                        </button>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>

<?php
endforeach;
?>
</div>

<script>
    $(document).ready(function () {

        $('#updateShift').ajaxForm({
            beforeSend: function () {
                $('#loading').show();
                $('#overlayDiv').show();
            },
            success: function (data) {
                var jData = JSON.parse(data);

                if (!jData.type) {
                    toastr.error(jData.msg);
                } else {
                    toastr.success(jData.msg);
                    $("#shiftList").html(jData.html);
                    $("#table_export").dataTable();
                    $("#innerEditShiftHoder").html('');
                }
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                $('#loading').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });

    });
</script>