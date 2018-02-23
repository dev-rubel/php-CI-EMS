<link rel="stylesheet" media="all" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css"
/>


<style>
	.container {
		padding-top: 30px;
	}

	.invoice-body {
		background-color: transparent;
	}

	.invoice-author {
		margin: 10px 0px 10px 0px;
		font-size: 12px;
	}

	.invoice-thank h5 {
		padding: 5px 0px;
	}

	address {
		margin-top: 0px;
	}

	.student-copy .row {
		border-left: 1px dotted;
	}

	.student-sign {
		border-top: 1px dotted;
		padding-top: 5px;
	}

	.office-sign {
		border-top: 1px dotted;
		padding-top: 5px;
	}

	.table td,
	.table th {
		padding: 5px !important;
	}

	hr {
		margin: 5px 0px;
	}

	table.invoice-head {
		font-size: 14px;
	}

	.table-bordered {
		font-size: 15px !important;
	}
</style>
<?php 
$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
list($schoolName,$schoolAddress,$eiin,$schoolEmail,$phone) = explode('+', $schoolInfo);


$invoice_info = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->result_array();
foreach ($invoice_info as $row):

	$class_id = $this->db->get_where('enroll' , array(
		'student_id' => $row['student_id'],
			'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
	))->row()->class_id;
	$shift_id = $this->db->get_where('enroll' , array(
		'student_id' => $row['student_id'],
			'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
	))->row()->shift_id;
	$section_id = $this->db->get_where('enroll' , array(
		'student_id' => $row['student_id'],
			'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
	))->row()->section_id;
	$std_roll = $this->db->get_where('enroll' , array(
		'student_id' => $row['student_id'],
			'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
	))->row()->roll;
?>
<div class="container">
	<div class="row">
		<!-- OFFICE COPY -->
		<div class="col-sm-6 office-copy">
			<div class="row">
				<div class="col-sm-6">
					<h6>Invoice</h5>
				</div>
				<div class="col-sm-6 text-right">
					<h6>Office Copy</h6>
				</div>
			</div>
			<div class="row header-area">
				<div class="col-sm-3 text-center">
					<img src="https://image3.mouthshut.com/images/imagesp/925732934s.png" width="120px" height="100px" class="img-responsive logo">
				</div>

				<div class="col-sm-9">
					<address class="bg-light text-center">
						<strong><?php echo $schoolName ?></strong>
						<br> <?php echo $schoolAddress ?>
						<br> Phone: <?php echo $phone; ?>
						<br>
					</address>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<h6 class="text-left">
						SL No.
						<?php echo $invoice_id; ?>
					</h6>
				</div>
				<div class="col-sm-6">
					<h6 class="text-right">
						Date:
						<?php echo date('d-m-Y', $row['creation_timestamp']); ?>
					</h6>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6 well invoice-author">
					<table class="invoice-head">
						<tbody>
							<tr>
								<td class="pull-right">
									<strong>Name: </strong>
								</td>
								<td><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?></td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Class: </strong>
								</td>
								<td><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?></td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Section: </strong>
								</td>
								<td><?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6 well invoice-author">
					<table class="invoice-head">
						<tbody>
						<?php 
							$group_name = ucfirst($this->db->get_where('group', array('class_id' => $class_id))->row()->name);
                            if(strlen($group_name) > 0):
						?>
							<tr>
								<td class="pull-right">
									<strong>Group: </strong>
								</td>
								<td><?php echo $group_name ?></td>
							</tr>
							<?php endif; ?>
							<tr>
								<td class="pull-right">
									<strong>Roll: </strong>
								</td>
								<td><?php echo $std_roll; ?></td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>ID No.: </strong>
								</td>
								<td><?php echo $row['acc_code']; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 well">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						<?php $fee_names = explode(',', $row['fee_name']); foreach($fee_names as $k=>$name): ?>
							<tr>
								<td><?php 
								if($name=='tution_fee'){
									echo ucwords(str_replace('_', ' ', $name)).' ('.str_replace(' ', ', ', ucwords(str_replace(',', ' ', $row['months']))).')';     
								} else {
									echo ucwords(str_replace('_', ' ', $name));     
								}?></td>
								<?php $fee_amounts = explode(',', $row['fee_amount']); ?>
                    			<td><?php echo $fee_amounts[$k]; ?></td>
							</tr>
						<?php endforeach; ?>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<strong>Total</strong>
								</td>
								<td>
									<strong><?php echo $row['amount_paid'].' TK.'; ?></strong>
								</td>
							</tr>
							<tr>
								<td>
									<strong>Due</strong>
								</td>
								<td>
									<?php if(!empty($row['due'])): $dueAmount = $row['due'];?>
										<strong><?php echo $row['due'].' TK.'; ?></strong>
									<?php else: $dueAmount = 0;?>
										<strong>0 TK.</strong>
									<?php endif; ?>									
								</td>
							</tr>
							<tr>
								<td class="text-center">
									<strong>Grand Total</strong>
								</td>
								<td>
									<strong><?php echo $row['amount']; ?> TK.</strong>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row pt-3">
				<div class="col-sm-6 invoice-thank text-left">
					<p class="bg-light student-sign">Student Sign</p>
				</div>
				<div class="col-sm-6 invoice-thank text-right">
					<p class="bg-light office-sign">Office Sign</p>
				</div>
			</div>

		</div>
		<!-- END OFFICE COPY -->
		<!-- STUDENT COPY -->
		<div class="col-sm-6 student-copy">
			<div class="row">
				<div class="col-sm-6">
					<h6>Invoice</h5>
				</div>
				<div class="col-sm-6 text-right">
					<h6>Student Copy</h6>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 text-center">
					<img src="https://image3.mouthshut.com/images/imagesp/925732934s.png" width="120px" height="100px" class="img-responsive logo">
				</div>

				<div class="col-sm-9">
					<address class="bg-light text-center">
						<strong><?php echo $schoolName ?></strong>
						<br> <?php echo $schoolAddress ?>
						<br> Phone: <?php echo $phone; ?>
						<br>
					</address>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<h6 class="text-left">
						SL No.
						<?php echo $invoice_id; ?>
					</h6>
				</div>
				<div class="col-sm-6">
					<h6 class="text-right">
						Date:
						<?php echo date('d-m-Y', $row['creation_timestamp']); ?>
					</h6>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6 well invoice-author">
					<table class="invoice-head">
						<tbody>
							<tr>
								<td class="pull-right">
									<strong>Name: </strong>
								</td>
								<td><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?></td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Class: </strong>
								</td>
								<td><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?></td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Section: </strong>
								</td>
								<td><?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6 well invoice-author">
					<table class="invoice-head">
						<tbody>
						<?php 
							$group_name = ucfirst($this->db->get_where('group', array('class_id' => $class_id))->row()->name);
                            if(strlen($group_name) > 0):
						?>
							<tr>
								<td class="pull-right">
									<strong>Group: </strong>
								</td>
								<td><?php echo $group_name ?></td>
							</tr>
							<?php endif; ?>
							<tr>
								<td class="pull-right">
									<strong>Roll: </strong>
								</td>
								<td><?php echo $std_roll; ?></td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>ID No.: </strong>
								</td>
								<td><?php echo $row['acc_code']; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 well invoice-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						<?php $fee_names = explode(',', $row['fee_name']); foreach($fee_names as $k=>$name): ?>
							<tr>
								<td><?php 
								if($name=='tution_fee'){
									echo ucwords(str_replace('_', ' ', $name)).' ('.str_replace(' ', ', ', ucwords(str_replace(',', ' ', $row['months']))).')';     
								} else {
									echo ucwords(str_replace('_', ' ', $name));     
								}?></td>
								<?php $fee_amounts = explode(',', $row['fee_amount']); ?>
                    			<td><?php echo $fee_amounts[$k]; ?></td>
							</tr>
						<?php endforeach; ?>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<strong>Total</strong>
								</td>
								<td>
									<strong><?php echo $row['amount_paid'].' TK.'; ?></strong>
								</td>
							</tr>
							<tr>
								<td>
									<strong>Due</strong>
								</td>
								<td>
									<?php if(!empty($row['due'])): $dueAmount = $row['due'];?>
										<strong><?php echo $row['due'].' TK.'; ?></strong>
									<?php else: $dueAmount = 0;?>
										<strong>0 TK.</strong>
									<?php endif; ?>									
								</td>
							</tr>
							<tr>
								<td class="text-center">
									<strong>Grand Total</strong>
								</td>
								<td>
									<strong><?php echo $row['amount']; ?> TK.</strong>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row pt-3">
				<div class="col-sm-6 invoice-thank text-left">
					<p class="bg-light student-sign">Student Sign</p>
				</div>
				<div class="col-sm-6 invoice-thank text-right">
					<p class="bg-light office-sign">Office Sign</p>
				</div>
			</div>

		</div>
		<!-- END STUDENT COPY -->
	</div>
</div>

<?php endforeach; ?>