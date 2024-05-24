<?php
session_start();

// Include the database connection file
include_once('connection.php');

// Check if the form has been submitted
if (isset($_POST['submt'])) {
  // Get the form data
  $name = mysqli_real_escape_string($con, $_POST['pharmacy_name']);
  $email = mysqli_real_escape_string($con, $_POST['phemail']);
  $password = mysqli_real_escape_string($con, $_POST['phpass']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $region = mysqli_real_escape_string($con, $_POST['region']);
  $certificateName = $_FILES['certificate']['name'];
  $certificateTmpName = $_FILES['certificate']['tmp_name'];

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
  if (empty($certificateName)) {
    $errors[] = 'Certificate file is required';
  } else {
    $allowedTypes = array('application/pdf', 'image/jpeg', 'image/png');
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    if (!in_array($_FILES['certificate']['type'], $allowedTypes)) {
      $errors[] = 'Invalid certificate file type. Allowed types are PDF, JPEG, and PNG';
    }
    if ($_FILES['certificate']['size'] > $maxFileSize) {
      $errors[] = 'Certificate file size exceeds the maximum allowed size (5MB)';
    }
  }


  $emailQuery = "SELECT * FROM pharmacies WHERE email = '$email' LIMIT 1";
  $mobileQuery = "SELECT * FROM pharmacies WHERE mobile = '$mobile' LIMIT 1";
  $emailResult = mysqli_query($con, $emailQuery);
  $mobileResult = mysqli_query($con, $mobileQuery);
  $pharmacy = mysqli_fetch_assoc($emailResult);

  if ($pharmacy) {
    if ($pharmacy['email'] === $email) {
      $errors[] = 'Email already exists';
    }
    if ($pharmacy['mobile'] === $mobile) {
      $errors[] = 'Mobile number already exists';
    }
  }

  if (count($errors) === 0) {

    // Upload the certificate file
    $certificatePath = 'certificates/' . $certificateName;
    move_uploaded_file($certificateTmpName, $certificatePath);

    // Insert the data into the database
    $query = "INSERT INTO pharmacies (pharmacy_name, email, password, mobile, region, certificate_path, is_approved) VALUES ('$name', '$email', '$password', '$mobile', '$region', '$certificatePath', 0)";
    mysqli_query($con, $query);

    // Redirect to the approval page
    $_SESSION['success_msg'] = 'Your registration request has been submitted for approval';
    header('Location: login.php');

    exit;
  }
}
?>

<!-- Display the form -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="..........................................................................." />
  <meta name="description" content="........................................................................" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico..........................................." />
  <link rel="apple-touch-icon" type="image/x-icon" href="apple-touch-icon.png..............................." />
  <title>Pharmacist Signup</title>
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/normalize.css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all" />
  <link rel="stylesheet" type="text/css" href="style.css" media="all" />
  <link rel="shortcut icon" href="img/Graphicloads-Medical-Health-Medicine-box-2.ico">
  <script type="text/javascript" src="js/modernizr.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <title>Pharmacy Registration</title>
  <style>
    ul li a:hover {
      background-color: #A0F3F8
    }

    .form-group {
      margin-bottom: -8%;
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
            <li><a href="cussignup.php" style="color:white;;font-size:20px">Customer SignUp</a></li>
            <!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
            <li><a href="login.php" style="color:white;font-size:20px">Login</a></li>

          </ul>
        </div>

      </div>
    </div>


  </div>
  <center>
    <h1 style="color:#1bbbc5">Pharmacist Registration</h1>
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
        <div class="form-group">
          <input type="hidden" class="form-control" name="id" id="id" style="width:50%;margin-left: 24%" required><br><br>
        </div>

        <div class="form-group">
          <label for="phuname">Pharmacy Name:</label>
          <input type="text" class="form-control" name="pharmacy_name" id="phuname" style="width:50%;margin-left: 24%" required><br><br>
        </div>
        <div class="form-group">
          <label for="phemail" style="font-weight: bold;color: #000000;">Email:</label>
          <input type="email" class="form-control" name="phemail" id="phemail" style="width:50%;margin-left: 24%" required><br><br>
        </div>
        <div class="form-group">
          <label for="phpass" style="font-weight: bold;color: #000000;">Password:</label>
          <input type="password" class="form-control" name="phpass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$" id="phpass" style="width:50%;margin-left: 24%" required><br><br>
        </div>
        <div class="form-group">
          <label for="phmobile" style="font-weight: bold;color: #000000;">Mobile Number:</label>
          <input type="text" name="mobile" id="mobile" class="form-control" style="width:50%;margin-left: 24%" required><br><br>
        </div>

        <div class="form-group">
          <label for="region" style="font-weight: bold;color: #000000;">Region:</label>
          <select name="region" id="region" class="form-control" style="width:50%;margin-left: 24%" required>
            <option value="">Select Region</option>
            <option value="Beirut">Beirut</option>
            <option value="Mount Lebanon">Mount Lebanon</option>
            <option value="Tripoli">Tripoli</option>
            <option value="Hermel">Hermel</option>
            <option value="Bekaa">Baalback</option>
            <option value="Nabatieh">Nabatieh</option>
            <option value="Nabatieh">Bekaa</option>
          </select>
        </div>
        <br><br>
        <div class="form-group">
          <label for="certificate" style="font-weight: bold;color: #000000;">Certificate:</label>
          <input type="file" name="certificate" id="certificate" class="form-control" accept=".pdf" style="width:50%;margin-left: 24%" required><br><br>
        </div>


        <div class="form-group">
          <input type="submit" name="submit" value="Sign Up!">
        </div>
        <br><br>

        <a href="index.php" style="color:#1bbbc5">Go back </a>
      </form>
    </div>
  </div>
</body>

</html>