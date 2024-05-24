<?php
require_once('connection.php');
$id=$_GET['id'];
mysqli_query($con,"delete from criticalmedicines where id=$id ");

header("location:fetchcritical.php");
?>
