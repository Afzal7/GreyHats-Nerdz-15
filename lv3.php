<?php
	require 'class.php';
	$asd=new main();

	$asd->connect();
	if(mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['image_link'])))=='')
	{
		header('location:l3.php?x=Empty+Input');
	}
	$asd->update_login_status();
	$asd->redirect_if();
	$asd->check_stage(3);
	
	$link=mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['image_link'])));
	$query="insert into final_stage (email,link) values ('$asd->user_id','$link')";
	$q=mysqli_query($asd->con,$query) or die('Something went wrong.. Try submitting again..');

	$asd->update_stage(111);
	$asd->offline();
	$asd->disconnect();

?>
<html>
<head>
	<title>Thank You</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div id="login_form_container" style='font-size:20px;font-family:Constantia;'>
		Your Link has been submitted.<br>The results will be announce shortly.<br>
		<br>You will be notified through email or call.
		<br><br>Good Day
	</div>
</body>
</html>