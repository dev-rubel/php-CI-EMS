    
    <script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('.cd-panel-content').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		//jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
        //event.preventDefault();
        $('.cd-panel').addClass('is-visible');
		$.ajax({
			url: url,
			 success: function(response)
			 {                
				jQuery('.cd-panel-content').html(response);                
			 }    
		});
	}
	</script>
    
    <!-- (Ajax Modal)-->
    <!-- <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $system_name;?></h4>
                </div>
                
                <div class="modal-body" style="height:350px; overflow:auto;">
                
                    
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

    <div class="cd-panel from-right"><!-- 
        <header class="cd-panel-header">
            <h1>Title Goes Here</h1>
            <a href="#0" class="cd-panel-close">Close</a>
        </header> -->

        <div class="cd-panel-container">
            <div class="cd-panel-content">
                
            </div> <!-- cd-panel-content -->
        </div> <!-- cd-panel-container -->
    </div> <!-- cd-panel -->
    
    
    
    
    <script type="text/javascript">
	function confirm_modal(delete_url)
	{
		jQuery('#modal-4').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
	}
	function confirm_std(confirm_url)
	{
		jQuery('#modal-11').modal('show', {backdrop: 'static'});
		document.getElementById('confirm_link').setAttribute('href' , confirm_url);
	}
	function pendding_std(pendding_url)
	{
		jQuery('#modal-12').modal('show', {backdrop: 'static'});
		document.getElementById('pendding_link').setAttribute('href' , pendding_url);
	}
    </script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo get_phrase('delete');?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- (Confirm Modal)-->
    <div class="modal fade" id="modal-11">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to confirm this student ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-success" id="confirm_link" target="_blank"><?php echo get_phrase('confirm');?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- (Padding Modal)-->
    <div class="modal fade" id="modal-12">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to pendding this student ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-warning" id="pendding_link"><?php echo get_phrase('confirm');?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                </div>
            </div>
        </div>
    </div>