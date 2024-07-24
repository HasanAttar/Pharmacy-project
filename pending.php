<?php
session_start();
include_once('connection.php');
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//Load Composer's autoloader


// Include the database connection file


// Get all pending pharmacy applications
$con = mysqli_connect('', '', '', '');
$sql = "SELECT * FROM pharmacies WHERE is_approved = 0";
$result = mysqli_query($con, $sql);

// Check if the approve button was clicked
if (isset($_POST['approve'])) {
    // Get the pharmacy ID from the form
    $pharmacy_id = $_POST['pharmacy_id'];
    $email = $_POST['email'];

    // Update the pharmacy record in the database
    $sql = "UPDATE pharmacies SET is_approved = 1 WHERE id = $pharmacy_id";
    mysqli_query($con, $sql);


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function




//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                     //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port='' ;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('', 'Admin');
    $mail->addAddress($email, '');     //Add a recipient
    

    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Registration Approved';
    $mail->Body    = 'Dear pharmacist,<br><br>Your registration has been approved. Thank you for choosing our pharmacy system.<br><br>Best regards,<br>Pharmacy System';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
   
    

    mysqli_close($con);

    header('Location: pending.php');
    exit;
}
$sql = "SELECT * FROM pharmacies WHERE is_approved = 1";
$resulti = mysqli_query($con, $sql);

if (isset($_POST['delete'])) {
  // Get the pharmacy ID from the form
  $pharmacy_id = $_POST['pharmacy_id'];

  // Delete the pharmacy record from the database
  $sql = "DELETE FROM pharmacies WHERE id = $pharmacy_id";
  mysqli_query($con, $sql);

  header('Location: pending.php');
  exit;
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/normalize.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all" />
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link rel="shortcut icon" href="img/Graphicloads-Medical-Health-Medicine-box-2.ico">
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

<style>
body{
background: url(images/104.jpg) no-repeat center center fixed; 
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
.header-area {
background-color: #3abac9;
}
ul li a:hover{
		background-color:#82EFF6

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
select {
    width: 300px;
    margin: 10px;
}
select:focus {
    min-width: 150px;
    width: auto;
}


option {
width: 250px;
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
						<li><a href="adminhome.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline"><i>Admin Home</i></a></li>
<!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
						<li><a href="logout.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline"><i>Logout</i></a></li>
						
					</ul>
				</div>
				
			</div>
</div>
		</div>
 <center> <h1 style="color:#1d5f7a">Pharmacist Approval </h1></center>
  <table>
    <thead>
      <tr style="background-color:#1BBBC5;font-weight:bold;font-size:20px; color:white;text-size:20px">
        <th>Pharmacy Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Region</th>
        <th>Certificate</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr style="font-size:20px">
          <td><?php echo $row['pharmacy_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['mobile']; ?></td>
          
          <td><?php echo $row['region'];?></td>
          <td>
          <?php echo '<a href="certificates/' . $row['certificate_path'] . '" download>' . $row['certificate_path'] . '</a>'; ?>
</td>

<td>
<form method="POST" action="">
<input type="hidden" name="pharmacy_id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="email" value="<?php echo $row['email']; ?>">
<button style="background-color:#1BBBC5;color:white" type="submit" name="approve">Approve</button>
</form>
<form method="POST" action="reject.php">
<input type="hidden" name="pharmacy_id" value="<?php echo $row['id']; ?>">
<button type="submit" style="background-color:#1BBBC5;color:white" name="reject">Reject</button>
</form>

</td>
</tr>


<?php endwhile; ?>
</tbody>


  </table>
  <center> <h1 style="color:#1d5f7a">Registered Pharmacists </h1></center>
  <table>
    <thead>
      <tr style="background-color:#1BBBC5;font-weight:bold;font-size:20px; color:white;text-size:20px">
        <th>Pharmacy Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Region</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($resulti)): ?>
        <tr style="font-size:20px">
          <td><?php echo $row['pharmacy_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['mobile']; ?></td>
          <td><?php echo $row['region'];?></td>
          <td>
            <form method="POST" action="">
              <input type="hidden" name="pharmacy_id" value="<?php echo $row['id']; ?>">
              
              <button style="background-color:#1BBBC5;color:white" type="submit" name="delete"><i class="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>  
</body>
</html>
