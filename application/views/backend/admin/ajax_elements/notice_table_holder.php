<?php 
  $this->db->where('track_name', 'notice');
  $notice = $this->db->get('linkinfo')->result_array();
  ?>
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
          <a href="#" class="btn btn-info btn-xs" onclick="editNotice('<?php echo $id;?>')">Edit</a>
          <a href="<?php echo base('homemanage', 'delete_notice'."/$id");?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><?php echo lng('Delete this');?></a>     
          <?php if($list['status']==1):?>
          <a href="#" class="btn btn-success btn-xs" onclick="statusNotice('<?php echo $id;?>','0')"><?php echo lng('Published');?></a>          
        <?php else:?>
          <a href="#" class="btn btn-warning btn-xs" onclick="statusNotice('<?php echo $id;?>','1')"><?php echo lng('Draft');?></a>  
        <?php endif;?>     
      </td>
    </tr>
    <?php endforeach;
    endif;
    ?>
  </tbody>
</table>