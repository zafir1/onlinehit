<?php 
	include "core/init.php";
	protected_page();
	include "includes/overall/header.php";
	if(empty($_POST) === false)
	{
		$required_fields = array('username','first_name');
		foreach ($_POST as $key => $value)
			if(empty($value) and in_array($key, $required_fields) === true){
				$errors[] = "Fields mark with an asterisk is required!";
				break 1;
			}
		if(empty($errors) === true)
		{
			if(empty($_POST['username']) === true)
			{
				$errors[] = "You can't leave username empty.";
			}
			if(strlen($_POST['username']) < 6)
			{
				$errors[] = "Your username must be atleast 6 character.";
			}
			if(user_exists($_POST['username']) and ($user_data['username'] != $_POST['username']))
			{
				$errors[] = "Someone is using this username. Please choose another one.";
			}
			
		}


	}



?>
<div class="well">
	<div class='well well-wb'>
		<h2 class="well-blue"><span class="fa fa-cogs" aria-hidden="true"></span> Settings <br>
			<small>
				<span class="glyphicon glyphicon-paperclip"></span> Keep your profile updated
			</small>
		</h2>
		
		<a href="<?php if($user_data['faculty'] == 0)
				{
				  	echo 'settmre.php';
				  }
				  else{
				  	echo 'facultycardsettings.php';
				  	} 
			?>
			" class="btn btn-primary"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> More Settings</a>
		
		
	</div>
</div>
	
	

<?php 
	if(isset($_GET['updated']) === true and empty($_GET['updated']) === true)
	{
		?>

		<div class="well">
			<div class="well well-wb well-blue">
				<div class="card text-center">

				  <div class="card-header">
				    <span class="fa fa-smile-o" id='big_smile'></span>
				  </div>

				  <div class="card-block">
				    <h4 class="card-title">Thank you!</h4>
				    <p class="card-text lead">We have successfully updated your account.</p>
				    <a href="#" class="btn btn-primary"><i class="fa fa-user"></i> Profile</a>
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

		if(empty($_POST) === false and empty($errors) === true)
		{
			//update users
			$update_data = array(
					'first_name' 	=> sanitize($_POST['first_name']),
					'last_name'		=> sanitize($_POST['last_name']),
					'username' 		=> sanitize($_POST['username'])
				);
			update_user($update_data);
			header("Location: settings.php?updated");
			exit();
		}
		else if(empty($_POST) === false and empty($errors) === false)
		{
			
			echo output_errors($errors);
			
		}
	 ?>
	 <div class="well">

		<form action="settings.php" method="POST" autocomplete="off" class="well">
			<ul>
				<li class="well-blue">
					<label for="username">
						<strong><span class="glyphicon glyphicon-hand-right"></span> username
							<small>
								<span class="fa fa-asterisk" aria-hidden="true"></span>
							</small>
						</strong>
					</label>
					<br>
					<input type="text" id='username' class="form-control well-blue" name="username" placeholder="username" value="<?php 
						if(isset($_POST['username']) === true)
						{
							echo $_POST['username'];
						}
						else
						{
							echo $user_data['username'];
						}

					 ?>">
				</li><br>

				<li class="well-blue">
					<label for="first_name">
						<strong><span class="glyphicon glyphicon-hand-right"></span> First Name 
							<small>
								<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
							</small>
						</strong>
					</label>
					<br>
					<input type="text" id='first_name' class="form-control well-blue" name="first_name" placeholder="Enter your First name" value="<?php 
					echo $user_data['first_name']; ?>">
				</li><br>

				<li class="well-blue">
					<label for="last_name">
						<strong><span class="glyphicon glyphicon-hand-right"></span> last Name
							<small>
								<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
							</small>
						</strong>
					</label>
					<br>
					<input type="text" id='last_name' class="form-control well-blue" name="last_name" placeholder="Enter your last name" value="<?php
					echo $user_data['last_name']; ?>">
				</li><br>

				<li>
					<input type="submit" name="submit" value="Update Account" class="btn btn-primary">
				</li>
			</ul>
		</form>

		</div>

	<?php
	}
	include "includes/overall/footer.php";
?>