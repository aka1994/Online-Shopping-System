<?php 
session_start();
$date=date("Y/m/d");
$nid=uniqid();
$email=$_GET['email'];
$db=mysqli_connect("localhost","root", "","online");
if (isset($_GET['orderid'])) {
	# code...
	$orderid=$_GET['orderid'];
	$message="You order with id:".$_GET['orderid']." have been approved!";
	$update="UPDATE `orders` SET `status`='approved' WHERE orderid='".$_GET['orderid']."'";
	        if (mysqli_query($db, $update)) {
 $nsql="INSERT INTO `notification`(`nid` ,`order_status`,`orderid`, `useremail`, `message`, `date`) VALUES ('$nid','approved','$orderid','$email','$message','$date')";
if (mysqli_query($db, $nsql)) {
echo "n added";
}
else{
	echo $db->error;
}
header("location:order.php");
	        }
	        else{
	        	echo "sorry";
	        }
}
else{
	echo "sorry";
}
 ?>
