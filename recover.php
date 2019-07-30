<?php
    include "core/init.php";
    logged_in_redirect();
	include "includes/overall/header.php";
	if(isset($_GET['recovered']) === true and empty($_GET['recovered']) === true)
	{
		echo "<p>Thanks we have mailed you.</p>";
	}
	else
	{

?>
<h1>Recover</h1>
<?php 
	$mode_allowed = array('username','password');
	if(isset($_GET['mode']) === true and in_array($_GET['mode'], $mode_allowed) === true)
	{
		if(isset($_POST['email']) === true and empty($_POST['email']) === false)
		{
			if(email_exists($_POST['email']) === true)
			{
				recover($_GET['mode'], $_POST['email']);
				header("Location:recover.php?recovered");
				exit();
			}
			else
			{
				echo "<p>OppS! We couldn't find that email address.</p>";
			}
		}

?>
	<form action="" method="POST" autocomplete="off">
		<ul>
			<li>Please Enter your username:<br><input type="email" name="email" placeholder="Type your email..."></li>
			<li><input type="submit" name="submit" value="Recover"></li>
		</ul>
		
	</form>
<?php
	}
	else
	{
		header("Location:index.php");
	}
?>


<?php
	}
 include "includes/overall/footer.php";

 ?>