<div class="col-md-offset-4 col-md-6">
  <form class="form-inline" action="<?php echo base_url();?>index.php?Home/student_idcard_view" method="post" target="_blank">
    <div class="form-group">
      <label for="email">Select Class: </label>
      <select name="class_id" id="" class="form-control">
        <?php $classs = $this->db->get('class')->result_array(); 
          foreach($classs as $k=>$class):
        ?>
        <option value="<?php echo $class['class_id'];?>"><?php echo $class['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
