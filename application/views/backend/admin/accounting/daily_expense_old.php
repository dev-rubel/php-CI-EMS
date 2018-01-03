<hr />
<style>
	input.form-control {
        /*min-width: 80px;*/
        border: 1px solid lightslategray;
    }
    b{
        color: black;
    }
    table thead tr{
    	display:block;
	}

	table th,table td{
	    min-width:100px; 
	    /*fixed width*/
	}


	table  tbody{
	  display:block;
	  height:500px;
	  overflow:auto;//set tbody to auto
	}


</style>

<?php //pd(date('d-m-Y', '1483207200')); ?>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
		<?php foreach(range(1, 12) as $each): $month = date('M', mktime(0,0,0,$each, 1, date('Y')));?>
			<li class="<?php 
			if(isset($_SESSION['working_month'])){
				if($_SESSION['working_month'] == $each){
					echo 'active';
				}
			}else{
				if($each == date('m')){
					echo 'active';
				}
			}
			?>">
            	<a href="#list_<?php echo $each; ?>" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase($month);?>
            	</a>
        	</li>
    	<?php endforeach; ?>
			
		</ul>
    	<!------ CONTROL TABS END ------>
		<div class="tab-content">
        <br>
            <!----TABLE LISTING STARTS-->

            <?php foreach(range(1, 12) as $eachs): ?>

            <div class="tab-pane box <?php 
			if(isset($_SESSION['working_month'])){
				if($_SESSION['working_month'] == $eachs){
					echo 'active';
				}
			}else{
				if($eachs == date('m')){
					echo 'active';
				}
			} ?>" id="list_<?php echo $eachs; ?>">
                <table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<?php foreach($expense_category as $each): ?>
								<th><b><?php echo $each['name']; ?></b></th>
							<?php endforeach; ?>
							<th>Total</th>
						</tr>
					</thead>
					<form action="<?php echo base('a/accounting', 'add_daily_expense'); ?>" method="post">
						<tbody>

						<?php $number = cal_days_in_month(CAL_GREGORIAN, $eachs, date('Y')); 
							for ($i = 1; $i <= $number; $i++):
						?>
							<tr>
								<td><b><?php echo date("$i-$eachs-Y"); ?></b></td>
								<?php 
								$day_total_amount = 0;
								foreach($expense_category as $each): 

							$exist = $this->db->get_where('daily_expense', array('expense_category_id' => $each['expense_category_id'], 'date' => strtotime(date("$i-$eachs-Y"))))->result_array();
							if(!empty($exist)){
								if($exist[0]['amount'] == 0){
									$value = '';
								}else{
									$value = $exist[0]['amount'];
								}	
								$day_total_amount += $exist[0]['amount'];						
							}else{
								$value = '';
							}

									?>
									<td>
										<input type="text" class="form-control" value="<?php echo $value; ?>" name="<?php echo $each['expense_category_id'].'_'.strtotime(date("$i-$eachs-Y")); ?>_expense[]">
									</td>
								<?php endforeach; ?>
								<td><?php echo $day_total_amount; ?></td>
							</tr>
						<?php endfor; ?>
						<tr>
							<td>Total</td>
							<?php 
							$grand_total = 0;
							foreach($expense_category as $each): 

									$this->db->select_sum('amount');
									$this->db->where('expense_category_id', $each['expense_category_id']);
									$this->db->where('date >=', strtotime(date("01-$eachs-Y")));
									$this->db->where('date <=', strtotime(date("t-$eachs-Y")));
									$category_month_total_amount = $this->db->get('daily_expense')->row();
							?>
								<td><?php echo $category_month_total_amount->amount.' TK.'; $grand_total += $category_month_total_amount->amount; ?></td>
							<?php endforeach; ?>
							<td><?php echo $grand_total.' TK.'; ?></td>
						</tr>
						<tr>
							<td>
								<button type="submit" class="btn btn-primary">Save</button>
							</td>
						</tr>
						</tbody>
					</form>
				</table>
			</div>

			<?php endforeach; ?>

		</div>
	</div>
</div>











