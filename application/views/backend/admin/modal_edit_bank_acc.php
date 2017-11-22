<?php
$edit_data = $this->db->get_where('bank_account', array('acc_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_bank_account_information'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?a/accounting/update_bank_account/' . $row['acc_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('account_name'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="acc_name" value="<?php echo $row['acc_name']; ?>" required="required"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('account_no'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="acc_no" value="<?php echo $row['acc_no']; ?>" required="required"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('account_details'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="acc_details" value="<?php echo $row['acc_details']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_account'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
endforeach;
?>


