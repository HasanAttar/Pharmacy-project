<?php
session_start();
require_once('connection.php');
$pharmacy_name = $_SESSION['pharmacy_name'];
   

$fetchQuery = "SELECT * FROM usedmedicines where pharmacy_name='$pharmacy_name' ";
$result = mysqli_query($con, $fetchQuery);



?>

<!DOCTYPE html>
<html>
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
		background-color:#82EFF6

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
						<li><a href="pharprofile.php" style="color:white;font-weight:bold;font-size:20px;text-decoration-line:underline">Pharmacist Home</a></li>
<!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
						<li><a href="logout.php" style="color:white;font-weight:bold;font-size:20px;text-decoration-line:underline">Logout</a></li>
						
					</ul>
				</div>
				
			</div>
</div>
		</div>
        <div class="container" >
            <div class="row mt-5">
                <div class="col">
                <div class="card mt-5">
                <div class="card-header">
                    <h2 class="display-6 text-center"style="color:#1BBBC5">List Of Used Medicines </h2>
                </div>
                <div class="card-body">
                <div class="card-body table-responsive">
                    <table class="table table-bordered text-center">
                        <tr class="" style="background-color:#1BBBC5;color:white">
                            
                             
                            
                            
                            <td>Medicines  Name</td>
                            <td>Expiration Date</td>
                            <td>Quantity</td>
                      
                            <td>Price/unit</td>
                            <td>Discount</td>
                            <td>Total Price/unit</td>
                       
                            
                           <!-- <td><a href="insertused.php">Insert</td>-->
                        </tr>

                        <tr style="font-size:15px">
                        <?php 
                                if($result){
                                  while($row = mysqli_fetch_assoc($result)){
                                      
                                  ?>
                               
                            
                            <td><?php echo $row['Name'];?> </td>
                            <td><?php echo $row['Expirationdate'];?> </td>
                            <td><?php echo $row['Quantity'];?> </td>
                            
                            <td ><?php echo $row['Price'];?>$ </td>
                            <td ><?php echo ($row['Discount']* 100) . '%';?> </td>
                            <td ><?php echo $row['total_price'];?> $</td>
                           
                            <td ><a style="color:white;" href="editused.php?id=<?php echo $row['id'];?>" ><button class="btn btn-success" style="background-color:#1BBBC5">Edit</a></td>
                            <td ><a style="color:white;" href="deleteused.php?id=<?php echo $row['id'];?>"><button class="btn btn-danger"style="background-color:#1BBBC5" >Delete</a></td>
                        </tr>
                    <?php
                                }}

                        ?>


                    </table>
                </div>
                <div class="text-center mt-3">
        <a href="insertused.php" class="btn btn-primary" style="background-color:#1BBBC5">Insert</a>
    </div>
                </div>
            </div>
        </div>
        </div>
                            </div>
        
    </body >

</html>