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

if(isset($_GET['knfrm'],$_GET['aspx'],$_GET['moderator'],$_GET['client']))
{
	$knfrm = sanitize($_GET['knfrm']);
	$aspx = sanitize($_GET['aspx']);
	$moderator = sanitize($_GET['moderator']);
	$client = sanitize($_GET['client']);

	if(($client_id = user_id_from_email_code($aspx))!== false)
	{
		$client_data = user_data($client_id,'user_id','username','password','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id','faculty');

		if(confirm_user_id_for_workshop_id($client_id,$workshop->id,0) === false)
		{
			header('Location:logout.php');
			exit();
		}

		if(password_verify($user_data['user_id'].$user_data['email_code'].$client_data['user_id'],$knfrm) && password_verify($client_data['user_id'].$user_data['user_id'].$workshop->id,$moderator) && password_verify($client_data['email_code'],$client))
		{
			include 'includes/overall/header.php';
?>
		<div class="well">
			<div class="well well-wb well-blue">
				<div class="card text-center">
				  <div class="card-header">
				    <h1>	
					<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Loading...</span>
				    </h1>
				  </div>
				  <div class="card-block">
				    <h4 class="card-title">Please wait...</h4>
				    <p class="card-text lead">We are uploading your payment request on serer.</p>
				  </div>
				  <div class="card-footer text-muted">
				   OnlineHIT
				  </div>
				</div>
			</div>
		</div>

		<?php header('Location:completepayment.php?nazir='.$knfrm.'&zafir='.$aspx.'&nasir='.$moderator.'&arfunarsi='.$client.'&hateorg='.password_hash($client_data['email'],PASSWORD_DEFAULT)); ?>

<?php
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