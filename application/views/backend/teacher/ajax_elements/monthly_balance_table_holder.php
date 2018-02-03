<table class="table table-bordered">
	<thead>
		<tr>
			<th>Month</th>
			<th>Income</th>
			<th>Expense</th>
			<th>Balance</th>
			<th>Cash IN (Bank)</th>
			<th>Cash OUT (Bank)</th>
			<th>Balance (Bank)</th>
		</tr>
	</thead>
	<tbody>
<?php foreach(range(1, 12) as $list): 
		$monthName = date('F', mktime(0, 0, 0, $list, 10));
		$first_day_of_month = date('01-m-'.$year, strtotime('01-'.$list.'-'.$year));
		$last_day_of_month = date('t-m-'.$year, strtotime('01-'.$list.'-'.$year)); 
	?>

		<tr>
			<td><?php echo $monthName.' &nbsp;&nbsp;&nbsp;('.$first_day_of_month.' <b>to</b> '.$last_day_of_month.')'; ?></td>
			<td>
			<?php 
			// INCOME BALANCE 
			$this->db->select_sum('amount');
			$this->db->where('timestamp >=', strtotime($first_day_of_month));
			$this->db->where('timestamp <=', strtotime($last_day_of_month));
			$this->db->where('payment_type' , 'income');					
			$income_amount = $this->db->get('payment');
			$income = $income_amount->row()->amount;
			echo $income !=0? $income.' tk/=':0;
		?>
			</td>
			<td>
			<?php 
			// EXPENSE BALANCE
			$this->db->select_sum('amount');
			$this->db->where('date >=', strtotime($first_day_of_month));
			$this->db->where('date <=', strtotime($last_day_of_month));				
			$expense_amount = $this->db->get('daily_expense');
			$expense = $expense_amount->row()->amount;
			echo $expense !=0? $expense.' tk/=':0;
		?>
			</td>
			<td>
		<?php echo $income-$expense.' tk/='; ?> <!-- INCOME - EXPENSE =  BALACNE -->
		<?php $grand_income += $income; $grand_expense += $expense; ?>
			</td>
			<td>
				<?php  
					// SELECT OLDEST DATE TO THIS MOUNTH INCOME
					$this->db->select_sum('tran_amount');
					$this->db->where('tran_date >=', strtotime($first_day_of_month));
					$this->db->where('tran_date <=', strtotime($last_day_of_month));
					$this->db->where('tran_status' , 1);					
					$amount_i = $this->db->get('bank_transaction');
					$amount_in = $amount_i->row()->tran_amount;
					echo $amount_in;
				?>
			</td>
			<td>
				<?php 
					// SELECT OLDEST DATE TO THIS MOUNTH EXPENSE
					$this->db->select_sum('tran_amount');
					$this->db->where('tran_date >=', strtotime($first_day_of_month));
					$this->db->where('tran_date <=', strtotime($last_day_of_month));
					$this->db->where('tran_status' , 2);					
					$amount_o = $this->db->get('bank_transaction');
					$amount_out = $amount_o->row()->tran_amount;
					echo $amount_out;
				?>
			</td>
			<td>
				<?php 
					// CURRENT BALANCE THIS MOUNTH (BANK)	
					// SELECT OLDEST DATE TO THIS MOUNTH INCOME
					$this->db->select_sum('tran_amount');
					$this->db->where('tran_date >=', strtotime($oldestDate));
					$this->db->where('tran_date <=', strtotime($last_day_of_month));
					$this->db->where('tran_status' , 1);					
					$amount_i = $this->db->get('bank_transaction');
					$amount_in = $amount_i->row()->tran_amount;
			
					// SELECT OLDEST DATE TO THIS MOUNTH EXPENSE
					$this->db->select_sum('tran_amount');
					$this->db->where('tran_date >=', strtotime($oldestDate));
					$this->db->where('tran_date <=', strtotime($last_day_of_month));
					$this->db->where('tran_status' , 2);					
					$amount_o = $this->db->get('bank_transaction');
					$amount_out = $amount_o->row()->tran_amount;

					echo $amount_in-$amount_out;
				?>
			</td>
		</tr>

		<?php endforeach; ?>
		<tr>
			<td><?php echo date('F', mktime(0, 0, 0, 1, 10)).' <b>to</b> '.date('F', mktime(0, 0, 0, 12, 10)); ?></td>
			<td><?php echo $grand_income.' tk/='; ?></td>
			<td><?php echo $grand_expense.' tk/='; ?></td>
			<td><?php echo $grand_income-$grand_expense.' tk/='; ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>

	</tbody>
</table>