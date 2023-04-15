<?php 

include_once('config.php');

$id=$_GET['id'];
$sql= "UPDATE `bookings` SET `is_approved` = 'false' WERE id=:id ";
$prep=$conn->prepare($sql);
$prep->bindParam(':id', $id);
$prep->execute();

header("Location: bookings.php");

?>