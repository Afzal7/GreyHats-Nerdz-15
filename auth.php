<?php
	require 'class.php';
	$asd=new main();

	$asd->connect();
	
	$email=mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['email'])));
	$password=mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['password'])));

	if($email=='' || $password=='')
	{
		header('location:login.php?x=Empty+Email+or+Password');
	}
	else{
		$temp=$asd->login($email,$password);
		
		if($temp==1)
		{
			header('location:introduction.php');
		}
		else
		{
			header('location:login.php?x=Invalid+Email+or+Password');
		}
	}	
	$asd->disconnect();
?>