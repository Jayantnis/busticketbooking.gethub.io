<?php
require_once('data/get_origin.php');
require_once('data/get_destination.php');

// echo '<pre>';
// print_r($origins);
// echo '</pre>';
?>

<!DOCTYPE html>
<html lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Ticket Rerservation</title>
	<link rel="shortcut icon" type="image/x-icon" href="./images/buslogo.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">

</head>

<body >
<style>
 body {
        background-image: url("./img/reserved.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
      }
      
	</style>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Online Ticketing</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="#">Rerservation
						<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
					</a>
				</li>
				<li class="active">
					<a href="./Schedule.php">Schedule Log
						<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php"><span class="glyphicon glyphicon-backward"></span> Back To Home</a></li>
			</ul>
		</div>
	</nav>



	<div class="container-fluid">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<h2>
						<!-- ITINERARY-->
						<center>Location Point</center>
					</h2>
					<div class="container-fluid">
						<form class="form-horizontal" role="form" id="form-itinerary">

							<div class="form-group">

								<label for="">Origin:</label>
								<select class="btn btn-default" id="orig-id">
									<?php foreach ($origins as $o) : ?>
										<option value="<?= $o['origin_id']; ?>"><?= $o['origin_desc']; ?></option>
									<?php endforeach; ?>
								</select>

								<label for="">Destination:</label>
								<select class="btn btn-default" id="dest-id">
									<?php foreach ($destinations as $d) : ?>
										<option value="<?= $d['dest_id']; ?>"><?= $d['dest_destination']; ?></option>
									<?php endforeach; ?>
								</select>
								<center>
									<br></br>
									<div class="form-group">
										<!--Enroll date-->
										<label for="">Departure Date:</label>
										<input type="date" class="btn btn-default" id="dept-date">
									</div>

									<button type="submit" class="btn btn-success">NEXT
										<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
									</button>
								</center>
						</form>

					</div>


				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
	</div>




	</tbody>
	</table>
	</div>

	<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).on('submit', '#form-itinerary', function(event) {
			event.preventDefault();
			/* Act on the event */
			var validate = "";
			var origin = $('select[id=orig-id]').val();
			var dest = $('select[id=dest-id]').val();
			var dept = $('input[id=dept-date]').val();

			if (dept.length == 0) {
				alert('Please Select Departure Date!');
			} else {
				$.ajax({
					url: 'data/session_itinerary.php',
					type: 'post',
					dataType: 'json',
					data: {
						oid: origin,
						did: dest,
						dd: dept
					},
					success: function(data) {
						console.log(data);
						if (data.valid == true) {
							window.location = data.url;
							console.log('sss');
						}
					},
					error: function() {
						alert('Error: L161+');
					}
				}); //error filed success of REF
			} //end dept kung == 0


		});
	</script>




</body>

</html>