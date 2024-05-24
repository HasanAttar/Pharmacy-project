<?php
session_start();

// Include the database connection file
include_once('connection.php');

if (isset($_POST['approve'])) {
  $pharmacyId = $_POST['pharmacy_id'];

  // Update the approval status in the database
  $con = mysqli_connect('localhost', 'root', '', 'pharmacy-system');
  $sql = "UPDATE pharmacies SET is_approved = 1 WHERE id = '$pharmacyId'";
  mysqli_query($con, $sql);
  mysqli_close($con);

  // Redirect the admin back to the pending applications page
  header('Location:pending.php');
  exit();
}
?>
