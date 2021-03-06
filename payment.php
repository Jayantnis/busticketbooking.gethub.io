<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start(); //start session if session not start
}

if (isset($_SESSION['tracker'])) {
?>

	<!DOCTYPE html>
	<html lang="">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Payment Ticket</title>
		<link rel="shortcut icon" type="image/x-icon" href="./images/buslogo.png">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
		<style>
			body {
				background-image: url("Rad.jpg");
				background-attachment: fixed;
				background-size: cover;
			}
		</style>

	</head>

	<body>

		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="./index.php">Online Bus Ticket</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="./reserved.php">Reservation
							<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
						</a>
					</li>

					<li><a href="#" class="nav navbar-nav" class="active" onclick="myfun()">PrintOut Page</button>
							<script type="text/javascript">
								function myfun() {
									window.print(); //window print() is the predeifned js 	
								}
							</script>
						</a>

						</a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php"><span class="glyphicon glyphicon-backward"></span> Back To Home</a></li>
				</ul>
			</div>
		</nav>



		<div class="container-fluid">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<h2>
							<center>Bus Booking Ticket</center>
						</h2>
						<br />
						<div class="panel panel-success">
							<div class="panel-heading">
								<h3 class="panel-title">
									<center>DEPARTURE</center>
								</h3>
							</div>
							<div class="panel-body">
								<strong>
									<i>Online Bus Transport, Ticket </i>
									<h3>
										<?php require_once('data/depart_from_to.php');
										echo $origin['origin_desc'];
										?>
										-
										<?= $dest['dest_destination']; ?>
									</h3>
									<p>Departure Date: <?= $_SESSION['departure_date']; ?> @9:00AM</p>
								</strong>
								<i>Estimated Arrival Time: The Next Day @3:00PM</i><br />
								<strong>

									<?php require_once('data/get_accomodation.php');
									echo $accomodation['acc_type'];
									?>
								</strong>
							</div>
						</div>

						<div class="panel panel-success">
							<div class="panel-heading">
								<h3 class="panel-title">CONTACT INFO</h3>
							</div>
							<div class="panel-body">
								<?php require_once('data/getBooked.php'); ?>
								<strong>Book By:</strong> <?= ucwords($bookByInfo['book_by']);  ?><br />
								<strong>Contact #:</strong> <?= $bookByInfo['book_contact']; ?><br />
								<strong>Address:</strong> <?= $bookByInfo['book_address']; ?><br />
							</div>
						</div>
						<div class="container-fluid">
							<strong>
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								PASSENGERS</strong>
							<table id="myTable-party" class="table table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>
											<center>
												Name
											</center>
										</th>
										<th>
											<center>
												Age
											</center>
										</th>
										<th>
											<center>
												Gender
											</center>
										</th>
										<th>
											<center>
												Departure Price
											</center>
										</th>
									</tr>
								</thead>

								<tbody>
									<?php
									require_once('data/getBooked.php');
									$totalPayment = 0;
									$tracker = '';
									foreach ($bookPass as $bp) :
										$name = $bp['book_name'];
										$name = ucwords($name);
										$price = $bp['acc_price'];
										$totalPayment += $price;
										$tracker = $bp['book_tracker'];
									?>
										<tr align="center">
											<td><?= $name; ?></td>
											<td><?= $bp['book_age']; ?></td>
											<td><?= $bp['book_gender']; ?></td>
											<td><?= $price; ?></td>
										</tr>

									<?php endforeach; ?>

									<tr>
										<td></td>
										<td></td>

										<td align="right"><strong>TOTAL:</strong></td>
										<td align="center"><strong><?= $totalPayment; ?></strong></td>
									</tr>
								</tbody>
								<!--ID Generate-->
								<strong>- Booked ID: <?= $tracker; ?></strong>
							</table>
						</div>
					</div>
				</div>

				<left>
					<a class="btn btn-success" href="./index.php"> Back To Home</a>
				</left>
			</div>
			<div class="col-md-3"></div>
		</div>

		<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<!--print page-- manually-->




	</body>

	</html>

<?php
} else {
	echo '<strong>';
	echo 'Page Not Exist';
	echo '</strong>';
} //end if else isset

?>