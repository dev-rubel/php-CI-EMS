<?php
		$this->db->select('location');
		$this->db->where('id', 1);
		$location = oneDim($this->db->get('taxtinfo')->result_array());
?>
<p>
		<?php echo lng('Current Location');?>
</p>
<div class="iframe-container">
		<?php echo $location['location'];?>
</div>