<?php
session_start();
include_once("config.php");


//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Harry Potter | ThinkGeek</title>
	<link rel="icon" href="res/ThinkGeek-pt.png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">

	<link rel="stylesheet" type="text/css" href="css/content.css">
	<!--BOOTSTRAP-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

	<style type="text/css">
		body{
			margin: 0;						
		}
		#logo{
			padding-top: 0.7%;			
			background-color: #333;
			width: 14%;
			height: 9.65%;
			float: left;
			position: fixed;
		}
		.container{
			width: 60%;
			position: absolute;
			margin-left: 20%;
			margin-top: 20px;
		}
	</style>
	
</head>

<body>

<div id="logo">
	<a href="fandom.php">
		<img src="res/thinkgeek-png.png" width="100%">
	</a>
</div>


<div id="sidebar">
	<ul>
		<li>Welcome <?php echo $_SESSION['username'];?></li>
		
		<li><a href="#cart"><table><tr><td><img src="res/icons/cart.png" /></td>
		<td>&nbsp;Shopping Cart</td></tr></table></a></li>
		
		<li><a href="#clothing"><table><tr><td><img src="res/icons/clothing.png" /></td>
		<td>&nbsp;Clothing</td></tr></table></a></li>

		<li><a href="#acc"><table><tr><td><img src="res/icons/accessories.png" /></td>
		<td>&nbsp;Accessories</td></tr></table></a></li>

		<li><a href="#sou"><table><tr><td><img src="res/icons/souvenir.png" /></td>
		<td>&nbsp;Souvenir</td></tr></table></a></li>	

		<li>&nbsp;</li>	

		<li><a href="view_cart.php"><table><tr><td><img src="res/icons/checkout.png" /></td>
		<td>&nbsp;Checkout&nbsp;</td><td><img src="res/icons/new_page.png" /></td></tr></table></a></li>

		<li>
			<a href="destroy.php"> 
			<table><tr><td><img src="res/icons/logout.png" /></td>
			<td>&nbsp;Logout</td></tr></table></a>
		</li>

		<li>&nbsp;</li>
			
		<li><a href="https://goo.gl/forms/jhAHet2TLLPIOQff1" target="_blank"><table><tr><td><img src="res/icons/request.png" /></td>
		<td>&nbsp;Request Here&nbsp;</td><td><img src="res/icons/new_page.png" /></td></tr></table></a></li>
	</ul>
</div>

<div id="navbar">
	<ul>
		<li><a href="got.php">Game of Thrones</a></li>
		<li><a class="active" href="hp.php">Harry Potter</a></li>
		<li><a href="hg.php">Hunger Games</a></li>
		<li><a href="notification.php">Notification</a></li>
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
	$sql = "SELECT * FROM notification WHERE useremail='".$_SESSION['username']."'";
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