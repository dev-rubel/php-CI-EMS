<?php
 $this->db->select('location');
$this->db->where('id', 1);
$location = oneDim($this->db->get('taxtinfo')->result_array());
?>

<div class="row">
  
    <div class="col-md-12">
            <div class="col-md-4 col-md-offset-1">
                <form action="<?php echo base('homemanage', 'update_location');?>" method="post">
        <div class="form-group">
                <label><?php echo lng('Code');?></label>
                <input class="form-control" placeholder="" name="code" data-validation="required">
        </div>
                    <button type="submit" class="btn btn-info"><?php echo lng('Update');?></button>
                </form>
    </div>
            <div class="col-md-offset-1 col-md-4">
                <p><?php echo lng('Current Location');?></p>
                <div class="iframe-container">
                        <?php echo $location['location'];?>
                </div>
            </div>
    </div>
    
    </div><!--/.row-->