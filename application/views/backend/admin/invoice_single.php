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
						<strong>Sonar Bangla High School</strong>
						<br> Banglabazar, Sonargaon, Narayangonj - 1440
						<br> Phone: 01715386301
						<br>
					</address>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<h6 class="text-left">
						SL No.
						<?php echo 55; ?>
					</h6>
				</div>
				<div class="col-sm-6">
					<h6 class="text-right">
						Date:
						<?php echo date('d-m-Y'); ?>
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
								<td>Student Name</td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Class: </strong>
								</td>
								<td>Class</td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Section: </strong>
								</td>
								<td>Section</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6 well invoice-author">
					<table class="invoice-head">
						<tbody>

							<tr>
								<td class="pull-right">
									<strong>Group: </strong>
								</td>
								<td>Group</td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Roll: </strong>
								</td>
								<td>Roll</td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>ID No.: </strong>
								</td>
								<td>ID No.</td>
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
							<tr>
								<td>Service request</td>
								<td>$1000.00</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<strong>Total</strong>
								</td>
								<td>
									<strong>$1000.00</strong>
								</td>
							</tr>
							<tr>
								<td>
									<strong>Due</strong>
								</td>
								<td>
									<strong>$1000.00</strong>
								</td>
							</tr>
							<tr>
								<td class="text-center">
									<strong>Grand Total</strong>
								</td>
								<td>
									<strong>$1000.00</strong>
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
						<strong>Sonar Bangla High School</strong>
						<br> Banglabazar, Sonargaon, Narayangonj - 1440
						<br> Phone: 01715386301
						<br>
					</address>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<h6 class="text-left">
						SL No.
						<?php echo 55; ?>
					</h6>
				</div>
				<div class="col-sm-6">
					<h6 class="text-right">
						Date:
						<?php echo date('d-m-Y'); ?>
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
								<td>Student Name</td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Class: </strong>
								</td>
								<td>Class</td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Section: </strong>
								</td>
								<td>Section</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6 well invoice-author">
					<table class="invoice-head">
						<tbody>

							<tr>
								<td class="pull-right">
									<strong>Group: </strong>
								</td>
								<td>Group</td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>Roll: </strong>
								</td>
								<td>Roll</td>
							</tr>
							<tr>
								<td class="pull-right">
									<strong>ID No.: </strong>
								</td>
								<td>ID No.</td>
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
							<tr>
								<td>Service request</td>
								<td>$1000.00</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<strong>Total</strong>
								</td>
								<td>
									<strong>$1000.00</strong>
								</td>
							</tr>
							<tr>
								<td>
									<strong>Due</strong>
								</td>
								<td>
									<strong>$1000.00</strong>
								</td>
							</tr>
							<tr>
								<td class="text-center">
									<strong>Grand Total</strong>
								</td>
								<td>
									<strong>$1000.00</strong>
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