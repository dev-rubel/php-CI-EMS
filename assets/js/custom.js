
jQuery(document).ready(function($)
{
	var datatable = $(".datatable").dataTable();	
	$(".dataTables_wrapper select").select2({
		minimumResultsForSearch: -1
	});
	
	
});

//close the lateral panel
$('.cd-panel').on('click', function(event){
	if( $(event.target).is('.cd-panel') || $(event.target).is('.cd-panel-close') ) { 
		$('.cd-panel').removeClass('is-visible');
		event.preventDefault();
	}
});

// DatePicker And Word Counter
// 
$(document).ready(function(){

	$('.datepicker').datepicker({
	    dateFormat: 'dd-mm-yy',
		startView: 1
	}).on('changeDate', function(e){
	    $(this).datepicker('hide');
	});
	
});

// Form Validation
// 
$(document).ready(function(){        	      	
    $.validate({
            modules : 'security, file'
        });
});




