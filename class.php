<?php

	class main
	{
		var $con,$sign,$name,$user_id,$msg;
		
		function connect()
		{
			$this->con=mysqli_connect("localhost","root","123456","greyhats")
			or die("Couldn't connect to SQL Server ".mysqli_connect_errno());

			$query="CREATE TABLE IF NOT EXISTS users(
					sno INT primary key NOT NULL AUTO_INCREMENT,
					name VARCHAR(20) NOT NULL,
					email VARCHAR(20) NOT NULL,
					password VARCHAR(32) NOT NULL,
					stage INT NOT NULL DEFAULT 0,
					time INT NOT NULL DEFAULT 600000,
					institution VARCHAR(20),
					phone VARCHAR(20),
					date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
				)";
			$q=mysqli_query($this->con,$query) or die('Error in creating the table U');
			$query="CREATE TABLE IF NOT EXISTS questions(
					sno INT primary key NOT NULL AUTO_INCREMENT,
					question TEXT NOT NULL,
					option1 TEXT NOT NULL,
					option2 TEXT NOT NULL,
					option3 TEXT NOT NULL,
					option4 TEXT NOT NULL,
					correct_option INT NOT NULL,
					date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
				)";
			$q=mysqli_query($this->con,$query) or die('Error in creating the table Q');
			$query="CREATE TABLE IF NOT EXISTS final_stage(
					sno INT primary key NOT NULL AUTO_INCREMENT,
					email VARCHAR(20) NOT NULL,
					link VARCHAR(100) NOT NULL,
					date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
				)";
			$q=mysqli_query($this->con,$query) or die('Error in creating the table F');
		}
				
		function disconnect()
		{
			mysqli_close($this->con);
			$this->con=NULL;
		}
		
		function login($email,$password)
		{
			$email=mysqli_real_escape_string($this->con,strip_tags(trim($email)));
			$password=md5(mysqli_real_escape_string($this->con,strip_tags(trim($password))));

			$query="select * from users where email='$email' and password='$password' and stage!=404 LIMIT 1";
			$q=mysqli_query($this->con,$query) or die('Something went wrong.. Try reloading the page!');

			$num_rows=mysqli_num_rows($q);
			if($q && $num_rows==1)
			{
				session_start();
				$_SESSION['token']=rand(1000000000,9999999999);
				$_SESSION['email']=$email;
				return 1;
			}
			else
			{
				return 0;
			}
		}

		function update_login_status()
		{
			session_start();
			if(isset($_SESSION['token']))
			{
				$this->sign='true';
				if(isset($_SESSION['email']))
				{
					$this->user_id=mysqli_real_escape_string($this->con,strip_tags(trim($_SESSION['email'])));

					$query="select * from users where email='$this->user_id'";
					$exe=mysqli_query($this->con,$query);
					$result=mysqli_fetch_assoc($exe);
					$this->name=$result['name'];
				}
				else
				{
					$this->offline();
				}
			}
			else
			{
				$this->offline();
			}
		}
		function offline()
		{
			if(!isset($_SESSION['token']))
			{
				session_start();
			}
			$_SESSION['token']=NULL;
			$_SESSION['email']=NULL;
			$this->sign='false';
			$this->user_id=NULL;
			$this->name=NULL;
			session_destroy();
		}
		function redirect_if()
		{
			if($_SESSION['token']==NULL || $_SESSION['email']==NULL || $this->sign=='false' || $this->user_id==NULL ||  $this->name==NULL)
			{
				header('location:login.php?x=Please+login+first+!!!');
			}
		}
		function grab_info()
		{
			echo 'asdasdasd';
		}
		function update_stage($stage)
		{
			$stage=mysqli_real_escape_string($this->con,strip_tags(trim($stage)));
			$query="update users set stage=$stage where email='".$_SESSION['email']."'";
			$exe=mysqli_query($this->con,$query) or die('Error in the setting the stage...');
		}
		function check_stage($source_stage)
		{
			$query="select stage from users where email='".$_SESSION['email']."'";
			$exe=mysqli_query($this->con,$query) or die('Error in the checking the stage...');

			$q=mysqli_fetch_array($exe);

			if($q[0]==404||$q[0]==111)
			{
				header('location:login.php?x=See+You+Next+Year');
			}
			else if($source_stage!=$q[0])
			{
				if($q[0]==0)
				{
					header("location:login.php");
				}
				else
				{
					header("location:l$q[0].php");
				}
			}
		}
		function time_left()
		{
			$query="select time from users where email='$this->user_id' LIMIT 1";
			$q=mysqli_query($this->con,$query) or die('..Reload..');
			$q=mysqli_fetch_array($q);
			if($q[0]<=0)
			{
				return 0;
			}
			else
			{
				return $q[0];
			}
		}
		function update_time()
		{
			$query="update users set time = time-30000 where email = '$this->user_id'";
			$q=mysqli_query($this->con,$query)or die('Error in updatng time..');
		}
		function any_messages()
		{
			if(isset($_REQUEST['x']))
			{
				$this->msg=mysqli_real_escape_string($this->con,strip_tags(trim($_REQUEST['x'])));
				$this->msg=urldecode($this->msg);
			}
			else
			{
				$this->msg=NULL;
			}
		}
		function display_questions(){
			$query="select * from questions";
			$exe=mysqli_query($this->con,$query) or die('Error in retrieving the data... Try reloading...');

			while($q=mysqli_fetch_assoc($exe))
			{
				echo "
					<span class='mcq_question'>Q".$q['sno'].")".$q['question']."</span><br>
					<br><input type='radio' name='".$q['sno']."' value='1' checked>".$q['option1']."
					<br><input type='radio' name='".$q['sno']."' value='2'>".$q['option2']."
					<br><input type='radio' name='".$q['sno']."' value='3'>".$q['option3']."
					<br><input type='radio' name='".$q['sno']."' value='4'>".$q['option4']."

					<br><br>
				";
			}
		}
		
	}

?>