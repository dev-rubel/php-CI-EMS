<?php 
$this->db->select('header_title');
$this->db->where('id', 1);
$result = oneDim($this->db->get('taxtinfo')->result_array());
$school_name = explode('+', $result['header_title']);
?>

<div class="row">
 
    
    <div class="col-md-4 col-md-offset-4">
        <?php echo flash_msg(); ?>
        <form action="<?php echo base('homemanage', 'add_header_info');?>" method="post">
        <div class="form-group">
                <label><?php echo lng('School Name');?></label>
                <input class="form-control" name="school_name" value="<?php echo notEmpty($school_name[0]);?>" placeholder="" data-validation="required">
        </div>
        <div class="form-group">
            <label><?php echo lng('EIIN No.');?></label>
            <input class="form-control" name="eiin" value="<?php echo notEmpty($school_name[1]);?>" placeholder="" data-validation="number"> 
        </div>
        <div class="form-group">
                <label><?php echo lng('Email');?></label>
                <input class="form-control" name="email" value="<?php echo notEmpty($school_name[2]);?>" placeholder="" data-validation="email">
        </div>
        <div class="form-group">
                <label><?php echo lng('Phone');?></label>
                <input class="form-control" name="phone" value="<?php echo notEmpty($school_name[3]);?>" placeholder="" data-validation="number">
        </div>
        <button class="btn btn-info"><?php echo lng('Save');?></button>
        </form>
    </div>
    
      </div><!--/.row-->