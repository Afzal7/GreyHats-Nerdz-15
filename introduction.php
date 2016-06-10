<!DOCTYPE html>
<html>
<head>
	<title>Introduction</title>
	<link rel="stylesheet" href="main.css">
<style type="text/css">
	body{
		 background: -webkit-linear-gradient(90deg, #00d2ff 10%, #3a7bd5 90%); /* Chrome 10+, Saf5.1+ */
  background:    -moz-linear-gradient(90deg, #00d2ff 10%, #3a7bd5 90%); /* FF3.6+ */
  background:     -ms-linear-gradient(90deg, #00d2ff 10%, #3a7bd5 90%); /* IE10 */
  background:      -o-linear-gradient(90deg, #00d2ff 10%, #3a7bd5 90%); /* Opera 11.10+ */
  background:         linear-gradient(90deg, #00d2ff 10%, #3a7bd5 90%); /* W3C */
	}
</style>
</head>
<?php

	require 'class.php';
	$asd=new main();

	$asd->connect();
	$asd->update_login_status();
	$asd->redirect_if();
	$asd->check_stage(0);
	$asd->disconnect();

?>
<body>
<div id='main_container'>
	<div id='login_form_container'>
		<span id='user_name'>Welcome <strong><?php echo $asd->name;?></strong></span><br>
		<span id='heading'>RULES</span><br>
		GreyHats consist of 1 MCQs round and 3 Levels.<br>
		<ul>
			<li>The MCQs round contains 10 questions. You have to attend those questions in a time limit of 10 minutes. If you are able to pass this you will proceed to Level 1. If you fail this you are eliminated.</li><br>
			<li>The three levels are designed to test the skills, logical reasoning and thinking ability of a hacker.</li><br>
			<li>There is no time limit in these 3 levels.</li><br>
			<li>The participant who will complete all the 3 levels in the minimum time will the Winner.</li><br>
		</ul> 
		<input type='button' value='Let The Game Begins' onclick="window.location='mcqs.php'">
	</div>
</div>
</body>
</html>