<style type="text/css">
	@media print 
		 {
		 body { margin: 0; background-color: green; font-size: 12pt; }
		 table {border: 1px solid;}
		 }
</style>

<div class="row">
	<div class="col-md-10">
		<h2>Current Month Balance Sheet (<?php echo date('M'); ?>)</h2>
	</div>
	<div class="col-md-2">
		<br>
		<button class="btn btn-md btn-info" onclick="printdiv('current_month_balance_sheet','Current Month Balance Sheet')">Print</button>	
	</div>
</div>
<hr>
<div class="row" id="current_month_balance_sheet">
<div class="col-md-10 col-md-offset-1">

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
    <tr>
      <td><?php echo date('M'); ?></td>
      <td>
      <?php 
			$this->db->select_sum('amount');
			$this->db->where('timestamp >=', strtotime(date('01-m-Y')));
			$this->db->where('timestamp <=', strtotime(date('t-m-Y')));
			$this->db->where('payment_type' , 'income');					
			$income_amount = $this->db->get('payment');
			$income = $income_amount->row()->amount;
			echo $income !=0? $income.' tk/=':0;
		 ?>
      </td>
      <td>
      <?php 
			$this->db->select_sum('amount');
			$this->db->where('date >=', strtotime(date('01-m-Y')));
			$this->db->where('date <=', strtotime(date('t-m-Y')));					
			$expense_amount = $this->db->get('daily_expense');
			$expense = $expense_amount->row()->amount;
			echo $expense !=0? $expense.' tk/=':0;
		 ?>
      </td>
      <td><?php echo $income-$expense.' tk/='; ?></td>
			<td>
				 <?php
				 		// SELECT OLDEST DATE TO TODAY DATE INCOME 
						$this->db->select_sum('tran_amount');
						$this->db->where('tran_date >=', strtotime(date('01-m-Y')));
						$this->db->where('tran_date <=', strtotime(date('t-m-Y')));
						$this->db->where('tran_status' , 1);					
						$amount_i = $this->db->get('bank_transaction');
						$amount_in = $amount_i->row()->tran_amount;
						echo $amount_in;
				 ?>
			</td>
			<td>
				<?php 
						// SELECT OLDEST DATE TO TODAY DATE EXPENSE
						$this->db->select_sum('tran_amount');
						$this->db->where('tran_date >=', strtotime(date('01-m-Y')));
						$this->db->where('tran_date <=', strtotime(date('t-m-Y')));
						$this->db->where('tran_status' , 2);					
						$amount_o = $this->db->get('bank_transaction');
						$amount_out = $amount_o->row()->tran_amount;
						echo $amount_out;
				?>
			</td>
      <td>
      	<?php  
      		$this->db->select_sum('tran_amount');
			$this->db->where('tran_date >=', strtotime(date('01-m-Y')));
			$this->db->where('tran_date <=', strtotime(date('t-m-Y')));
			$this->db->where('tran_status' , 1);					
			$amount_i = $this->db->get('bank_transaction');
			$amount_in = $amount_i->row()->tran_amount;
			
			$this->db->select_sum('tran_amount');
			$this->db->where('tran_date >=', strtotime(date('01-m-Y')));
			$this->db->where('tran_date <=', strtotime(date('t-m-Y')));
			$this->db->where('tran_status' , 2);					
			$amount_o = $this->db->get('bank_transaction');
			$amount_out = $amount_o->row()->tran_amount;

			echo $amount_in-$amount_out;
      	?>
      </td>
    </tr>
  </tbody>
</table>
	
</div>
</div>

<hr>

<div class="row">
	<div class="col-md-10">
		<h2>Total Balance Sheet (From Beginning)</h2>
	</div>
	<div class="col-md-2">
		<br>
		<button class="btn btn-md btn-info" onclick="printdiv('total_balance_sheet','Total Balance Sheet (From Beginning)')">Print</button>	
	</div>
</div>
<hr>
<div class="row" id="total_balance_sheet">
<div class="col-md-10 col-md-offset-1">

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
    <tr>
      <td>From Beginning</td>
      <td>
      <?php 
			$this->db->select_sum('amount');
			$this->db->where('payment_type' , 'income');					
			$income_amount = $this->db->get('payment');
			$income = $income_amount->row()->amount;
			echo $income !=0? $income.' tk/=':0;
		 ?>
      </td>
      <td>
      <?php 
			$this->db->select_sum('amount');			
			$expense_amount = $this->db->get('daily_expense');
			$expense = $expense_amount->row()->amount;
			echo $expense !=0? $expense.' tk/=':0;
		 ?>
      </td>
      <td><?php echo $income-$expense.' tk/='; ?></td>
			<td>
				 <?php
				 	// SELECT OLDEST DATE
					$this->db->order_by('tran_date', 'ASC');
					$oldestDate = $this->db->get('bank_transaction', 1)->row()->tran_date;

					// SELECT OLDEST DATE TO THIS MOUNTH INCOME
      		$this->db->select_sum('tran_amount');
					$this->db->where('tran_date >=', $oldestDate);
					$this->db->where('tran_date <=', strtotime(date('t-m-Y')));
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
					$this->db->where('tran_date >=', $oldestDate);
					$this->db->where('tran_date <=', strtotime(date('t-m-Y')));
					$this->db->where('tran_status' , 2);					
					$amount_o = $this->db->get('bank_transaction');
					$amount_out = $amount_o->row()->tran_amount;
					echo $amount_out;
				?>
			</td>
      <td>
      	<?php  
      		$this->db->select_sum('tran_amount');
					$this->db->where('tran_status' , 1);					
					$amount_i = $this->db->get('bank_transaction');
					$amount_in = $amount_i->row()->tran_amount;
					
					$this->db->select_sum('tran_amount');
					$this->db->where('tran_status' , 2);					
					$amount_o = $this->db->get('bank_transaction');
					$amount_out = $amount_o->row()->tran_amount;

					echo $amount_in-$amount_out.' tk/=';
      	?>
      </td>
    </tr>
  </tbody>
</table>


</div>
</div>


<script type="text/javascript">
	
	function printdiv(elem, title)
	{
	    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

	    mywindow.document.write('<html><head><title>' + title  + '</title>');
	    mywindow.document.write('<style>.row{}table{width: 100%; border: 1px solid; border-collapse: collapse; text-align: center;} table th, td{border: 1px solid; padding: 10px 0px;}</style>');
	    mywindow.document.write('</head><body>');
	    mywindow.document.write('<h1 style="text-align: center;">' + title  + '</h1>');

	    mywindow.document.write(document.getElementById(elem).innerHTML);
	    mywindow.document.write('</body></html>');

	    mywindow.document.close(); // necessary for IE >= 10
	    mywindow.focus(); // necessary for IE >= 10*/

	    mywindow.print();
	    mywindow.close();

	    return true;
	}
</script>