<?php
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="..........................................................................." />
	<meta name="description" content="........................................................................" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico..........................................." />
	<link rel="apple-touch-icon" type="image/x-icon" href="apple-touch-icon.png..............................." />
	<title>Pharmacy System</title>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />
	<link rel="shortcut icon" href="img/Graphicloads-Medical-Health-Medicine-box-2.ico">
	<script type="text/javascript" src="js/modernizr.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<style>
		ul li a:hover {
			background-color: #82EFF6;
		}

		.row {
			margin-top: 15px;
		}

		@media (max-width: 767px) {

			/* Adjust styles for smaller screens */
			.parts.container.row {
				padding-bottom: 15px;
			}

			.col-md-6.text-center {
				margin-top: 30px;
				padding-bottom: 15px;
			}

			.col-md-6.text-center img {
				max-width: 100%;
				height: auto;
			}

			.col-md-6.text-center h3,
			.col-md-6.text-center p {
				font-size: 16px;
			}
		}
	</style>

</head>


<body class="">

	<div class="header-area" style="background: #3abac9;">
		<div class="header-top">
			<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container">
				<div class="logo col-md-3">
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7">
					<ul class="list-unstyled list-inline pull-right">
						<li><a href="cussignup.php" style="color:white;font-size:20px ">Customer SignUp</a></li>
						<li><a href="pharsignup.php" style="color:white;font-size:20px ">Pharmacist SignUp</a></li>
						<li><a href="login.php" style="color:white;font-size:20px ">Login</a></li>

					</ul>
				</div>

			</div>
		</div>


	</div>

	<div class="slider">
		<!--  <h2></h2>  -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->


			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active">
					<img src="images/34.jpg" alt="Los Angeles" style="width:100%;">
					<div class="carousel-caption">
						<h3 style="color:white ;font-size:50px">Critical Medicines</h3>
					</div>
				</div>

			</div>

			<div class="parts container row" style="margin-top:30px;padding-bottom:30px; background:#EAEAEAE6;width: 101%;">
				<div class="col-md-4 text-center" style="margin-top:60px;padding-bottom:30px;">
					<img src="images/38.png" alt="" />
					<h3>Reservation of medicines</h3>
					<p>Finding out if a medicines is available in some pharmacies is a difficult task, here you can reserve the medicines by contacting the pharmacist.</p>
				</div>
				<div class="col-md-4 text-center" style="margin-top:60px;padding-bottom:30px;">
					<img src="images/37.png" alt="" />
					<h3>Nearest Pharmacy</h3>
					<p>Our website helps to find the nearest pharmacy to get medicines, with just a few clicks, you can easily search for pharmacies in your area that carry the medicines you need.</p>
				</div>
				<div class="col-md-4 text-center" style="margin-top:60px;padding-bottom:30px;">
					<img src="images/33.png" alt="" />
					<h3>Quality Medicine</h3>
					<p>At our website, we understand that when it comes to your health, you deserve the best. That's why we are committed to providing our customers with only the highest quality medications from reputable and trusted sources.</p>
				</div>
			</div>

			<div class="parts container row" style="padding-bottom:30px; background:#F2F2F2;width: 101%;">
				<div class="row">
					<div class="col-md-6 col-sm-12 text-center" style="margin-top:60px;padding-bottom:30px;">
						<img src="images/39.jpg" alt="" />

					</div>
					<div class="col-md-6 col-sm-12 text-center" style="margin-top:130px;padding-bottom:30px;">

						<h3>Critical Medicines</h3>
						<p style="font-size: 17px;">when pharmacy has a need for medications that are nearing their expiration date, our website can provide a solution.pharmacist can offer medications that have a shorter shelf life, but are still safe and effective for use. This can be particularly useful for pharmacies or healthcare facilities that need to manage their inventory of medications, and need to purchase medications with a shorter shelf life in order to reduce waste and save costs also with some discount so its good for customer too.</p>
					</div>
				</div>


				<div class="row">
					<div class="col-md-6 col-sm-12 text-center" style="margin-top:60px;padding-bottom:30px;">
						<img src="images/40.jpg" alt="" />

					</div>
					<div class="col-md-6 col-sm-12 text-center" style="margin-top:130px;padding-bottom:30px;">

						<h3>Used Medicines</h3>
						<p style="font-size: 17px;">We do offer the option to purchase smaller quantities of medication, including individual envelopes or single doses. This can be particularly useful for patients who require medication for a short period of time, or who have a prescription for a medication they do not need to take on a regular basis. Our website offers a range of medication options, including single doses and smaller quantities, to meet the needs of our customers with discounts too.</p>
					</div>

				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12 text-center" style="margin-top:60px;padding-bottom:30px;">
						<img src="images/41.jpg" alt="" />

					</div>
					<div class="col-md-6 col-sm-12 text-center" style="margin-top:130px;padding-bottom:30px;">

						<h3>Medicines on hold</h3>
						<p style="font-size: 17px;">If you need to request that a pharmacist hold a particular medication for you, you can usually do so by contacting the pharmacist directly. Many pharmacies have a phone number listed on their website, and you can use this number to contact the pharmacist and place your order. When contacting your pharmacist, be sure to have the name of the medication and any other relevant information available. The pharmacist will then be able to confirm whether or not they have the medicine in stock and can keep it for you.</p>
					</div>

				</div>

			</div>


			<div class="container row" style="width: 103%; background: #1a1a1ae6; margin-top: -30px;">
				<div class="col-md-12 text-center" style="margin-top:30px;padding-bottom:20px;">


					<p style="font-weight: bold; font-size: 15px;color: white;">Designed by LIU STUDENTS</p>
				</div>



			</div>
</body>

</html>