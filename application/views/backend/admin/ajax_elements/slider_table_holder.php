<?php 
  $this->db->where('track_name', 'slider');
  $slider = $this->db->get('images')->result_array();
?>
<table class="table">
  <thead class="thead-inverse">
	<tr>
	  <th>#</th>
	  <th>
		<?php echo lng('Image Title');?>
	  </th>
	  <th>
		<?php echo lng('Description');?>
	  </th>
	  <th>
		<?php echo lng('Images');?>
	  </th>
	  <th>
		<?php echo lng('Action');?>
	  </th>
	</tr>
  </thead>
  <tbody>
	<?php 
if(!empty($slider)):
foreach($slider as $key=>$list): $info = explode('+', $list['info']); $id = $list['id']; $name = $list['img_name'];?>
	<tr>
	  <th scope="row">
		<?php echo $key+1;?>
	  </th>
	  <td>
		<?php echo $info[0];?>
	  </td>
	  <td>
		<?php echo $info[1];?>
	  </td>
	  <td>
		<img src="<?php echo base_url().'assets/images/slider_image/'.$list['img_name'];?>" width="150px" height="100px"
		/>
	  </td>
	  <td>
		<a href="#" class="btn btn-info btn-xs" onclick="editSlider('<?php echo $id;?>')">Edit</a>
		<a href="<?php echo base('homemanage', 'delete_slider'." /$id/$name ");?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');">
		  <?php echo lng('Delete this');?>
		</a>
	  </td>
	</tr>
	<?php endforeach;
endif;
?>
  </tbody>
</table>

