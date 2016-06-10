<?php
	require 'class.php';
	$asd=new main();
	$asd->connect();
	$asd->update_login_status();
	$asd->redirect_if();
	$asd->check_stage(0);
	$asd->update_time();
	$asd->disconnect();
?>