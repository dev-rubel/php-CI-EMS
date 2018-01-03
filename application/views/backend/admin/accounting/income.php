
<hr />
<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a href="#unpaid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('invoices');?></span>
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
			<br>
				<div class="tab-pane active" id="unpaid">	

				<form action="<?php echo base('a/accounting', 'income_date_search_result');?>" method="post" target="_blank">

				<div class="row">
					<div class="col-md-offset-2 col-md-1">
						<p>Date Search: </p>
					</div>
					<div class="col-md-3">					
						<input type="text" class="form-control datepicker" id="fromdate" placeholder="From Date" name="fromdate">		
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control datepicker" placeholder="To Date" id="max" name="todate">		
					</div>
					<div class="col-md-1">
						<button type="submit" class="btn btn-sm btn-info">Search</button>
					</div>
					
				</div>
		    </form>
			    	
				<br>
				</div>
				
			</div>
			
			
	</div>
</div>
