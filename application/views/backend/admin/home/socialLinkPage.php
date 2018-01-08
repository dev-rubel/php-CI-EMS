<?php
$this->db->select('social_links');
$this->db->where('id', 1);
$result = oneDim($this->db->get('taxtinfo')->result_array());
$social_link = explode('+', $result['social_links']);
?>

<div class="row">           
    
    <div class="col-md-4 col-md-offset-4">
        <?php echo flash_msg(); ?>        
        <form id="updateSocialLink" action="<?php echo base_url() .'index.php?homemanage/ajax_update_social_link'; ?>" class="form-horizontal form-groups-bordered" method="post">
        
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-facebook" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="<?php echo lng('Facebook');?>" aria-describedby="basic-addon1" name="facebook_link" value="<?php echo notEmpty($social_link[0]);?>">
      </div><br/>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-twitter" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="<?php echo lng('Twitter');?>" aria-describedby="basic-addon1" name="twitter_link" value="<?php echo notEmpty($social_link[1]);?>">
      </div><br/>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-linkedin" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="<?php echo lng('Linkedin');?>" aria-describedby="basic-addon1" name="linkedin_link" value="<?php echo notEmpty($social_link[2]);?>">
      </div><br/>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-google-plus" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="<?php echo lng('Google Plus');?>" aria-describedby="basic-addon1" name="googleplus_link" value="<?php echo notEmpty($social_link[3]);?>">
      </div><br/>
        <button class="btn btn-info"><?php echo lng('Save');?></button>
        </form>
    </div>
    
    
</div>

<script>
$(document).ready(function () {

    $('#updateSocialLink').ajaxForm({
        beforeSend: function () {
            $('#loading2').show();
            $('#overlayDiv').show();
        },
        success: function (data) {
            var jData = JSON.parse(data);

            if (!jData.type) {
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg);
            }
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');
        }
    });

});
</script>