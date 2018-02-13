<div id="teacherEditHolder"></div>
<br>
<br>
<div id="teacherList">
	<table class="table table-bordered datatable" id="table_export">
		<thead>
			<tr>
				<th width="80">
					<div>
						<?php echo get_phrase('photo');?>
					</div>
				</th>
				<th>
					<div>
						<?php echo get_phrase('name');?>
					</div>
				</th>
				<th>
					<div>
						<?php echo get_phrase('address');?>
					</div>
				</th>
				<th>
					<div>
						<?php echo get_phrase('phone');?>
					</div>
				</th>
				<th>
					<div>
						<?php echo get_phrase('email');?>
					</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$teachers	=	$this->db->get('teacher' )->result_array();
				foreach($teachers as $row):?>
			<tr id="teacher<?php echo $row['teacher_id'];?>">
				<td>
					<img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" class="img-circle" width="30"
					/>
				</td>
				<td>
					<?php echo $row['name'];?>
				</td>
				<td>
					<?php echo $row['address'];?>
				</td>
				<td>
					<?php echo $row['phone'];?>
				</td>
				<td>
					<?php echo $row['email'];?>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">
	function editTeacher(teacherID) {
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url();?>index.php?teacher/ajax_edit_teacher/' + teacherID,
			beforeSend: function () {
				$('#loading2').show();
				$('#overlayDiv').show();
			},
			success: function (data) {
				var jData = JSON.parse(data);

				toastr.success(jData.msg);
				$("#teacherEditHolder").html(jData.html);
				$('.datepicker').datepicker();
				$('body,html').animate({
					scrollTop: 300
				}, 800);
				$('#loading2').fadeOut('slow');
				$('#overlayDiv').fadeOut('slow');
			}
		});
	}


	jQuery(document).ready(function ($) {
		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [

					{
						"sExtends": "xls",
						"mColumns": [1, 2]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1, 2]
					},
					{
						"sExtends": "print",
						"fnSetText": "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(3, false);

							this.fnPrint(true, oConfig);

							window.print();

							$(window).keyup(function (e) {
								if (e.which == 27) {
									datatable.fnSetColumnVis(0, true);
									datatable.fnSetColumnVis(3, true);
								}
							});
						},

					},
				]
			},

		});

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>