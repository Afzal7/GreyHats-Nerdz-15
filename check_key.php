<?php
	require 'class.php';
	$asd=new main();

	$asd->connect();
	if(mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['key'])))=='')
	{
		$asd->disconnect();
		header('location:l2.php?x=Empty+Input');
	}
	else
	{
		$asd->update_login_status();
		$asd->redirect_if();
		$asd->check_stage(2);

		$password=mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['key'])));
		if($password=='%ThIs@Is#ThE$kEy%')
		{
			$asd->update_stage(3);
			$asd->disconnect();
			header('location:l3.php');
		}
		else
		{
			$asd->disconnect();
			header('location:l2.php?x=Invalid+Key');
		}
	}
?>