<table class="table table-bordered datatable" id="table_export">
<thead>
	<tr>
		<th><div>#</div></th>
		<th><div><?php echo get_phrase('group_name'); ?></div></th>
		<th><div><?php echo get_phrase('class_name'); ?></div></th>
		<th><div><?php echo get_phrase('options'); ?></div></th>
	</tr>
</thead>
<tbody>
	<?php $count = 1;
	foreach ($groups as $row): ?>
		<tr>
			<td><?php echo $count++; ?></td>
			<td><?php echo ucwords(str_replace('-', ' ', $row['name'])); ?></td>
			<td><?php echo $this->db->get_where('class',array('class_id'=>$row['class_id']))->row()->name;?></td>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						Action <span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-default pull-right" role="menu">

						<!-- EDITING LINK -->
						<li>
							<a href="#" onclick="editGroup('<?php echo $row['group_id'];?>')">
								<i class="entypo-pencil"></i>
<?php echo get_phrase('edit'); ?>
							</a>
						</li>
						<li class="divider"></li>

						<!-- DELETION LINK -->
						<li>
							<a href="#" onclick="confDelete('admin','ajax_delete_groups','<?php echo $row['group_id'];?>','groups<?php echo $row['group_id'];?>')">
								<i class="entypo-trash"></i>
<?php echo get_phrase('delete'); ?>
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
</tbody>
</table>