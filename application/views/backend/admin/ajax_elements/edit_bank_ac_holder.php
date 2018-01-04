<div id="innerEditBankACHoder">
    <?php 
$edit_data = $this->db->get_where('bank_account' , array('acc_id' => $acc_id) )->result_array();
foreach ( $edit_data as $row):
?>
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_BankAC');?>
                </div>
            </div>
            <div class="panel-body">

                <form id="updateBankAC" action="<?php echo base_url() .'index.php?admin/ajax_update_bank_ac/'.$row['acc_id']; ?>" class="form-horizontal form-groups-bordered" method="post">

				<div class="form-group">
                    <label class="col-sm-3 control-label">
                        Bank Account Name
                    </label>
                    <div class="col-sm-5">
					  <input type="text" class="form-control" name="acc_name" placeholder="Bank Account Name" value="<?php echo $row['acc_name']; ?>" required="required">
                    </div>

				</div>

				<div class="form-group">
                    <label class="col-sm-3 control-label">
                        Bank Account No
                    </label>
                    <div class="col-sm-5">
				        <input type="number" class="form-control" name="acc_no" value="<?php echo $row['acc_no']; ?>" placeholder="Bank Account No." required="required">
                    </div>
				</div>

				<div class="form-group">
                    <label class="col-sm-3 control-label">
                        Bank Account Details
                    </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="acc_details" value="<?php echo $row['acc_details']; ?>" placeholder="Bank Account Details">
                    </div>
				</div>
				<div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
				        <button class="btn btn-info" type="submit">Save</button>
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

        $('#updateBankAC').ajaxForm({
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
                    $("#BankACList").html(jData.html);
                    $("#table_export").dataTable();
                    $("#innerEditBankACHoder").html('');
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