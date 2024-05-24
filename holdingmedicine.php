<?php
session_start();
require_once('connection.php');

$pharmacy_name = $_SESSION["pharmacy_name"];
$id = $_SESSION["pharmacy_id"];

// Get a list of all orders for the pharmacy
$query_orders = "SELECT orders.id, orders.medicine_id, criticalmedicines.Name AS medicine_name, orders.quantity, orders.date_added ,orders.pharmacy_name,orders.price,orders.customer_name, orders.is_held, criticalmedicines.quantity AS medicine_quantity FROM orders JOIN criticalmedicines ON orders.medicine_id = criticalmedicines.id 
WHERE orders.pharmacy_name = '$pharmacy_name' 
AND orders.quantity > 0 ";

$result_orders = mysqli_query($con, $query_orders);
$orders = array();
$grouped_orders = array();

while ($row_orders = mysqli_fetch_assoc($result_orders)) {
    $customer_name = $row_orders['customer_name'];
    if (!isset($grouped_orders[$customer_name])) {
        $grouped_orders[$customer_name] = array();
    }
    $grouped_orders[$customer_name][] = $row_orders;
}

// Decrement the quantity in the critical medicine table for each order
if (isset($_POST['hold'])) {
    $order_id = $_POST['order_id'];
    $medicine_id = $_POST['medicine_id'];
    $quantity_ordered = $_POST['quantity_ordered'];

    // Get the quantity of the medicine in stock
    $query_stock = "SELECT quantity FROM criticalmedicines WHERE id = $medicine_id";
    $result_stock = mysqli_query($con, $query_stock);
    $row_stock = mysqli_fetch_assoc($result_stock);
    $medicine_quantity = $row_stock['quantity'];

    // Check if the quantity ordered is above the quantity in stock
    if ($quantity_ordered > $medicine_quantity) {
        // Quantity ordered is above the quantity in stock, display an error message or take appropriate action
        $error_message = "Insufficient stock";
    } else {
        // Check if the order is already held
        $query_check_hold = "SELECT is_held FROM orders WHERE id = $order_id";
        $result_check_hold = mysqli_query($con, $query_check_hold);
        $row_check_hold = mysqli_fetch_assoc($result_check_hold);
        $is_held = $row_check_hold['is_held'];

        if ($is_held == 0) {
            $query_critical = "UPDATE criticalmedicines SET quantity = quantity - $quantity_ordered WHERE pharmacy_name = '$pharmacy_name' AND id = $medicine_id";
            mysqli_query($con, $query_critical);
            $query_update_order = "UPDATE orders SET is_held = 1 WHERE id = $order_id";
            mysqli_query($con, $query_update_order);
        } 
    }
}
// $dashboard_data = array();
// foreach ($grouped_orders as $customer_name => $customer_orders) {
//     $total_quantity = 0;
//     $total_price = 0;

//     foreach ($customer_orders as $order) {
//         if ($order['is_held']) {
//             $total_quantity += $order['quantity'];
//             $total_price += $order['price'];
//         }
//     }

//     $dashboard_data[$customer_name] = array(
//         'total_quantity' => $total_quantity,
//         'total_price' => $total_price
//     );
// }


?>
<!DOCTYPE html>
<html>
<head>
    <title>Pharmacist Order List</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Your existing styles and scripts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
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
        canvas{
            background-color:lightgrey;
        }
        .card-body{
  background: url(images/104.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;}
  /* background: none;
  background-color: transparent; */
 table{
        margin: 0 auto; /* Center the table horizontally */
        max-width: 800px; /* Set a max width for better readability, adjust as needed */
        overflow-x: hidden; /* Hide horizontal scrollbar */
    
}
.header-area {
   background-color: #3abac9; 
 
}
.header-top {
  padding: 20px;
}
ul li a:hover{
		background-color:#82EFF6

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
.navbar {
    padding: 20px;
}

.navbar-toggler {
    border: none;
}

.navbar-toggler-icon {
    background-color: #1bbbc5;
}

@media (max-width: 767px) {
    .navbar {
        padding: 10px;
    }
}



    </style>
</head>
<body>
<div class="header-area">
<div class="header-top"> 
<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container"> 
				<div class="logo col-md-3" > 
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7"> 
					<ul class="list-unstyled list-inline pull-right">
						<li><a href="pharprofile.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Pharmacist Home</a></li>
<!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
						<li><a href="logout.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Logout</a></li>
                        <li><a href="fetchcritical.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">critical Medicines</a></li>	
					</ul>
				</div>
				
			</div>
            </div>
</div>

                    <div class="card-body">
                        <div class="card-body table-responsive">
                            <table class="table table-striped mt-4" style="background-color:white" >
                                <thead>
                                    <tr style="font-size:20px;color:#1bbbc5">
                                    
                                        <th scope="col">Medicines Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Price</th>
                                        
                                        
                                        <th scope="col">Hold</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($grouped_orders as $customer_name => $customer_orders): ?>
    <tr>
        <th scope="row" colspan="7" style="background-color:#1bbbc5;font-size:18px"><?php echo "Customer Name: " . $customer_name; ?></th>
    </tr>
    <?php foreach ($customer_orders as $order): ?>
        <tr style="font-size:18px" >
           
            <td><?php echo $order['medicine_name']; ?></td>
            <td><?php echo $order['quantity']; ?></td>
            <td><?php echo date('F d, Y ', strtotime($order['date_added'])); ?></td>
            <td><?php echo $order['price']; ?>$</td>
            
            
            <td>
            <?php if ($order['is_held']): ?>
        <button type="button" class="btn btn-secondary" disabled>Hold</button>
        <span class="text-danger">Order already held</span>
    <?php elseif (isset($error_message) && $order_id == $order['id']): ?>
        <span class="text-danger"><?php echo $error_message; ?></span>
    <?php else: ?>
                    <form method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <input type="hidden" name="medicine_id" value="<?php echo $order['medicine_id']; ?>">
                        <input type="hidden" name="quantity_ordered" value="<?php echo $order['quantity']; ?>">
                        <button type="submit" style="background-color:#1bbbc5" name="hold" class="btn btn-primary">Hold</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="chart-area">
    <canvas id="chartHeldMedicines"></canvas>
</div>
<?php 

$line_chart_data = array();
$line_chart_labels = array();

foreach ($grouped_orders as $customer_name => $customer_orders) {
    $total_held_quantity = 0;

    foreach ($customer_orders as $order) {
        if ($order['is_held']) {
            $total_held_quantity += $order['quantity'];
        }
    }

    $line_chart_data[] = $total_held_quantity ;
    $line_chart_labels[] = $customer_name;
}?>


<?php
echo "<script>";
echo "var ctx = document.getElementById('chartHeldMedicines').getContext('2d');";

echo "var chart = new Chart(ctx, {";
echo "    type: 'line',";
echo "    data: {";
echo "        labels: " . json_encode($line_chart_labels)  . ",";
echo "        datasets: [{";
echo "            label: 'Total Held Medicines Quantity for $pharmacy_name',";
echo "            data: " . json_encode($line_chart_data) . ",";
echo "            fill: false,";
echo "           borderColor: 'rgba(255, 99, 132, 1)',"; // You can change this color
echo "            borderWidth: 2"; // You can adjust the line width
echo "        }]";
echo "    },";
echo "    options: {";
    echo "        scales: {";
    echo "            x: {";
    echo "                grid: {";
    echo "                    color: 'rgba(255, 255, 255, 0.2)'"; // Adjust the grid color for X-axis
    echo "                },";
    echo "                ticks: {";
    echo "                    color: 'black'"; // Adjust the label color for X-axis
    echo "                }";
    echo "            },";
    echo "            y: {";
    echo "                grid: {";
    echo "                    color: 'rgba(255, 255, 255, 0.2)'"; // Adjust the grid color for Y-axis
    echo "                },";
    echo "                ticks: {";
    echo "                    color: 'black'"; // Adjust the label color for Y-axis
    echo "                }";
    echo "            }";
    echo "        }";
    echo "    }";
    echo "});";
    echo "</script>";

?>
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>