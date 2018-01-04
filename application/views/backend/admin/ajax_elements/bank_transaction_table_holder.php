<table class="table table-bordered">
	<thead>
	  <tr>
		<th>#</th>
		<th>Account Name</th>
		<th>Account No.</th>
		<th>Total Cash IN</th>
		<th>Total Cash OUT</th>
		<th>Current Balance</th>
	  </tr>
	</thead>
	<tbody>
	<?php if(!empty($bank_accounts)): foreach($bank_accounts as $k=>$each): ?>
	  <tr>
		<td><?php echo $k+1; ?></td>
		<td><?php echo $each['acc_name']; ?></td>
		<td><?php echo $each['acc_no']; ?></td>
		<td>
		  <?php 
			$this->db->select_sum('tran_amount');
			$this->db->where('acc_id', $each['acc_id']);
			$this->db->where('tran_status', 1);
			$totalCashIN = $this->db->get('bank_transaction')->result_array();
			echo $totalCashIN[0]['tran_amount'];
		  ?>
		</td>
		<td>
		  <?php 
			$this->db->select_sum('tran_amount');
			$this->db->where('acc_id', $each['acc_id']);
			$this->db->where('tran_status', 2);
			$totalCashOUT = $this->db->get('bank_transaction')->result_array();
			echo $totalCashOUT[0]['tran_amount'];
		  ?>
		</td>
		<td>
		  <?php echo  $totalCashIN[0]['tran_amount']-$totalCashOUT[0]['tran_amount']?>
		</td>
	  </tr>
	<?php endforeach; else: ?>
	  <tr class="text-center">
		<td colspan="6">No Account Found</td>
	  </tr>
	<?php endif; ?>
	</tbody>
</table>