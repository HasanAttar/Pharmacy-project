<?php
session_start();
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
	<title>Home</title>
    <link rel="shortcut icon" href="img/Graphicloads-Medical-Health-Medicine-box-2.ico">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />
	
	<script type="text/javascript" src="js/modernizr.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<style type="text/css">
 ul li a:hover{
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
  padding: 5px;
}


.container {
  max-width: 1300px;
  margin: 0 auto;
}

.cus-bottom {
  padding-top: 70px;
}
.img-row1 {
  display: flex;
  justify-content: space-between;
}

  
    </style>

</head>


<body class="cushome1" >
<div class="header-area" > 
		<div class="header-top"> 
<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container"> 
				<div class="logo col-md-3" > 
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7"> 
					<ul class="list-unstyled list-inline pull-right">
						<li><a href="cushome.php" style="color:white;font-size:20px;text-decoration-line:underline"><i>Customer Home</i></a></li>
<!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
						<li><a href="logout.php" style="color:white;font-weight:bold;font-size:20px;text-decoration-line:underline"><i>Logout</i></a></li>
						
					</ul>
				</div>
				
			</div>
		</div>
		
		
	</div>

	
		
		
		
		<div class="homecust1" >
		<div class="cushome" > 
		<div class="chome"> 
			<div class="cus-top text-center"> 
				
			</div>
			<div class="cus-bottom" style="margin-top: 5%"> 
				<div class="container" style="padding-bottom:150px;"> 
					<div class="img-row1">
					<div class="img col-md-3" style="margin: 2%;background-color: #e3e8ef;border: 1px #e3e8ef;border-radius: 5%; opacity:0.9;filter: alpha(opacity=60);text-align: center;margin-left: 0%;padding-top: 2%;padding-bottom: 2%;box-shadow: 5px 10px #989ba0;margin-top: 4%">
  						<a href="viewcritical.php">
    					<img src="img/65.png" alt="" style="max-height: 115px;max-width: 300px;margin-left: 5%">
 						 </a>
						  <br>
					<br>
                    <label style="margin-left: 2%">Critical Medicines</label>
					</div>
					<div class="img col-md-3" style="margin: 2%;background-color: #e3e8ef;border: 1px #e3e8ef;border-radius: 5%; opacity:0.9;filter: alpha(opacity=60);text-align: center;margin-left: 0%;padding-top: 2%;padding-bottom: 2%;box-shadow: 5px 10px #989ba0;margin-top: 4%">
  						<a href="viewused.php">
						  <img src="images/40.jpg" alt="" style="max-height: 115px;max-width: 300px;margin-left: 10%">
 						 </a>
						  <br>
					<br>
                    <label style="margin-left: 2%">Used Medicines</label>
					</div>
					<div class="img col-md-3" style="margin: 2%;background-color: #e3e8ef;border: 1px #e3e8ef;border-radius: 5%; opacity:0.9;filter: alpha(opacity=60);text-align: center;margin-left: 0%;padding-top: 2%;padding-bottom: 2%;box-shadow: 5px 10px #989ba0;margin-top: 4%">
  						<a href="view_cart.php">
    					<img src="img/90.jpg" alt="" style="max-height: 125px;max-width: 315px;margin-left: 5%">
 						 </a>
						  <br>
					<br>
                    <label style="margin-left: 2%">Your Critical Order</label>
					</div>
					<div class="img col-md-3" style="margin: 2%;background-color: #e3e8ef;border: 1px #e3e8ef;border-radius: 5%; opacity:0.9;filter: alpha(opacity=60);text-align: center;margin-left: 0%;padding-top: 2%;padding-bottom: 2%;box-shadow: 5px 10px #989ba0;margin-top: 4%">
  						<a href="view_usedcart.php">
    					<img src="img/97.jpg" alt="" style="max-height: 120px;max-width: 400px;margin-left: 5%">
 						 </a>
						  <br>
					<br>
                    <label style="margin-left: 2%">Your Used Order</label>
					</div>

					
				
					</div>
					
				</div>
			</div>
		</div>
			
			
            
            
</div>
            
            
            
            
            
            
		
<!--
		<div class="signup col-sm-offset-8 col-md-8"> 
			<p>Not a registered user. Please Sign Up...</p>
			<button type="submit" class="btn btn-success">  </button>
			<button type="submit" class="btn btn-success"></button>
			<a href="cussignup.html">As Customer</a>
			
		</div>
-->
		
		
		
		
	</div>
 
		
		
		
		
		
	
	
	
</body>
</html>
