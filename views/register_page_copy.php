<?php 
	include "core/init.php";
	logged_in_redirect();
	include "includes/overall/header.php";
?>
<div class="well">
	<div class="well well-wb well-blue">
		<h2>
			<span class="glyphicon glyphicon-user"></span>	
			Registration 
			<br>
			<small>
				<span class="glyphicon glyphicon-paperclip"></span>
				Connnect yourself from HIT family
			</small>
		</h2>
		<a href="" class="btn btn-primary"><i class="fa fa-user-plus"></i> student</a>
	</div>
</div>

<?php
	 

	if(empty($_POST) === false)
	{
		$required_fields = array('username','password','password_again','first_name','email');
		//echo print_r($_POST);
		//echo '<pre>', print_r($_POST, true),'</pre>';
		foreach ($_POST as $key => $value) {
			if(empty($value) and in_array($key, $required_fields) === true){
				$errors[] = "Fields mark with an asterisk is required!";
				break 1;
			}
		}
		if(empty($errors) === true)
		{
			 if(user_exists($_POST['username']) === true){
			 	$errors[] = "Sorry the username ".$_POST['username']." is already in use.";
			 }
			 if(preg_match("/\\s/", $_POST['username'])){
			 	$errors[] = "Username must not contain any space.";
			 }
			 if(strlen($_POST['password']) < 6)
			 {
			 	$errors[] = "Password must be gratter then 6 character.";
			 }
			 if(strlen($_POST['password']) > 32)
			 {
			 	$errors[] = "Password must be gratter then 6 character.";
			 }
			 if($_POST['password'] !== $_POST['password_again'])
			 {
			 	$errors[] = "Password donot match.";
			 }
			 if(email_exists($_POST['email']) === true)
			 {
			 	$errors[] = "Sorry the email ".$_POST['email']." is already taken.";
			 }
			 if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
			 {
			 	$errors[] = "A valid email address is required.";
			 }
		}

	}

	


	if(isset($_GET['success']) === true and empty($_GET['success']) === true)
	{
?>
		<div class="well alert alert-success lead">
			<i class="fa fa-smile-o" aria-hidden="true" id='no_result_found'></i>
			Your registration is successful. <br>
			<span class="glyphicon glyphicon-hand-right"></span>
			Please check E-mail to <b>activate</b> your account.
		</div>


<?php
	}
	else{

	if(empty($_POST) === false and empty($errors) === true){
		
		$register_data = array(
				'username'		=> $_POST['username'],
				'password'		=> $_POST['password'],
				'first_name'	=> $_POST['first_name'],
				'last_name'		=> $_POST['last_name'],
				'email'			=> $_POST['email'],
				'email_code'	=> md5(microtime() + time())
			);
		register_user($register_data);
		header("Location: register.php?success");
	}
	else if(empty($errors) === false)
	{
		echo "<div class='alert alert-danger' role='alert'>";
		echo output_errors($errors)."<br>";
		echo "</div>";
	}

 ?>
<p>
	<form action="register.php" method="POST" autocomplete="off" class='form well'>
		<ul>
			<li>
				<strong>username*:</strong><br>
				<input type="text" class="form-control" name="username" placeholder="Enter username" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['username']);
					} ?> >
			</li>
			<br>
			<li>
				<strong>Password*:</strong>
				<input type="password" name="password" class="form-control" placeholder="Enter password">
			</li><br>
			<li>
				<strong>Password Again*:</strong>
				<input type="password" name="password_again" class="form-control" placeholder="password Again">
			</li><br>
			<li>
				<strong>First name*:</strong>
				<input type="text" name="first_name" class="form-control" placeholder="First name" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['first_name']);
					} ?> >
			</li><br>
			<li>
				<strong>last name*:</strong>
				<input type="text" class="form-control" name="last_name" placeholder="last name" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['last_name']);
					} ?> >
			</li><br>
			<li>
				<strong>Email*:</strong> <input type="email" class="form-control" name="email" placeholder="Type Email" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['email']);
					} ?> >
			</li><br>
			<li>
				<input type="submit" name="submit" value="Sign up!">
			</li>
		</ul>
	</form>
</p>




<?php 
}

include "includes/overall/footer.php";?>