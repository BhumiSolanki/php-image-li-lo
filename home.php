<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css"/>
<?php
	session_start();
	if(!$_SESSION['regtab'])
	{
		header("location:login.php");
	}
	$con = mysqli_connect("localhost","root","","login");
	if(!$con)
	{
		echo "Error DB!";
	}
	else
	{
		$oldmail = $_SESSION['regtab'];
		$sql = "select * from `regtab` where email='$oldmail'";
		$res = mysqli_query($con,$sql);
	}
?>
<div class="container-fluid mt-2 text-center">
	<?php
			$count  = mysqli_affected_rows($con);
			if($count == 1)
			{
				$row = mysqli_fetch_assoc($res);
			}
		?>
	<form action="home.php" method="POST" enctype="multipart/form-data">
		<?php
			if($row['profile_pic']!="")
			{
		?>
		<img class="img-circle" src="<?php echo "images/".$row['profile_pic']; ?>" alt="No Image" height="100" width="100" name="usrimg" id="usrimg"></br>
		<?php
			}
			if($row['profile_pic']=="")
			{
		?>
		<img class="img-circle" src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png" alt="No Image" height="100" width="100" name="usrimg" id="usrimg"></br>
		<input type="file" class="form-control" id="fileupload" name="fileupload" accept=".JPEG,.JPG,.PNG"></br>
		<?php
			}
		?>
		<input type="text" value="<?php echo $row['first_name']; ?>" name="txtfnm" class="form-control" required></br>
		<input type="text" value="<?php echo $row['middle_name']; ?>" name="txtmnm" class="form-control" required></br>
		<input type="text" value="<?php echo $row['last_name']; ?>" name="txtlnm" class="form-control" required></br>
		<input type="text" value="<?php echo $row['contact']; ?>" name="txtcno" class="form-control" required></br>
		<input type="email" value="<?php echo $row['email']; ?>" name="txtmail" class="form-control" disabled></br>
		<input type="password" value="<?php echo $row['password']; ?>" name="txtpwd" class="form-control" required></br>
		<input type="submit" value="Save Changes" class="btn btn-primary w-100"></br></br>
		<a href="logout.php" class="btn btn-danger w-100">Log out</a>
	</form>
</div>
<?php
	if(isset($_POST['txtfnm']))
	{
		$fnm = $_POST['txtfnm'];
		$mnm = $_POST['txtmnm'];
		$lnm = $_POST['txtlnm'];
		$cno = $_POST['txtcno'];
		$pwd = $_POST['txtpwd'];
		$target_dir = "images/";
		$temp = explode(".", $_FILES["fileupload"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		echo $newfilename;
		if(move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_dir.$newfilename))
		{
			$sql = "update `regtab` set first_name='$fnm',middle_name='$mnm',last_name='$lnm',contact='$cno', password='$pwd', profile_pic='$newfilename' where email='$oldmail'";
			echo $sql;
		}
		else
		{
			$sql = "update `regtab` set first_name='$fnm',middle_name='$mnm',last_name='$lnm',contact='$cno', password='$pwd' where email='$oldmail'";
		}
		 if(mysqli_query($con,$sql))
		{
			header("location:home.php");
		} 
	}
?>
<script>
	fileupload.onchange = evt => {
  const [file] = fileupload.files
  if (file) {
    usrimg.src = URL.createObjectURL(file)
  }
}
</script>