<?php
require_once('connection.php');

// Get a list of all pharmacies
$query_pharmacies = "SELECT id, pharmacy_name, region,mobile FROM pharmacies";
$result_pharmacies = mysqli_query($con, $query_pharmacies);
$pharmacies = array();
while ($row_pharmacies = mysqli_fetch_assoc($result_pharmacies)) {
    $pharmacies[] = $row_pharmacies;
}

// Get a list of all critical medicines
$query_critical_medicines = "SELECT * FROM criticalmedicines";
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
$result_critical_medicines = mysqli_query($con, $query_critical_medicines);
$critical_medicines = array();
while ($row_critical_medicines = mysqli_fetch_assoc($result_critical_medicines)) {
    $critical_medicines[] = $row_critical_medicines;
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
    <title>Customer Page</title>
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
        body {
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

        ul li a:hover {
            background-color: #82EFF6
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
        }

        .cus-bottom {
            padding-top: 5px;
        }

        option {
            width: 150px;
        }
    </style>
</head>

<body>
    <div class="header-area">
        <div class="header-top">
            <!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
            <div class="container">
                <div class="logo col-md-3">
                    <img src="images/51.png" alt="" />
                </div>
                <div class="menu col-md-7">
                    <ul class="list-unstyled list-inline pull-right">
                        <li><a href="cushome.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Customer Home</a></li>
                        <!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
                        <li><a href="logout.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Logout</a></li>

                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center" style="color:#1bbbc5">List Of Critical Medicines</h2>
                    </div>
                    <div class="card-body">
                        <div class="card-body table-responsive">
                            <form method="GET" action="" style="padding-left: 15px">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="region">Filter by Region:</label>
                                        <select class="form-control" id="region" name="region" style="width:100%">
                                            <option value="">Select a Region</option>
                                            <?php foreach ($pharmacies as $pharmacy) : ?>
                                                <option value="<?php echo $pharmacy['region']; ?>" <?php if (isset($_GET['region']) && $_GET['region'] == $pharmacy['region']) : ?> selected<?php endif; ?>><?php echo $pharmacy['region']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="medicine_name">Search by Medicines Name:</label>
                                        <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?php echo isset($_GET['medicine_name']) ? $_GET['medicine_name'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" style="background-color: #1BBBC5">Apply Filters</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table table-striped mt-4 mx-auto">
                        <thead>
                            <tr style="background-color:#1BBBC5;color:white;font-size:18px">

                                <th scope="col">Medicines Name</th>

                                <th scope="col">Pharmacy Name</th>
                                <th scope="col">Region</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Total_Price</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($critical_medicines as $medicine) : ?>
                                <tr style="font-size:16px">
                                    <td><?php echo $medicine['Name']; ?></td>
                                    <td><?php echo $medicine['pharmacy_name']; ?></td>
                                    <td><?php echo $medicine['region']; ?></td>
                                    <td><?php echo $medicine['Quantity']; ?></td>
                                    <td><?php echo $medicine['Price']; ?>$</td>
                                    <td><?php echo ($medicine['Discount'] * 100) . '%'; ?></td>
                                    <td><?php echo $medicine['total_price']; ?>$</td>
                                    <td>
                                        <?php
                                        // Check if the quantity exceeds the available stock
                                        $availableStock = $medicine['Quantity'];
                                        $quantityError = '';
                                        if ($availableStock <= 0) {
                                            $quantityError = 'Quantity out of stock';
                                        } else if (isset($_GET['quantity']) && $_GET['quantity'] > $availableStock) {
                                            $quantityError = 'Quantity exceeds available stock';
                                        }
                                        ?>
                                        <?php if ($quantityError) : ?>
                                            <span class="text-danger"><?php echo $quantityError; ?></span>
                                        <?php else : ?>
                                            <form method="POST" action="add_to_cart.php">
                                                <input type="hidden" name="medicine_id" value="<?php echo $medicine['id']; ?>">
                                                <input type="hidden" name="pharmacy_name" value="<?php echo $medicine['pharmacy_name']; ?>">
                                                <input type="hidden" name="Name" value="<?php echo $medicine['Name']; ?>">
                                                <input type="hidden" name="price" value="<?php echo $medicine['Price']; ?>">
                                                <input type="number" name="quantity" value="1" min="1" max="<?php echo $availableStock; ?>">
                                                <input type="hidden" name="Discount" value="<?php echo $medicine['Discount']; ?>">
                                                <input type="hidden" name="price" value="<?php echo $medicine['total_price']; ?>">
                                                <button type="submit" class="btn btn-primary" style="background-color:#1BBBC5">Place Order</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        $(function() {
            $('#pharmacy_name').on('change', function() {
                var selectedPharmacy = $(this).val();
                var mobileNumber = '';
                $.each(<?php echo json_encode($pharmacies); ?>, function(index, value) {
                    if (value.pharmacy_name == selectedPharmacy) {
                        mobileNumber = value.mobile;
                        return false;
                    }
                });
                $('#mobile').val(mobileNumber);
            });
        });
    </script>
    <script>
        function addToCart(medicine_id, medicine_name, pharmacy_name, quantity, price) {
            var customer_name = prompt("Please enter your name:", "");
            if (customer_name == null || customer_name == "") {
                alert("Please enter your name to add item to cart.");
                return;
            }
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var cart_count = document.getElementById("cart-count");
                    cart_count.innerHTML = parseInt(cart_count.innerHTML) + 1;
                    alert("Item added to cart.");
                }
            };
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("customer_name=" + customer_name + "&medicine_id=" + medicine_id + "&medicine_name=" + medicine_name + "&pharmacy_name=" + pharmacy_name + "&quantity=" + quantity + "&price=" + price);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>