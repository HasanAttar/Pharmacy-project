<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "pharmacy-system";

$con=mysqli_connect("localhost","root","","pharmacy-system");
if (mysqli_connect_errno())
{echo "failed to connect to db: ".  mysqli_connect_error();}


?>