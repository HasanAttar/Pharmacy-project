<?php
require_once('connection.php');
$id=$_GET['id'];
$Name="";
$expired="";
$Quantity="";
$price="";
$discount="";
$query="select * from criticalmedicines where id=$id";
$result= mysqli_query($con,$query);
while($row=mysqli_fetch_array($result)){
    $Name=$row['Name'];
    $expired=$row['Expirationdate'];
    $Quantity=$row['Quantity'];
    $discount=$row['Discount'];
    $price=$row['Price'];
}
if(isset($_POST['Update']))
{
    
    $name = $_POST['Name'];
    $expirationdate = $_POST['Expirationdate'];
    $quantity = $_POST['Quantity'];
    $price = $_POST['Price'];
    $discount = $_POST['Discount'];
    $total_price = $price - ($price * $discount);

    mysqli_query($con, "UPDATE criticalmedicines SET Name='$name', Expirationdate='$expirationdate', Quantity='$quantity', Price='$price', Discount='$discount',total_price='$total_price' WHERE id=$id");

    // Add a message to confirm the update operation
    echo "Data updated successfully";
    header('location:fetchcritical.php');
}

mysqli_close($con);

?>

<!DOCTYPE html>
<head>

        <link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.min.css">
        <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="..........................................................................." />
	<meta name="description" content="........................................................................" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico..........................................." />
	<link rel="apple-touch-icon" type="image/x-icon" href="apple-touch-icon.png..............................." />
	<title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />
	<link rel="shortcut icon" href="img/Graphicloads-Medical-Health-Medicine-box-2.ico">
	<script type="text/javascript" src="js/modernizr.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

<style>
  	ul li a:hover{
		background-color:#82EFF6;

	}
.bg-darg {
  background: url(images/104.jpg) no-repeat center center fixed; 
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
    <body class="bg-darg"  >
    <div class="header-area"  > 
		<div class="header-top"> 
<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container"> 
				<div class="logo col-md-3" > 
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7"> 
					<ul class="list-unstyled list-inline pull-right">
						<li><a href="fetchcritical.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Critical List</a></li>
<!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
						<li><a href="logout.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Logout</a></li>
						
					</ul>
				</div>
				
			</div>
</div>
</div>
   
    <div class="container">
        <div class="col-lg-4">
  <h2>Edit Critical Medicines</h2>
  <form action="" name="form1" method="POST">
 
    <div class="form-group">
      <label for="email">Name</label>
      <input type="text" class="form-control" id="Name" placeholder="Enter medicine name" name="Name" value="<?php echo $Name; ?>">
    </div>
    <div class="form-group">
      <label for="pwd">Expiration date</label>
      <input type="text" class="form-control" id="pwd"  name="Expirationdate" value="<?php echo $expired; ?>">
    </div>
    <div class="form-group">
      <label for="pwd">Quantity</label>
      <input type="int" class="form-control" id="Quantity"  name="Quantity" value="<?php echo $Quantity; ?>">
    </div>
    <div class="form-group">
      <label for="pwd">Price</label>
      <input type="text" class="form-control" id="pwd"  name="Price" value="<?php echo $price; ?>">
    </div>
    <div class="form-group">
      <label for="pwd">Discount</label>
      <input type="int" class="form-control" id="pwd"  name="Discount" value="<?php echo $discount; ?>">
    </div>
    <button type="submit" name="Update" class="btn btn-default">Update</button>
  </form>
</div>
</div>
</body>


</html>
        
    