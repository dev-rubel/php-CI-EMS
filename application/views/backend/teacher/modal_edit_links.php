<?php
$this->db->where('id', $param2);
$title = $this->db->get('linkinfo')->row()->title;
$this->db->where('id', $param2);
$link = $this->db->get('linkinfo')->row()->link;
?>
<form action="<?php echo base('homemanage', 'update_link'); ?>" method="post">
    <div class="form-group">
        <label><?php echo lng('Link Title'); ?></label>
        <input class="form-control" placeholder="" name="title" value="<?php echo $title; ?>">
        <input type="hidden" name="id" value="<?php echo $param2; ?>">
    </div>
    <div class="form-group">
        <div class="form-group">
            <label><?php echo lng('Link'); ?></label>
            <input class="form-control" placeholder="" name="title_link" value="<?php echo $link; ?>">
            <input type="hidden" name="description" value="">
        </div>
    </div>
    <button type="submit" class="btn btn-info"><?php echo lng('Update'); ?></button>
</form>