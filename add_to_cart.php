<?php
session_start();
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medicine_id = mysqli_real_escape_string($con, $_POST['medicine_id']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    
    $pharmacy_name = mysqli_real_escape_string($con, $_POST['pharmacy_name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $customer_name = mysqli_real_escape_string($con, $_SESSION["uname"]); // Retrieve the customer name from registration

    // Retrieve the available stock quantity for the selected medicine
    $query_stock = "SELECT Quantity FROM criticalmedicines WHERE id = '$medicine_id'";
$result_stock = mysqli_query($con, $query_stock);
$row_stock = mysqli_fetch_assoc($result_stock);
$available_stock = $row_stock['Quantity'];

// Calculate the total quantity of the medicine already ordered by the customer
$query_total_quantity = "SELECT SUM(quantity) AS total_quantity FROM orders WHERE medicine_id = '$medicine_id' AND customer_name = '$customer_name'";
$result_total_quantity = mysqli_query($con, $query_total_quantity);
$row_total_quantity = mysqli_fetch_assoc($result_total_quantity);
$total_quantity_ordered = $row_total_quantity['total_quantity'];

// Calculate the remaining available quantity for the customer to order
$remaining_quantity = $available_stock - $total_quantity_ordered;

if ($quantity <= $remaining_quantity) {
    // Check if the medicine_id already exists in the orders table
    $query_check_order = "SELECT * FROM orders WHERE medicine_id = '$medicine_id' AND customer_name = '$customer_name'";
    $result_check_order = mysqli_query($con, $query_check_order);

    if (mysqli_num_rows($result_check_order) > 0) {
        // If an order already exists, update the quantity of the medicine for that order
        $row = mysqli_fetch_assoc($result_check_order);
        $order_id = $row['id'];
        $new_quantity = $row['quantity'] + $quantity;
        $query_update_order = "UPDATE orders SET quantity = '$new_quantity' WHERE id = '$order_id'";
        $result_update_order = mysqli_query($con, $query_update_order);

        if ($result_update_order) {
            echo "Order updated successfully!";
        } else {
            echo "Failed to update order.";
        }
    } else {
        // Insert the order into the database
        $query_insert_order = "INSERT INTO orders (medicine_id, customer_name, quantity, price, pharmacy_name) VALUES ('$medicine_id', '$customer_name', '$quantity', '$price', '$pharmacy_name')";
        $result_insert_order = mysqli_query($con, $query_insert_order);

        if ($result_insert_order) {
            echo "Order placed successfully!";
        } else {
            echo "Failed to place order.";
        }
    }
    header("location:view_cart.php");
} else {
    echo "Quantity exceeds available stock!";
}
}
?>
