<?php
$segment = $_SERVER['REQUEST_URI'];
$url = explode('?', $segment);
$url = explode('/', $url[1]);
$url = $url[0];
?>


<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="assets/js/select2/select2.css">
<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">

   
<!-- Bottom Scripts -->
<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/toastr.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/fullcalendar/fullcalendar.min.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/fileinput.js"></script>

<!-- Ajax Request Handle -->
<script src="assets/backend/js/jquery.form.js"></script> 
<!-- Bootstrap Tag Input -->
<script src="assets/backend/js/bootstrap-tagsinput.js"></script> 

<!--start for homemanage controller-->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="assets/js/jquery.word-and-character-counter.min.js"></script>
<script src="assets/backend/js/bootstrap-toggle.min.js"></script>
<script src="assets/backend/js/jscolor.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<!-- end for homemanage controller-->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/datatables/TableTools.min.js"></script>
<script src="assets/js/dataTables.bootstrap.js"></script>
<script src="assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="assets/js/datatables/lodash.min.js"></script>
<script src="assets/js/datatables/responsive/js/datatables.responsive.js"></script>

<script src="assets/js/select2/select2.min.js"></script>
<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>


<script src="assets/js/neon-calendar.js"></script>
<script src="assets/js/neon-chat.js"></script>
<script src="assets/js/neon-custom.js"></script>
<script src="assets/js/neon-demo.js"></script>
<script src="assets/js/custom.js"></script>


<script>
// Confirm delete function

function confDelete(con,func,id,id2){
	$.confirm({
		title: 'Confirm!',
		content: 'Are you sure? You want to delete this.',
		type: 'red',
    	typeAnimated: true,
		buttons: {
			tryAgain: {
				text: 'Delete',
				btnClass: 'btn-red',
				action: function(){
					$.ajax({
						url: '<?php echo base_url();?>index.php?'+con+'/'+func+'/'+id,
						dataType: 'json',
						method: 'get'
					}).done(function (response) {
						$('#'+id2).remove();
					}).fail(function(){
						$.alert('Location problem.');
					});
				}
			},
			close: function () {
			}
		}
	});
}
</script>

<!-- SHOW SUCCESS TOASTR NOTIFICATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">
	toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>

<?php endif;?>

<!-- SHOW ERROR TOASTR NOTIFICATION -->
<?php if ($this->session->flashdata('error') != ""):?>

<script type="text/javascript">
	toastr.error('<?php echo $this->session->flashdata("error");?>');
</script>

<?php endif;?>
