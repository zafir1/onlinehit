<?php 
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','moderator'");

if(isset($_GET['kxps'],$_GET['l'],$_GET['m'],$_GET['mn'])===true)
{
	$kxps = sanitize($_GET['kxps']);
	$l = sanitize($_GET['l']);
	$m = sanitize($_GET['m']);
	$mn = sanitize($_GET['mn']);

	$workshop_hash = active_workshop_hash_of($user_data['member']);
	if($workshop_hash == false)
	{
		header('Location:logout.php');
		exit();
	}
	$workshop = workshop_details_from_hash($workshop_hash);

	if(($client_id = user_id_from_email_code($m))!== false)
	{

		$client_data = user_data($client_id,'user_id','username','password','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id','faculty');

		if(confirm_user_id_for_workshop_id($client_id,$workshop->id,0) === false)
		{
			header('Location:logout.php');
			exit();
		}

		if(($kxps===md5($user_data['email'].$client_data['user_id'].$user_data['user_id'])) && (password_verify($user_data['user_id'].$client_data['email_code'].$client_data['email'],$l)) && ($mn===md5($user_data['user_id'].substr($user_data['email_code'],5,6).substr($client_data['email_code'],5,8).$client_data['user_id'])) )
		{
			include 'includes/overall/header.php';
?>

		<div class="well">
			<div class="well well-wb well-blue">
				<h3>
					<i class="fa fa-paypal"></i> Assure Payment <br>
					<small>
						<span class="glyphicon glyphicon-paperclip"></span> <?php echo $workshop->name; ?>
					</small>
				</h3>
			</div>

			<div class="well well-wb well-blue">
				<div class="card text-center">

				  <div class="card-header lead">
				    <h1><i class="fa fa-paypal"></i></h1>
				  </div>
				  <div class="card-block">
				  	<b><?php echo $client_data['first_name'].' '.$client_data['last_name']; ?></b>
					  	<br><?php if($client_data['uni_roll']){ echo '('.$client_data['uni_roll'].')'; } ?><br>
					  	<i class="time-h"><?php echo $client_data['email']; ?></i>
				  	<br>
				    <h4 class="card-title">Dear <b><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?> </b> </h4>
				    <p class="card-text">Please make sure that you have accepted <i class="fa fa-inr"></i> <b><?php echo $workshop->fee; ?></b> from the applicant.</p>
				    <a href="knfrmpyment.php?knfrm=<?php echo password_hash($user_data['user_id'].$user_data['email_code'].$client_data['user_id'],PASSWORD_DEFAULT); ?>&moderator=<?php echo password_hash($client_data['user_id'].$user_data['user_id'].$workshop->id,PASSWORD_DEFAULT); ?>&aspx=<?php echo $client_data['email_code']; ?>&client=<?php echo password_hash($client_data['email_code'],PASSWORD_DEFAULT); ?>" class="btn btn-success"><i class="fa fa-check-square-o"></i> Confirm Paymnet</a>
				  </div>
				  <div class="card-footer text-muted">
				    OnlineHIT
				  </div>
				</div>
			</div>

		</div>






<?php
			include 'includes/overall/footer.php';
		}
		else
		{
			header("Location:logout.php");
		}


	}else{
		header("Location:logout.php");
	}
}
else
{
	header("Location:logout.php");
}
	
 ?>