<br><br>
<?php 
function checkUnpaid($monthArray) {
    $monthNum = date('m');
    for($i = 1; $i <= $monthNum; $i++) {
        $month = date('F', mktime(0, 0, 0, $i, 10));
        $monthl = strtolower($month);
        if(!in_array($monthl, $monthArray)) {
            $unpaidMonth[] = ucfirst(substr($monthl,0,3)) ;
        }
    }
    return $unpaidMonth;
}
?>
<div class="row">
<form action="<?php echo base('a/accounting','send_unpaid_sms');?>" method="post">
    <div class="col-md-offset-1 col-md-10">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Roll</th>
                    <th>Name</th>
                    <th>Unpaid Month</th>
                    <th>Unpaid Amount</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Due</th>
                    <th>Mobile</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($enroll)): 
                foreach($enroll as $k => $each): 
                    if(!empty(checkUnpaid($students[$each['student_id']]['months']))):  
                        $remain_month = checkUnpaid($students[$each['student_id']]['months']); 
            ?>
                <tr>
                <td><?php echo $each['roll']; ?></td>
                    <td><?php echo $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->name; ?></td>
                    <td><?php echo implode(',',$remain_month); ?></td>
                    <td><?php 
                        $group_name = $this->db->get_where('group',['group_id'=>$each['group_id']])->row()->name;     
                        if($group_name == 'Bangla Medium'){
                            $dueAmountTotal += count($remain_month)*600;
                            echo count($remain_month)*600;
                        } elseif($group_name == 'English Version') {
                            $dueAmountTotal += count($remain_month)*900;
                            echo count($remain_month)*900;
                        } else {
                            echo count($remain_month)*900;
                        }
                    ?></td>
                    <td><?php echo $students[$each['student_id']]['amount']; ?></td>
                    <td><?php echo $students[$each['student_id']]['amount_paid'];; ?></td>                    
                    <td><?php echo $students[$each['student_id']]['due'];; ?></td>
                    <td><?php $mobile = $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->mobile; echo $mobile; ?></td>

                    <input type="hidden" name="mobile[<?php echo $each['student_id']; ?>]" value="<?php echo $mobile;?>">
                </tr>   
                <?php endif; endforeach; endif; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-info">Send SMS</button>
    </div>

</form>

</div>
