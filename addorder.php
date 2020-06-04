    <?php
session_start();
$email=$_SESSION['username'];
$db=mysqli_connect("localhost","root", "","online");
if ($_SESSION["cart_products"]) {
    # code...
    foreach ($_SESSION["cart_products"] as $citems)
        {
       
            $orderid=uniqid();
            $date=date("Y/m/d");
            $orderid="INSERT INTO `orders`( `orderid`, `email`, `productid`, `date`, `status`) VALUES ('$orderid','$email','".$citems["product_code"]."','$date','ordered')";
            if (mysqli_query($db, $orderid)) {
                echo "done";
                 unset($_SESSION["cart_products"]);
                      header("Location: view_cart.php");
               
            }
            else{
                echo "Error: " . $orderid . "<br>" . $db->error;
            }

        }
}
	else{
         header("Location: view_cart.php");
    }	

		
?>