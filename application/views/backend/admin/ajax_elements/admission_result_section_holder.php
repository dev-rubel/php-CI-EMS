<?php
//pd($result);
!empty($result[0]['class'])?$Sclass = 'Class '.$result[0]['class']:$Sclass='';
!empty($result[0]['group'])?$Sgroup = ', Group: '.ucwords($result[0]['group']):$Sgroup='';

!empty($result[0]['class'])?$Oclass = $result[0]['class']:$Oclass='';
!empty($result[0]['group'])?$Ogroup = $result[0]['group']:$Ogroup='';
?>

<h3 class="text-center"><a href="<?php echo base('Home', 'meritlistPage/'.$Oclass.'/'.$Ogroup);?>" class="btn btn-info" target="_blank" title="Click to download marksheet"><?php echo 'Download '.$Sclass.'-'.$Sgroup.' Mark-Sheet'?></a></h3>
                
<table id="example" class="table table-bordered datatable" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Merit</th>
			<th>Roll</th>
			<th>Name</th>
			<th>Father's Name</th>
			<th>Obtain Mark</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php /* pd($result); */ foreach($result as $key=>$list):?>
		<tr>
			<td><?php echo $key+1;?></td>
			<td><?php echo $list['uniq_id'];?></td>
			<td><?php echo $list['namebn'];?></td>
			<td><?php echo $list['fnamebn'];?></td>
			<td><?php echo $list['mark'];?></td>     
			<td width="100px">
			<?php if($list['status'] != 2):?>
				<a href="#" class="btn btn-danger btn-sm" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_admit_new_student/<?php echo $list['std_id'];?>');">Admit Student</a>
			<?php else: 
				$invoice_id = $this->db->get_where('invoice', array('acc_code' => $list['uniq_id']))->row()->invoice_id;
			?>
				<a href="#" class="btn btn-success btn-sm" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $invoice_id;?>');">Download Invoice</a>
			<?php endif;?>
			</td>                       
		</tr>
		<?php endforeach;?>
	</tbody>
</table>