<?php
session_start();

// Include the database connection file
include_once('connection.php');

// Check if the user is logged in as an admin


// Get the pharmacist ID from the form
$pharmacist_id = $_POST['pharmacist_id'];

// Delete the pharmacist from the database
$sql = "DELETE FROM pharmacies WHERE id = '$pharmacist_id'";
if (mysqli_query($con, $sql)) {
  $_SESSION['success'] = 'Pharmacist deleted successfully.';
} else {
  $_SESSION['errors'][] = 'An error occurred. Please try again later.';
}

// Redirect back to the admin page
header('Location: pending.php');
exit();

?>