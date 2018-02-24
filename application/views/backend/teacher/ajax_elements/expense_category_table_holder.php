<table class="table table-bordered datatable" id="table_export">
<thead>
	<tr>
		<th><div>#</div></th>
		<th><div><?php echo get_phrase('name');?></div></th>
		<th><div><?php echo get_phrase('options');?></div></th>
	</tr>
</thead>
<tbody>
	<?php 
		$count = 1;
		$expenses = $this->db->get('expense_category')->result_array();
		foreach ($expenses as $row):
	?>
	<tr id="expense_category<?php echo $row['expense_category_id'];?>">
		<td><?php echo $count++;?></td>
		<td><?php echo $row['name'];?></td>
		<td>
			
			<div class="btn-group">
				<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
					Action <span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-default pull-right" role="menu">
					
					<!-- Category EDITING LINK -->
					<li>
						<a href="#" onclick="editExpenseCategory('<?php echo $row['expense_category_id'];?>')">
							<i class="entypo-pencil"></i>
								<?php echo get_phrase('edit');?>
							</a>
									</li>
					<li class="divider"></li>
					
					<!-- Category DELETION LINK -->
					<li>
						<a href="#" onclick="confDelete('admin','ajax_delete_expense_category','<?php echo $row['expense_category_id'];?>','expense_category<?php echo $row['expense_category_id'];?>')">
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

function editExpenseCategory(ExpenseCategoryID) {
	$.ajax({
		type: 'GET',
		url: '<?php echo base_url();?>index.php?admin/ajax_expense_category_edit/' + ExpenseCategoryID,
		beforeSend: function () {
			$('#loading2').show();
			$('#overlayDiv').show();
		},
		success: function (data) {
			var jData = JSON.parse(data);

			toastr.success(jData.msg);
			$("#editExpenseCategoryHolder").html(jData.html);
			$('body,html').animate({
				scrollTop: 350
			}, 800);
			$('#loading2').fadeOut('slow');
			$('#overlayDiv').fadeOut('slow');
		}
	});
}

</script>