<?php  
$active_month = explode(',', $invoice_info[0]['months']);
// pd($invoice_info);
?>
<hr />
<style>
    .custom-control-description {
        display: block;
    }
    input.form-control {
        border: 1px solid lightslategray;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0; 
    }   
</style>
<div class="row">
    <div class="col-md-12">
            
            <ul class="nav nav-tabs bordered">
                <li class="active">
                    <a href="#unpaid" data-toggle="tab">
                        <span class="hidden-xs"><?php echo get_phrase('edit_student_invoice');?></span>
                    </a>
                </li>
            </ul>
            
            <div class="tab-content">
            <br>
                <div class="tab-pane active" id="unpaid">

                <!-- creation of single invoice -->
                <?php echo form_open(base_url() . 'index.php?a/accounting/invoice/do_update/'.$invoice_info[0]['invoice_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-md-8">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <div class="panel-title"><?php echo get_phrase('invoice_informations');?></div>
                                </div>
                                <div class="panel-body">
                                    
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('input_student_roll');?>
                                    </label>
                                    <div class="col-sm-9">

                                        <div class="col-md-6">
                                            <select name="classId" id="classId" class="form-control" onchange="getClassId(this)">
                                                <?php $classList = $this->db->get('class')->result_array(); 
                                                    foreach($classList as $k=>$each):
                                                    ?>
                                                    <option value="<?php echo $each['name_numeric']; ?>-" <?php echo selected($student_info[0]['class_id'],$each['class_id']);?>><?php echo $each['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>  
                                            <input type="hidden" id="hidden_student_id">                                     
                                        </div>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="student_code" id="acc_student_id" placeholder="Student Roll"
                                            required="required" value="<?php echo $student_info[0]['roll'];?>"/>                                        
                                        </div>

                                        
                                    </div>
                                </div>
                                
                                <div id="students_lists">
                                    <div class="form-group">
                                        <div class="row student-list-wrapper">
                                        <?php 
                                                
                                                    $data = ['student_id'=>$student_info[0]['student_id']];
                                                    $students = $this->db->get_where('enroll',$data)->result_array();
                                                        if(!empty($students)):
                                                    foreach($students as $k=>$each):
                                                        $stdName = $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->name;
                                                        $student_code = $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->student_code;                    
                                            ?>
                                            <div class="col-sm-6">
                                                <div class="funkyradio">
                                                    <div class="funkyradio-success">
                                                        <input type="radio" name="radio" value="<?php echo $student_code;?>" class="radio" id="radio<?php echo $k?>" checked="checked"/>
                                                        <label for="radio<?php echo $k?>"><?php echo $stdName;?></label>
                                                    </div>      
                                                </div>
                                            </div>
                                                    <?php endforeach; 
                                                    echo '</row>';
                                                    else: echo '<p class="text-center"><b>No Student Found</b></p>'; endif;
                                                    ?>
                                        </div>
                                    </div>
                                </div>    

                                
                                <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('months');?></label>
                                        <div class="col-sm-9">
                                            <div class="col-sm-3">
                                                <input type="checkbox" name="months[]" value="january" class="custom-control-input" <?php $january = checked2('january',$active_month); echo $january; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;January</span>
                                                <input type="checkbox" name="months[]" value="february" class="custom-control-input" <?php $february = checked2('february',$active_month); echo $february; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;February</span>
                                                <input type="checkbox" name="months[]" value="march" class="custom-control-input" <?php $march = checked2('march',$active_month); echo $march; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;March</span>
                                                <input type="checkbox" name="months[]" value="april" class="custom-control-input" <?php $april = checked2('april',$active_month); echo $april; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;April</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="checkbox" name="months[]" value="may" class="custom-control-input" <?php $may = checked2('may',$active_month); echo $may; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;May</span>
                                                <input type="checkbox" name="months[]" value="june" class="custom-control-input" <?php $june = checked2('june',$active_month); echo $june; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;June</span>
                                                <input type="checkbox" name="months[]" value="july" class="custom-control-input" <?php $july = checked2('july',$active_month); echo $july; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;July</span>
                                                <input type="checkbox" name="months[]" value="august" class="custom-control-input" <?php $august = checked2('august',$active_month); echo $august; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;August</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="checkbox" name="months[]" value="september" class="custom-control-input" <?php $september = checked2('september',$active_month); echo $september; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;September</span>
                                                <input type="checkbox" name="months[]" value="october" class="custom-control-input" <?php $october = checked2('october',$active_month); echo $october; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;October</span>
                                                <input type="checkbox" name="months[]" value="november" class="custom-control-input" <?php $november = checked2('november',$active_month); echo $november; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;November</span>
                                                <input type="checkbox" name="months[]" value="december" class="custom-control-input" <?php $december = checked2('december',$active_month); echo $december; ?>>
                                                <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;December</span>
                                            </div>   
                                        </div>
                                    </div>
                                    <div id="accMonthCheckbox">
                                        
                                    </div>
                    
                                    

                    <div class="form-group">
                       
                        <div class="col-sm-3 text-center">
                            <input type="button" value="Add Row" class="btn btn-xs btn-info" onclick="addRow('dataTable')" />
                            <input type="button" value="Delete Row" class="btn btn-xs btn-danger" onclick="deleteRow('dataTable')" />
                        </div>
                        <div class="col-sm-9">
                        <table id="dataTable" class="table fee-list">
                        <?php $entrys = explode(',', $invoice_info[0]['fee_name']);
                            $fees = explode(',', $invoice_info[0]['fee_amount']);
                            foreach($entrys as $k=>$entry) :
                        ?>
                            <tr>
                                <td><input type="checkbox" class="form-control" name="chk"/></td>
                                

                                <td>
                                    <select name="fee_name[]" class="form-control">
                                        <?php foreach($income_category as $inlist): ?>
                                        <option value="<?php echo $inlist['name']; ?>" <?php echo selected($inlist['name'],$entry);?>>

                                        <?php echo ucwords(str_replace('_', ' ', $inlist['name'])); ?>                                            
                                        </option>
                                    <?php endforeach; ?>
                                    </select>
                                </td>

                                <td><input type="text" class="form-control" value="<?php echo $fees[$k]?>" name="fee_amount[]" pattern=".{3,4}" required title="3 to 4 characters"/></td>
                            </tr>
                        <?php endforeach;?>
                        </table>

                        </div>
                    </div>








                                    

                                    
                                    
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo get_phrase('payment_informations');?></div>
                            </div>
                            <div class="panel-body">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('total');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount" id="grandtotal" value="<?php echo $invoice_info[0]['amount']?>"
                                            placeholder="<?php echo get_phrase('enter_total_amount');?>" readonly="readonly"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('payment');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid" id="payment" value="<?php echo $invoice_info[0]['amount_paid']?>"
                                            placeholder="<?php echo get_phrase('enter_payment_amount');?>"
                                                data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $invoice_info[0]['description']?>" name="description"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="datepicker form-control" name="date" value="<?php echo date('d-m-Y', $invoice_info[0]['creation_timestamp'])?>"/>
                                    </div>
                                </div>

                                <input type="hidden" name="status" value="paid">
                                <input type="hidden" name="method" value="1">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('update_invoice');?></button>
                            </div>
                        </div>
                    </div>


                    </div>
                    <?php echo form_close();?>

                <!-- creation of single invoice -->
                    
                </div>
            
            </div>
            
            
    </div>
</div>

<script type="text/javascript">

    function select() {
        var chk = $('.check');
            for (i = 0; i < chk.length; i++) {
                chk[i].checked = true ;
            }

        //alert('asasas');
    }
    function unselect() {
        var chk = $('.check');
            for (i = 0; i < chk.length; i++) {
                chk[i].checked = false ;
            }
    }


    $(document).ready(function () {
        $( "#studentInfoBox" ).hide(); 
        $( "#addInvoice" ).hide(); 
        //$("#acc_date").datepicker({format: 'dd-mm-yyyy'}).datepicker("setDate", new Date());

        $("table.fee-list").on("change", 'input[name^="fee_amount"]', function (event) {
            calculateGrandTotal();
        });
        
        $("input[name=student_code]").keyup(function () {
            
            var value = $('#classId').val()+$(this).val();         
           
            $.get( "<?php echo base_url();?>index.php?a/accounting/getRollToStudentInfo/"+value+'/'+<?php echo $student_info[0]['student_id'];?>, function( data ){
                if(data) {
                    $( "#students_lists" ).show(); 
                    $( "#students_lists" ).html( data );  
                    $( "#accMonthCheckbox" ).show();  
                } else {
                    $( "#students_lists" ).hide();  
                    $( "#studentInfoBox" ).hide();  
                    $( "#accMonthCheckbox" ).html('');  
                    $( "#acc_student_info" ).val('');  
 
                }                
            });

        });
    });

     

    function calculateGrandTotal() {
       var grandTotal = 0;
        $("table.fee-list").find('input[name^="fee_amount"]').each(function () {
            grandTotal += +$(this).val();
        });
        console.log(grandTotal);
        $("#grandtotal, #payment").val(grandTotal.toFixed(2));
        
        //row.find('input[name^="grandtotal"]').val((price).toFixed(2));
    }
</script>

<script type="text/javascript">
    function get_class_students(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
            }
        });
    }

     function get_class_students_mass(class_id) {
        
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students_mass/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder_mass').html(response);
            }
        });

        
    }
</script>


<SCRIPT language="javascript">
        function addRow(tableID) {

            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;

            for(var i=0; i<colCount; i++) {

                var newcell = row.insertCell(i);

                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }

        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
            }catch(e) {
                alert(e);
            }
        }

    </SCRIPT>
