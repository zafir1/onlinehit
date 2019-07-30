<?php
    include "core/init.php";
    protected_page();
    if(isset($_POST['submit']) === true)
    {
    	$required_fields = array('current_password','password','password_again');
    	foreach ($_POST as $key => $value) 
    	{
			if(empty($value) and in_array($key, $required_fields) === true)
			{
				$errors[] = "Fields mark with an asterisk is required!";
				break 1;
			}
		}
    
    if(empty($errors) === true)
    {
    	if(md5($_POST['current_password']) === $user_data['password'])
    	{
    		if(trim($_POST['password']) !== trim($_POST['password_again']))
    		{
    			$errors[] = "Your current password don't match.";
    		}
    		if(strlen($_POST['password']) < 6)
    		{
    			$errors[] = "Your current password must contain at least 6 character.";
    		}
    		if(strlen($_POST['password']) > 32)
    		{
    			$errors[] = "Your current password must be less then or equal to 32 character.";
    		}
    	}
    	else
    	{
    		$errors[] = "Your current password don't match.";
    	}
    }

    }


	include "includes/overall/header.php";
		
?>
<div class="well">
	<div class="well well-wb">
		<h2 class="well-blue">
			<span class="glyphicon glyphicon-cog"></span> Change password <br>
			<small class="lead"><span class="glyphicon glyphicon-paperclip"></span> 
				We recommend you to change your password regularly.
			</small>
		</h2>	
	</div>
</div>



<?php 
	if(isset($_GET['success']) === true and empty($_GET['success']) === true)
	{
		?>
		<div class="well">
			<div class="well well-wb">
				<div class="card text-center">
				  <div class="card-header">
				    <i class="fa fa-smile-o well-blue" id='big_smile'></i>
				  </div>
				  <div class="card-block">
				    <h4 class="card-title well-blue lead">Password successfully changed</h4>
				    <p class="card-text time-h">Thank you for changing the password. we have logged you out from all other devices.</p>
				    <a href="index.php" class="btn btn-primary"><i class="glyphicon glyphicon-home"></i> Home</a>
				  </div>
				  <div class="card-footer text-muted">
				    Just now
				  </div>
				</div>
			</div>
			
		</div>
			


		<?php
	}
	else
	{
		if(empty($_POST['submit']) === false and empty($errors) === true)
		{
			change_password($user_data['user_id'],$_POST['password']);

			reset_user_all_ip_combo_flag($user_data['user_id']);

			header("Location: changepassword.php?success");
		}
		else if(empty($_POST['submit']) === false and empty($errors) === false)
		{
			echo output_errors($errors)."<br>";
		}

	 ?>
	 <div class="well">
		<div class="well"><p>
			<form action="changepassword.php" method="POST" autocomplete="off" class="form">
				<ul>
					<li class="well-blue">
						<label for='current_password'>
							<strong><span class="glyphicon glyphicon-hand-right"></span> Current Password 
								<small>
									<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
								</small>
							</strong>
						</label>
						<br>
						<input type="password" id='current_password' class="form-control well-blue" name="current_password" placeholder="Enter your old password">
					</li><br>
					<li class="well-blue">
						<label for="password">
							<strong><span class="glyphicon glyphicon-hand-right"></span> New Password 
								<small>
									<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
								</small>
							</strong>
						</label>
						<br>
						<input type="password" id="password" class="form-control well-blue" name="password" placeholder="Enter your new password">
					</li><br>
					<li class="well-blue">
						<label for="password_again">
							<strong><span class="glyphicon glyphicon-hand-right"></span> New Password Again
								<small>
									<span class="glyphicon glyphicon-asterisk well-blue" aria-hidden="true"></span>
								</small>
							</strong>
						</label>
						<br>
						<input type="password" id='password_again' class="form-control well-blue" name="password_again" placeholder="Enter your new password again">
					</li><br>
					<li>
						<input type="submit"  name="submit" value="Update password" class="btn btn-primary">
					</li>
				</ul>
			</form>
		</p>
		</div>
	</div>


<?php 
	}
include "includes/overall/footer.php";?>