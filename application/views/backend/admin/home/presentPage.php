<?php 
$this->db->select('present');
$this->db->where('id', 1);
$present = oneDim($this->db->get('taxtinfo')->result_array());
?>

<div class="row">
    
    
    <div class="col-md-12 text-center">
        <?php echo flash_msg();?>
        <form action="<?php echo base('homemanage', 'update_present_section');?>" method="post">
        <div class="row">
            <input type="checkbox" name="status" data-toggle="toggle" <?php echo $present['present']==1?'checked':''?>><br/><br/>
            <button type="submit" class="btn btn-info"><?php echo lng('Update');?></button>
        </div>
        </form>
    </div>
    
    </div><!--/.row-->