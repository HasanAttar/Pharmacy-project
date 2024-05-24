<?php
session_start();

// Include the database connection file
include_once('connection.php');

// Check if the user is logged in as an admin


// Get the pharmacist ID from the form
$pharmacist_id = $_POST['pharmacist_id'];

// Update the 'is_approved' field to true in the database
$sql = "UPDATE pharmacies SET is_approved = 1 WHERE id = '$pharmacist_id'";
if (mysqli_query($con, $sql)) {
  $_SESSION['success'] = 'Pharmacist approved successfully.';
} else {
  $_SESSION['errors'][] = 'An error occurred. Please try again later.';
}

// Redirect back to the admin page
header('Location: checkpharmacist.php');
exit();

?>