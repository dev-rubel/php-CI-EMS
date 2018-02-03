<?php

$title = $this->db->get_where('linkinfo',array('id'=>$param2))->row()->title;
$description = $this->db->get_where('linkinfo',array('id'=>$param2))->row()->description;
//pd($title);
?>
<div class="profile-env">
<form action="<?php echo base('homemanage', 'update_important_notice'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label><?php echo lng('Notice Title'); ?></label>
        <input class="form-control" name="title" value="<?php echo $title; ?>" placeholder="" data-validation="required">
        <input type="hidden" name="id" value="<?php echo $param2; ?>">
    </div>
    <div class="form-group">
        <label><?php echo lng('Notice Description'); ?></label>
		<textarea class="form-control" name="description" data-validation="required" rows="7"><?php echo $description; ?></textarea>
    </div>
    <button type="submit" class="btn btn-info"><?php echo lng('Update'); ?></button>
</form>
</div>