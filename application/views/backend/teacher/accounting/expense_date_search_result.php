<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">

    <button id="firstpage" class="btn btn-sm btn-primary">First Page</button>                   
    <button id="lastpage" class="btn btn-sm btn-primary pull-right">Last Page</button>                  
<br><br>


<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('date');?></div></th>
            <th><div><?php echo get_phrase('title');?></div></th>
            <th><div><?php echo get_phrase('category');?></div></th>
            <th><div><?php echo get_phrase('teacher_name');?></div></th>
            <th class="sum"><div><?php echo get_phrase('amount');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
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
    <tbody>
        <?php 
        	$count = 1;
        	foreach ($expenses as $row):
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo date('d-m-Y', $row['timestamp']);?></td>
            <td><?php echo $row['title'];?></td>
            <td>
                <?php 
                    if ($row['expense_category_id'] != 0 || $row['expense_category_id'] != '')
                        echo $this->db->get_where('expense_category' , array('expense_category_id' => $row['expense_category_id']))->row()->name;                    
                ?>
            </td>
            <td>
                <?php 
                    if($name = $this->db->get_where('teacher' , array('teacher_id' => $row['student_id']))->row()->name)
                        echo $name;
                 ?>
            </td>
            <td><?php echo $row['amount'];?></td>            
            <td>
                <a href="#" class="btn btn-xs btn-info" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_edit/<?php echo $row['payment_id'];?>');">
                                <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit');?>
                                </a>
                                <a href="#" class="btn btn-xs btn-danger" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/expense/delete/<?php echo $row['payment_id'];?>');">
                                <i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete');?>
                                </a>
                
                
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
    
</table>


<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    var table;
    //datatables
    table = $('#table_export').DataTable({         
        

        "lengthMenu": [[10, 50, 100, 500, -1], [10, 50, 100, 500, "All"]],
        dom: 'lBfrtip',
        buttons: [
            {
              extend: 'print',
              text: '<i class="fa fa-print"></i> Print',
              exportOptions: {
                columns: [5,2,3,4]
              },
              footer: true,
              autoPrint: true
            }
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
 
            var numFormat = $.fn.dataTable.render.number( '\,', '.', 2, '$' ).display;
            // Update footer
            $( api.column( 4 ).footer() ).html(
                numFormat(pageTotal)
            );
        },       



        initComplete: function () {
            this.api().columns(2).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
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
