<?php

$title = $this->db->get_where('linkinfo',array('id'=>$param2))->row()->title;
$description = $this->db->get_where('linkinfo',array('id'=>$param2))->row()->description;
//pd($result);
?>
<div class="profile-env">
<form action="<?php echo base('homemanage', 'update_notice'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label><?php echo lng('Notice Title'); ?></label>
        <input class="form-control" name="title" value="<?php echo $title; ?>" placeholder="" data-validation="required">
        <input type="hidden" name="id" value="<?php echo $param2; ?>">
    </div>
    <div class="form-group">
        <label><?php echo lng('Notice Description'); ?></label>
		<textarea class="form-control" name="description" data-validation="required" rows="7"><?php echo $description; ?></textarea>
    </div>
    <div class="form-group">
        <h4 style="font-weight: bold;"><?php echo file_exists('assets/otherFiles/' . $param2 . '_noticepdf.pdf') == true ? 'File already exist' : ''; ?></h4>
        <input type="file" class="form-control" name="file" data-validation="mime size" data-validation-allowing="pdf" data-validation-max-size="3mb">
        <small>Max file size: 3MB.</small>
    </div>
    <button type="submit" class="btn btn-info"><?php echo lng('Update'); ?></button>
</form>
</div>