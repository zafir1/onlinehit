<?php
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','moderator'");

$workshop_hash = active_workshop_hash_of($user_data['member']);
if($workshop_hash == false)
{
	header('Location:logout.php');
	exit();
}
$workshop = workshop_details_from_hash($workshop_hash);

if(isset($_GET['nazir'],$_GET['zafir'],$_GET['nasir'],$_GET['arfunarsi'],$_GET['hateorg']))
{
	$knfrm = sanitize($_GET['nazir']);
	$aspx = sanitize($_GET['zafir']);
	$moderator = sanitize($_GET['nasir']);
	$client = sanitize($_GET['arfunarsi']);
	$hateorg = sanitize($_GET['hateorg']);

	if(($client_id = user_id_from_email_code($aspx))!== false)
	{
		$client_data = user_data($client_id,'user_id','username','password','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id','faculty');

		if(confirm_user_id_for_workshop_id($client_id,$workshop->id,0) === false)
		{
			header('Location:logout.php');
			exit();
		}

		if(password_verify($user_data['user_id'].$user_data['email_code'].$client_data['user_id'],$knfrm) && password_verify($client_data['user_id'].$user_data['user_id'].$workshop->id,$moderator) && password_verify($client_data['email_code'],$client) && password_verify($client_data['email'],$hateorg))
		{
			include 'includes/overall/header.php';

			

			$payment_status = complete_payment_for_workshop($client_data['user_id'],$workshop->id,$user_data['user_id']);
			if($payment_status === true)
			{
				header("Location:generateworkshopreceipt.php?applicant=".password_hash($client_data['user_id'].$client_data['email_code'].$user_data['user_id'].$workshop->id,PASSWORD_DEFAULT)."&preceiver=".$client_data['email_code']."&code=".password_hash($workshop->id.$user_data['user_id'].$client_data['user_id'].$user_data['email_code'],PASSWORD_DEFAULT));
			}
			else{
				?>
				<div class="card text-center">
				  <div class="card-header">
				    Sorry
				  </div>
				  <div class="card-block">
				    <h4 class="card-title">Something Went wrong.</h4>
				    <p class="card-text">We are unable to accept payment this time. Please Report this to <b>Zafir Ahmad</b> and stop accepting payment.</p>
				    <a href="index.php" class="btn btn-primary">Home</a>
				  </div>
				  <div class="card-footer text-muted">
				    2 days ago
				  </div>
				</div>

				<?php
			}
			include 'includes/overall/footer.php';
		}
	}
	else
	{
		header('Location:logout.php');
	}


}else{
	header('Location:logout.php');
}

?>