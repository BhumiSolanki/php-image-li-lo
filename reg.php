<?php
	$con=mysqli_connect("localhost","root","","login");
	if(!$con)
	{
		echo "Error DB!";
	}
	else
	{ 
		if(isset($_POST['txtfnm']))
		{
			$fnm=$_POST['txtfnm'];
			$mnm=$_POST['txtmnm'];
			$lnm=$_POST['txtlnm'];
			$cno=$_POST['txtcno'];
			$em=$_POST['txtem'];
			$pwd=$_POST['txtpwd'];
			$sql="INSERT INTO `regtab`(`first_name`,`middle_name`,`last_name`,`contact`,`email`,`password`) VALUES ('$fnm','$mnm','$lnm','$cno','$em','$pwd')";
			if(mysqli_query($con,$sql))
			{
				header("location:login.php");
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
		<form action="reg.php" method="POST">
			<u><h5><center> REGISTRATION FORM </u></h5></center>
			
				<input type="text" name="txtfnm" class="form-control" placeholder="Enter first name" required></br>
				<input type="text" name="txtmnm" class="form-control" placeholder="Enter middle name" required></br>
				<input type="text" name="txtlnm" class="form-control" placeholder="Enter last name" required></br>
				<input type="text" name="txtcno" class="form-control" placeholder="Enter contact no" required></br>
				<input type="E-mail" name="txtem" class="form-control" placeholder="Enter email"required></br>
				<input type="password" name="txtpwd" class="form-control" placeholder="Enter password" required></br>
				<input type="submit" class="btn btn-success w-100" value="register"></br>
		</form>
	</div>
	</body>
</html>