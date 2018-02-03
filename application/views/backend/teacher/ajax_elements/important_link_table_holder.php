<?php
$this->db->where('track_name', 'link');
$link = $this->db->get('linkinfo')->result_array();
?>
<table class="table">
  <thead class="thead-inverse">
	<tr>
	  <th>#</th>
	  <th>
		<?php echo lng('Link Title');?>
	  </th>
	  <th>
		<?php echo lng('Link');?>
	  </th>
	  <th>
		<?php echo lng('Actions');?>
	  </th>
	</tr>
  </thead>
  <tbody>
	<?php 
if(!empty($link)):
foreach ($link as $key=>$list): $id = $list['id'];?>
	<tr id="imLink<?php echo $key;?>">
		<th scope="row">
			<?php echo $key+1;?>
		</th>
		<td>
			<?php echo $list['title'];?>
		</td>
		<td>
			<?php echo $list['link'];?>
		</td>
		<td>
			<a href="#" class="btn btn-info btn-xs" onclick="editImLink('<?php echo $id;?>')">Edit</a>
			<a href="#" class="btn btn-danger btn-xs" onclick="confDelete('homemanage','ajax_delete_link','<?php echo $id;?>','imLink<?php echo $key;?>')">
				<?php echo lng('Delete');?>
			</a>
		</td>
	</tr>
	<?php endforeach;
endif;
?>
  </tbody>
</table>