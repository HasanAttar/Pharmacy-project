
<div class=""></div><?php
require_once('connection.php');

// Get a list of all pharmacies
$query_pharmacies = "SELECT id, pharmacy_name, region,mobile FROM pharmacies";
$result_pharmacies = mysqli_query($con, $query_pharmacies);
$pharmacies = array();
while ($row_pharmacies = mysqli_fetch_assoc($result_pharmacies)) {
    $pharmacies[] = $row_pharmacies;
}

// Get a list of all critical medicines
$query_used_medicines = "SELECT * FROM usedmedicines";
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
    $query_used_medicines .= " WHERE " . implode(' AND ', $conditions);
}
$result_used_medicines = mysqli_query($con, $query_used_medicines);
$used_medicines = array();
while ($row_used_medicines = mysqli_fetch_assoc($result_used_medicines)) {
    $used_medicines[] = $row_used_medicines;
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

ul li a:hover{
		background-color:#82EFF6

	}

    </style>
</head>
<body>
<div class="header-area"  > 
		<div class="header-top"> 
<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container"> 
				<div class="logo col-md-3" > 
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7"> 
					<ul class="list-unstyled list-inline pull-right">
						<li><a href="adminhome.php" style="color:white;font-weight:bold;font-size:18px;text-decoration-line:underline">Admin Home</a></li>
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
                        <h2 class="display-6 text-center" style="color:#1bbbc5">List Of Used Medicines</h2>
                    </div>
                    <div class="card-body">
    <div class="card-body table-responsive">
        <form method="GET" action="" style="padding-left: 15px">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="region">Filter by Region:</label>
                    <select class="form-control" id="region" name="region">
                        <option value="">Select a Region</option>
                        <?php foreach ($pharmacies as $pharmacy): ?>
                            <option value="<?php echo $pharmacy['region']; ?>" <?php if (isset($_GET['region']) && $_GET['region'] == $pharmacy['region']): ?> selected<?php endif; ?>><?php echo $pharmacy['region']; ?></option>
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



<table  class="table table-striped mt-4 mx-auto">
<thead>
<tr style="background-color:#1BBBC5;color:white;font-size:18px">

<th scope="col">Medicines Name</th>

<th scope="col">Pharmacy Name</th>
<th scope="col">Region</th>
<th scope="col">Quantity</th>
<th scope="col">Price</th>
<th scope="col">Discount</th>
<th scope="col">Total_Price</th>


</tr>
</thead>
<tbody>
<?php foreach ($used_medicines as $medicine): ?>
<tr style="font-size:16px">

<td><?php echo $medicine['Name']; ?></td>

<td><?php echo $medicine['pharmacy_name']; ?></td>
<td><?php echo $medicine['region']; ?></td>
<td><?php echo $medicine['Quantity']; ?></td>
<td><?php echo $medicine['Price']; ?>$</td>
<td><?php echo ($medicine['Discount'] * 100) . '%'; ?></td>
<td><?php echo $medicine['total_price']; ?>$</td>





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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>