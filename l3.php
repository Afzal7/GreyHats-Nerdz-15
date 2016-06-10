<?php

	require 'class.php';
	$asd=new main();

	$asd->connect();
	$asd->update_login_status();
	$asd->redirect_if();
	$asd->check_stage(3);
	$asd->any_messages();
	$asd->disconnect();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Level 3 : Difficult </title>
	<link rel="stylesheet" href="main.css">
	<style type="text/css">
	body{
		background: -webkit-linear-gradient(90deg, #000000 10%, #53346D 90%); /* Chrome 10+, Saf5.1+ */
  		background:    -moz-linear-gradient(90deg, #000000 10%, #53346D 90%); /* FF3.6+ */
  		background:     -ms-linear-gradient(90deg, #000000 10%, #53346D 90%); /* IE10 */
  		background:      -o-linear-gradient(90deg, #000000 10%, #53346D 90%); /* Opera 11.10+ */
  		background:         linear-gradient(90deg, #000000 10%, #53346D 90%); /* W3C */        
	}
	</style>	
</head>
<body>
<div id='main_container'>
	<div id='msg_container'><center><p id='message'></p></center></div>
	<div id='login_form_container'>
		<span id='heading'>Welcome to Level 3</span><br>
		An image has been striped into many vertical pieces.<br>
		The urls of these individual images are hidden inside the log file of an apache server.<br><br>
		<b>Your mission is to locate those images, join them and re-create the original image.</b><br><br>
		You can download the log file from <a href='apache_log_file.txt' download>here</a>.<br><br>
		Upload the re-created image to a server (tiikoni.com) and submit the link below.<br>
		<form action='lv3.php' method='POST'>
		<input type='text' placeholder='The link can be submitted only once.' name='image_link' required>
		<br><input type='submit' value='Submit'>
		</form>
	</div>
</div>
</body>
<script src='jq.js'></script>
<script>					
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