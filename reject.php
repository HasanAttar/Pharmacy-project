<?php
session_start();

// Include the database connection file
include_once('connection.php');

if (isset($_POST['reject'])) {
  $pharmacyId = $_POST['pharmacy_id'];

  // Delete the pharmacy application from the database
  $con = mysqli_connect('localhost', 'root', '', 'pharmacy-system');
  $sql = "DELETE FROM pharmacies WHERE id = '$pharmacyId'";
  mysqli_query($con, $sql);
  mysqli_close($con);

  // Redirect the admin back to the pending applications page
  header('Location:pending.php');
  exit();
}
?>
