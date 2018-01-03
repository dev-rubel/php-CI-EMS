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
		$incomes = $this->db->get('income_category')->result_array();
		foreach ($incomes as $row):
	?>
	<tr>
		<td><?php echo $count++;?></td>
		<td><?php echo ucwords(str_replace('_', ' ', $row['name']));?></td>
		<td>
			
			<div class="btn-group">
				<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
					Action <span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-default pull-right" role="menu">
					
					<!-- Category EDITING LINK -->
					<li>
						<a href="#" onclick="editIncomeCategory('<?php echo $row['income_category_id'];?>')">
							<i class="entypo-pencil"></i>
								<?php echo get_phrase('edit');?>
							</a>
									</li>
					<li class="divider"></li>
					
					<!-- Category DELETION LINK -->
					<li>
						<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/income_category/delete/<?php echo $row['income_category_id'];?>');">
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

function editIncomeCategory(incomeCategoryID) {
	$.ajax({
		type: 'GET',
		url: '<?php echo base_url();?>index.php?admin/ajax_income_category_edit/' + incomeCategoryID,
		beforeSend: function () {
			$('#loading2').show();
			$('#overlayDiv').show();
		},
		success: function (data) {
			var jData = JSON.parse(data);

			toastr.success(jData.msg);
			$("#editIncomeCategoryHolder").html(jData.html);
			$('body,html').animate({
				scrollTop: 350
			}, 800);
			$('#loading2').fadeOut('slow');
			$('#overlayDiv').fadeOut('slow');
		}
	});
}

</script>