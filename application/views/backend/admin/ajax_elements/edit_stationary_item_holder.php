<div id="innerEditStationaryItemHoder">
    <?php 
$edit_data = $this->db->get_where('stationary_items' , array('stationary_item_id' => $stationary_item_id) )->result_array();
foreach ( $edit_data as $row):
?>
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="entypo-plus-circled"></i>
                <?php echo get_phrase('edit_stationary_item');?>
            </div>
        </div>
        <div class="panel-body">

            <form id="updateStationaryItem" action="<?php echo base_url() .'index.php?admin/ajax_update_stationary_item/'.$row['stationary_item_id']; ?>" class="form-horizontal form-groups-bordered" method="post">

                <div class="form-group">
                    <div class="col-sm-1">
                        <select name="stationary_category_id" class="form-control" onchange="return get_stationary_item_remain(this.value)">
                            <option value="">Select One</option>
                            <?php 
                                $stationarys = $this->db->get('stationary_category')->result_array();
                                foreach ($stationarys as $row2):
                            ?>
                            <option value="<?php echo $row2['stationary_category_id']; ?>" <?php echo selected($row2['stationary_category_id'],$row['stationary_category_id']); ?>><?php echo ucfirst($row2['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="item_amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"
                            value="<?php echo $row['item_amount'];?>" placeholder="Item Amount">
                        <p id="stationary_item_remain" class="text-center"></p>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="item_price" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"
                            value="<?php echo $row['item_price'];?>" placeholder="Each Item Price">
                    </div>
                    <div class="col-sm-2">
                        <textarea name="item_description" class="form-control" placeholder="Item Description" cols="30" rows="5"><?php echo $row['item_description'];?></textarea>
                    </div>
                    <div class="col-sm-1">
                        <select name="item_status" class="form-control">
                            <option value="1" <?php echo selected('1',$row['item_status']); ?>>IN</option>
                            <option value="2" <?php echo selected('2',$row['item_status']); ?>>OUT</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="datepicker form-control" value="<?php echo date('d-m-Y',$row['item_transaction_date']);?>" name="item_transaction_date" readonly required />
                    </div>

                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-info">
                            <?php echo get_phrase('edit_item');?>
                        </button>
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

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
        });

        $('#updateStationaryItem').ajaxForm({
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
                    // $("#StationaryItemList").html(jData.html);
                    ajaxDataTable('stationary_item', 'admin/ajaxStationaryItemList');
                    $("#innerEditStationaryItemHoder").html('');
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