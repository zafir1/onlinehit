<?php 
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','ieee_head'");

if(isset($_GET['wkspid'],$_GET['adminID'],$_GET['AdminQRCODE']) === true)
{
	$workshop_hash 		= sanitize($_GET['wkspid']);
	$user_id 			= sanitize($_GET['adminID']);
	$user_vid 			= sanitize($_GET['AdminQRCODE']);

	if(workshop_hash_exits($workshop_hash) === false)
	{
		header('Location:index.php');
	}
	else if($user_id != substr(md5($user_data['user_id']),8,10))
	{
		header('Location:index.php');
	}
	else if($user_vid != md5(substr(md5($user_data['user_id']),8,10)))
	{
		header('Location:index.php');
	}
	else
	{
		include 'includes/overall/header.php';


		include 'includes/overall/footer.php';
	}
}
?>