<?php
require("connection.php");

if (isset($_POST['submit'])) {
	$name = mysqli_real_escape_string($con, $_POST['uname']);
	$pass = mysqli_real_escape_string($con, $_POST['upass']);
	$email = mysqli_real_escape_string($con, $_POST['uemail']);
	$mobile = mysqli_real_escape_string($con, $_POST['umobile']);
	$region = mysqli_real_escape_string($con, $_POST['region']);


	// $error = array();
	if (empty($name)) {
		echo 'pharmacy name is required';
	}
	if (empty($pass)) {
		echo  'pharmacy password is required';
	}
	if (empty($email)) {
		echo  'pharmacy email is required';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "email format dosen't matches";
	}
	if (empty($mobile)) {
		echo  'mobile is required';
	}

	$emailquery = "SELECT * FROM customer_registration where email='$email' limit 1  ";
	$mobilequery = "SELECT * FROM customer_registration where mobile='$mobile' limit 1 ";
	$emailresult = mysqli_query($con, $emailquery);
	$mobileresult = mysqli_query($con, $mobilequery);

	$customer = mysqli_fetch_assoc($emailresult);
	$errors = array();
	if ($customer) {
		if ($customer['email'] === $email) {
			$errors[] = 'Email already exists';
		}
		if ($customer['mobile'] === $mobile) {
			$errors[] = 'Mobile number already exists';
		}
	}



	$query = "INSERT INTO customer_registration (name,password,email,mobile,region) VALUE('$name','$pass','$email','$mobile','$region') ";
	mysqli_query($con, $query);
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

				<button href="login.php" type="submit" name="submit" class="btn btn-default">Sign Up!</button>
				<br>
				<br>
				<a href="index.php" style="color:#1bbbc5">Go back </a>
			</form>
		</div>
	</div>



</body>

</html>