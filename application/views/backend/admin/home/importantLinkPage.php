
<?php
$this->db->where('track_name', 'link');
$link = $this->db->get('linkinfo')->result_array();
pd
?>    


<div class="row">

    
    <div class="col-md-12">
            <div class="col-md-4">
                <form action="<?php echo base('homemanage', 'add_important_link');?>" method="post">
        <div class="form-group">
                <label><?php echo lng('Link Title');?></label>
                <input class="form-control" placeholder="" name="title" data-validation="required">
                <input type="hidden" class="form-control" value="" name="description">
        </div>
        <div class="form-group">
                <label><?php echo lng('Link');?></label>
                <input class="form-control" placeholder="" name="title_link" data-validation="required">
        </div>
                    <button type="submit" class="btn btn-info"><?php echo lng('Add');?></button>
                </form>
    </div>
            <div class="col-md-8">
                <table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th><?php echo lng('Link Title');?></th>
      <th><?php echo lng('Link');?></th>
      <th><?php echo lng('Actions');?></th>
    </tr>
  </thead>
  <tbody>
      <?php 
      if(!empty($link)):
      foreach ($link as $key=>$list): $id = $list['id'];?>
    <tr>
      <th scope="row"><?php echo $key+1;?></th>
      <td><?php echo $list['title'];?></td>
      <td><?php echo $list['link'];?></td>
      <td>
          <a href="#" class="btn btn-info btn-xs" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_links/<?php echo $id; ?>');">Edit</a>
          <a href="<?php echo base('homemanage', 'delete_link'."/$id");?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to Remove?');"><?php echo lng('Delete');?></a>
      </td>
    </tr>
    <?php endforeach;
    endif;
    ?>
  </tbody>
</table>
            </div>
    </div><!--/.row-->
    
</div>
