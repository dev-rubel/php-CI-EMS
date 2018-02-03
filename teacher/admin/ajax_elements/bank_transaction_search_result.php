<h3>Form: <?php echo $fromDate;?> || TO: <?php echo $toDate;?> </h3>

<table class="table table-bordered datatable">
  <thead>
	<tr>
	  <th>#</th>
	  <th>Account Name</th>
	  <th>Account No.</th>
	  <th>Transaction</th>
	  <th class="sum">Amount</th>
	  <th>Date</th>
	  <th>Action</th>
	</tr>
  </thead>
  
  <tbody>
  <?php  if(!empty($bank_transactions)): 
	  $count = 0;
	  $inAmount = 0;
	  $outAmount = 0;
	  $totalAmount = 0;
	  foreach($bank_transactions as $each): 
	  $key = array_search($each['acc_id'], array_column($bank_accounts, 'acc_id'));
  ?>
	<tr id="acc_transaction<?php echo $each['tran_id'];?>">
	  <td><?php echo $count += 1; ?></td>
	  <td><?php echo $bank_accounts[$key]['acc_name'];?></td>
	  <td><?php echo $bank_accounts[$key]['acc_no'];?></td>
	  <td class="<?php echo $each['tran_status'] == 1?'cash-in':'cash-out';?>"><?php echo $each['tran_status'] == 1?'Cash IN':'Cash Out'; ?></td>
	  <td><?php echo $each['tran_amount']; ?></td>
	  <td><?php echo date('d-m-Y', $each['tran_date']); ?></td>
	  <td>
		<a href="#" class="btn btn-xs btn-danger" onclick="confDelete('admin','ajax_delete_acc_transaction','<?php echo $each['tran_id'];?>','acc_transaction<?php echo $each['tran_id'];?>')">Delete</a>
	  </td>
	</tr>
	<?php 
		if($each['tran_status'] == 1){
			$inAmount += $each['tran_amount'];
		}
		if($each['tran_status'] == 2){
			$outAmount += $each['tran_amount'];
		}
		$totalAmount += $each['tran_amount'];
		
	?>
	
  <?php endforeach; ?>
	<tr>
		<td colspan="7"></td>
	</tr>	
  <?php else:?>
	  <tr class="text-center">
		<td colspan="6">No Transaction Found</td>
	  </tr>
  <?php endif; ?>
  </tbody>

</table>


<table class="table table-bordered">
	<thead>
		<tr>
		  <th>#</th>
		  <th>Type</th>
		  <th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td class="cash-in">Total Cash IN: </td>
			<td><?php echo $inAmount;?></td>
		</tr>
		<tr>
			<td>2</td>
			<td class="cash-out">Total Cash OUT: </td>
			<td><?php echo $outAmount;?></td>
		</tr>

		<tr>
			<td>3</td>
			<td>Total: </td>
			<td><?php echo $totalAmount;?></td>
		</tr>
	</tbody>
	
</table>