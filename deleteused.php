<?php
require_once('connection.php');
$id=$_GET['id'];
mysqli_query($con,"delete from usedmedicines where id=$id ");

header("location:fetchused.php");
?>
