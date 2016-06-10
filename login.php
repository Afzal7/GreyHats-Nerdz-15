<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="main.css">
</head>
<?php

	require 'class.php';
	$asd=new main();

	$asd->connect();
	$asd->offline();
	$asd->any_messages();
	$asd->disconnect();

?>
<script src='jq.js'></script>
<script>
	$(document).ready(function(){
		h=$(window).height();
		//$('#main_container').height(h);
		msg='<?php echo $asd->msg;?>';
		if(msg!='')
		{
			$('#msg_container').show();
			$('#message').text(msg);
			window.history.replaceState("","", "login.php");
		}
	});
</script>
<body><div id='msg_container'><center><p id='message'></p></center></div>
<div id='main_container'>
	<div id='login_form_container'>
		<span id='heading'>Sign In</span>
		<form id='login_form' action='auth.php' method='POST'>
			<input id='email' name='email' type='text' placeholder='Email'>
			<br><input id='password' name='password' type='password' placeholder='Password'>
			<br><input type='submit' value='submit'>
		</form>
	</div>
</div>
</body>
</html>