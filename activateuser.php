<?php 
include "core/init.php";
logged_in_redirect();
include 'includes/overall/header.php';

?>
	<div class="well">
		<div class="well well-wb well-blue">
			<h2>
				<span class="fa fa-check-circle-o"></span>
				Account verification
				<br>
				<small>
					<span class="glyphicon glyphicon-paperclip"></span> Verify account and feel free to login
				</small>
			</h2>

		</div>
		
	</div>
<?php
		if(isset($_GET['email'],$_GET['KoDEmLIYGFFhf356'],$_GET['nKpoDh']) === true)
		{
			$email 		= sanitize($_GET['email']);
			$email_code = sanitize($_GET['KoDEmLIYGFFhf356']);
			$new_code 	= sanitize($_GET['nKpoDh']);
			if($new_code != md5(substr($email_code,5,10))){
				$errors[] = "nKpoDh Don't match";
			}
			if(email_exists($email) === false)
			{
				$errors[] = "Invalid link";
			}
			if(empty($errors) === true)
			{
				if(activate($email,$email_code) === true)
				{
					echo "Successfully verified";
				}
			}
			
		}
		else if(isset($_GET['mailsent']) === true)
		{
		?>
		<div class="well">
			<div class="well well-wb well-blue">
				<div class="card text-center">
				  <div class="card-header">
				    <span class="fa fa-smile-o" id='big_smile'></span>
				  </div>
				  <div class="card-block">
				    <h4 class="card-title">We are glad to see you here</h4>
				    <p class="card-text lead"><span class="fa fa-check-circle"></span> Account verified <br> </p>
				    <a href="index.php" class="btn btn-primary">
				    <span class="fa fa-sign-in"></span> Home
				    </a>
				  </div>
				  <div class="card-footer text-muted">
				    OnlineHIT
				  </div>
				</div>
			</div>
		</div>

		<div class="well">
			<div class="well well-wb well-blue">
				<div class="card text-center">
				  <div class="card-header">
				    <span class="fa fa-smile-o" id='big_smile'></span>
				  </div>
				  <div class="card-block">
				    <h4 class="card-title">Thank you!</h4>
				    <p class="card-text lead">Check your email for account activation</p>
				    <a href="#" class="btn btn-primary">
				    <span class="fa fa-home"></span> Home
				    </a>
				  </div>
				  <div class="card-footer text-muted">
				    OnlineHIT
				  </div>
				</div>
			</div>
		</div>

			

		<?php
		}
		else
		{

 ?>


	<?php
		if(isset($_POST['submit']) === true)
		{
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
			{
			 	$errors[] = "A valid email address is required.";
			}
			if(email_exists($_POST['email']) === false)
			{
			 	$errors[] = "Sorry we can't find that email.";
			}
			if(empty($errors) === true)
			{
				$email = sanitize($_POST['email']);
				if(has_activated($email) === true)
				{
					$errors[] = "This user has already activated his/her account.";
				}
				if(empty($errors) === true)
				{
					make_a_new_link_for_activation($email);
					echo "<br>Fine.";
					

				}
				else
				{
					echo output_errors($errors);
				}
			}
		} 
	?>

	<div class="well">
		<div class="well-wb well well-blue">
			<form action='activateuser.php' method="POST" class="form" autocomplete="off">
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
						<input type="submit" name="submit" value="Send Link" class="btn btn-primary">
					</li>
				</ul>
				
			</form>
		</div><span id='float_right'>Please provide latest link for account activation</span>
	</div>

	



<?php
}
include 'includes/overall/footer.php';
?>