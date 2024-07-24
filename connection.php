<?php
$host = "";
$username = "";
$password = "";
$database = "";

$con=mysqli_connect($host,$username,$password,$database);
if (mysqli_connect_errno())
{echo "failed to connect to db: ".  mysqli_connect_error();}


?>
