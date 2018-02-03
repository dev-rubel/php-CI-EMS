<div id="innerEditIncomeCategoryHoder">
    <?php 
$edit_data = $this->db->get_where('income_category' , array('income_category_id' => $income_category_id) )->result_array();
foreach ( $edit_data as $row):
?>
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('edit_income_category');?>
                </div>
            </div>
            <div class="panel-body">

                <form id="updateIncomeCategory" action="<?php echo base_url() .'index.php?admin/ajax_update_income_category/'.$row['income_category_id']; ?>" class="form-horizontal form-groups-bordered" method="post">

                <div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
					
					<div class="col-sm-6">
						<input type="text" class="form-control" name="name" value="<?php echo ucwords(str_replace('_', ' ', $row['name']))?>" autofocus>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-info"><?php echo get_phrase('add_income_category');?></button>
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

        $('#updateIncomeCategory').ajaxForm({
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
                    $("#IncomeCategoryList").html(jData.html);
                    $("#table_export").dataTable();
                    $("#innerEditIncomeCategoryHoder").html('');
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