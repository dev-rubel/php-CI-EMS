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
	$("#sms_description").counter({
		   count: 'down',
	   goal: 160
	});
	$("#sms_title").counter({
	   count: 'down',
	   goal: 11
	});
	$("#sms_number").counter({
	   count: 'down',
	   goal: 11
	});
});

// Form Validation
// 
$(document).ready(function(){        	      	
    $.validate({
            modules : 'security, file'
        });
});

// HTML Editor
// 
tinymce.init({ 
    selector:'.editor',
            height: 500,
  plugins: 'table image',
  style_formats: [
    { title: 'Bold text', inline: 'strong' },
    { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
    { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
    { title: 'Badge', inline: 'span', styles: { display: 'inline-block', border: '1px solid #2276d2', 'border-radius': '5px', padding: '2px 5px', margin: '0 2px', color: '#2276d2' } },
    { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
  ],
  formats: {
    alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left' },
    aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center' },
    alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right' },
    alignfull: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full' },
    bold: { inline: 'span', 'classes': 'bold' },
    italic: { inline: 'span', 'classes': 'italic' },
    underline: { inline: 'span', 'classes': 'underline', exact: true },
    strikethrough: { inline: 'del' }
  },
    });


