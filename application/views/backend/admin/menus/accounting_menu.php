<style>
.extra-menu h2, 
.extra-menu h4{
    color: #fff;
}
.extra-menu {
    padding: 2px 10px !important;
    min-height: 40px;
}
.extra-menu h4 {
    font-size: 13px !important;
}
.customNavManu {
    margin-bottom: 20px;
    border-bottom: 1px solid #EEEEEE;
}
.panel-stat3 .stat-icon {
    top: 0 !important;
}

.panel-stat3 {
    border-radius: 0px !important;
}
</style>    

<br>
<br>
<?php 

if($_SESSION['name']=='NihalIT'):
    $links = ['student_payment','income','income_category','daily_expense','expense_category','monthly_expense_sheet','monthly_balance_sheet','total_balance_sheet','manage_bank_ac','bank_transaction','tution_pendding'];
    $title = ['Create Student Payment','Student Payment','Payment Category', 'Daily Expense','Expense Category','Monthly Expense Sheet','Monthly balance Sheet','Total balance Sheet','Manage Account','Bank Transaction','Tution Pendding'];
else:
    $links = ['student_payment','income','income_category','daily_expense','expense_category','monthly_expense_sheet','monthly_balance_sheet','total_balance_sheet','manage_bank_ac','bank_transaction'];
    $title = ['Create Student Payment','Student Payment','Payment Category', 'Daily Expense','Expense Category','Monthly Expense Sheet','Monthly balance Sheet','Total balance Sheet','Manage Account','Bank Transaction'];
endif;
$color = ['bg-info','bg-primary','bg-sms','bg-today-app','bg-confirm-app','bg-padding-app','input-group-addon'];
 ?>
<div class="row customNavManu" id="accountingNavManu">

<?php foreach($links as $k=>$each):?>
    <div class="col-sm-3 col-md-2" style="margin-bottom: 10px;">
        <a href="#" onclick="changePage('<?php echo $each?>')">
            <div class="panel-stat3 bg-info extra-menu" id="customNavBg<?php echo $each;?>">
                <!-- <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2> -->
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="customIcon fa" id="customNavIcon<?php echo $each; ?>"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>
</div>


<div class="row" id="accountingMainManu">

<div class="menu-navigation-icons">
    <?php foreach($links as $k=>$each):?>
        <div class="col-sm-4 col-md-3" style="margin-bottom: 10px;">
            <a href="#" class="<?php echo manuColor($k);?>" onclick="changePage('<?php echo $each?>')">
                <i class="fa <?php echo fo_icon();?>"></i>
                <span><?php echo $title[$k];?></span>
            </a>
        </div>
        <!-- /.col -->
    <?php endforeach;?>
</div>


</div>



<div id="ajaxPageContainer"></div>


<script>

$('#accountingNavManu').hide();

function changePage(page)
{
    var selectValue = page;
    /* ACTIVE MANU SECTION */
    $('.extra-menu').addClass('bg-info').removeClass('bg-success');
    $('.customIcon').removeClass('fa-thumb-tack');
    $('#customNavBg'+selectValue).addClass('bg-success').removeClass('bg-info');
    $('#customNavIcon'+selectValue).addClass('fa-thumb-tack');
    /* END ACTIVE MANU SECTION */
    
    $.ajax({
        type: "POST",
        data: {
            pageName : selectValue                
        },
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        url: '<?php echo base_url(); ?>index.php?a/accounting/ajax_accounting_menu_pages',
        success: function (response)
        {   
            // var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?a/accounting/' + selectValue;
            // window.history.pushState({path:newurl},'',newurl);                
           
            $('#accountingNavManu').show();
            $('#accountingMainManu').hide();
            $('#ajaxPageContainer').html(response);

            if(selectValue == 'student_payment') {
                $("#acc_date").datepicker({
                    format: 'dd-mm-yyyy',
                    startView: 1
                }).datepicker("setDate", new Date()).on('changeDate', function (e) {
                    $(this).datepicker('hide');
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
            }

            $("#table_export").dataTable();
            $('.datepicker').datepicker({
            	format: 'dd-mm-yyyy',
            });
            $('#toggleButton').bootstrapToggle();
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                
        }
    });
}

</script>