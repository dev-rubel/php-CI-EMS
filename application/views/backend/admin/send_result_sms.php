<hr />
<div class="row">
	<div class="col-md-12">
		
		<!-- CONTROL TABS START -->
		<ul class="nav nav-tabs bordered">
			<li>
				<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
				<?php echo get_phrase('result_list').' (Last 5 Days)';?>
				</a>
			</li>
				<li class="active">
					<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
						<?php echo get_phrase('send_result');?>
					</a>
				</li>
				<li>
					<a href="#notice" data-toggle="tab"><i class="entypo-mail"></i>
						<?php echo get_phrase('send_notice');?>
					</a>
				</li>
				</ul>
				<!-- CONTROL TABS END -->
				<div class="tab-content">
					<br>
					<!-- TABLE LISTING STARTS-->
					<div class="tab-pane box" id="list">
						<table  class="table table-bordered datatable" id="table_export">
							<thead>
								<tr>
									<th>#</th>
									<th>ID</th>
									<th>Subject</th>
									<th>Obtain Mark</th>
									<th>Height Mark</th>
									<th>Total Mark</th>
									<th>Phone</th>
									<th>Exam Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($csv_result as $k=>$each): 
								$marks = explode('|', $each['marks']); ?>
									<tr>
										<td><?php echo $k;?></td>
										<td><?php echo $each['csv_id'];?></td>
										<td><?php echo $each['subjects'];?></td>
										<td><?php echo $marks[0];?></td>
										<td><?php echo $marks[1];?></td>
										<td><?php echo $marks[2];?></td>
										<td><?php echo $each['phone'];?></td>
										<td><?php echo date('d-m-Y', $each['exam_date']);?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<!--TABLE LISTING ENDS -->
					
					
					<!-- CREATION FORM STARTS -->
					<div class="tab-pane box active" id="add" style="padding: 5px">
						<div class="box-content">
							<form action="<?php echo base('admin', 'send_result_csv'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-groups-bordered validate">
							
							<div class="form-group">
								<label class="col-sm-3 control-label"><?php echo get_phrase('download_demo_file'); ?></label>
								<div class="col-sm-5">
									<a href="<?php echo base('admin','download_excel_result_format');?>" class="btn btn-default btn-sm">Download</a>
									<p class="form-text text-muted">
										Please do not change file format.
									</p>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-sm-3 control-label"><?php echo get_phrase('exam_type'); ?></label>
								<div class="col-sm-5">
									<select name="exam_type" class="form-control">
										<option value="class_test">Class Test</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-sm-3 control-label"><?php echo get_phrase('input_.xls_file'); ?></label>
								<div class="col-sm-5">
									<input type="file" class="form-control" name="csv_file">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-info"><?php echo get_phrase('send_sms');?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- CREATION FORM ENDS -->



				<!-- CREATION FORM STARTS -->
					<div class="tab-pane box" id="notice" style="padding: 5px">
						<div class="box-content">
							<form action="<?php echo base('admin', 'send_notice_sms'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-groups-bordered validate">
							
							<div class="form-group">
								<label class="col-sm-3 control-label"><?php echo get_phrase('download_demo_file'); ?></label>
								<div class="col-sm-5">
									<a href="<?php echo base('admin','download_excel_notice_format'); ?>" class="btn btn-default btn-sm">Download</a>
									<p class="form-text text-muted">
										Please do not change file format.
									</p>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-sm-3 control-label"><?php echo get_phrase('select_class'); ?></label>
								<div class="col-sm-5">
									<select name="class" id="" class="form-control">
										<option value="">Select Class</option>
										<option value="all">All</option>
										<?php $class = $this->db->get('class')->result_array(); 
											foreach($class as $k=>$each):
										?>
												<option value="<?php echo $each['class_id']?>"><?php echo $each['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-sm-3 control-label"><?php echo get_phrase('SMS Description'); ?></label>
								<div class="col-sm-5">
									<textarea name="sms_description" id="sms_description" class="form-control" rows="15"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label  class="col-sm-3 control-label"><?php echo get_phrase('input_.xls_file'); ?></label>
								<div class="col-sm-5">
									<input type="file" class="form-control" name="xls_file">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="submit" class="btn btn-info"><?php echo get_phrase('send_notice');?></button>
								</div>
							</div>
						</form>

					</div>
				</div>
				<!-- CREATION FORM ENDS -->
				
			</div>
		</div>
	</div>
	<!---  DATA TABLE EXPORT CONFIGURATIONS -->
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			
			var datatable = $("#table_export").dataTable();
			
			$(".dataTables_wrapper select").select2({
				minimumResultsForSearch: -1
			});
		});
			
	</script>