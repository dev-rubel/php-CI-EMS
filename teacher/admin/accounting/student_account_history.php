<table class="table table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Type</th>
        <th>Name</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
    <?php if(!empty($student_payment)): $totalAmount = 0; foreach($student_payment as $k=>$each):?>
    <?php   $multipleValue = strpos($each['fee_name'], ','); 
            if($multipleValue !== false): 
            $multiplefee_name = explode(',',$each['fee_name']); 
            $multipleAmount = explode(',',$each['fee_amount']);  
            $multipleMonths = explode(',',$each['months']);  
            foreach($multiplefee_name as $k2=>$each2): 
                $totalAmount += $multipleAmount[$k2];
        ?>
        <tr>      
            <td><?php echo date('d-m-y', $each['creation_timestamp']);?></td>
            <td><?php echo ucwords(str_replace('_',' ',$multiplefee_name[$k2]));?></td>
            <td><?php echo $multiplefee_name[$k2]=='tution_fee'?ucfirst($each['months']):'';?></td>
            <td><?php echo $multipleAmount[$k2];?></td>
        </tr>
    <?php endforeach; else: $totalAmount += $each['amount'];?>
        <tr>      
            <td><?php echo date('d-m-y', $each['creation_timestamp']);?></td>
            <td><?php echo ucwords(str_replace('_',' ',$each['fee_name']));?></td>
            <td><?php echo ucfirst($each['months']);?></td>
            <td><?php echo $each['amount'];?></td>
        </tr>
    <?php endif;?>
    <?php endforeach; else:?>
        <tr class="text-center">
            <td colspan="4">No Record Found</td>
        </tr>
    <?php endif;?>
        <tr>
            <td><b>Total<b></td>
            <td></td>
            <td></td>
            <td><?php echo $totalAmount;?></td>
        </tr>
    </tbody>
  </table>