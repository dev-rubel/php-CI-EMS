<hr />
<style>
    .custom-control-description {
        display: block;
    }

    input.form-control {
        border: 1px solid lightslategray;
    }
    .panel {
        margin: 5px 0px;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#unpaid" data-toggle="tab">
                    <span class="hidden-xs">
                        <?php echo get_phrase('create_single_invoice');?>
                    </span>
                </a>
            </li>
            <li>
                <a href="#payment_setting" data-toggle="tab">
                    <span class="hidden-xs">
                        <?php echo get_phrase('payment_setting');?>
                    </span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <br>
            <div class="tab-pane active" id="unpaid">

                <!-- creation of single invoice -->
               
                <form id="createInvoice" action="<?php echo base_url() .'index.php?admin/ajax_create_invoice'; ?>" class="form-horizontal form-groups-bordered" method="post">   

                <div class="row">                    
                    <div class="col-md-7">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('invoice_informations');?>
                                </div>
                            </div>
                            <div class="panel-body">



                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('input_student_id');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="student_code" id="acc_student_id" placeholder="Student Uniqe ID"
                                            required="required" autofocus/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('student_info');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="acc_student_info" disabled="disabled" />
                                    </div>
                                </div>
                                <div id="accMonthCheckbox"></div>


                                <div class="form-group">

                                    <div class="col-sm-3 text-center">
                                        <input type="button" value="Add Row" class="btn btn-xs btn-info" onclick="addRow('dataTable')" />
                                        <input type="button" value="Delete Row" class="btn btn-xs btn-danger" onclick="deleteRow('dataTable')" />
                                    </div>
                                    <div class="col-sm-9">
                                        <table id="dataTable" class="table fee-list">
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-control" name="chk" />
                                                </td>

                                                <td>
                                                    <select name="fee_name[]" class="form-control">
                                                        <?php foreach($income_category as $inlist): ?>
                                                        <option value="<?php echo $inlist['name']; ?>">

                                                            <?php echo ucwords(str_replace('_', ' ', $inlist['name'])); ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="fee_amount[]" pattern=".{3,4}"
                                                        required title="3 to 4 characters" />
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('payment_informations');?>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('total');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount" id="grandtotal" placeholder="<?php echo get_phrase('enter_total_amount');?>"
                                            readonly="readonly" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('payment');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid" id="payment" placeholder="<?php echo get_phrase('enter_payment_amount');?>"
                                            required="required" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('description');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="description" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('date');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <?php if(isset($_SESSION['sessionSaveDate'])): ?>
                                        <input type="text" class="datepicker form-control" name="date" value="<?php echo $_SESSION['sessionSaveDate']; ?>" readonly
                                            required />
                                        <?php else: ?>
                                        <input type="text" class="datepicker form-control" name="date" id="acc_date" readonly required />
                                        <?php endif; ?>

                                    </div>
                                </div>

                                <input type="hidden" name="status" value="paid">
                                <input type="hidden" name="method" value="1">                                

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info">
                                    <?php echo get_phrase('add_invoice');?>
                                </button>
                            </div>
                        </div>
                    </div>


                </div>

                <?php echo form_close();?>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('student_tution_fee_history');?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div id="studentAccountHistory"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- creation of single invoice -->

            </div>
            <div class="tab-pane" id="payment_setting">

                <form id="updateTutionSmsSetting" action="<?php echo base_url() .'index.php?admin/ajax_tution_fee_sms_setting'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   

                <div class="col-md-offset-2 col-md-8">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('tution_fee_sms_setting');?>
                                </div>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('tution_fee_sms_status');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="tution_fee_sms_status" id="tution_fee_sms_status" data-toggle="toggle" <?php echo $tution_fee_setting[0]['description']==1?'checked':''?>>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('tution_fee_sms_description');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="tution_fee_sms_details" id="" cols="30" rows="10"><?php echo $tution_fee_setting[1]['description']; ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-info">
                                    <?php echo get_phrase('save_setting');?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>

        </div>


    </div>
</div>

<script type="text/javascript">
    function select() {
        var chk = $('.check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = true;
        }

        //alert('asasas');
    }

    function unselect() {
        var chk = $('.check');
        for (i = 0; i < chk.length; i++) {
            chk[i].checked = false;
        }
    }



    $(document).ready(function () {

        $("#acc_date").datepicker({
            format: 'dd-mm-yyyy',
            startView: 1
        }).datepicker("setDate", new Date()).on('changeDate', function (e) {
            $(this).datepicker('hide');
        });

        $("table.fee-list").on("change", 'input[name^="fee_amount"]', function (event) {
            calculateGrandTotal();
        });

        $("input[name=student_code]").keyup(function () {
            var value = $(this).val();
            $.ajax({
                url: '<?php echo base_url();?>index.php?a/accounting/getAccStdInfo/' + value,
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (!data.name) {
                        jQuery('#acc_student_info').val('কোন ছাত্র খুজে পাওয়া যায় নি।');
                    } else {
                        jQuery('#acc_student_info').val(data.name);
                    }
                }
            });
            $.get( "<?php echo base_url();?>index.php?a/accounting/getStudentAccHistory/"+value, function( data ){
                $( "#studentAccountHistory" ).html( data );  
            });
            $.get( "<?php echo base_url();?>index.php?a/accounting/getStudentAccMonthCheckbox/"+value, function( data ){
                $( "#accMonthCheckbox" ).html( data );  
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

$(document).ready(function() { 

    $('#createInvoice').ajaxForm({
        beforeSend: function() {
                $('#loading2').show();
                $('#overlayDiv').show();
        },
        success: function (data){
            var jData = JSON.parse(data);

            if(!jData.type) {
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg);
                $('#createInvoice').resetForm();
                $('#studentAccountHistory').html('');
            }   
            $('body,html').animate({scrollTop:0},800);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');
        }
    });

    $('#updateTutionSmsSetting').ajaxForm({ 
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);  

            if(!jData.type) {    
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg);              
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 

});

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


<script language="javascript">
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
            // console.log(chkbox);
            if(null != chkbox && true == chkbox.nextSibling.checked) {
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

</script>
