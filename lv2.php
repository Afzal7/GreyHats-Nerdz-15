<?php
	require 'class.php';
	$asd=new main();

	$asd->connect();
	if(mysqli_real_escape_string($asd->con,strip_tags(trim($_GET['pw'])))=='')
	{
		header('location:l2.php?x=Empty+Input');
	}

	$password=(int)mysqli_real_escape_string($asd->con,strip_tags(trim($_GET['pw'])));
	if($password=='774')
	{
		$msg='Key = %ThIs@Is#ThE$kEy%';
	}
	else
	{
		$msg='Invalid Password';
	}
	$asd->disconnect();
?>
<html>
<head>
	<title>SAFE</title>
	<link rel="stylesheet" href="main.css">
</head>
<body style='background:black;'>
	<div id="login_form_container">
		<?php echo $msg;?>
	</div>
</body>
</html>