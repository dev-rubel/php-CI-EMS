<hr />

<div class="row">
	<div class="col-md-12">
		<form id="attendanceSelector" action="<?php echo base_url() .'index.php?admin/ajax_attendance_selector'; ?>" class="form-horizontal form-groups-bordered validate"
		    method="post">

			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label" style="margin-bottom: 5px;">
						<?php echo get_phrase('class');?>
					</label>
					<select name="class_id" class="form-control" onchange="select_section(this.value)">
						<option value="">
							<?php echo get_phrase('select_class');?>
						</option>
						<?php
							$classes = $this->db->get('class')->result_array();
							foreach($classes as $row):
													
						?>

							<option value="<?php echo $row['class_id'];?>">
								<?php echo $row['name'];?>
							</option>

							<?php endforeach;?>
					</select>
				</div>
			</div>

			<div id="group_holder">
			</div>

			<div id="section_holder">
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" style="margin-bottom: 5px;">
							<?php echo get_phrase('section');?>
						</label>
						<select class="form-control" name="section_id">
							<option value="">
								<?php echo get_phrase('select_class_first') ?>
							</option>

						</select>
					</div>
				</div>
			</div>

			<div id="shift_holder">
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" style="margin-bottom: 5px;">
							<?php echo get_phrase('shift');?>
						</label>
						<select class="form-control" name="shift_id">
							<option value="">
								<?php echo get_phrase('select_shift_first') ?>
							</option>
							<?php $shifts = $this->db->get('shift')->result_array();
                            	foreach($shifts as $shift):
                            ?>
							<option value="<?php echo $shift['shift_id'];?>">
								<?php echo $shift['name'] ;?>
							</option>
							<?php endforeach;?>

						</select>
					</div>
				</div>
			</div>



			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label" style="margin-bottom: 5px;">
						<?php echo get_phrase('date');?>
					</label>
					<input type="text" class="form-control datepicker" name="timestamp" data-format="dd-mm-yyyy" value="<?php echo date(" d-m-Y
					    ");?>"/>
				</div>
			</div>
			<input type="hidden" name="year" value="<?php echo $running_year;?>">

			<div class="col-md-1" style="margin-top: 25px;">
				<button type="submit" class="btn btn-info">
					<?php echo get_phrase('manage_attendance');?>
				</button>
			</div>


			<?php echo form_close();?>
	</div>
</div>

<div id="attendance_section_holder"></div>

<script type="text/javascript">
	$('#group_holder').hide();

	/* Search Attendance */
	$('#attendanceSelector').ajaxForm({
		beforeSend: function () {
			$('#loading2').show();
			$('#overlayDiv').show();
		},
		success: function (data) {
			$("#attendance_section_holder").html(data);
			$('body,html').animate({
				scrollTop: 400
			}, 800);
			$('#loading2').fadeOut('slow');
			$('#overlayDiv').fadeOut('slow');

		}
	});

	function select_section(class_id) {

		$.ajax({
			url: '<?php echo base_url(); ?>index.php?admin/get_group/' + class_id,
			success: function (response) {
				if (response) {
					$('#group_holder').show();
					jQuery('#group_holder').html(response);
				} else {
					$('#group_holder').hide();
				}
			}
		});

		$.ajax({
			url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id,
			success: function (response) {

				jQuery('#section_holder').html(response);
			}
		});
	}
</script>