<?php 

$db=mysqli_connect("localhost","root", "","online");
$date=date("Y/m/d");
$nid=uniqid();
$email='admin';

if (isset($_GET['orderid'])) {
	# code...
		$orderid=$_GET['orderid'];
	$message="Order with id:".$_GET['orderid']." is on return";
	$update="UPDATE `orders` SET `status`='return' WHERE orderid='".$_GET['orderid']."'";
	        if (mysqli_query($db, $update)) {
 $nsql="INSERT INTO `notification`(`nid` ,`order_status`,`orderid`, `useremail`, `message`, `date`) VALUES ('$nid','return','$orderid','$email','$message','$date')";
if (mysqli_query($db, $nsql)) {
echo "n added";
header("location:notification.php");
}

}

	        	}
echo "returned";
 ?>