<?php
$edit_data = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();

//pd($edit_data);
foreach ($edit_data as $row):
?>
<center>
    <a onClick="PrintElem('#invoice_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Print Invoice
        <i class="entypo-print"></i>
    </a>
</center>

    <br><br>

    <div id="invoice_print">

        <table width="100%" border="0">    
            <tr>
                <td align="left"><h4><?php echo get_phrase('payment_info'); ?> </h4></td>
                <td align="right"><h4><?php echo get_phrase('student_information'); ?> </h4></td>
            </tr>

            <tr>
                <td align="left" valign="top">
                    <h5><?php echo get_phrase('creation_date'); ?> : <?php echo date('d-M-Y', $row['creation_timestamp']);?></h5>
                    <h5><?php echo get_phrase('invoice_id'); ?> : <?php echo $param2;?></h5>
                    <h5><?php 
                    if(strlen($row['description']) > 0){
                        echo get_phrase('description').': '.$row['description'];
                    }
                     ?></h5>

                    <h5><?php //echo get_phrase('status'); ?> <?php //echo ucfirst($row['status']); ?></h5>         
                </td>
                <td align="right" valign="top">
                    <?php 
                    if(!empty($row['student_id'])){
                        echo get_phrase('name: ') . ' ' . $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name.'<br>'; 
                    
                        $class_id = $this->db->get_where('enroll' , array(
                            'student_id' => $row['student_id'],
                                'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
                        ))->row()->class_id;
                        $shift_id = $this->db->get_where('enroll' , array(
                            'student_id' => $row['student_id'],
                                'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
                        ))->row()->shift_id;
                        $section_id = $this->db->get_where('enroll' , array(
                            'student_id' => $row['student_id'],
                                'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
                        ))->row()->section_id;
                        $std_roll = $this->db->get_where('enroll' , array(
                            'student_id' => $row['student_id'],
                                'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
                        ))->row()->roll;
                        if(!empty($class_id)){
                            echo get_phrase('shift: ') . ' ' . $this->db->get_where('shift', array('shift_id' => $shift_id))->row()->name.'<br>';
                            echo get_phrase('class: ') . ' ' . $this->db->get_where('class', array('class_id' => $class_id))->row()->name.'<br>';
                            
                            $group_name = ucfirst($this->db->get_where('group', array('class_id' => $class_id))->row()->name);
                            if(strlen($group_name) > 0){
                                echo get_phrase('group: ') . ' ' .$group_name.'<br>';
                            }                           

                            echo get_phrase('secton: ') . ' ' . $this->db->get_where('section', array('section_id' => $section_id))->row()->name.'<br>';
                            echo get_phrase('roll: ') . ' ' . $std_roll;
                        }
                    }
                        
                    ?><br>
                </td>
            </tr>
        </table>
        <hr>

        <!-- payment history -->
        <h4><?php echo get_phrase('payment_history'); ?></h4>
        <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><?php echo get_phrase('fee_name'); ?></th>
                    <th><?php echo get_phrase('fee_amount'); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php $fee_names = explode(',', $row['fee_name']); foreach($fee_names as $k=>$name):?>
                <tr>                
                    <td><?php 
                    if($name=='tution_fee'){
                        echo ucwords(str_replace('_', ' ', $name)).' ('.str_replace(' ', ', ', ucwords(str_replace(',', ' ', $row['months']))).')';     
                    }else{
                        echo ucwords(str_replace('_', ' ', $name));     
                    }
                    
                    ?></td>
                
                <?php $fee_amounts = explode(',', $row['fee_amount']); ?>
                    <td><?php echo $fee_amounts[$k]; ?></td>
                
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tbody>
        </table>
        <hr>

        <table width="100%" border="0"> 
            <tr>
                <td align="right" width="80%"><h4><?php echo get_phrase('total_amount'); ?> :</h4></td>
                <td align="right"><h4><?php echo money_format('%n', $row['amount_paid']).' TK.'; ?></h4></td>
            </tr>
        </table>

        <hr>

        <div style="float: right; margin-top: 100px;">
            <p style="border-top: 1px solid">Signature</p>
        </div>
    </div>
<?php endforeach; ?>


<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>