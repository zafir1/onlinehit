<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor/autoload.php';

	function generate_roll_reg_combo($pre_roll,$roll_start,$roll_end,$pre_reg,$reg_start)
	{
		global $db;
		$diff = $reg_start-$roll_start;
		for($roll=$roll_start;$roll<=$roll_end;$roll++)
		{
			echo $pre_roll.$roll."<br>".$pre_reg.($roll+$diff)."<br><br>";
		}

	}

	function faculty_protected()
	{
		global $user_data;
		if(is_faculty($user_data['user_id']) === false)
		{
			header("location:index.php");
		}
	}

	function admin_protect()
	{
		global $user_data;
		if(has_access($user_data['user_id'],'admin') === false)
		{
			header("Location:index.php");
		}
	}

	function who_can_access($user_id,$type)
	{	
		$user_id	= (int)$user_id;
		//$type		= mysql_real_escape_string($type);
		if(can_access($user_id,$type) === false)
		{
			header("location: index.php");
		}	
	}

	function moderator_protect()
	{
		global $user_data;
		if(has_access($user_data['user_id'],'moderator') === false)
		{
			header("Location:index.php");
		}
	}

	function hod_protect()
	{
		global $user_data;
		if(has_access($user_data['user_id'],'hod') === false)
		{
			header("Location:logout.php");
		}
	}


	function ieee_head_protect(){
		global $user_data;
		if(has_access($user_data['user_id'],'ieee_head') === false)
		{
			header("Location:index.php");
		}
	}

	function logged_in_redirect()
	{
		if(logged_in() === true)
		{
			header("Location: index.php");
			exit();
		}
	}

	function protected_page(){
		if(logged_in() === false){
			header("Location: protected.php");
		}
	}

	function count_page_request()
	{
		return mysql_result(mysql_query("SELECT `tpr` FROM `page_request` WHERE `id` = 1"), 0);
	}

	function page_request()
	{
		$page_no = count_page_request();
		$page_no = $page_no + 1;
		mysql_query("UPDATE `page_request` SET `tpr` = '$page_no'");
	}

	function has_activated($email)
	{
		$email 		= sanitize($email);
		return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `active` = '1' "), 0) == 1)? true : false;
	}

	function make_a_new_link_for_activation($email)
	{
		global $website;
		$email 		= sanitize($email);
		$email_code = md5(time()+microtime());
		mysql_query("UPDATE `users` SET `email_code` = '$email_code' WHERE `email` = '$email'");
		$query = mysql_query("SELECT `email_code`,`first_name` FROM `users` WHERE `email` = '$email' ");

		$email_code = mysql_result($query, 0,'email_code');
		$name 		= mysql_result($query, 0,'first_name');
		$newcode 	= md5(substr($email_code,5,10));

		email($email,'Activate your account', "Hello ".$user['first_name'].",\n\nYou need to activate your account, So use the below link:\n\n http://".$website."/activate.php?email=".$email."&KoDEmLIYGFFhf356=".$email_code."&nKpoDh=".$newcode."\n\n~OnlineHIT");
	}
	/*************************************************************************************/
	function email($to,$subject,$body)
	{
		
		$mail = new PHPMailer(true);
	    $mail->isSMTP();                                      
	    $mail->Host = 'smtp.gmail.com';
	    $mail->SMTPAuth = true;
	    $mail->Username = 'myusername@gmail.com';
	    $mail->Password = 'mypassword';
	    $mail->SMTPSecure = 'ssl';
	    $mail->Port = '465';

	    //Recipients
	    $mail->setFrom('from@example.com', 'OnlineHIT');
	    $mail->addAddress($to, '');
	    $mail->addReplyTo('noreply@onlinehit.co.in', 'No-reply');
	    $mail->addCC('onlinehit.co@gmail.com');
	    $mail->addBCC('onlinehit.co@gmail.com');

	    $mail->isHTML(false);                                  
	    $mail->Subject = $subject;
	    $mail->Body    = $body;
	    $mail->AltBody = $body;

	    $mail->send();
	}

	function mail_user_about_security($to,$name)
	{
		$to = sanitize($to);
		$subject = 'Security Reason';
		$body = 'Dear '.$name.', \n\n Your Account has been logged in through an unknown device \n\n If this is you then ignore this mail otherwise go and secure your account. \n\n\n ~OnlineHIT.';
		$headers = 'From: OnlineHIT';
		mail($to,$subject,$body,$header);
	}

	function array_sanitize(&$item){
		global $db;
		return htmlentities(strip_tags(mysqli_real_escape_string($db,$item)));
	}

	function sanitize($data)
	{
		global $db;
		return htmlentities(strip_tags(mysqli_real_escape_string($db,$data)));
	}

	function output_errors($errors)
	{

		return "<ul><li class='well-blue'><span class='fa fa-exclamation-triangle'></span> ". implode("</li><li class='well-blue'><span class='fa fa-exclamation-triangle'></span>  ", $errors). "</li></ul>";
	}

	/*This function is showing the filled values on register.php*/
	function show_value($value){
		if(isset($value) === true and empty($value) === false)
		{
			echo "value = ".sanitize($value);
		}
	}

	function ckeditor(){
		echo '<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>';
	}

	function ckeked($var){
		if(isset($var) === true and empty($var) === false)
		{
			echo "cheked='cheked'";
		}
	}

	function selected($var)
	{
		if (isset($var) === true) {
			echo "selected = 'selected'";
		}
	}

	function greeting_card($smile,$greeting,$message,$link,$button_text,$button_color,$extra_flash,$is_button)
	{
		?>
			<div class="card text-center">
			  <div class="card-header">
			    <i class="fa fa-<?php echo $smile; ?>" id="big_smile"></i>
			  </div>
			  <div class="card-block">
			    <h4 class="card-title"><?php echo $greeting; ?></h4>
			    <p class="card-text"><?php echo $message; ?></p>
			  	<?php echo $extra_flash; ?>
			    <?php if($is_button == 1){ ?>
			    <a href="<?php echo $link; ?>" class="btn btn-<?php echo $button_color; ?>"><?php echo $button_text; ?></a><?php } ?>
			  </div>
			  <div class="card-footer text-muted">
			    OnlineHIT
			  </div>
			</div>
		<?php
	}

	function recover_forgot_password($username,$email)
	{
		global $db;
		global $website;
		$username 	= sanitize($username);
		$email 		= sanitize($email); 

		$client_data = user_data(user_id_from_email($email),'user_id','username','password','first_name','last_name','email','email_code','faculty');

		$password_change_link = $website."/rfpp.php?AsPXmkNhT=".password_hash($client_data['password'],PASSWORD_DEFAULT)."&kec=".password_hash($client_data['email_code'],PASSWORD_DEFAULT)."&s=".password_hash($client_data['password'].$client_data['user_id'],PASSWORD_DEFAULT)."&email=".$client_data['email']."&ecod=".password_hash($client_data['username'],PASSWORD_DEFAULT);

		$first_name = $client_data['first_name'];

		//echo $password_change_link;
		$to = $client_data['email'];
		$subject = "Change Password";
		$body = "Hi ,\n\nWe received a request to reset your OnlineHIT password. Click on the below link to reset your password.\n\n".$password_change_link."\n\n(If this link is not redirecting you anywhere then copy it and paste it into the browser.)\n\n~OnlineHIT";
		email($to,$subject,$body);

	}
 ?>