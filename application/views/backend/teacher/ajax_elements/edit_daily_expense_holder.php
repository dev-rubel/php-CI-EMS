<div id="innerEditDailyExpenseHoder">
    <?php 
$edit_data = $this->db->get_where('daily_expense' , array('daily_expense_id' => $daily_expense_id) )->result_array();
foreach ( $edit_data as $row):
?>
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_daily_expense');?>
                </div>
            </div>
            <div class="panel-body">

			<form id="updateDailyExpense" action="<?php echo base_url() .'index.php?admin/ajax_update_daily_expense/'.$row['daily_expense_id']; ?>" class="form-horizontal form-groups-bordered" method="post">

                <div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
					
					<div class="col-sm-6">
						<input type="text" class="datepicker form-control" value="<?php echo date('d/m/Y', $row['date']);?>" name="date" readonly>
					</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('category');?></label>
					
					<div class="col-sm-6">
						<select name="expense_category_id" class="form-control">
						<option value="">Please Select One</option>
						<?php 
						$categoryList = $this->db->get('expense_category')->result_array();
						foreach($categoryList as $k=>$each):?>
							<option value="<?php echo $each['expense_category_id'];?>" <?php if($row[ 'daily_expense_id'] == $each[ 'expense_category_id'])echo 'selected';?>><?php echo $each['name'];?></option>
						<?php endforeach;?>
						</select>
					</div>							
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
					
					<div class="col-sm-6">
						<input type="text" class="form-control" name="amount" value="<?php echo $row['amount'];?>">
					</div>							
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-info"><?php echo get_phrase('add_daily_expense');?></button>
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

        $('#updateDailyExpense').ajaxForm({
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
                    $("#DailyExpenseList").html(jData.html);					
                    $("#table_export").dataTable();
                    $("#innerEditDailyExpenseHoder").html('');
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