<?php
session_start();
// Connection to Database
require_once('connection.php');


// Check if the form has been submitted
if(isset($_POST['submit'])){
  
  // Collect Form Data
  $name = $_POST['name'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  

  // Insert Data into Table
  $sql = "INSERT INTO customer_registration (name, password, email, mobile) VALUES ('$name', '$password', '$email', '$mobile')";
  
  if(mysqli_query($con, $sql)){
    echo "Customer Added Successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
}

// Close Connection

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
          a:hover{
	background-color:#A0F3F8
  }
      body { 
  background: url(images/70.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  }
  .header-area {
  background-color: #3abac9;
}

.header-top {
  padding: 20px;
}

.container {
  max-width: 1300px;
  margin: 0 auto;
}

.cus-bottom {
  padding-top: 5px;
}

    </style>
</head>

<body>
<div class="header-area"  > 
		<div class="header-top"> 
<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container"> 
				<div class="logo col-md-3" > 
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7"> 
					<ul class="list-unstyled list-inline pull-right">
						<li><a href="adminhome.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Admin Home</a></li>
<!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
						<li><a href="logout.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Logout</a></li>
						
					</ul>
				</div>
 				
			</div>
</div>
		</div>


<!-- Customer Registration Form -->

<?php
// Connection to Database


// Check if the form has been submitted



// Check if the form has been submitted
if(isset($_POST['delete'])){
  
  // Collect Form Data
  $name = $_POST['customer'];

  // Delete Data from Table
  $sql = "DELETE FROM customer_registration WHERE name='$name'";
  
  if(mysqli_query($con, $sql)){
    echo "Customer Deleted Successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
}

// Get List of Customer Names
$sql = "SELECT name FROM customer_registration";
$result = mysqli_query($con, $sql);

// Close Connection
mysqli_close($con);
?>

<!-- Customer Delete Form -->
<form action="" method="POST" style="margin: 2%;background-color: #e3e8ef;margin-top:150px;border: 1px #e3e8ef;border-radius: 5%; opacity:0.9;filter: alpha(opacity=60);text-align: center;margin-left: 35%;padding-top: 2%;padding-bottom: 2%;box-shadow: 5px 10px #989ba0;"  class="col-md-4 col-sm-offset-4 text-center">
<div class="form-group" >
    <h2 style="color:#1bbbc5">Delete Customer</h2>
    <select name="customer" required>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <option style="margin-right:50%"value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
        <?php endwhile; ?>
    </select>
    <input style="color:white;background-color:#1bbbc5" type="submit" name="delete" value="Delete">
</div>
</form>

</body>
    </html>