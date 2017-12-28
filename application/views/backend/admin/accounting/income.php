<hr />

<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a href="#unpaid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('invoices');?></span>
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
			<br>
				<div class="tab-pane active" id="unpaid">
					
				<button id="firstpage" class="btn btn-sm btn-primary">First Page</button>					
				<button id="lastpage" class="btn btn-sm btn-primary pull-right">Last Page</button>					
				<br><br>

			<form action="<?php echo base('a/accounting', 'income_date_search_result');?>" method="post" target="_blank">
				<div class="row">
					<div class="col-md-1">
						<p>Date Search: </p>
					</div>
					<div class="col-md-2">					
						<input type="text" class="form-control datepicker" id="fromdate" placeholder="From Date" name="fromdate">		
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control datepicker" placeholder="To Date" id="max" name="todate">		
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-sm btn-info">Search</button>
					</div>
				</div>
		    </form>
			    	
				<br>

				<table class="table table-striped table-bordered" id="incomedata">
                	<thead>
                		<tr>
                			<th>#</th>
                    		<th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('class_info / Description');?></div></th>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th class="sum"><div><?php echo get_phrase('total_amount');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('action');?></div></th>
						</tr>
					</thead> 
					<tfoot>
			            <tr>
			                <th colspan=""></th>
					        <th style="text-align:right">Total:</th>
					        <th> </th>
					        <th> </th>
					        <th> </th>
					        <th> </th>
					        <th> </th>
			            </tr>
			        </tfoot>                   
                </table>
					
				</div>
				
			</div>
			
			
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
 
 	var table;
    //datatables
    table = $('#incomedata').DataTable({    	 
    	

    	"lengthMenu": [[10, 50, 100, 500, -1], [10, 50, 100, 500, "All"]],
    	dom: 'lBfrtip',
        buttons: [
            {
		      extend: 'print',
		      text: '<i class="fa fa-print"></i> Print',
		      exportOptions: {
		        columns: [4,1,2,3,5]
		      },
		      footer: true,
		      autoPrint: true
		    }
        ],
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url();?>index.php?a/accounting/ajax_list",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
 			var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, 'TK: ' ).display;
            // Update footer
            $( api.column( 4 ).footer() ).html(
                numFormat(pageTotal) 
                //+' ('+ numFormat(total) +' total)'
            );
        }

        
 
    });

    $('#lastpage').on('click', function () {
   		table.page('last').draw(false);
   	});
    $('#firstpage').on('click', function () {
   		table.page('first').draw(false);
   	});
       
 
});








jQuery(document).ready(function($)
{	
	$(".dataTables_wrapper select").select2({
		minimumResultsForSearch: -1
	});
});
</script>