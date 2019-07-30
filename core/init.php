<?php
	session_start();
	// error_reporting(0);
	require "database/connect.php";
	require "functions/users.php";
	require "functions/general.php";
	require "functions/library_function.php";
	require "functions/pages.php";
	require "functions/teachers_post.php";
	require "functions/userteacher.php";
	require "functions/cards.php";
	require "functions/university.php";
	require "functions/events.php";
	require "functions/chat.php";

	if(logged_in() === true)
	{
		$session_user_id = $_SESSION['user_id'];
		$user_data = user_data($session_user_id,'user_id','username','password','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id','faculty');
		if(user_active($user_data['username']) === false)
		{
			session_destroy();
			header("Location: index.php");
			exit();
		}
		
		
	}

	$errors = array();
	define('CURRENT_TIME', "CURRENT_TIMESTAMP");
	$website = "http://localhost/newlrn";
	
	
?>