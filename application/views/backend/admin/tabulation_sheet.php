<hr />
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('download_tabulation'); ?>
                </div>
            </div>
            <div class="panel-body">

		<form action="<?php echo base('admin', 'tabulation_sheet_print_view');?>" method="post" class="form-horizontal form-groups-bordered validate" target="_blank">
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">
					<?php echo get_phrase('want_to_admit_class'); ?>
				</label>

				<div class="col-sm-6">
					<select name="class_id" class="form-control" data-validate="required" id="class_id" data-message-required="<?php echo get_phrase('value_required'); ?>"
						onchange="return get_class_sections(this.value)">
						<option value="">
							<?php echo get_phrase('select'); ?>
						</option>
						<?php
							$classes = $this->db->get('class')->result_array();
							foreach ($classes as $row):
						?>
							<option value="<?php echo $row['class_id']; ?>">
								<?php echo $row['name']; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="form-group groupHolder">
				<label for="field-1" class="col-sm-3 control-label">
					<?php echo get_phrase('group'); ?>
				</label>

				<div class="col-sm-6">
					<select class="form-control groupSection" name="group_id" id="group_selector_holder">
						<option value="">
							<?php echo get_phrase('select_group'); ?>
						</option>
					</select>
				</div>
			</div>

			<div class="form-group sectionHolder">
				<label for="field-2" class="col-sm-3 control-label">
					<?php echo get_phrase('section'); ?>
				</label>
				<div class="col-sm-6">
					<select name="section_id" class="form-control" id="section_selector_holder">
						<option value="">
							<?php echo get_phrase('select_section'); ?>
						</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="field-2" class="col-sm-3 control-label">
					<?php echo get_phrase('shift'); ?>
				</label>
				<div class="col-sm-6">
					<select name="shift_id" class="form-control" id="shift_selector_holder">
						<option value="">
							<?php echo get_phrase('select_shift'); ?>
						</option>
						<?php $shiftList = $this->db->get('shift')->result_array();
							foreach($shiftList as $list):
						?>
						<option value="<?php echo $list['shift_id'];?>">
							<?php echo $list['name'];?>
						</option>
						<?php endforeach;?>
					</select>
				</div>
			</div>

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
				<div class="col-sm-offset-3 col-sm-6">
					<input type="submit" value="Download" id="submit" class="btn btn-info">
				</div>
			</div>
				<?php echo form_close();?>


			</div>
        </div>    
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