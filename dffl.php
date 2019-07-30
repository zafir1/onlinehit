<?php 
include "core/init.php";
protected_page();
faculty_protected();
hod_protect();
	
	if(isset($_GET['hoid']) === true and isset($_GET['user']) === true and isset($_GET['usercode']) === true)
	{
		if(empty($_GET['hoid']) === false and empty($_GET['user']) === false and empty($_GET['usercode']) === false)
		{
			$user = (int)sanitize($_GET['user']);
			$usercode = sanitize($_GET['usercode']);
			delete_from_faculty_list($user,$usercode);
			header('Location:upgradetoteacher.php');
		}
		else
		{
			header('Location:index.php');
		}
	}
	else
	{
		header('Location: index.php');
	}
?>
