<hr />
<style>
    .custom-control-description {
        display: block;
    }

    input.form-control {
        border: 1px solid lightslategray;
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
                <?php echo form_open(base_url() . 'index.php?a/accounting/invoice/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <?php echo get_phrase('student_tution_fee_info');?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div id="studentAccountHistory"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
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
                                        <input type="text" class="form-control" name="student_code" id="acc_student_id" placeholder="Shift Class Section Roll Group"
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
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo get_phrase('months');?>
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="months[]" value="january" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;January</span>
                                            <input type="checkbox" name="months[]" value="february" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;February</span>
                                            <input type="checkbox" name="months[]" value="march" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;March</span>
                                            <input type="checkbox" name="months[]" value="april" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;April</span>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="months[]" value="may" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;May</span>
                                            <input type="checkbox" name="months[]" value="june" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;June</span>
                                            <input type="checkbox" name="months[]" value="july" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;July</span>
                                            <input type="checkbox" name="months[]" value="august" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;August</span>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="months[]" value="september" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;September</span>
                                            <input type="checkbox" name="months[]" value="october" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;October</span>
                                            <input type="checkbox" name="months[]" value="november" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;November</span>
                                            <input type="checkbox" name="months[]" value="december" class="custom-control-input">
                                            <span class="custom-control-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;December</span>
                                        </div>



                                    </div>
                                </div>


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

                    <div class="col-md-3">
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
                                <!--<div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control selectboxit">
                                            <option value="paid"><?php echo get_phrase('paid');?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                                    <div class="col-sm-9">
                                        <select name="method" class="form-control selectboxit">
                                            <option value="1"><?php echo get_phrase('cash');?></option>
                                        </select>
                                    </div>
                                </div>-->

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

                <!-- creation of single invoice -->

            </div>
            <div class="tab-pane" id="payment_setting">
                <?php echo form_open(base_url() . 'index.php?a/accounting/tution_fee_sms_setting' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
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
                                        <input type="checkbox" name="tution_fee_sms_status" data-toggle="toggle" <?php echo $tution_fee_setting[0]['description']==1?'checked':''?>>
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
