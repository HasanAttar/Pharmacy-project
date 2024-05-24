<?php
session_start();

// Include the database connection file
include_once('connection.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Get the form data
	$name = mysqli_real_escape_string($con, $_POST['uname']);
	$email = mysqli_real_escape_string($con, $_POST['uemail']);
	$password = mysqli_real_escape_string($con, $_POST['upass']);
	$mobile = mysqli_real_escape_string($con, $_POST['umobile']);
	$region = mysqli_real_escape_string($con, $_POST['region']);


	// Validate the form data
	$errors = array();
	if (empty($name)) {
		$errors[] = 'Pharmacy name is required';
	}
	if (empty($email)) {
		$errors[] = 'Email is required';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Invalid email format';
	}
	if (empty($password)) {
		$errors[] = 'Password is required';
	}
	if (empty($mobile)) {
		$errors[] = 'Mobile number is required';
	} elseif (!preg_match('/^(961(3|70|71|76|79|81)|(03|70|71|76|79|81))\d{6}$/', $mobile)) {
		$errors[] = 'Invalid mobile number format';
	}
	if (empty($region)) {
		$errors[] = 'Region is required';
	}



	// Check if the email                                                                                                                                                                             i want to complete the rest of code

	// and mobile number are already registered in the database
	$emailQuery = "SELECT * FROM customer_registration WHERE email = '$email' LIMIT 1";
	$mobileQuery = "SELECT * FROM customer_registration WHERE mobile = '$mobile' LIMIT 1";
	$emailResult = mysqli_query($con, $emailQuery);
	$mobileResult = mysqli_query($con, $mobileQuery);
	$customer = mysqli_fetch_assoc($emailResult);
	$errors = array();
	if ($customer) {
		if ($customer['email'] === $email) {
			$errors[] = 'Email already exists';
		}
		if ($customer['mobile'] === $mobile) {
			$errors[] = 'Mobile number already exists';
		}
	}

	// If there are no errors, insert the data into the database
	if (count($errors) === 0) {
		// Upload the certificate file



		// Insert the data into the database
		$query = "INSERT INTO customer_registration (name, email, password, mobile,region) VALUES ('$name', '$email', '$password', '$mobile','$region')";
		mysqli_query($con, $query);

		// Redirect to the approval page
		$_SESSION['success_msg'] = 'Your registration request has been submitted ';
		header('Location: login.php');
		exit;
	}
}
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
	<title>Customer Signup</title>
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
			background-color: #A0F3F8
		}

		.form-group {
			margin-bottom: 2%;
		}
	</style>
</head>


<body class="brwsmdcn">
	<div class="header-area" style="background: #3abac9;">
		<div class="header-top">
			<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container">
				<div class="logo col-md-3">
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7">
					<ul class="list-unstyled list-inline pull-right">
						<!--						<li><a href="cussignup.php" style="color:white;">Customer SignUp</a></li>-->
						<li><a href="pharsignup.php" style="color:white;font-size:20px">Pharmacist SignUp</a></li>
						<li><a href="login.php" style="color:white;font-size:20px">Login</a></li>

					</ul>
				</div>

			</div>
		</div>


	</div>
	<center>
		<h1 style="color:#1bbbc5">Customer Registration</h1>
	</center>
	<?php if (!empty($errors)) : ?>
		<ul>
			<?php foreach ($errors as $error) : ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<div class="main-area">





		<div class="">
			<form class="col-md-4 col-sm-offset-4 text-center" style="margin: 2%;background-color: #e3e8ef;border: 1px #e3e8ef;border-radius: 5%; opacity:0.9;filter: alpha(opacity=60);text-align: center;margin-left: 35%;padding-top: 2%;padding-bottom: 2%;box-shadow: 5px 10px #989ba0;" method="POST" enctype="multipart/form-data">
				<div class="form-group ">
					<label for="user" style="font-weight: bold;color: #000000;">Username:</label>
					<input type="text" class="form-control" id="user" name="uname" style="width:50%;margin-left: 24%" required>
				</div>
				<div class="form-group ">
					<label for="email" style="font-weight: bold;color: #000000;">Email:</label>
					<input type="email" class="form-control" id="email" name="uemail" style="width:50%;margin-left: 24%" required>
				</div>
				<div class="form-group">
					<label for="pwd" style="font-weight: bold;color: #000000;">Password:</label>
					<input type="password" class="form-control" id="pwd" name="upass" style="width:50%;margin-left: 24%" required>
				</div>
				<div class="form-group">
					<label for="mbl" style="font-weight: bold;color: #000000;">Mobile:</label>
					<input type="text" class="form-control" id="mbl" pattern="^(961(3|70|71|81|76)|(03|70|71))\d{6}$" name="umobile" style="width:50%;margin-left: 24%" required>
				</div>
				<div class="form-group">
					<label for="region" style="font-weight: bold;color: #000000;">Region:</label>
					<select name="region" id="region" class="form-control" style="width:50%;margin-left: 24%" required>
						<option value="">Select Region</option>
						<option value="Beirut">Beirut</option>
						<option value="Mount Lebanon">Mount Lebanon</option>
						<option value="North Lebanon">Baalback</option>
						<option value="South Lebanon">Hermel</option>
						<option value="Bekaa">Bekaa</option>
						<option value="Nabatieh">Nabatieh</option>
					</select>
				</div>

				<button href="login.php" type="submit" class="btn btn-default">Sign Up!</button>
				<br>
				<br>
				<a href="index.php" style="color:#1bbbc5">Go back </a>
			</form>
		</div>
	</div>



</body>

</html>