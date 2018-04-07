<hr />
<div class="row">
	<div class="col-md-offset-3 col-md-8">
		<form id="teacherAttendanceSelector" action="<?php echo base_url() .'index.php?admin/ajax_teacher_attendance_selector'; ?>" method="post">
			<div class="col-md-6">
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

<div id="teacher_attendance_section_holder"></div>

<script type="text/javascript">
	/* Search Attendance */
	$('#teacherAttendanceSelector').ajaxForm({
		beforeSend: function () {
			$('#loading2').show();
			$('#overlayDiv').show();
		},
		success: function (data) {
			$("#teacher_attendance_section_holder").html(data);
			$('body,html').animate({
				scrollTop: 400
			}, 800);
			$('#loading2').fadeOut('slow');
			$('#overlayDiv').fadeOut('slow');
		}
	});
</script>