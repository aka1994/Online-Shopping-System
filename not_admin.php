<?php
session_start();
include_once("config.php");


//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Orders | ThinkGeek</title>
	<link rel="icon" href="res/ThinkGeek-pt.png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/head.css">
	<link rel="stylesheet" type="text/css" href="css/sidebar2.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">

	<link rel="stylesheet" type="text/css" href="css/content.css">
	<!--BOOTSTRAP-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

	<style type="text/css">
		
		#logo{
			padding-top: 0.7%;						
			width: 14%;
			height: 62px;
			float: left;	
			position: fixed;		
		}
			.container{
			width: 60%;
			position: absolute;
			margin-left: 20%;
			margin-top: 20px;
		}
		td{
			padding: 5px;
		}

		th{
			padding: 5px;
			font-size: 20px;
			text-align: center;
		}
.link{
	color:#1a75ff;
	padding: 5px;
	text-decoration: none;
	font-weight: bold;
}

	</style>
	
</head>

<body>

<div id="logo">
	<a href="admin.php">
		<img src="res/thinkgeek-png.png" width="100%">
	</a>
</div>

<div id="sidebar">
	<ul>
		<li>Welcome <?php echo $_SESSION['username'];?></li>
				
		<li>
			<a href="destroy.php"> 
			<table><tr><td><img src="res/icons/logout2.png" /></td>
			<td>&nbsp;Logout</td></tr></table></a>
		</li>

		<li>&nbsp;</li>
		
	</ul>
</div>

<div id="navbar">
	<ul>
		<li><a class="active" href="inventory.php">Inventory</a></li>
		<li><a href="add_product.php">Add Product</a></li>
		<li><a href="remove_product.php">Remove Product</a></li>
		<li><a href="order.php">Order</a></li>
		<li><a href="not_admin.php">Notification</a></li>

	</ul>
</div>



<div class="container"> 

	<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nid</th>
      <th scope="col">Date</th>
      <th scope="col">Message</th>
      <th>Status</th>
      <th>action</th>
    </tr>
  </thead>
  <tbody>

    	<?php 

$db=mysqli_connect("localhost","root", "","online");
	$sql = "SELECT * FROM notification WHERE useremail='admin'";
$result = $db->query($sql); ?>
<?php 
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    		 $command = $db->query("SELECT * FROM orders WHERE orderid='".$row['orderid']."'");
  $order = $command->fetch_assoc();
 ?>
	<tr>
		 <th scope="col">#</th>
		<td><?php echo $row['nid']; ?></td>
		<td><?php echo $row['date']; ?></td>
		<td><?php echo $row['message']; ?></td>
		<td><?php echo $order['status']; ?></td>
		<?php 
		
if ($order['status']=="delivered") {
	# code...
	?>
<td><a class="btn btn-danger" href="return.php?orderid=<?php echo $row['orderid'] ?>">Return</a></td>

	<?php
}
else if ($order['status']=='return') {
	# code...
	?>
<td><a class="btn btn-warning disabled" href="return.php?orderid=<?php echo $row['orderid'] ?>">progress..</a></td>


	<?php
}
else if ($order['status']=='cancled') {
	# code...
	?>
<td><a class="btn btn-danger disabled" href="return.php?orderid=<?php echo $row['orderid'] ?>">cancelled..</a></td>
	<?php
}
else if ($order['status']=='approved') {
	# code...
	?>
<td><a class="btn btn-primary" href="cancle.php?orderid=<?php echo $row['orderid'] ?>">cancel</a></td>

	<?php
}
else{

	?>

<td><a class="btn btn-primary" href="cancle.php?orderid=<?php echo $row['orderid'] ?>">cancel</a></td>

	<?php
}
		 ?>
	</tr>
	<?php 
}
}
	 ?>
  </tbody>
</table>

</div>



</body>
</html>