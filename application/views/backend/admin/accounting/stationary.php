<style>
	.stationary_profit {
		color: green;
		font-weight: bold;
	}
	.stationary_loss {
		color: red;
		font-weight: bold;
	}
</style>
<?php $stationarys = $this->db->get('stationary_category')->result_array(); ?>
<hr />
<div class="row">
	<div class="col-md-12">

		<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
				<a href="#report" data-toggle="tab">
					<i class="entypo-menu"></i>
					<?php echo get_phrase('stationary_item_report'); ?>
				</a>
			</li>
			<li>
				<a href="#list" data-toggle="tab">
					<i class="entypo-menu"></i>
					<?php echo get_phrase('stationary_item'); ?>
				</a>
			</li>
			<li>
				<a href="#add" data-toggle="tab">
					<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('stationary_category'); ?>
				</a>
			</li>
		</ul>
		<!------CONTROL TABS END------>

		<div class="tab-content">
			<br>
			<!----TABLE LISTING STARTS-->
			<div class="tab-pane box active" id="report">
				<table class="table table-striped table-bordered table-hover table-header-fixed">
					<thead>
						<tr>
							<th>#</th>
							<th>IN/OUT</th>
							<th>Category Name</th>
							<th>Amount IN/OUT</th>
							<th>Price (Avg)</th>
							<th>Total Price (IN/OUT)</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($stationarys as $k=>$each): 
								$data['stationary_category_id'] = $each['stationary_category_id'];
						?>
						<tr>
							<td><?php echo $k+1; ?></td>
							<td>IN</td>
							<td><?php echo ucwords(str_replace('_', ' ', $each['name'])); ?></td>
							<td>
								<?php 								
									$data['item_status'] = 1;
									$this->db->select_sum('item_amount');
									$totalIn = $this->db->get_where('stationary_items',$data)->row()->item_amount;
									echo $totalIn;
								?>
							</td>
							<td>
								<?php 						
									$this->db->select_avg('item_price');
									$inAvgPrice = $this->db->get_where('stationary_items',$data)->row()->item_price;
									echo round($inAvgPrice);
								?>
							</td>
							<td>
								<?php 						
									$this->db->select_sum('item_price_total');
									$inSumPrice = $this->db->get_where('stationary_items',$data)->row()->item_price_total;
									echo $inSumPrice;
								?>
							</td>
						</tr>
						<tr>
							<td><?php echo $k+1; ?></td>
							<td>OUT</td>
							<td><?php echo ucwords(str_replace('_', ' ', $each['name'])); ?></td>
							<td>
								<?php 
									$data['item_status'] = 2;
									$this->db->select_sum('item_amount');
									$totalOut = $this->db->get_where('stationary_items',$data)->row()->item_amount;
									echo $totalOut;
								?>
							</td>
							<td>
								<?php 						
									$this->db->select_avg('item_price');
									$outAvgPrice = $this->db->get_where('stationary_items',$data)->row()->item_price;
									echo round($outAvgPrice);
								?>
							</td>
							<td>
								<?php 						
									$this->db->select_sum('item_price_total');
									$outSumPrice = $this->db->get_where('stationary_items',$data)->row()->item_price_total;
									echo $outSumPrice;
								?>
							</td>
						</tr>
						<?php $loss_profit = $outSumPrice - $inSumPrice; ?>
						<tr class="<?php echo $loss_profit<=0?'stationary_loss':'stationary_profit'; ?>">
							<td></td>
							<td></td>
							<td>Remaning: <?php echo $totalIn - $totalOut; ?></td>
							<td></td>
							<td></td>
							<td>
								<?php 
									if($loss_profit <= 0) {
										echo  'Loss: '.$loss_profit;
									} else {
										echo  'Profit: '.$loss_profit;
									}
								?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane box" id="list">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="entypo-plus-circled"></i>
							<?php echo get_phrase('add_stationary_item');?>
						</div>
					</div>
					<div class="panel-body">

					<form id="createStationaryItem" action="<?php echo base_url() .'index.php?admin/ajax_stationary_item_create'; ?>" class="form-horizontal form-groups-bordered" method="post">

						<div class="form-group">
							<div class="col-sm-1">
								<select name="stationary_category_id" class="form-control" onchange="return get_stationary_item_remain(this.value)">
									<option value="">Select One</option>
									<?php 
										
										foreach ($stationarys as $row):
									?>
									<option value="<?php echo $row['stationary_category_id']; ?>"><?php echo ucfirst($row['name']); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="item_amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"
									value="" placeholder="Item Amount">
								<p id="stationary_item_remain" class="text-center"></p>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="item_price" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"
									value="" placeholder="Each Item Price">
							</div>
							<div class="col-sm-2">
								<textarea name="item_description" class="form-control" placeholder="Item Description" cols="30" rows="5"></textarea>
							</div>
							<div class="col-sm-1">
								<select name="item_status" class="form-control">
									<option value="1">IN</option>
									<option value="2">OUT</option>
								</select>
							</div>
							<div class="col-sm-2">
								<input type="text" class="datepicker form-control" name="item_transaction_date" readonly required />
							</div>

							<div class="col-sm-2">
								<button type="submit" class="btn btn-info">
									<?php echo get_phrase('add_item');?>
								</button>
							</div>
						</div>
					<?php echo form_close();?>
				</div>
			</div>
				<div id="editStationaryItemHolder"></div>
				<div id="StationaryItemList">

					<table class="table table-striped table-bordered table-hover table-header-fixed" id="stationary_item">
						<thead>
							<tr>
							<th>#</th>
							<th>Category Name</th>
							<th>Item Amount</th>
							<th>Price</th>
							<th>Description</th>
							<th>Status</th>
							<th>Date</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>

				</div>
				
			</div>
			<!----TABLE LISTING ENDS--->


			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="entypo-plus-circled"></i>
							<?php echo get_phrase('add_stationary_category');?>
						</div>
					</div>
					<div class="panel-body">
						<form id="createStationaryCategory" action="<?php echo base_url() .'index.php?admin/ajax_stationary_category_create'; ?>" class="form-horizontal form-groups-bordered" method="post">
							<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label">
									<?php echo get_phrase('name');?>
								</label>

								<div class="col-sm-5">
									<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"
										value="" autofocus>
								</div>

								<div class="col-sm-2">
									<button type="submit" class="btn btn-info">
										<?php echo get_phrase('add_stationary_category');?>
									</button>
								</div>
							</div>
						<?php echo form_close();?>
					</div>
				</div>
                    <div id="editStationaryCategoryHolder"></div>
                    <div id="StationaryCategoryList">

                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="stationary_category">
							<thead>
								<tr>
									<th>#</th>
									<th>Category Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>

                    </div>

			</div>
			<!----CREATION FORM ENDS-->
		</div>

	</div>
</div>



<script type="text/javascript">

	function get_stationary_item_remain(stationary_item_id) {
		$.ajax({
			url: '<?php echo base_url(); ?>index.php?admin/get_stationary_item_remain/' + stationary_item_id,
			success: function (response) {
				if (response) {
					$('#stationary_item_remain').show();
					$('#stationary_item_remain').html('<b>'+response+'</b> item remaining.');
				} else {
					$('#stationary_item_remain').hide();
				}
			}
		});
	}


	$(document).ready(function () {        

		$('#createStationaryItem').ajaxForm({
			beforeSend: function () {
				$('#loading2').show();
				$('#overlayDiv').show();
			},
			success: function (data) {
				var jData = JSON.parse(data);

				if (!jData.type) {
					toastr.error(jData.msg);
				} else {
					toastr.success(jData.msg);
					// $("#StationaryCategoryList").html(jData.html);
					//ajaxDataTable('stationary_category', 'admin/ajaxStationaryCategoryList');
					ajaxDataTable('stationary_item', 'admin/ajaxStationaryItemList');
					$('#createStationaryItem').resetForm();
				}
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				$('#loading2').fadeOut('slow');
				$('#overlayDiv').fadeOut('slow');
			}
		});


		$('#createStationaryCategory').ajaxForm({
			beforeSend: function () {
				$('#loading2').show();
				$('#overlayDiv').show();
			},
			success: function (data) {
				var jData = JSON.parse(data);

				if (!jData.type) {
					toastr.error(jData.msg);
				} else {
					toastr.success(jData.msg);
					// $("#StationaryCategoryList").html(jData.html);
					ajaxDataTable('stationary_category', 'admin/ajaxStationaryCategoryList');
					$('#createStationaryCategory').resetForm();
				}
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				$('#loading2').fadeOut('slow');
				$('#overlayDiv').fadeOut('slow');
			}
		});

	});

	function editStationaryItem(stationaryItemID) {
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url();?>index.php?admin/ajax_stationary_item_edit/' + stationaryItemID,
			beforeSend: function () {
				$('#loading2').show();
				$('#overlayDiv').show();
			},
			success: function (data) {
				var jData = JSON.parse(data);

				toastr.success(jData.msg);
				$("#editStationaryItemHolder").html(jData.html);
				$('body,html').animate({
					scrollTop: 350
				}, 800);
				$('#loading2').fadeOut('slow');
				$('#overlayDiv').fadeOut('slow');
			}
		});
	}

	function editStationaryCategory(stationaryCategoryID) {
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url();?>index.php?admin/ajax_stationary_category_edit/' + stationaryCategoryID,
			beforeSend: function () {
				$('#loading2').show();
				$('#overlayDiv').show();
			},
			success: function (data) {
				var jData = JSON.parse(data);

				toastr.success(jData.msg);
				$("#editStationaryCategoryHolder").html(jData.html);
				$('body,html').animate({
					scrollTop: 350
				}, 800);
				$('#loading2').fadeOut('slow');
				$('#overlayDiv').fadeOut('slow');
			}
		});
	}

</script>