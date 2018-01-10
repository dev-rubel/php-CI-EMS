<?php 
    $this->db->select('present');
    $this->db->where('id', 1);
    $present = oneDim($this->db->get('taxtinfo')->result_array());
?>

<div class="row">
    
    <div class="col-md-12 text-center">
        <?php echo flash_msg();?>
        
        <form id="websiteStatus" action="<?php echo base_url() .'index.php?homemanage/ajax_update_present_section'; ?>" class="form-horizontal form-groups-bordered" method="post">
        
        <div class="row">
            <input type="checkbox" name="status" id="presentStatus" data-toggle="toggle" <?php echo $present['present']==1?'checked':''?>><br/><br/>
            <button type="submit" class="btn btn-info"><?php echo lng('Update');?></button>
        </div>
        </form>
    </div>
    
</div><!--/.row-->


<script>
$(document).ready(function () {

    $('#websiteStatus').ajaxForm({
    beforeSend: function () {
        $('#loading2').show();
        $('#overlayDiv').show();
    },
    success: function (data) {
        var jData = JSON.parse(data);
        toastr.success(jData.msg);        
        $('body,html').animate({
        scrollTop: 0
        }, 800);
        $('#loading2').fadeOut('slow');
        $('#overlayDiv').fadeOut('slow');
    }
    });

});
</script>