<?php 
include "core/init.php";
logged_in_redirect();
if(isset($_GET['AsPXmkNhT'],$_GET['s'],$_GET['ecod'],$_GET['email'],$_GET['kec'])===false)
{
	echo "Link is not correct";
	die();
}
$email = sanitize($_GET['email']);
$aspx = sanitize($_GET['AsPXmkNhT']);
$kec = sanitize($_GET['kec']);
$s = sanitize($_GET['s']);
$ecod = sanitize($_GET['ecod']);


$link = "rfpp.php?AsPXmkNhT=".$aspx."&kec=".$kec."&s=".$s."&email=".$email."&ecod=".$ecod;

if(email_exists($email)===false)
{
	echo "Email does not exists.";
	die();//header("Location:index.php");
}
$user_data = user_data(user_id_from_email($email),'user_id','username','password','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id','active');

include 'includes/overall/header.php';

if($user_data['active']!=1)
{
?>
	<div class="well">
		<div class="well well-blue well-wb">
			<h3><i class="glyphicon glyphicon-registration-mark"></i> Reset Password <br><small>
				<i class="fa fa-user"></i>  <b><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?></b>
			</small></h3>
		</div>

		<div class="well well-wb well-blue">
			<?php 
				$smile = "frown-o";
				$greeting = "Sorry!";
				$message = "Your account is not activated. Please activate your account first.";
				$link = "activate.php";
				$button_text = "Activate Account";
				$button_color = "success";
				$extra_flash = "";
				$is_button = 1;
				greeting_card($smile,$greeting,$message,$link,$button_text,$button_color,$extra_flash,$is_button)
			?>
		</div>
	</div>

<?php
}
else if(isset($_GET['change']) && (sanitize($_GET['change'])==="Success"))
{
	// Password successfully changed message flash. 
	?>
		<div class="well">
			<div class="well well-blue well-wb">
				<h3><i class="glyphicon glyphicon-registration-mark"></i> Password Changed <br><small>
					<i class="fa fa-user"></i> <b><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?></b><br>
					<i class="fa fa-envelope"></i> <?php echo $email; ?>
				</small></h3>
			</div>
			<div class="well well-blue well-wb">
			<?php 
				// Greeting to the the user for successful password changed.
				$smile = "smile-o";
				$greeting = "Thank you!";
				$message = "<b>We have successfully changed your password.</b>";
				$link = "index.php";
				$button_text = "Home";
				$button_color = "success";
				$extra_flash = "";
				$is_button = 1;
				greeting_card($smile,$greeting,$message,$link,$button_text,$button_color,$extra_flash,$is_button)

			 ?>
			</div>
		</div>

	<?php
}
else
{
	if(password_verify($user_data['password'],$aspx)===false){
		$errors[] = "Password not matched";
	}
	if(password_verify($user_data['email_code'],$kec)===false){
		$errors[] = "hash version of email_code does not matched";
	}
	if(password_verify($user_data['password'].$user_data['user_id'],$s)===false){
		$errors[] = "s does not matched";
	}
	if(password_verify($user_data['username'],$ecod)===false){
		$errors[] = "ecod doesnot matched";
	}

	if(empty($errors)===true)
	{

	?>
		<div class="well">
			<div class="well well-blue well-wb">
				<h3><i class="glyphicon glyphicon-registration-mark"></i> Reset Password <br><small>
					<i class="fa fa-user"></i> <b><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?></b><br>
					<i class="fa fa-envelope"></i> <?php echo $email; ?>
				</small></h3>
			</div>
	<?php
		if(isset($_POST['submit']))
		{
			if((empty($_POST['new_password']) || empty($_POST['re_new_password'])) === true)
			{
				$errors[] = "<b>Both password fields are require.</b>";
			}
			if(empty($errors)===true)
			{
				$password 			= sanitize($_POST['new_password']);
				$confirm_password 	= sanitize($_POST['re_new_password']);

				if(strlen($password) < 6){
					$errors[] = "Password must be greatter then 6 characters.";
				}

				if(empty($errors)===true)
				{
					if($password === $confirm_password)
					{
						// echo "Yes now password can be changed";
						// Changing Password;
						change_password($user_data['user_id'],$password);
						$moving_link = $link."&change=Success";
						header("Location:$moving_link");
					}
					else
					{
						$errors[] = "Both passwords are not matching.";
						echo output_errors($errors);
					}
				}
				else
				{
					echo output_errors($errors);
				}
				
			}
			else
			{
				echo output_errors($errors);
			}
		}

	?>

			<div class="well well-wb well-blue">
				<form method="POST" action="<?php echo $link; ?>" autocomplete="off" class="form">
					<ul>
						<li>
							<label for="new_password">
								<strong><span class="glyphicon glyphicon-hand-right"></span> New Password 
									<small>
										<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
									</small>
								</strong>
							</label>
							<br>
							<input type="password" id='new_password' class="form-control well-blue" name="new_password" placeholder="Enter your new password...">
							<span id="float_right" title="Please don't include any spaces.">More then 6 character</span>
						</li>
						<br>
						<li>
							<label for="re_new_password">
								<strong><span class="glyphicon glyphicon-hand-right"></span> Confirm new Password 
									<small>
										<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
									</small>
								</strong>
							</label>
							<br>
							<input type="password" id='re_new_password' class="form-control well-blue" name="re_new_password" placeholder="Confirm your new password...">
							<span id="float_right" title="Both password fields should match...">Confirm new password</span>
						</li>
						<br>
						<li>
							<input type="submit"  name="submit" value="Change Password" class="btn btn-primary">
						</li>
					</ul>
				</form>
			</div>
		</div>
	<?php
	}
	else
	{
	?>
	<div class="well">
			<div class="well well-blue well-wb">
				<h3><i class="fa fa-exclamation-triangle"></i> Link Error! <br><small>
					<i class="fa fa-user"></i> <b><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?></b><br>
					<i class="fa fa-envelope"></i> <?php echo $email; ?>
				</small></h3>
			</div>
			<div class="well well-blue well-wb">
			<?php 
				// Greeting to the the user for successful password changed.
				$smile = "frown-o";
				$greeting = "Sorry!";
				$message = "<b>Something went wrong.</b>";
				$link = "index.php";
				$button_text = "Home";
				$button_color = "success";
				$extra_flash = "<span class='time'>(Please provide latest and correct link.)<br></span>";
				$is_button = 1;
				greeting_card($smile,$greeting,$message,$link,$button_text,$button_color,$extra_flash,$is_button)

			 ?>
			</div>
		</div>
	<?php
	}
}

include "includes/overall/footer.php";
?>