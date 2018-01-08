<style>
.extra-menu h2,  
.extra-menu h4{
    color: #fff;
}
.extra-menu {
    padding: 2px 10px !important;
    min-height: 60px;
}
.extra-menu h4 {
    font-size: 13px !important;
}
.customNavManu {
    margin-bottom: 20px;
    border-bottom: #F5F5F6;
}
</style>

<br>
<br>
<?php 
$links = ['student_payment','income','income_category','daily_expense','expense_category','monthly_expense_sheet','monthly_balance_sheet','total_balance_sheet','manage_bank_ac','bank_transaction'];

$title = ['Create Student Payment','Student Payment','Payment Category', 'Daily Expense','Expense Category','Monthly Expense Sheet','Monthly balance Sheet','Total balance Sheet','Manage Account','Bank Transaction'];
$color = ['bg-info','bg-primary','bg-sms','bg-today-app','bg-confirm-app','bg-padding-app','input-group-addon'];
 ?>
<div class="row customNavManu" id="accountingNavManu">

<?php foreach($links as $k=>$each):?>
    <div class="col-sm-3 col-md-2" style="margin-bottom: 10px;">
        <a href="#" onclick="changePage('<?php echo $each?>')">
            <div class="panel-stat3 bg-info extra-menu" id="customNavBg<?php echo $each;?>">
                <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2>
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="customIcon fa fa-bars" id="customNavIcon<?php echo $each; ?>"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>
</div>


<div class="row" id="accountingMainManu">

<?php foreach($links as $k=>$each):?>
    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px;">
        <a href="#" onclick="changePage('<?php echo $each?>')">
            <div class="panel-stat3 bg-info<?php //echo $color[rand(1,7)];?>">
                <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2>
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="fa fa-bars fa-3x"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>
</div>



<div id="ajaxPageContainer"></div>


<script>

$('#accountingNavManu').hide();

function changePage(page)
{
    var selectValue = page;
    /* ACTIVE MANU SECTION */
    $('.extra-menu').addClass('bg-info').removeClass('bg-success');
    $('.customIcon').addClass('fa-bars').removeClass('fa-thumb-tack');
    $('#customNavBg'+selectValue).addClass('bg-success').removeClass('bg-info');
    $('#customNavIcon'+selectValue).addClass('fa-thumb-tack').removeClass('fa-bars');
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
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?a/accounting/' + selectValue;
            window.history.pushState({path:newurl},'',newurl);                
            // var cName = $('#'+selectValue).hasClass('bg-info'); 
            // if(cName){
            //     $("#"+selectValue).removeClass("bg-info");
            //     $("#"+selectValue).addClass("bg-primary");
            // } else {
            //     $("#"+selectValue).addClass("bg-info");
            //     $("#"+selectValue).removeClass("bg-primary");
            // }
            // if(cName.contains("bg-info")){
            //     console.log("String Found");
            // }
            //$("#"+selectValue).removeClass("bg-info");
            //$("#"+selectValue).toggleClass("bg-primary");
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


            if(selectValue == 'income') {
            // var table;
            // //datatables
            // table = $('#incomedata').DataTable({    	 
                

            //     "lengthMenu": [[10, 50, 100, 500, -1], [10, 50, 100, 500, "All"]],
            //     dom: 'lBfrtip',
            //     buttons: [
            //         {
            //         extend: 'print',
            //         text: '<i class="fa fa-print"></i> Print',
            //         exportOptions: {
            //             columns: [4,1,2,3,5]
            //         },
            //         footer: true,
            //         autoPrint: true
            //         }
            //     ],
        
            //     "processing": true, //Feature control the processing indicator.
            //     "serverSide": true, //Feature control DataTables' server-side processing mode.
            //     "order": [], //Initial no order.
        
            //     // Load data for the table's content from an Ajax source
            //     "ajax": {
            //         "url": "<?php // echo base_url();?>index.php?a/accounting/ajax_list",
            //         "type": "POST"
            //     },
        
            //     //Set column definition initialisation properties.
            //     "columnDefs": [
            //     { 
            //         "targets": [ 0 ], //first column / numbering column
            //         "orderable": false, //set not orderable
            //     },
            //     ],

            //     "footerCallback": function ( row, data, start, end, display ) {
            //         var api = this.api(), data;
        
            //         // Remove the formatting to get integer data for summation
            //         var intVal = function ( i ) {
            //             return typeof i === 'string' ?
            //                 i.replace(/[\$,]/g, '')*1 :
            //                 typeof i === 'number' ?
            //                     i : 0;
            //         };
        
            //         // Total over all pages
            //         total = api
            //             .column( 4 )
            //             .data()
            //             .reduce( function (a, b) {
            //                 return intVal(a) + intVal(b);
            //             }, 0 );
        
            //         // Total over this page
            //         pageTotal = api
            //             .column( 4, { page: 'current'} )
            //             .data()
            //             .reduce( function (a, b) {
            //                 return intVal(a) + intVal(b);
            //             }, 0 );
        
            //         var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, 'TK: ' ).display;
            //         // Update footer
            //         $( api.column( 4 ).footer() ).html(
            //             numFormat(pageTotal) 
            //             //+' ('+ numFormat(total) +' total)'
            //         );
            //     }

                
        
            // });

            // $('#lastpage').on('click', function () {
            //     table.page('last').draw(false);
            // });
            // $('#firstpage').on('click', function () {
            //     table.page('first').draw(false);
            // });
        }


            $("#table_export").dataTable();
            $('.datepicker').datepicker();
            $('#tution_fee_sms_status').bootstrapToggle();
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                
        }
    });
}

</script>