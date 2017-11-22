<style type="text/css">
	@media print 
		 {
		 body { margin: 0; background-color: green; font-size: 12pt; }
		 }
</style>

<div class="row">
	<div class="col-md-10">
		<h2>Today Balance Sheet</h2>
	</div>
	<div class="col-md-2">
		<br>
		<button class="btn btn-md btn-info" onclick="printdiv('today_balance_sheet','Today Balance Sheet')">Print</button>	
	</div>
</div>
<hr>
<div class="row" id="today_balance_sheet">
<div class="col-md-10 col-md-offset-1">

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Month</th>
      <th>Income</th>
      <th>Expense</th>
      <th>Balance</th>
      <th>Bank(Current Balance)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo date('d-M-Y'); ?></td>
      <td>
      <?php 
			$this->db->select_sum('amount');
			$this->db->where('timestamp >=', strtotime(date('d-m-Y')));
			$this->db->where('timestamp <=', strtotime(date('d-m-Y')));
			$this->db->where('payment_type' , 'income');					
			$income_amount = $this->db->get('payment');
			$income = $income_amount->row()->amount;
			echo $income !=0? $income.' tk/=':0;
		 ?>
      </td>
      <td>
      <?php 
			$this->db->select_sum('amount');
			$this->db->where('date >=', strtotime(date('d-m-Y')));
			$this->db->where('date <=', strtotime(date('d-m-Y')));
			//$this->db->where('payment_type' , 'expense');					
			$expense_amount = $this->db->get('daily_expense');
			$expense = $expense_amount->row()->amount;
			echo $expense !=0? $expense.' tk/=':0;
		 ?>
      </td>
      <td><?php echo $income-$expense.' tk/='; ?></td>
      <td>
      	<?php  
      		$this->db->select_sum('tran_amount');
			$this->db->where('tran_date >=', strtotime(date('d-m-Y')));
			$this->db->where('tran_date <=', strtotime(date('d-m-Y')));
			$this->db->where('tran_status' , 1);					
			$amount_i = $this->db->get('bank_transaction');
			$amount_in = $amount_i->row()->tran_amount;
			
			$this->db->select_sum('tran_amount');
			$this->db->where('tran_date >=', strtotime(date('d-m-Y')));
			$this->db->where('tran_date <=', strtotime(date('d-m-Y')));
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


<div class="wrapper">
	<div class="row">
		<div class="col-md-10">
			<h2>Monthly Balance Sheet</h2>
		</div>
		<div class="col-md-2">
			<br>
			<button class="btn btn-md btn-info" onclick="printdiv('monthly_balance_sheet','Monthly Balance Sheet')">Print</button>	
		</div>
	</div>
<div id="monthly_balance_sheet">
<div class="col-md-10 col-md-offset-1">

<br><br>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Month</th>
      <th>Income</th>
      <th>Expense</th>
      <th>Balance</th>
      <th>Bank(Current Balance)</th>
    </tr>
  </thead>
  <tbody>
<?php foreach(range(1, 12) as $list): 
		$monthName = date('F', mktime(0, 0, 0, $list, 10));
		$first_day_of_month = date('01-m-Y', strtotime('01-'.$list.'-2017'));
		$last_day_of_month = date('t-m-Y', strtotime('01-'.$list.'-2017')); 
	?>

    <tr>
      <td><?php echo $monthName.' &nbsp;&nbsp;&nbsp;('.$first_day_of_month.' <b>to</b> '.$last_day_of_month.')'; ?></td>
      <td>
      <?php 
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
			$this->db->select_sum('amount');
			$this->db->where('date >=', strtotime($first_day_of_month));
			$this->db->where('date <=', strtotime($last_day_of_month));
			//$this->db->where('payment_type' , 'expense');					
			$expense_amount = $this->db->get('daily_expense');
			$expense = $expense_amount->row()->amount;
			echo $expense !=0? $expense.' tk/=':0;
		 ?>
      </td>
      <td>
		<?php echo $income-$expense.' tk/='; ?>
		<?php $grand_income += $income; $grand_expense += $expense; ?>
      </td>
      <td>
      	<?php  
      		$this->db->select_sum('tran_amount');
			$this->db->where('tran_date >=', strtotime($first_day_of_month));
			$this->db->where('tran_date <=', strtotime($last_day_of_month));
			$this->db->where('tran_status' , 1);					
			$amount_i = $this->db->get('bank_transaction');
			$amount_in = $amount_i->row()->tran_amount;
			
			$this->db->select_sum('tran_amount');
			$this->db->where('tran_date >=', strtotime($first_day_of_month));
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
    </tr>

  </tbody>
</table>

</div>
</div>


</div>

<script type="text/javascript">
	
	function printdiv(elem, title)
	{
	    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

	    mywindow.document.write('<html><head><title>' + title  + '</title>');
	    mywindow.document.write('<style>.row{}table{width: 100%; border: 1px solid; border-collapse: collapse; text-align: left;} table th, td{border: 1px solid; padding: 10px 0px; padding-left: 5px;}</style>');
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