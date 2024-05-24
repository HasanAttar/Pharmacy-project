<?php
session_start();
include('connection.php');
// Retrieve the pharmacy name and region from the pharmacies table
if(isset($_SESSION['pharmacy_id'])) {
    $pharmacy_id = $_SESSION['pharmacy_id'];
    
    // check that pharmacy_id is not empty
    if(!empty($pharmacy_id)) {
        $pharmacy_query = "SELECT pharmacy_name, region,mobile FROM pharmacies WHERE id = $pharmacy_id";
        $pharmacy_result = mysqli_query($con, $pharmacy_query);

        // check that query executed successfully
        if($pharmacy_result) {
            $pharmacy_row = mysqli_fetch_assoc($pharmacy_result);
            $pharmacy_name = $pharmacy_row['pharmacy_name'];
            $region = $pharmacy_row['region'];
            $mobile = $pharmacy_row['mobile'];
        } else {
            // query failed
            echo "Error executing query: " . mysqli_error($con);
        }
    } else {
        // pharmacy_id is empty
        echo "Error: pharmacy_id is empty";
    }
} else {
    // id key not set in $_SESSION array
    echo "Error: id key not set in SESSION array";
}


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = 0;
        foreach ($data as $row) {
            if ($count > 0) {
                $Name = mysqli_real_escape_string($con, $row['0']);
                $expired = mysqli_real_escape_string($con, $row['1']);
                $quantity = mysqli_real_escape_string($con, $row['2']);
                $price = mysqli_real_escape_string($con, str_replace('$', '', $row['3']));
                $discount = mysqli_real_escape_string($con, str_replace('%', '', $row['4'])) / 100;
                $price = (float)$price;
                $discount=(float)$discount;
                
                $total_price = $price - ($price * $discount); // Calculate total price
        
                $pharmacy_name = mysqli_real_escape_string($con, $_POST['pharmacy_name']);
                $region = mysqli_real_escape_string($con, $_POST['region']);
                $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
        
                $criticalQuery = "INSERT INTO criticalmedicines (Name, Expirationdate, Quantity, Price, Discount, Total_price, pharmacy_name, region, pharmacist_mobile) VALUES ('$Name', '$expired', '$quantity', '$price', '$discount', '$total_price', '$pharmacy_name', '$region', '$mobile')";
                $result = mysqli_query($con, $criticalQuery);
                $msg = true;
            } else {
                $count = 1;
            }
        
        


        }

        if(isset($msg))
        {
            $_SESSION['message'] = "";
            header('Location: fetchcritical.php?pharmacy_name='.$pharmacy_name.'&region='.$region.'&mobile='.$mobile);
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            header('Location: codecritical.php');
            exit(0);
  }

    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: codecritical.php');
        exit(0);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Import Excel Data </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />
	
	<script type="text/javascript" src="js/modernizr.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
    <style>
     body { 
  background: url(images/14.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  }
  .form2, .form3 {
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
}

ul li a:hover{
		background-color:#82EFF6

	}
.header-area {
  background-color: #3abac9;
}

.header-top {
  padding: 20px;
}
.card-body table {
      font-size: 16px;
    }

    .card-body th {
      font-weight: bold;
      font-size: 18px;
    }

    .card-body td {
      padding: 10px;
    }

    .card-body tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .list-container {
    display: flex;
    justify-content: space-between;
}
.list {
    flex-basis: 45%; /* Adjust as needed */
}

    </style>
</head>
<body>
<div class="header-area" > 
		<div class="header-top"> 
<!--            <img src="img/client-1295901_960_720.png" style="max-height: 5%;max-width: 5%;margin-left: 48%;opacity:1.0;"> <h1 style="text-align: center;color: black">Medicine Guide</h1>-->
			<div class="container"> 
				<div class="logo col-md-3" > 
					<img src="images/51.png" alt="" />
				</div>
				<div class="menu col-md-7"> 
					<ul class="list-unstyled list-inline pull-right">
						<li><a href="pharprofile.php" style="color:white;font-size:20px;text-decoration-line:underline"><i>Pharmacist Home</i></a></li>
<!--						<li><a href="pharsignup.php" style="color:white;">Pharmacy SignUp</a></li>-->
						<li><a href="logout.php" style="color:white;font-weight:bold;font-size:20px;text-decoration-line:underline"><i>Logout</i></a></li>
						
					</ul>
				</div>
				
			</div>
		</div>
		
		
	</div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

                <?php
                if(isset($_SESSION['message']))
                {
                    echo "<h4>".$_SESSION['message']."</h4>";
                    unset($_SESSION['message']);
                }
                ?>

                <div class="card" style= "height:100%;font-size:25px; text-align:center;position:absolute;left:50%;transform: translateX(-50%); ">
                    <div class="card-header">
                        <h4 style="font-size:25px">Import Critical medicines list  </h4>
                    </div>
                    <div class="card-body">

                    <form method="post" action="codecritical.php" enctype="multipart/form-data">
   
    <input type="file" name="import_file">
    <input type="submit" name="save_excel_data" value="Import">
    <input type="hidden" name="pharmacy_name" value="<?php echo $pharmacy_name; ?>">
    <input type="hidden" name="region" value="<?php echo $region; ?>">
    <input type="hidden" name="mobile" value="<?php echo $mobile; ?>">
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>