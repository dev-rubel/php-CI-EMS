<table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th><div>#</div></th>
			<th><div><?php echo get_phrase('category');?></div></th>
			<th><div><?php echo get_phrase('amount');?></div></th>
			<th><div><?php echo get_phrase('date');?></div></th>
			<th><div><?php echo get_phrase('action');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$count = 1;
			$daily_expense = $this->db->get('daily_expense')->result_array();
			foreach ($daily_expense as $row):
		?>
		<tr id="daily_expense<?php echo $row['daily_expense_id'];?>">
			<td><?php echo $count++;?></td>
			<td><?php echo $this->db->get_where('expense_category',['expense_category_id'=>$row['expense_category_id']])->row()->name;?></td>
			<td><?php echo $row['amount'];?></td>
			<td><?php echo date('d/m/Y', $row['date']);?></td>
			<td>
				
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						Action <span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-default pull-right" role="menu">
						
						<!-- Category EDITING LINK -->
						<li>
							<a href="#" onclick="editDailyExpense('<?php echo $row['daily_expense_id'];?>')">
								<i class="entypo-pencil"></i>
									<?php echo get_phrase('edit');?>
								</a>
										</li>
						<li class="divider"></li>
						
						<!-- Category DELETION LINK -->
						<li>
							<a href="#" onclick="confDelete('admin','ajax_delete_daily_expense','<?php echo $row['daily_expense_id'];?>','daily_expense<?php echo $row['daily_expense_id'];?>')">
								<i class="entypo-trash"></i>
									<?php echo get_phrase('delete');?>
								</a>
										</li>
					</ul>
				</div>
				
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>


<script>

function editDailyExpense(DailyExpenseID) {
	$.ajax({
		type: 'GET',
		url: '<?php echo base_url();?>index.php?admin/ajax_daily_expense_edit/' + DailyExpenseID,
		beforeSend: function () {
			$('#loading2').show();
			$('#overlayDiv').show();
		},
		success: function (data) {
			var jData = JSON.parse(data);

			toastr.success(jData.msg);
			$("#editDailyExpenseHolder").html(jData.html);
			$('.datepicker').datepicker();
			$('body,html').animate({
				scrollTop: 350
			}, 800);
			$('#loading2').fadeOut('slow');
			$('#overlayDiv').fadeOut('slow');
		}
	});
}

</script>