<?php
	$con=mysqli_connect("localhost","root","","login");
	if(!$con)
	{
		echo "Error DB!";
	}
	else
	{
		
			if(isset($_POST['txtmail']))
		{
			$mail=$_POST['txtmail'];
			$pwd=$_POST['txtpwd'];
			$sql = "select * from `regtab` where email='$mail' and password='$pwd'";
			$res= mysqli_query($con,$sql);
			$count= mysqli_affected_rows($con);
			if($count == 1)
			{
				session_start();
				$_SESSION['regtab'] = $mail;
				header("location:home.php");
			}
			else
			{
				echo ("Invalid Username or Password!");
			}
		}
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class="container mt-3">
	<form action="login.php" method="POST">
		<u><h6><center> LOGIN FORM </u></h6><center>
		<input type="email" name="txtmail" class="form-control" placeholder="Enter email id" required></br>
		<input type="password" name="txtpwd" class="form-control" placeholder="Enter password" required></br>
		<input type="submit" class="btn btn-success w-100" value="login">
	</form>
	</div>
	</body>
</html>