<style>
.bg-sms{
	background-color: #9684A3;
    color: #fff;
}
.bg-today-app{
	background-color: #83D6DE;
    color: #fff;
}
.bg-confirm-app{
	background-color: #D1D6A9;
    color: #fff;
}
.bg-padding-app{
	background-color: #FEC606;
    color: #fff;
}
</style>

  <div class="row">
    <div class="col-md-12">
          	<br><br>
      <!-- tabs left -->
      <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#today" data-toggle="tab">Today</a></li>
          <?php foreach(range(1, 12) as $list): 
				$monthName = date('F', mktime(0, 0, 0, $list, 10));
			?>
          <li><a href="#monthly<?php echo $monthName; ?>" data-toggle="tab"><?php echo $monthName; ?></a></li>
  			<?php endforeach; ?>

          <li><a href="#yearly" data-toggle="tab">Yearly</a></li>
        </ul>
        <div class="tab-content">

         <div class="tab-pane active" id="today">
         	<div class="row">
				<div class="col-md-10">
					<h2>Today Balance Sheet (<?php echo date('d-M-Y'); ?>)</h2>
				</div>
				<div class="col-md-2">
					<br>
					<button class="btn btn-md btn-info" onclick="printdiv('today_balance_sheet','Today Balance Sheet (<?php echo date("d-M-Y"); ?>)')">Print</button>	
				</div>
			</div>
			<hr>
			<div class="row" id="today_balance_sheet">
			<div class="col-md-10 col-md-offset-1">

				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><h3>Source</h3></th>
							<th><h3>Amount</h3></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$expense_category = $this->db->get('expense_category')->result_array();
					 foreach($expense_category as $each): 
					 	$this->db->select_sum('amount');
					 	$this->db->where('expense_category_id', $each['expense_category_id']);
					 	$this->db->where('date', strtotime(date('d-m-Y')));
				 		$today_ex = $this->db->get('daily_expense')->row();
					 	?>
						<tr>
							<td><?php echo $each['name']; ?></td>
							<td>
								<?php echo number_format($today_ex->amount).' tk/='; $today_total +=  $today_ex->amount;?>
							</td>
						</tr>
					<?php endforeach; ?>

						<tr>
							<td></td>
							<td style="font-weight: bold;">Total: 
								<?php echo number_format($today_total).' tk/='; ?>
							</td>
						</tr>
						</tbody>
					</table>
			</div>
			</div>
         </div>


         <?php foreach(range(1, 12) as $list): 
				$monthName = date('F', mktime(0, 0, 0, $list, 10));
				$first_day_of_month = date('01-m-Y', strtotime('01-'.$list.'-2017'));
				$last_day_of_month = date('t-m-Y', strtotime('01-'.$list.'-2017')); 
				$monthly_total = 0;
			?>
         <div class="tab-pane" id="monthly<?php echo $monthName; ?>">
         	

         	<div class="row">
				<div class="col-md-10">
					<h2>Monthly Balance Sheet (<?php echo date('F', mktime(0, 0, 0, $list, 10)); ?>)</h2>
				</div>
				<div class="col-md-2">
					<br>
					<button class="btn btn-md btn-info" onclick="printdiv('category_balance_sheet_<?php echo $monthName; ?>','Monthly Balance Sheet (<?php echo $monthName; ?>)')">Print</button>	
				</div>
			</div>
			<hr>
			<div class="row" id="category_balance_sheet_<?php echo $monthName; ?>">
			<div class="col-md-10 col-md-offset-1">

				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><h3>Source</h3></th>
							<th><h3>Amount</h3></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$expense_category = $this->db->get('expense_category')->result_array();
					 foreach($expense_category as $each): 
					 	$this->db->select_sum('amount');
						$this->db->where('date >=', strtotime($first_day_of_month));
						$this->db->where('date <=', strtotime($last_day_of_month));
						$this->db->where('expense_category_id' , $each['expense_category_id']);		
						$monthly_ex = $this->db->get('daily_expense')->row();
					 	?>
						<tr>
							<td><?php echo $each['name']; ?></td>
							<td>
								<?php echo number_format($monthly_ex->amount).' tk/='; $monthly_total +=  $monthly_ex->amount; ?>
							</td>
						</tr>
					<?php endforeach; ?>

						<tr>
							<td></td>
							<td style="font-weight: bold;">Total: 
							<?php $store_monthly_amount[$monthName] =  $monthly_total;?>
								<?php echo number_format($monthly_total).' tk/='; ?>
							</td>
						</tr>
						</tbody>
					</table>
			</div>
			</div>


         </div>
     	<?php endforeach; ?>




         <div class="tab-pane" id="yearly">

		    <div class="row">
				<div class="col-md-10">
					<h2>Yearly Balance Sheet</h2>
				</div>
				<div class="col-md-2">
					<br>
					<button class="btn btn-md btn-info" onclick="printdiv('yearly_balance_sheet','Yearly Balance Sheet')">Print</button>	
				</div>
			</div>
			<hr>
			<div class="row" id="yearly_balance_sheet">
			<div class="col-md-10 col-md-offset-1">

				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><h4>Source</h4></th>
							<?php foreach(range(1, 12) as $list): 
								$monthName = date('F', mktime(0, 0, 0, $list, 10));
								$first_day_of_month = date('01-m-Y', strtotime('01-'.$list.'-2017'));
								$last_day_of_month = date('t-m-Y', strtotime('01-'.$list.'-2017')); 
							?>
							<th><h4><?php echo substr($monthName, 0, 3); ?></h4></th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
					<?php
						$expense_category = $this->db->get('expense_category')->result_array();
					 foreach($expense_category as $each): 
					 	?>
						<tr>
							<td><?php echo $each['name']; ?></td>
							<?php 
						foreach(range(1, 12) as $list): 
							$monthName = date('F', mktime(0, 0, 0, $list, 10));
							$first_day_of_month = date('01-m-Y', strtotime('01-'.$list.'-2017'));
							$last_day_of_month = date('t-m-Y', strtotime('01-'.$list.'-2017')); 


						 	$this->db->select_sum('amount');
							$this->db->where('date >=', strtotime($first_day_of_month));
							$this->db->where('date <=', strtotime($last_day_of_month));
							$this->db->where('expense_category_id' , $each['expense_category_id']);		
							$yearly_ex = $this->db->get('daily_expense')->row();
							 ?>
							<td>
								<?php echo number_format($yearly_ex->amount).' tk/='; $yearly_total +=  $yearly_ex->amount; ?>
							</td>
						<?php endforeach; ?>
						</tr>
					<?php endforeach;?>

						<tr>
							<td>Yearly Total: </td>
							<?php foreach($store_monthly_amount as $each): ?>
							<td style="font-weight: bold;">
								<?php echo number_format($each).' tk/='; ?>
							</td>
							<?php endforeach; ?>
						</tr>
						
						</tbody>
						<tfoot>
							<tr>
								<th colspan="13" class="text-center" style="padding-top: 10px;"><h3>Yearly Grand Total: <?php echo $yearly_total; ?></h3></th>
							</tr>
						</tfoot>
					</table>
			</div>
			</div>

         </div>

        </div>
      </div>
      <!-- /tabs -->
      
    </div>   
  </div><!-- /row -->





<script type="text/javascript">
	
	function printdiv(elem, title)
	{
	    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

	    mywindow.document.write('<html><head><title>' + title  + '</title>');
	    mywindow.document.write('<style>table, td, th{border: 1px solid;}table{border-collapse: collapse;width: 100%; text-align: center;} table, td{padding: 10px;}</style>');
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