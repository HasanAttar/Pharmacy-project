<?php
session_start();

// Include the database connection file
include_once('connection.php');

// Check if the delete button was clicked
if (isset($_POST['delete'])) {
    // Get the pharmacy ID from the form
    $pharmacy_id = $_POST['pharmacy_id'];

    // Delete the pharmacy record from the database
    $sql = "DELETE FROM pharmacies WHERE id = $pharmacy_id";
    mysqli_query($con, $sql);

    // Redirect to the same page to refresh the table
    header('Location: pending.php');
    exit();
}

mysqli_close($con);
?>
