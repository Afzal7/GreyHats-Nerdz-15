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
<style type="text/css">
	body{
	background:black;
	margin:0;
}
canvas{
	display: block;
	position:absolute;
	z-index:0; 
}
#main_container{
	margin-top:0px;
	width:100%;
	z-index:3;
	position:absolute;
}
</style>
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
<script>
function matrix()
{	
	var c = document.getElementById("c");
	var ctx = c.getContext("2d");

	//making the canvas full screen
	c.height = window.innerHeight;
	c.width = window.innerWidth;

	//chinese characters - taken from the unicode charset
	var chinese = "01";
	//converting the string into an array of single characters
	chinese = chinese.split("");

	var font_size = 10;
	var columns = c.width/font_size; //number of columns for the rain
	//an array of drops - one per column
	var drops = [];
	//x below is the x coordinate
	//1 = y co-ordinate of the drop(same for every drop initially)
	for(var x = 0; x < columns; x++)
		drops[x] = 1; 

	//drawing the characters
	function draw()
	{
		//Black BG for the canvas
		//translucent BG to show trail
		ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
		ctx.fillRect(0, 0, c.width, c.height);
		
		ctx.fillStyle = "#0D0"; //green text
		ctx.font = font_size + "px arial";
		//looping over drops
		for(var i = 0; i < drops.length; i++)
		{
			//a random chinese character to print
			var text = chinese[Math.floor(Math.random()*chinese.length)];
			//x = i*font_size, y = value of drops[i]*font_size
			ctx.fillText(text, i*font_size, drops[i]*font_size);
			
			//sending the drop back to the top randomly after it has crossed the screen
			//adding a randomness to the reset to make the drops scattered on the Y axis
			if(drops[i]*font_size > c.height && Math.random() > 0.975)
				drops[i] = 0;
			
			//incrementing Y coordinate
			drops[i]++;
		}
	}
	setInterval(draw, 35);
}	
</script>

<body onload='matrix()'>
<canvas width="849" height="587" id="c"></canvas>
<div id='msg_container'><center><p id='message'></p></center></div>
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