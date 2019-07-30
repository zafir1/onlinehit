<?php 
	include "core/init.php";
	logged_in_redirect();
	include "includes/overall/header.php";

?>
	<div class="well">
		<div class="well well-wb well-blue">
			<h3>
				<span class="glyphicon glyphicon-user"></span>	
				 Student Registration Page
				<br>
				<small>
					<span class="glyphicon glyphicon-paperclip"></span>
					Connnect yourself from HIT family
				</small>
			</h3>
			<a href="factreg.php" class="btn btn-primary"><i class="fa fa-user-plus"></i> Register as a faculty</a>
		</div>

<?php 
	if(isset($_GET['success']) === true)
	{
		?>
		<div class="well well-wb">
			<div class="card text-center">
			  <div class="card-header">
			    <span class="fa fa-smile-o well-blue" id='big_smile'></span>
			  </div>
			  <div class="card-block">
			    <h4 class="card-title well-blue">Thank you.</h4>
			    <p class="card-text lead well-blue">Please check your email to activate your account.</p>
			    <a href="" class="btn btn-primary"><span class="fa fa-sign-in"></span> Login</a>
			  </div>
			  <div class="card-footer text-muted">
			    OnlineHIT
			  </div>
			</div>
		</div>
			

		<?php
	}
	else
	{


	if(empty($_POST) === false)
	{
		$required_fields = array('username','password','password_again','first_name','email','uni_roll','uni_reg');
		foreach ($_POST as $key => $value) {
			if(empty($value) and in_array($key, $required_fields) === true){
				$errors[] = "Fields mark with an asterisk is required!";
				break 1;
			}
		}
		if(empty($errors) === true)
		{
			$roll 	= sanitize($_POST['uni_roll']);
			$reg 	= sanitize($_POST['uni_reg']);
			$college_admission_id 	= sanitize($_POST['college_admission_id']);

			 if(user_exists($_POST['username']) === true){
			 	$errors[] = "Sorry the username <b>'".$_POST['username']."'</b> is already in use.";
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
			 	$errors[] = "Sorry the email <b>'".$_POST['email']."'</b> is already in use.";
			 }
			 if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
			 {
			 	$errors[] = "A valid email address is required.";
			 }
			 if((university_roll_registration_id_combo_exists($roll,$reg,$college_admission_id)) === false)
			 {
			 	$errors[] = "University roll-registration combo doesn't exist";
			 }
			 if(empty($errors) === true)
			 {
			 	if(roll_exists($roll) === true)
				 {
				 	$errors[] = "Sorry roll no <b>".$roll."</b> is already in use. If this is not you please contact us.";
				 }
			 }
			 

		}

	}

	if(isset($_POST['submit']) === true and empty($errors) === false)
	{
		echo output_errors($errors);
	}

	else if(isset($_POST['submit']) === true and empty($errors) === true)
	{
		$register_data = array(
				'username'			=> sanitize($_POST['username']),
				'password'			=> sanitize($_POST['password']),
				'first_name'		=> sanitize($_POST['first_name']),
				'last_name'			=> sanitize($_POST['last_name']),
				'email'				=> sanitize($_POST['email']),
				'uni_roll' 			=> sanitize($roll),
				'uni_reg' 			=> sanitize($reg),
				/*'college_id' 		=> $college_admission_id,*/
				'email_code'	=> md5(microtime() + time())
			);
		register_user($register_data);
		header("Location: register.php?success");

		// var_dump($register_data);
	}


 ?>


		<form action="register.php" method="POST" autocomplete="off" class='form well'>
		<ul class="well-blue">
			<li>
				<label for="username">
					<strong>
						<span class="glyphicon glyphicon-hand-right"></span> 
							username <span class="fa fa-asterisk"></span>
					</strong>
				</label>
				
				<input type="text" id='username' class="form-control well-blue" name="username" placeholder="Enter username" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['username']);
					} ?> >
					<span id="float_right">Less then 32 character</span>
			</li>
			<br>
			<li>
				<label for="password"> 
					<span class="glyphicon glyphicon-hand-right"></span>
					 <strong> 
					 	Password <span class="fa fa-asterisk"></span>

					 </strong>
				</label>
				
				<input id='password' type="password" name="password" class="form-control well-blue" placeholder="Enter password">
				<span id="float_right">Less then 32 character</span>
			</li><br>
			<li>
				<label for="password_again"> 
					<span class="glyphicon glyphicon-hand-right"></span>
					 <strong> 
					 	Password Again <span class="fa fa-asterisk"></span>

					 </strong>
				</label>

				<input id="password_again" type="password" name="password_again" class="form-control well-blue" placeholder="password Again">
				
			</li><br>
			<li>
				<label for="first_name"> 
					<span class="glyphicon glyphicon-hand-right"></span>
					 <strong> 
					 	First name <span class="fa fa-asterisk"></span>

					 </strong>
				</label>

				<input id='first_name' type="text" name="first_name" class="form-control well-blue" placeholder="First name" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['first_name']);
					} ?> >
					<span id="float_right">Less then 50 character</span>
			</li><br>
			<li>
				<label for="last_name"> 
					<span class="glyphicon glyphicon-hand-right"></span>
					 <strong> 
					 	Last name

					 </strong>
				</label>

				<input id='last_name' type="text" class="form-control well-blue" name="last_name" placeholder="last name" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['last_name']);
					} ?> >
					<span id="float_right">Less then 32 character</span>
			</li><br>


			<li>
				<label for="roll"> 
					<span class="glyphicon glyphicon-hand-right"></span>
					 <strong> 
					 	University Roll number <span class="fa fa-asterisk"></span>

					 </strong>
				</label>

				<input id='roll' type="number" class="form-control well-blue" name="uni_roll" maxlength="11" placeholder="10300212315" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['uni_roll']);
					} ?> >
					<span id="float_right">Exact 11 character</span>
			</li><br>

			<li>
				<label for="reg"> 
					<span class="glyphicon glyphicon-hand-right"></span>
					 <strong> 
					 	University Registration no <span class="fa fa-asterisk"></span>

					 </strong>
				</label>

				<input id='reg' type="number" class="form-control well-blue" name="uni_reg" maxlength="11" placeholder="10300212315" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['uni_reg']);
					} ?> >
					<span id="float_right">Exact 11 character</span>
			</li><br>

			<!-- <li>
				<label for="coll_id"> 
					<span class="glyphicon glyphicon-hand-right"></span>
					 <strong> 
					 	College ID no <span class="fa fa-asterisk"></span>

					 </strong>
				</label>

				<input id='coll_id' type="text" class="form-control well-blue" name="college_admission_id" maxlength="11" placeholder="004-16-0658" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['college_admission_id']);
					} ?> >
					<span id="float_right">Look your fee receipt</span>
			</li><br> -->

			<li>
				<label for="email"> 
					<span class="glyphicon glyphicon-hand-right"></span>
					 <strong> 
					 	Email <span class="fa fa-asterisk"></span>

					 </strong>
				</label>
				<input id='email' type="email" class="form-control well-blue" name="email" placeholder="someone@onlinehit.co.in" <?php if(isset($_POST['submit']) === true){
						show_value($_POST['email']);
					} ?> >
			</li><br>
			<li>
				<input type="submit" name="submit" value="Sign up!" class="btn btn-primary">
			</li>
		</ul>
	</form>
	<?php } ?>
	</div>

<?php
	
	include "includes/overall/footer.php";

?>