<?php
session_start();
require_once('connection.php');
$customer_name = $_SESSION["uname"]; // Retrieve the customer name from registration

// Get a list of all orders for the customer
$query_orders = "SELECT usedorders.medicine_id, usedmedicines.Name AS medicine_name, usedorders.quantity, usedorders.date_added ,usedorders.pharmacy_name,usedorders.price,usedorders.customer_name FROM usedorders JOIN usedmedicines ON usedorders.medicine_id = usedmedicines.id WHERE customer_name = '$customer_name'";
 $result_orders = mysqli_query($con, $query_orders);
  $orders = array(); 
  while ($row_orders = mysqli_fetch_assoc($result_orders)) {

  $orders[] = $row_orders;
 } 
$query_pharmacies = "SELECT id, pharmacy_name, region, mobile FROM pharmacies";
$result_pharmacies = mysqli_query($con, $query_pharmacies);
$pharmacies = array();
while ($row_pharmacies = mysqli_fetch_assoc($result_pharmacies)) {
    $pharmacies[] = $row_pharmacies;
}

// Group the orders by pharmacy name
$orders_by_pharmacy = array();
foreach ($orders as $order) {
    $pharmacy_name = $order['pharmacy_name'];
    if (!isset($orders_by_pharmacy[$pharmacy_name])) {
        $orders_by_pharmacy[$pharmacy_name] = array();
    }
    $orders_by_pharmacy[$pharmacy_name][] = $order;
}
$query_critical_medicines = "SELECT * FROM usedmedicines";
$conditions = array();

// Filter critical medicines by pharmacy ID or name
if (isset($_GET['pharmacy_id'])) {
    $pharmacy_id = $_GET['pharmacy_id'];
    $conditions[] = "pharmacy_id = '$pharmacy_id'";
}
if (isset($_GET['pharmacy_name'])) {
    $pharmacy_name = $_GET['pharmacy_name'];
    $conditions[] = "pharmacy_name = '$pharmacy_name'";
}
if (isset($_GET['region'])) {
    $region = $_GET['region'];
    $conditions[] = "region = '$region'";
}
if (isset($_GET['mobile'])) {
    $mobile = $_GET['mobile'];
    $conditions[] = "mobile = '$mobile'";
}
if (isset($_GET['medicine_name'])) {
  $medicine_name = $_GET['medicine_name'];
  $conditions[] = "Name = '$medicine_name'";
}
if (!empty($conditions)) {
    $query_critical_medicines .= " WHERE " . implode(' AND ', $conditions);
}


$pharmacy_name = isset($_GET['pharmacy_name']) ? $_GET['pharmacy_name'] : null;
$pharmacy_mobile = null;

foreach ($pharmacies as $pharmacy) {
  if ($pharmacy['pharmacy_name'] == $pharmacy_name) {
    $pharmacy_mobile = $pharmacy['mobile'];
    break;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Cart</title>
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
    body{
  background: url(images/104.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
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


    </style>
</head>

    <!-- CSS and JavaScript code -->

</head>


<body>
<div class="container">
<div class="header-area"  > 
		<div class="header-top"> 
<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container"> 
				<div class="logo col-md-3" > 
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7"> 
					<ul class="list-unstyled list-inline pull-right">
						<li><a href="cushome.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Customer Home</a></li>
<!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
<li><a href="viewused.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">View Used Medicines</a></li>	
						<li><a href="logout.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Logout</a></li>
                       
					</ul>
				</div>
				
			</div>
            </div>
</div>

        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center" style="color:#1bbbc5">Your Order Of Used Medicines List</h2>
                    </div>
                    <div class="col-md-6">
      <form method="get" style="padding-left:1px;padding-right:150px;">
        <div class="form-group">
          <label for="pharmacy_name">Pharmacy Name:</label>
          <select class="form-control" id="pharmacy_name" name="pharmacy_name">
            <option value="" style="margin-top:20%">Select Pharmacy</option>
            <?php foreach ($pharmacies as $pharmacy): ?>
              <option value="<?php echo $pharmacy['pharmacy_name']; ?>"<?php if ($pharmacy_name == $pharmacy['pharmacy_name']) echo ' selected'; ?>><?php echo $pharmacy['pharmacy_name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color:#1BBBC5">Submit</button>
      </form>

      <?php if ($pharmacy_mobile): ?>
        <form action="https://api.whatsapp.com/send" method="get" target="_blank">
          <input type="hidden" name="phone" value="<?php echo $pharmacy_mobile; ?>">
          <input type="hidden" name="text" value="Hello, I am interested in buying some medicines.">
          <button type="submit" class="btn btn-success">Contact Pharmacist on WhatsApp</button>
        </form>
      <?php endif; ?>
    </div>
    <div class="row mt-5">
        <?php foreach ($orders_by_pharmacy as $pharmacy_name => $pharmacy_orders): ?>
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center" style="color:#1bbbc5">Orders for <?php echo $pharmacy_name; ?></h2>
                    </div>
                    <div class="card-body">
                        <div class="card-body table-responsive">
                            <table class="table table-striped mt-4 mx-auto">
                                <thead>
                                <tr style="color:#1bbbc5;font-size:18px">
                                    <th scope="col">Medicines Name</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Actions</th> 
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $totalCost = 0; // Initialize the total cost variable
                                foreach ($pharmacy_orders as $order):
                                    $totalCost += $order['price'] * $order['quantity']; // Add current order's price to total cost
                                    ?>
                                    <tr style="font-size:17px">
                                        <td><?php echo $order['medicine_name']; ?></td>
                                        <td><?php echo date('F d, Y ', strtotime($order['date_added'])); ?></td>
                                        <td><?php echo $order['quantity']; ?></td>
                                        <td><?php echo $order['price']; ?>$</td>
                                        <td><?php echo $order['price'] * $order['quantity']; ?>$</td>
                                        <td>
            <form method="post" action="delete_usedorder.php">
                <input type="hidden" name="order_id" value="<?php echo $order['medicine_id']; ?>">
                <button type="submit" class="btn btn-danger btn-sm" style="background-color:#1bbbc5">Delete</button>
            </form>
        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4" style="text-align: right; font-weight: bold;font-size:20px">Total Cost:</td>
                                    <td style="font-size:20px;background-color:#1bbbc5"><?php echo $totalCost; ?>$</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
