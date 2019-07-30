<?php 
include "core/init.php";
logged_in_redirect();
include 'includes/overall/header.php';
?>

<div class="well">
	<div class="well well-wb well-blue">
		<h2>
			<span class="fa fa-question-circle-o"></span>
			Forgot username?
			<br>
			<small>
				<span class="glyphicon glyphicon-paperclip"></span> We will help you to find your username
			</small>
		</h2>
	</div>
	<?php 
		if(isset($_POST['submit']) === true)
		{
			if(empty($_POST['email']) === true)
			{
				$errors[] = "Please provide a valid registered email address";
			}
			if(empty($errors) === true)
			{
				if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
				{
				 	$errors[] = "A valid email address is required.";
				}
				if(email_exists($_POST['email']) === false)
				{
				 	$errors[] = "Sorry we can't find that email.";
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
			recover_username($_POST['email']);
		}
		

	 ?>
	<div class="well well-wb well-blue">
		<form action='forgousrname.php' method="POST" class="form" autocomplete="off">
				<ul>
					<li>
						<b> Type your Email-ID</b><br>
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