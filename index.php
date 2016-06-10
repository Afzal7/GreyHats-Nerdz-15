<!DOCTYPE html>
<html>
<head>
	<title>Grey Hats</title>
<style>
@font-face {
  font-family: 'Audiowide';
  font-style: normal;
  font-weight: 400;
  src: local('Audiowide'), local('Audiowide-Regular'), url(http://themes.googleusercontent.com/static/fonts/audiowide/v2/8XtYtNKEyyZh481XVWfVOj8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
@font-face {
  font-family: 'Iceland';
  font-style: normal;
  font-weight: 400;
  src: local('Iceland'), local('Iceland-Regular'), url(http://themes.googleusercontent.com/static/fonts/iceland/v3/F6LYTZLHrG9BNYXRjU7RSw.woff) format('woff');
}
body{
	background:black;
	margin:0;
}
canvas{
	display: block;
	position:absolute;
	z-index:1; 
}
#msg_container{
	background:rgba(0,0,0,.7);
	min-width:200px;
	width:30%;
	margin-left:50%;
	margin-top:-8%;
	position:fixed;
	z-index:3;
	color:white;
	font-family:Consolas,Arial;
	font-size:18px;
	text-shadow:0px 0px 2px grey;
	border-radius:5px;
	display:none;
	transform:translateX(-50%);
}
#main_container{
	margin-top:4%;
	background:transparent;
	text-align:center;
	position:absolute;
	z-index:2;
	width:100%;
}
#main_title{
	color:#00FF00;
	text-shadow:0px 0px 5px #99FF33;
	font-size:180px;
	font-family:Audiowide,sans-serif;
}
#presents{
	color:#ccc;
	font-size:15px;
	font-family:consolas;
}
#greyhats{
	color:white;
	text-shadow:0px 0px 3px white;
	font-size:120px;
	font-family:Iceland,Constantia;
}
input[type='button'],input[type='submit']{
	padding:6px 13px;
	margin:5px;
	font-family:Consolas,Arial;
	font-size:20px;
	background:rgba(0,100,150,0.8);
	color:white;
	outline:0;
	cursor:pointer;
	border:solid 2px transparent;
	border-radius:3px;
}
input[type='button']:hover,input[type='submit']:hover{
	font-weight:bold;
	/color:black;
	background:rgba(0,100,150,1);
}
</style>
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
		msg='<?php echo $asd->msg;?>';
		if(msg!='')
		{
			$('#msg_container').show();
			$('#message').text(msg);
			window.history.replaceState("","", "index.php");
		}
	});
</script>

<body onload="matrix()">
<canvas width="849" height="587" id="c"></canvas>
<div id='msg_container'><center><p id='message'></p></center></div>
<div id='main_container'>
	<span id='main_title'>Nerdz'15</span><br>
	<span id='presents'>presents</span><br>
	<span id='greyhats'>Grey Hats</span><br>
	<span id='about'></span>
	<br><br>
	<input type='button' onclick="window.location='http://nerdz15.com/register/'" value='Register'>
	<input type='button' onclick="window.location='login.php'" value='Enter the Arena'>
</div>
</body>
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
	setInterval(draw, 40);
}	
</script>

</html>