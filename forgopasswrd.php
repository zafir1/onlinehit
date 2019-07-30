<?php 
include "core/init.php";
logged_in_redirect();
include 'includes/overall/header.php';
?>

<div class="well">
	<div class="well well-wb well-blue">
		<h3>
			<span class="fa fa-question-circle-o"></span>
			Forgot Password?
			<br>
			<small>
				<span class="glyphicon glyphicon-paperclip"></span> Don't Worry we will help you in recovery
			</small>
		</h3>
	</div>
	<?php 
		if(isset($_POST['submit']) === true)
		{
			if(empty($_POST['email']) === true)
			{
				$errors[] = "Please provide a valid registered email address";
			}
			if(empty($_POST['username']) === true)
			{
				$errors[] = "Please provide a valid username.";
			}
			
			if(empty($errors) === true)
			{
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
				{
				 	$errors[] = "A valid email address is required.";
				}
				if(empty($errors) === false)
				{
					echo output_errors($errors);
				}
			}
			else
			{
				echo output_errors($errors);
			}
		}
		if(isset($_POST['submit']) === true and empty($errors) === true)
		{
			$username 	= sanitize($_POST['username']);
			$email 		= sanitize($_POST['email']);
			$check_user = email_username_combo_exists($username,$email);

			if(!$check_user===true)
			{
				$smile = "frown-o";
				$greeting = "Sorry!";
				$message = "We couldn't find this <b>$username</b> and <b>$email</b> combination. <br> Please try again with correct credientals.";
				$link = "index.php";
				$button_text = "Home";
				$button_color = "primary";
				$extra_flash = "";
				?>
				<div class=" well well-wb well-blue">
					<?php greeting_card($smile,$greeting,$message,$link,$button_text,$button_color,$extra_flash,1); ?>
				</div>
				<?php
				
			}
			else{				
				$smile = "smile-o";
				$greeting = "Thank you!";
				$message = "We have sent you an email on your provided email-ID.<br> <b>Please check your email.</b>";
				$link = "index.php";
				$button_text = "Home";
				$button_color = "primary";
				$extra_flash = "<small class='time'>(Please wait for 5-minutes. Email is on the way.)</small><br>";
				?>
				<div class=" well well-wb well-blue">
				<?php 

				recover_forgot_password($username,$email);

				greeting_card($smile,$greeting,$message,$link,$button_text,$button_color,$extra_flash,1); 
				?>
				</div>
				<?php
			}

		}
		

	 ?>
	<div class="well well-wb well-blue">
		<form action='forgopasswrd.php' method="POST" class="form" autocomplete="off">
				<ul>
					<li>
					<label for="username">
						<b><span class="glyphicon glyphicon-hand-right"></span> Type your username</b><br>
					</label>
						
						<div class="input-group margin-bottom-sm">
  							<span class="input-group-addon">
  								<i class="fa fa-envelope-o fa-fw well-blue"></i>
  							</span>
  							<input name='username' id='username' class="form-control well-blue" type="text" placeholder="Enter your username...">
						</div>
					</li>
					<br>

					<li>
					<label for="email">
						<b><span class="glyphicon glyphicon-hand-right"></span> Type your Email-ID</b><br>
					</label>
						
						<div class="input-group margin-bottom-sm">
  							<span class="input-group-addon">
  								<i class="fa fa-envelope-o fa-fw well-blue"></i>
  							</span>
  							<input name='email' class="form-control well-blue" type="email" placeholder="ahmadzafir@onlinehit.co.in">
						</div>
					</li>
					<li>
						<input type="submit" name="submit" value="Find" class="btn btn-primary">
					</li>
				</ul>
				
			</form>
	</div>
</div>


<?php 
	include 'includes/overall/footer.php';

 ?>