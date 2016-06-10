<?php

	require 'class.php';
	$asd=new main();

	$asd->connect();
	$asd->update_login_status();
	$asd->redirect_if();
	$asd->check_stage(2);
	$asd->any_messages();
	$asd->disconnect();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Level 2 : Intermediate </title>
	<link rel="stylesheet" href="main.css">
	<style type="text/css">
	body{
      background: -webkit-linear-gradient(90deg, #360033 10%, #0b8793 90%); /* Chrome 10+, Saf5.1+ */
	  background:    -moz-linear-gradient(90deg, #360033 10%, #0b8793 90%); /* FF3.6+ */
	  background:     -ms-linear-gradient(90deg, #360033 10%, #0b8793 90%); /* IE10 */
	  background:      -o-linear-gradient(90deg, #360033 10%, #0b8793 90%); /* Opera 11.10+ */
	  background:         linear-gradient(90deg, #360033 1%, #0b8793 99%); /* W3C */   
	}
	</style>	
</head>
<body>
<div id='main_container'>
	<div id='msg_container'><center><p id='message'></p></center></div>
	<div id='login_form_container'>
		<span id='heading'><b>Welcome to Level 2</b></span><br>
		Open the safe to retrieve the key of Level 3.<br><br>
		Hints: The password of the safe is a three digit number, for example 123,456,789,etc.
		<form action='lv2.php' method="GET">
			<input placeholder='Password' type='password' name='pw'><br>
			<input type='submit' value='Open the Safe' id='submit'>
		</form>
		<form action='check_key.php' method='POST'>
			<input placeholder='Key' type='password' name='key'><br>
			<input type='submit' value='Enter Key' id='submit'>
		</form>
	</div>
</div>
</body>
<script src='jq.js'></script>
<script>
///////////////////////////////////////////////////////////////////////////////////////////////////
							// YOU ARE UNBEARABLY NAIVE //
//////////////////////////////////////////////////////////////////////////////////////////////////							
	$(document).ready(function(){
		msg='<?php echo $asd->msg;?>';
		if(msg!='')
		{
			$('#msg_container').show();
			$('#message').text(msg);
			window.history.replaceState("","", "l2.php");
		}
	});
</script>
</html>