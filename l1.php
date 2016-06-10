<?php

	require 'class.php';
	$asd=new main();

	$asd->connect();
	$asd->update_login_status();
	$asd->redirect_if();
	$asd->check_stage(1);
	$asd->any_messages();
	$asd->disconnect();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Level 1 : Beginners </title>
	<link rel="stylesheet" href="main.css">
<style type="text/css">
	body{
 background: -webkit-linear-gradient(90deg, #C04848 10%, #480048 90%); /* Chrome 10+, Saf5.1+ */
  background:    -moz-linear-gradient(90deg, #C04848 10%, #480048 90%); /* FF3.6+ */
  background:     -ms-linear-gradient(90deg, #C04848 10%, #480048 90%); /* IE10 */
  background:      -o-linear-gradient(90deg, #C04848 10%, #480048 90%); /* Opera 11.10+ */
  background:         linear-gradient(90deg, #C04848 10%, #480048 90%); /* W3C */
	}
</style>	
</head>

<body>
<div id='main_container'>
	<div id='msg_container'><center><p id='message'></p></center></div>
	<div id='login_form_container'>
		<span id='heading'>Welcome to Level 1</span><br>
		You have to hack this login form<br>
		<input placeholder='Username' type='text' id='un'	><br>
		<input placeholder='Password' type='password' id='pw'><br>
		<input type='button' value='Submit' id='submit'>
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
			window.history.replaceState("","", "l1.php");
		}
	password='Peace of our time';
//////////////////////////////////////////////////////////////////////////////////////////////

								//YOU ARE AT THE RIGHT PLACE//

////////////////////////////////////////////////////////////////////////////////////////////
		$('#submit').click(function(){
			u=$('#un').val();
			p=$('#pw').val();
			if(u=='R00T' && p==password){$('#msg_container').show();$('#message').html(msg);p=1;}
			else{$('#msg_container').show();$('#message').text('Invalid Username or Password');}
		});





		















































		msg="Well that was easy... <br>Just type 7 in both inputs and wait ;)";
		$('#pw').keyup(function(){if($('#un').val()==7&&$('#pw').val()==7&&p==1){$.post('lv1.php',{temp:1},function(r){if(r){window.location='l2.php';}});}});
	});
</script>
</html>