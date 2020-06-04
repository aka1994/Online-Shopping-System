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


<!-- BACK TO TOP-->
<a href="#" class="back-to-top">Back To Top </a>

<!--CONTENT-->

<div class="content">
	<section class="container">

<?php
$db=mysqli_connect("localhost","root", "","online");
$results = $db->query("SELECT * FROM orders  ORDER BY id ASC");

?>

<table border="1" bordercolor="white" style="color:white;"><th>ID</th><th>Order Id</th><th>By</th><th>Date</th><th>Status</th><th>Approve</th><th>action</th>
<?php
if ($results->num_rows > 0) {
while($row = $results->fetch_assoc())
{
?>
	<tr>
	<td><p align="center"><?php echo $row["id"]  ?></p></td>
	<td><?php echo $row['orderid']  ?></td>
    <td><p align="center"><?php echo $row['email']  ?></p></td>
    <td><p align="center"><?php echo $row['date']  ?></p></td>
    <td><p align="center"><?php echo $row['status']  ?></p></td>
    <?php 
    if($row['status']=="approved"){
?>
<td><a href="approve.php?orderid=<?php echo $row['orderid']  ?>&email=<?php echo $row['email']  ?>" class="btn btn-primary disabled">Approve</a></td>
<td><a href="delivered.php?orderid=<?php echo $row['orderid']  ?>&email=<?php echo $row['email']  ?>" class="btn btn-danger">Delivered</a></td>
<?php
    	 }

    	 else if ($row['status']=="delivered") {
    	 	?>
    	 	<td><a href="approve.php?orderid=<?php echo $row['orderid']  ?>&email=<?php echo $row['email']  ?>" class="btn btn-primary disabled">Approve</a></td>

    	 <td><a href="delivered.php?orderid=<?php echo $row['orderid']  ?>&email=<?php echo $row['email']  ?>" class="btn btn-danger disabled">Delivered</a></td>

    	 	<?php
    	 }
    	 else if ($row['status']=="cancled" || $row['status']=="return") {
    	 	# code...
    	 	?>
<td><a href="approve.php?orderid=<?php echo $row['orderid']  ?>&email=<?php echo $row['email']  ?>" class="btn btn-primary disabled">Approve</a></td>
 <td><a href="delivered.php?orderid=<?php echo $row['orderid']  ?>&email=<?php echo $row['email']  ?>" class="btn btn-danger disabled">Delivered</a></td>

    	 	<?php
    	 }
    	 else{
?>
<td><a href="approve.php?orderid=<?php echo $row['orderid']  ?>&email=<?php echo $row['email']  ?>" class="btn btn-primary">Approve</a></td>
 <td><a href="delivered.php?orderid=<?php echo $row['orderid']  ?>&email=<?php echo $row['email']  ?>" class="btn btn-danger">Delivered</a></td>
    	  }
  
}
     ?>
	</tr>
	<?php
    	  }
    	}
  
}
     ?>
   
    
	

</table>
  
</div>




</section>
</div>






</body>
</html>