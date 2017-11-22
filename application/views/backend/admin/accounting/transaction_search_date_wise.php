<?php //print_r($bank_transactions); ?>

<!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <title><?php echo 'Report: '.$fromDate.' TO '.$toDate; ?></title>
 
     <!-- Bootstrap -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
 
     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
     <![endif]-->
   </head>
   <body onload="window.print()">

	<h3 class="text-center"><?php echo $fromDate.' TO '.$toDate; ?></h3>
   	<!-- RESULT DATA -->
	<table class="table table-bordered" >
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Date</th>
	      <th>Account Name</th>
	      <th>Account No.</th>
	      <th>Transaction</th>
	      <th class="sum">Amount</th>	      
	    </tr>
	  </thead>
	  
	  <tbody>
	  <?php  if(!empty($bank_transactions)): 
	      $count = 0;
	      foreach($bank_transactions as $each): 
	      $key = array_search($each['acc_id'], array_column($bank_accounts, 'acc_id'));
	  ?>
	    <tr>
	      <td><?php echo $count += 1; ?></td>
	      <td><?php echo date('d-m-Y', $each['tran_date']); ?></td>
	      <td><?php echo $bank_accounts[$key]['acc_name'];?></td>
	      <td><?php echo $bank_accounts[$key]['acc_no'];?></td>
	      <td  class="<?php echo $each['tran_status'] == 1?'cash-in':'cash-out';?>"><?php echo $each['tran_status'] == 1?'Cash IN':'Cash Out'; ?></td>
	      <td><?php echo $each['tran_amount']; ?></td>	      
	    </tr>	    
	  <?php endforeach; ?>
	  <tr>
	  	<td>Total: </td>
	   	<td colspan="5" class="text-center"><?php echo array_sum(array_column($bank_transactions, 'tran_amount')); ?> TK.</td>
	  </tr>
	  <?php else: ?>
	      <tr class="text-center">
	        <td colspan="6">No Transaction Found</td>
	      </tr>
	  <?php endif; ?>
	  </tbody>

	</table>
     
 
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
   </body>
 </html> 

