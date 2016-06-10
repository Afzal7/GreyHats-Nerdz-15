<?php
	require 'class.php';
	$asd=new main();

	$asd->connect();
	if(mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['temp'])))=='')
	{
		header('location:index.php');
	}

	$asd->update_login_status();
	$asd->redirect_if();
	$asd->check_stage(1);

	$temp=mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['temp'])));
	if($temp==1)
	{
		$asd->update_stage(2);
		echo 1;
	}
	else
	{
		echo 0;
	}

	$asd->disconnect();
?>