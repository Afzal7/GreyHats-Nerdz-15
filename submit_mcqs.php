<?php
	require 'class.php';
	$asd=new main();
	
	$asd->connect();

	if(mysqli_real_escape_string($asd->con,strip_tags(trim($_POST['1'])))=='')
	{
		header('location:mcqs.php');
	}

	$asd->update_login_status();
	$asd->redirect_if();
	$asd->check_stage(0);
?>
<html>
<head>
	<title>MCQs Result</title>
<link rel="stylesheet" href="main.css">
<style type="text/css">
	body{
	  background: -webkit-linear-gradient(90deg, #7474BF 10%, #348AC7 90%); /* Chrome 10+, Saf5.1+ */
  background:    -moz-linear-gradient(90deg, #7474BF 10%, #348AC7 90%); /* FF3.6+ */
  background:     -ms-linear-gradient(90deg, #7474BF 10%, #348AC7 90%); /* IE10 */
  background:      -o-linear-gradient(90deg, #7474BF 10%, #348AC7 90%); /* Opera 11.10+ */
  background:         linear-gradient(90deg, #7474BF 10%, #348AC7 90%); /* W3C */
	}
</style>
</head>
<body>	
<?php
	$cut_offs=5;
	$marks=0;

	$q=mysqli_query($asd->con,"select count(sno) from questions");
	$limit=mysqli_fetch_array($q);

	$ques=1;
	while($ques<=$limit[0])
	{
		$answer=mysqli_real_escape_string($asd->con,strip_tags(trim($_POST[$ques])));
		if($answer=='')
		{
			header('location:mcqs.php');
		}	
		
		$query="select * from questions where sno=$ques and correct_option=$answer LIMIT 1";
		$exe=mysqli_query($asd->con,$query) or die('Error in checking the answers...');

		$num_rows=mysqli_num_rows($exe);
		if($num_rows==1)
		{
			$marks+=1;
		}

		$ques+=1;
	}
	if($marks>=$cut_offs)
	{
		$asd->update_stage(1);
		?>
		<div id='main_container'>
			<div id='login_form_container'>
				<h1>Well Done!</h1>
				<br>
				<span>
					You have cleared the MCQs level with a score of <?php echo $marks?> out of <?php echo $limit[0]?><br>
				</span>
				<br>
				<input type='button' value='Proceed' onclick='window.location="l1.php"'>
			</div>	
		</div>
		<?php
	}
	else
	{
		$asd->update_stage(404);
		?>
		<div id='main_container'>
			<div id='login_form_container'>
				<h1>Unfortunately!</h1>
				<br>
				<span>
					Your journey ends here. See you next year. <br> <br>
					You have scored only <?php echo $marks?> out of <?php echo $limit[0]?>
				</span>
			</div>	
		</div>
		<?php
	}
	$asd->disconnect();

?>