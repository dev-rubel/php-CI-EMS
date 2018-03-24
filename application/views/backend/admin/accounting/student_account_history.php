<style>
.vertical-center {
    vertical-align: middle !important;
}
</style>
<table class="table table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Type</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Total Amount</th>
        <th>Paid Amount</th>
        <th>Due</th>
      </tr>
    </thead>
    <tbody>
    <?php if(!empty($student_payment)): 
    $totalAmountPaid = 0; 
    $dueTotal = 0; 
    $totalAmount = 0;
    foreach($student_payment as $k=>$each):
        $multipleValue = strpos($each['fee_name'], ','); 
        $dueTotal += $each['due'];
        $totalAmountPaid += $each['amount_paid'];
        $totalAmount += $each['amount'];   
        
        if($multipleValue !== false): 
        $multiplefee_name = explode(',',$each['fee_name']); 
        $multipleAmount = explode(',',$each['fee_amount']);  
        $multipleMonths = explode(',',$each['months']);            
            foreach($multiplefee_name as $k2=>$each2):  
                
        ?>
        <tr valign="middle">      
            <td><?php echo date('d-m-y', $each['creation_timestamp']);?></td>
            <td><?php echo ucwords(str_replace('_',' ',$multiplefee_name[$k2]));?></td>
            <td><?php echo $multiplefee_name[$k2]=='tution_fee'?ucfirst($each['months']):'';?></td>
            <td><?php echo $multipleAmount[$k2];?></td>           
            
            <?php if($k2==0): ?>
                <td class="vertical-center" rowspan="<?php echo count($multiplefee_name);?>">
                    <?php echo array_sum($multipleAmount); ?>
                </td>
                <td class="vertical-center" rowspan="<?php echo count($multiplefee_name);?>">
                    <?php echo $each['amount_paid']; ?>
                </td>
                <td class="vertical-center" rowspan="<?php echo count($multiplefee_name);?>">
                    <?php echo $each['due'];?>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; else: ?>
        <tr>      
            <td><?php echo date('d-m-y', $each['creation_timestamp']);?></td>
            <td><?php echo ucwords(str_replace('_',' ',$each['fee_name']));?></td>
            <td><?php echo ucfirst($each['months']);?></td>
            <td><?php echo $each['amount'];?></td>
            <td><?php echo $each['amount'];?></td>
            <td><?php echo $each['amount_paid']; ?></td>
            <td><?php echo $each['due'];?></td>
        </tr>
    <?php endif;?>
    <?php endforeach; else:?>
        <tr class="text-center">
            <td colspan="7">No Record Found</td>
        </tr>
    <?php endif;?>
        <tr>
            <td><b>Total<b></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $totalAmount; ?></td>
            <td><?php echo $totalAmountPaid;?></td>
            <td><b><?php echo $totalAmount - $totalAmountPaid; ?></b></td>
        </tr>
    </tbody>
  </table>