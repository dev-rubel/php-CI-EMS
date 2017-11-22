
<?php 
$this->db->where('track_name', 'imnotice');
$notice = $this->db->get('linkinfo')->result_array();
?>

<div class="row">
    
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <?php echo flash_msg();?>
                <form action="<?php echo base('homemanage', 'add_important_notice');?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
                <label><?php echo lng('Notice Title');?></label>
                <input class="form-control" name="title" placeholder="" data-validation="required">
                <input type="hidden" name="title_link" value="">
        </div>
        <div class="form-group">
                <label><?php echo lng('Notice Description');?></label>
				<textarea class="form-control" name="description" data-validation="required" rows="7"></textarea>
        </div>
                    <button type="submit" class="btn btn-info"><?php echo lng('Add');?></button>
                </form>
    </div>
            <div class="col-md-8">
                <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th><?php echo lng('Notice Title');?></th>
      <th><?php echo lng('Description');?></th>
      <th><?php echo lng('Action');?></th>
    </tr>
  </thead>
  <tbody>
      <?php 
      if(!empty($notice)):
      foreach($notice as $key=>$list): $id = $list['id'];?>
    <tr>
      <th scope="row"><?php echo $key+1;?></th>
      <td><?php echo $list['title'];?></td>
      <td><?php echo mb_substr($list['description'],0,200, "utf-8").'....';?></td>
      <td>
          <a href="#" class="btn btn-info btn-xs" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_home_important_notice/<?php echo $id; ?>');">Edit</a>
          <a href="<?php echo base('homemanage', 'delete_important_notice'."/$id");?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><?php echo lng('Delete this');?></a>    
          <?php if($list['status']==1):?>
          <a href="<?php echo base('homemanage', 'change_imnotice_status'."/$id/0");?>" class="btn btn-success btn-xs" onclick="return confirm('Are you sure you want to draft this notice?');"><?php echo lng('Published');?></a>          
        <?php else:?>
          <a href="<?php echo base('homemanage', 'change_imnotice_status'."/$id/1");?>" class="btn btn-warning btn-xs" onclick="return confirm('Are you sure you want to publish this notice?');"><?php echo lng('Draft');?></a>  
        <?php endif;?>        
      </td>
    </tr>
    <?php endforeach;
    endif;
    ?>
  </tbody>
</table>
            </div>
        </div>
    </div>
    
    </div>
    