<!DOCTYPE html>
<html>
<head>
	<title>MCQs</title>
	<link rel="stylesheet" href="main.css">
<style>
body{
 background: -webkit-linear-gradient(90deg, #50C9C3 10%, #96DEDA 90%); /* Chrome 10+, Saf5.1+ */
  background:    -moz-linear-gradient(90deg, #50C9C3 10%, #96DEDA 90%); /* FF3.6+ */
  background:     -ms-linear-gradient(90deg, #50C9C3 10%, #96DEDA 90%); /* IE10 */
  background:      -o-linear-gradient(90deg, #50C9C3 10%, #96DEDA 90%); /* Opera 11.10+ */
  background:         linear-gradient(90deg, #50C9C3 10%, #96DEDA 90%); /* W3C */
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

?>
<script src='jq.js'></script>
<script src='jquery.countdown.min.js'></script>
<body>
<div id='main_container'>
<div id="timer"></div>
	<div id='questions'>
		<div id='login_form_container' style='text-align:justify;margin-top:5%;'>
			<span id='heading'><center>MCQs</center></span><br><br>
			<form id='mcq_form' action='submit_mcqs.php' method='POST'>
				<?php
					$asd->display_questions();
				?>
				<br><br><input type='submit' value='Submit'>
			</form>
		</div>	
	</div>
</div>
</body>
 <script type="text/javascript">
 	var time=<?php echo $asd->time_left();?>;
	if(time>0)
	{ 	
		var fiveSeconds = new Date().getTime() + time;
	   	$("#timer").countdown(fiveSeconds, function(event) {
		    $(this).text(
		       event.strftime('%M:%S')
		     );
		    t=parseInt(event.strftime('%S'));
		    if(t==30||t==59)
		    {
		    	$.post("update_time.php");
		    }
		    if(event.elapsed)
		    {
		    	$('#mcq_form').submit();
		    }
	    });
	}
	else
	{
		$('#mcq_form').submit();
	}
 </script>
 <?php $asd->disconnect();?>
</html>