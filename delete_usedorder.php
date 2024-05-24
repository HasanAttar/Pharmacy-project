<?php
session_start();
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $customer_name = $_SESSION["uname"];

    // Delete the order
    $delete_query = "DELETE FROM usedorders WHERE medicine_id = '$order_id' AND customer_name = '$customer_name'";
    mysqli_query($con, $delete_query);

    // Redirect back to the same page
    header("Location: view_usedcart.php");
    exit();
} else {
    // Invalid request, redirect back to the same page
    header("Location: view_usedcart.php");
    exit();
}
?>
