<?php
require_once('connection.php');
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
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/normalize.css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all" />
  <link rel="stylesheet" type="text/css" href="style.css" media="all" />
  <link rel="shortcut icon" href="img/Graphicloads-Medical-Health-Medicine-box-2.ico">
  <script type="text/javascript" src="js/modernizr.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <style type="text/css">
    body {
      background: url(images/104.jpg) no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    ul li a:hover {
      background-color: #82EFF6
    }
  </style>
</head>


<body class="">

  <div class="menu col-md-7">
    <ul class="list-unstyled list-inline pull-right">


    </ul>
  </div>

  </div>
  </div>

  </div>
  <div class="">

    <form class="col-md-4 col-sm-offset-4 justify-content text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="margin: 10%;background-color: rgba(80, 173, 150, 0.3);border: 1px #e3e8ef;border-radius: 5%; opacity:0.8;filter: alpha(opacity=60);text-align: center;margin-left: 35%;padding-top: 2%;padding-bottom: 2%;box-shadow: 5px 10px #989ba0;">
      <div class="form-group center">
        <label for="uname" style="font-weight: bold;color: #000000;">Username:</label>
        <input type="text" class="form-control" id="email" name="uname" style="width:50%;margin-left: 24%;" required>
      </div>
      <div class="form-group">
        <label for="pwd" style="font-weight: bold;color: #000000;">Password:</label>
        <input type="password" class="form-control" id="pwd" name="upass" style="width:50%;margin-left: 24%" required>
      </div>
      <div class="form-group">

        <input type="hidden" class="form-control" id="pwd" name="region" style="width:50%;margin-left: 24%" required>
      </div>

      <button type="submit" class="btn btn-default" style="font-weight: bold;color: #000000;">Login</button>
      <br>
      <br>
      <label style="font-weight: bold;color: #000000;">Don't have an account? Sign Up!</label>
      <br>
      <a href="cussignup.php" style="font-weight: bold;color: #1BBBC5;font-size:15px">As Customer</a>
      <br>
      <a href="pharsignup.php" style="font-weight: bold;color: #1BBBC5;font-size:15px">As Pharmacist</a>
      <br>
      <a href="index.php" style="font-weight: bold;color: black;font-size:15px">Go Back</a>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // Get the username and password from the form submission
      $username = mysqli_real_escape_string($con, $_POST['uname']);
      $password = mysqli_real_escape_string($con, $_POST['upass']);

      // Check if the user is a customer
      $result = mysqli_query($con, "SELECT * FROM customer_registration WHERE name='$username' AND password='$password'");
      $row = mysqli_fetch_array($result);

      if ($row && $row["name"] == $username && $row["password"] == $password) {
        // Login successful - redirect to customer home page
        $_SESSION["uname"] = $username;
        $_SESSION["upass"] = $password;
        header("Location: cushome.php");
        exit();
      } else {
        // Check if the user is an admin
        $stmt = mysqli_prepare($con, "SELECT * FROM admin WHERE `A-username`=? AND `A-password`=?");
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
          // Login successful - redirect to admin home page
          $_SESSION["uname"] = $username;
          $_SESSION["upass"] = $password;
          header("Location: adminhome.php");
          exit();
        } else {
          // Check if the user is a pharmacist
          $sql = "SELECT * FROM pharmacies WHERE pharmacy_name='$username' AND password='$password'";
          $result = mysqli_query($con, $sql);

          if (mysqli_num_rows($result) == 1) {
            $pharmacy = mysqli_fetch_assoc($result);
            if ($pharmacy['is_approved'] == 1) {
              // Login successful - redirect to pharmacist profile page
              $_SESSION['pharmacy_id'] = $pharmacy['id'];
              $_SESSION['pharmacy_name'] = $pharmacy['pharmacy_name'];
              $_SESSION['region'] = $pharmacy['region'];
              $_SESSION['mobile'] = $pharmacy['mobile'];

              header('Location: pharprofile.php');
              exit();
            } else {
              // Account not yet approved
              echo '<script>alert("Waiting for Admin Approval.")</script>';
            }
          } else {
            // Login failed - show error message
            echo '<p style="color:red; font-weight:bold; text-align:center;">Invalid username or password!</p>';
          }
        }
      }
    }
    ?>

    <br>

    <div class="bottomimg">
      <img src="img/105569.png" height="200" width="200">
    </div>
  </div>
</body>

</html>