<?php 
	include "core/init.php";
	//protected_page();
	include "includes/overall/header.php";
	
?>
	<div class="well">
		<div class="well well-blue well-wb">
			<h2><i class="fa fa-sign-in"></i> Login <br>
			<small>
				<span class="glyphicon glyphicon-paperclip"></span> 
				Authentication Failed.
			</small>
			</h2>
		</div>
	</div>
	
	

<?php
	if(isset($_POST['submit']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username)=== true or empty($password)=== true) {
			$errors[] = "Both username and password is required!";
		}
		else if(user_exists($username) === false)
		{
			$errors[] = "<b> ". $username. "</b> doesn't exist.";
		}
		else if(user_active($username) === false)
		{
			$errors[] = "Your account is not activated. Please activate your account.";
		}
		else
		{
			if(strlen($username) > 32)
			{
				$errors[] = "username must be less than 32 character.";
			}
			if(strlen($password) > 32)
			{
				$errors[] = "password must be less than 32 character.";
			}

			$login = login($username, $password);

			if($login === false)
			{
				$errors[] = "<b>username and password combination is incorrect.</b>";
			}
			else
			{
				$_SESSION['user_id'] = $login;
				header("Location: index.php");
			}
		}
	}

?>
<div class="well">
			<div class="well well-wb well-blue">
				<div class="card text-center">
				  <div class="card-header">
				    <span class="fa fa-frown-o" id='big_smile'></span>
				  </div>
				  <div class="card-block">
				    <h4 class="card-title">Sorry!</h4>
				    <p class="card-text lead"> <?php 

				    if(empty($errors) === false)
				    {
				    	echo output_errors($errors);
				    }

				     ?> Please try again with correct credientals.</p>
				    <a href="index.php" class="btn btn-primary">
				    <span class="fa fa-sign-in"></span> Home
				    </a>
				  </div>
				  <div class="card-footer text-muted">
				  <i class="time"> If you are facing problems, Please contact us on our <b>contact us</b>  page. <br></i>
				    OnlineHIT
				  </div>
				</div>
			</div>
		</div>

<?php

	include "includes/overall/footer.php";

?>