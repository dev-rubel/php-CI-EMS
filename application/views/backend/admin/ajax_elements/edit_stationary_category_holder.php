<div id="innerEditStationaryCategoryHoder">
    <?php 
$edit_data = $this->db->get_where('stationary_category' , array('stationary_category_id' => $stationary_category_id) )->result_array();
foreach ( $edit_data as $row):
?>
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                <?php echo get_phrase('edit_stationary_category');?>
            </div>
        </div>
        <div class="panel-body">

            <form id="updateStationaryCategory" action="<?php echo base_url() .'index.php?admin/ajax_update_stationary_category/'.$row['stationary_category_id']; ?>" class="form-horizontal form-groups-bordered" method="post">

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" value="<?php echo ucwords(str_replace('_', ' ', $row['name']))?>" autofocus>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_stationary_category');?></button>
                </div>
            </div>
        
        </form>
    </div>
</div>

<?php
endforeach;
?>
</div>

<script>
    $(document).ready(function () {

        $('#updateStationaryCategory').ajaxForm({
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
                    // $("#StationaryCategoryList").html(jData.html);
                    ajaxDataTable('stationary_category', 'admin/ajaxStationaryCategoryList');
                    $("#innerEditStationaryCategoryHoder").html('');
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