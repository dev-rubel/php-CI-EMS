<table class="table table-bordered">
	<thead>
		<tr>
		<th>#</th>
		<th>Account Name</th>
		<th>Account No.</th>
		<th>Account Description</th>
		<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $count = 0;
	if(!empty($accounts)):
	foreach($accounts as $each): ?>
			<tr id="bank_account<?php echo $each['acc_id'];?>">
			<th scope="row"><?php echo $count++; ?></th>
			<td><?php echo $each['acc_name'] ?></td>
			<td><?php echo $each['acc_no'] ?></td>
			<td><?php echo $each['acc_details'] ?></td>
			<td>
				<a href="#" class="btn btn-xs btn-primary" onclick="editBankAC('<?php echo $each['acc_id'];?>')">Edit</a>
				
				<a href="#" class="btn btn-xs btn-danger" onclick="confDelete('admin','ajax_delete_bank_account','<?php echo $each['acc_id'];?>','bank_account<?php echo $each['acc_id'];?>')">Delete</a>
			</td>
			</tr>
		<?php endforeach;
		else:
		echo '<tr class="text-center">';
		echo '<td colspan="5">No Account Found</td>';
		echo '</tr>';
		endif;
		?>
	</tbody>
</table>


<script>

function editBankAC(BankACID) {
	$.ajax({
		type: 'GET',
		url: '<?php echo base_url();?>index.php?teacher/ajax_edit_bank_ac/' + BankACID,
		beforeSend: function () {
			$('#loading2').show();
			$('#overlayDiv').show();
		},
		success: function (data) {
			var jData = JSON.parse(data);

			toastr.success(jData.msg);
			$("#editBankACHolder").html(jData.html);
			$('body,html').animate({
				scrollTop: 350
			}, 800);
			$('#loading2').fadeOut('slow');
			$('#overlayDiv').fadeOut('slow');
		}
	});
}
</script>