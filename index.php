<?php
session_start();
if(isset($_SESSION['username'])){
	header("Location: fandom.php");
}


	$db=mysqli_connect("localhost","root", "","online");
	if(isset($_POST['signup'])) {

		$fname = ($_POST['fname']);
		$lname = ($_POST['lname']);
		$password = ($_POST['password']);
		$email = ($_POST['email']);
		$phone = ($_POST['phone']);
		$sql;
		$password=md5($password);
		
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "Insert into users(fname,lname,phone,email,password) values ('$fname','$lname','$phone','$email','$password')";

if (mysqli_query($db, $sql)) 
{
	?>

<script type="text/javascript">
	alert("New record created successfully");
</script>

	<?php

} 
else 
{
	echo '<script type="text/javascript">prompt("Error Occured");</script>';
	header("Location:http://localhost/onlinepro/index.php");

    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

	}
?>
 <html>
 <head>
<link rel="stylesheet" href="css/head.css">
<link rel="icon" href="res/ThinkGeek-pt.png" sizes="16x16">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<script type="text/javascript" src="scripts/signupForm.js"></script>
<script type="text/javascript" src="scripts/loginForm.js"></script>
<title>ThinkGeek | Join in. Geek out.</title>
</head>
<body>
<h1><center><img src="res/thinkgeek-png.png"></center></h1>



<!-- LOGIN -->

<div id="login">
<form name="loginForm" method="post" action="log.php">
<table align="left" width="150%">
<tr>
	<td align="center">
		<h2>Login</h2>
	</td>
</tr>
<tr>	
	<td>
		<input type="text" name="username" id="user" placeholder="Email" required>
	</td>	
</tr>
<br>
<tr>	

	<td>
		<input type="password" name="password" id="pass" placeholder="Password" required>
	</td>
</tr>
<tr>
	
	<td>
		<input type="submit" name="login" value="Let me in.." class="click">
	</td>
</tr>
<!--
<tr>
	<td colspan="2" class="signin">
		<input type="image" src="signin_google.png" alt="Login with Google" width="50%" height="50%">

	</td>
</tr>
<tr>
	<td colspan="2" class="signin">
		<input type="image" src="signin_fb.png" alt="Login with FB" width="50%" height="50%">

	</td>
</tr>
//-->
</table>
</form>
</div>


<!-- SIGNUP -->

<form name="signupForm" method="post" action="index.php" id="signup" onsubmit="return ValidateFname() || ValidateLname() || ValidateEmail() || ValidateMobile() ">
<table align="right"> 
<tr>
	<td align="center" colspan="2">
		<h2>New Here? Register with us..</h2>
	</td>
</tr>
<tr>
	<td>
		<input type="text" name="fname" placeholder="First Name" required>	
	</td>
	<td>
		<input type="text" name="lname" placeholder="Last Name" required>
	</td>
</tr>

<tr>
	<td colspan="2">
		<input type="email" name="email" placeholder="Email" required>
	</td>
</tr>
<tr>
	<td colspan="2">
		<input type="text" name="phone" placeholder="Contact Number" required>
	</td>
</tr>
<tr>	
	<td colspan="2">
		<input type="password" name="password" placeholder="Password" required>
	</td>
</tr>

<tr>
<td colspan="2">
	<input type="submit" name="signup" value="Sign Up" class="click">
</td>
</tr>

</table>
</form>

</body>
</html>