<?php
    include "core/init.php";
	include "includes/overall/header.php";
?>

<div class="well">
	<div class="well well-wb">
		<h3 class="well-blue"><span class="fa fa-phone" aria-hidden="true"></span> Contact us 
		<br>
		<small><i class="glyphicon glyphicon-paperclip"></i> Want any Help or give some suggestion please contact us.</small></h3>
	</div>


<?php 
	if(isset($_GET['success']) === true and empty($_GET['success']) === true)
	{
		echo "<div class='alert alert-success'>Thank you for connecting with us. <br> Very soon we will touch you.</div>";
	}
	else{
	
	if(isset($_POST['submit']) === true)
	{
		if(empty($_POST['name']) === true or empty($_POST['email'])=== true or empty($_POST['message']) === true or empty($_POST['subject']))
		{
			$errors[] = "Fields mark with an asterisk is required.";
		}
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
		{
		 	$errors[] = "A valid email address is required.";
		}
		if(empty($errors) === false)
		{
			echo "<div class='alert alert-danger'>";
			echo output_errors($errors);
			echo "</div>";
		}
		else if(empty($errors) === true)
		{
			$name 		= sanitize($_POST['name']);
			$email 		= sanitize($_POST['email']);
			$subject 	= sanitize($_POST['subject']);
			$message 	= sanitize($_POST['message']);

			mail("zafirahmad718@gmail.com", $subject, $message, "From:".$email);

			header("Location:contact.php?success");
			exit();
		}
	}


 ?>

	<div class="well">
		<form class="form-group" action="contact.php" method="POST" autocomplete="off">
			<ul>
				<li class="well-blue"><strong>Name <small>
					<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
				</small></strong><br>
					<input type="text" name="name" class="form-control" title="Enter your name"
					 placeholder="Enter your name...">
				</li>
				<br>
				<li class="well-blue"><strong>Email <small>
					<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
				</small></strong><br>
					<input type="email" name="email" title="Enter a valid email" class="form-control"
					 placeholder="Enter your email...">
				</li>
				<br>
				<li class="well-blue">
					<strong>Subject <small>
					<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
				</small></strong><br>
					<input type="text" name="subject" class="form-control" title="Type your subject of email" placeholder="Type your subject">
				</li>
				<br>
				<li class="well-blue">
					<strong>Message <small>
					<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
				</small></strong><br>
					<textarea name="message" rows="8" title="Type your message here" class="form-control" placeholder="Type your message here.."></textarea>
				</li>

				<li>
					<input type="submit" name="submit" value="Send" class="btn btn-primary">
				</li>
			</ul>

		</form>
	</div>
</div>

<?php 
}
include "includes/overall/footer.php";?>