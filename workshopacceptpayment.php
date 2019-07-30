<?php 
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','moderator'");

if(isset($_GET['moderator'],$_GET['moderatorid'],$_GET['moderatorcode'],$_GET['hspzcode'],$_GET['m']) === true)
{
	$moderator = sanitize($_GET['moderator']);
	$moderatorid = sanitize($_GET['moderatorid']);
	$moderatorcode = sanitize($_GET['moderatorcode']);
	$hspzcode = sanitize($_GET['hspzcode']);
	$m = sanitize($_GET['m']);

	if(password_verify($user_data['username'].$user_data['user_id'],$moderator) && password_verify($user_data['email_code'],$moderatorid) && password_verify($user_data['email_code'],$m) && ($moderatorcode===(md5($user_data['email_code']).md5($user_data['user_id']))) && ($hspzcode ===md5($user_data['email'].$user_data['user_id']).md5($user_data['user_id'].$user_data['email'])) )
	{
		include 'includes/overall/header.php';

		$active_workshop_id = active_workshop_of($user_data['member']);
		if($active_workshop_id === false)
		{





			echo "There is not any active workshop.";







		}
		else
		{
			$workshop_hash = active_workshop_hash_of($user_data['member']);
			$workshop = workshop_details_from_hash($workshop_hash);

?>
		<div class="well">
			<div class="well well-wb well-blue">
				<h3><?php echo $workshop->name; ?></h3>
			</div>

			<form action='' method="POST" autocomplete='off'>
				<div class="well-wb well well-blue">
					<label for="email"><b><i class="fa fa-search"></i> Find Student</b></label>
					<div class="input-group margin-bottom-sm">
					  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw well-blue"></i></span>
					  <input class="form-control well-blue" type="email" name='email' id='email' placeholder="ahmadzafir01@onlinehit.co.in"
					  	<?php if(isset($_POST['email']) === true and empty($_POST['email']) === false)
					  	{
					  		echo "value='".$_POST['email']."'";
					  		} ?>
					  >
					</div>
					<input type="submit" class="form-control btn btn-success" name="submit" value="Find and make payment!">
				</div>
			</form>

			<?php 
			if(isset($_POST['submit'])===true)
			{
			 	echo "Form submitted!";
			}
			else
			{
				waited_students_for_workshop($workshop->id);
			}
			?>


		</div>
	
<?php
		}

		include 'includes/overall/footer.php';
	}
	else
	{
		header("Location:logout.php");
	}
}
else
{
	header("Location:logout.php");
}
 ?>

 