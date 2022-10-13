<?php
	session_start();
	$_SESSION['regtab'] = '';
	header("location:login.php");
?>