<div class="row">
        <div class="col-md-offset-1 col-md-10">
                <div class="col-md-4 col-md-offset-1" id="add_location_form_holder">
                        <form id="addImportantLink" action="<?php echo base_url() .'index.php?homemanage/ajax_update_location'; ?>" class="form-horizontal form-groups-bordered" method="post">
                                <div class="form-group">
                                        <label>
                                                <?php echo lng('Code');?>
                                        </label>
                                        <textarea name="code" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                <button type="submit" class="btn btn-info">
                                        <?php echo lng('Update');?>
                                </button>
                        </form>
                </div>
                <div class="col-md-offset-1 col-md-4" id="location_iframe_holder">
                <?php
                        $this->db->select('location');
                        $this->db->where('id', 1);
                        $location = oneDim($this->db->get('taxtinfo')->result_array());
                ?>
                        <p>
                                <?php echo lng('Current Location');?>
                        </p>
                        <div class="iframe-container">
                                <?php echo $location['location'];?>
                        </div>
                </div>
        </div>

</div>
<!--/.row-->

<script>
$(document).ready(function () {
        $('#addImportantLink').ajaxForm({
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
                $("#location_iframe_holder").html(jData.html);
                $('#addImportantLink').resetForm();
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