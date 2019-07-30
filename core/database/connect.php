<?php 

	$localhost 	= "localhost";
	$user 		= "root";
	$password 	= "";
	$data_base 	= "lr";

	$error_message = "Sorry we are facing connection problems.";

	mysql_connect($localhost,$user,$password) or die($error_message);
	
	mysql_select_db($data_base) or die($error_message);

	$db = new mysqli("127.0.0.1",'root','','lr');
	if($db->connect_errno)
	{
		die('Sorry we are facing some problems');
	}

	@$dbevents = new mysqli("127.0.0.1", 'root','','events');
	if($dbevents->connect_errno)
	{
		die('Sorry we are unable to connect our events database');
	}

	@$dbchat = new mysqli("127.0.0.1", 'root','','chat');
	if($dbevents->connect_errno)
	{
		die('Sorry we are unable to connect our Chat database');
	}

?>