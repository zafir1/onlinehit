<?php
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','ieee_head'");

if(isset($_GET['Ad$m$nIP'],$_GET['MHpiRXtRj3^3$$NxT']) === true)
{
	$id_hash = sanitize($_GET['Ad$m$nIP']);
	$email_hash = sanitize($_GET['MHpiRXtRj3^3$$NxT']);
	if(md5(substr(md5($user_data['user_id']),3,20)) !== $id_hash or substr(md5($user_data['email_code']),0,28) !== $email_hash)
	{
		header('Location:index.php');
	}
	else
	{
		include 'includes/overall/header.php';
		$active_workshop_id = active_workshop_of($user_data['member']);
		if($active_workshop_id === false)
		{
			ckeditor();

			?>

		<div class="well">
			<div class="well well-wb well-blue">
				<h3><span class="fa fa-shopping-cart"></span> Arrange Workshop / Event
				<br>
				<small>
					<span class="glyphicon glyphicon-paperclip"></span> We will help you to take registration
				</small>
				</h3>
				<a class="btn btn-success"><span class="fa fa-plus-square-o"></span> Add Workshop</a>
			</div>

			<?php
				if(empty($_POST) === false)
				{
					$required_fields = array('name','phone','email','payment_venue','fee','workshop_venue','envelope_heading','envelope_title','editor1');
					foreach ($_POST as $key => $value) {
						if(empty($value) and in_array($key, $required_fields) === true){
							$errors[] = "Fields mark with an asterisk is required!";
							break 1;
						}
					}

					if(empty($errors) === false)
					{
						echo output_errors($errors);
					}
					else
					{
						if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
						 {
						 	$errors[] = "A valid email address is required.";
						 }
						 if(strlen($_POST['phone']) != 10)
						 {
						 	$errors[] = "Please provide a correct number";
						 }
						 if($_POST['fee'] < 0)
						 {
						 	$errors[] = "Fee must be a positive number";
						 }
						 if(empty($errors) === false)
						 {
						 	echo output_errors($errors);
						 }
						 else
						 {
						 	$name 				= sanitize($_POST['name']);
							$phone 				= sanitize($_POST['phone']);
							$email 				= sanitize($_POST['email']);
							$payment_venue 		= sanitize($_POST['payment_venue']);
							$workshop_venue 	= sanitize($_POST['workshop_venue']);
							$fee 				= sanitize($_POST['fee']);
							$envelope_heading 	= sanitize($_POST['envelope_heading']);
							$envelope_title 	= sanitize($_POST['envelope_title']);
							$description 		= $_POST['editor1'];

							$register_data = array(
								'name'				=> $name,
								'phone'				=> $phone,
								'email'				=> $email,
								'payment_venue'		=> $payment_venue,
								'workshop_venue'	=> $workshop_venue,
								'fee' 				=> $fee,
								'eheading' 			=> $envelope_heading,
								'etitle' 			=> $envelope_title,
								'description' 		=> $description,
								'club' 				=> $user_data['member'],
								'hash'				=> md5(microtime() + 3*time())
							);

							register_workshop($register_data);
						 }
					}
				}



			 ?>

			<div class="">
				<form action="" method="POST" autocomplete="off">
					<ul class="well-blue">
						<div class="well">
							<li>
								<label for="name">
									<span class="glyphicon glyphicon-hand-right"></span>
									<b>Title of the workshop <span class="fa fa-asterisk"></span></b>
								</label>
								<input type="text" id='name' name="name" class="form-control well-blue" placeholder="Title of the workshop"
								<?php if(isset($_POST['name']) === true and empty($_POST['name']) === false)
								{
									echo "value='".sanitize($_POST['name'])."'";
									} ?>
								>
								<span id="float_right">Less then 100 character</span>
							</li>
							<br>
							<li>
								<label for="phone">
									<span class="glyphicon glyphicon-hand-right"></span>
									<b>Contact <span class="fa fa-asterisk"></span></b>
								</label>
								<input type="number" id='phone' name="phone" class="form-control well-blue" placeholder="9473142093"
								<?php if(isset($_POST['phone']) === true and empty($_POST['phone']) === false)
								{
									echo "value='".sanitize($_POST['phone'])."'";
									}
								?>
								>
								<span id="float_right">Visible To Registered Stdents Only</span>
							</li>
							<br>
							<li>
								<label for="email">
									<span class="glyphicon glyphicon-hand-right"></span>
									<b>Email <span class="fa fa-asterisk"></span></b>
								</label>
								<input type="email" id='email' name="email" class="form-control well-blue" placeholder="ahmadzafir01@onlinehit.co.in"
								<?php if(isset($_POST['email']) === true and empty($_POST['email']) === false)
								{
									echo "value='".sanitize($_POST['email'])."'";
									}
								?>
								>
								<span id="float_right">Visible To Registered Stdents Only</span>
							</li>
							<br>
							<li>
								<label for="payment_venue">
									<span class="glyphicon glyphicon-hand-right"></span>
									<b>Payment Venue <span class="fa fa-asterisk"></span></b>
								</label>
								<input type="text" id='payment_venue' name="payment_venue" class="form-control well-blue" placeholder="MBA Seminar Hall"
								<?php if(isset($_POST['payment_venue']) === true and empty($_POST['payment_venue']) === false)
								{
									echo "value='".sanitize($_POST['payment_venue'])."'";
									}
								?>
								>
								<span id="float_right">Less then 150 character</span>
							</li>
							<br>
							<li>
								<label for="fee">
									<span class="glyphicon glyphicon-hand-right"></span>
									<b>Fee <span class="fa fa-asterisk"></span></b>
								</label>
								<input type="number" id='fee' name="fee" class="form-control well-blue" placeholder="400"
								<?php if(isset($_POST['fee']) === true and empty($_POST['fee']) === false)
								{
									echo "value='".sanitize($_POST['fee'])."'";
									}
								?>
								>
								<span id="float_right">Must be Integer</span>
							</li>
							<br>
							<li>
								<label for="workshop_venue">
									<span class="glyphicon glyphicon-hand-right"></span>
									<b>Workshop Venue <span class="fa fa-asterisk"></span></b>
								</label>
								<input type="text" id='workshop_venue' name="workshop_venue" class="form-control well-blue" placeholder="MBA Seminar Hall"
								<?php if(isset($_POST['workshop_venue']) === true and empty($_POST['workshop_venue']) === false)
								{
									echo "value='".sanitize($_POST['workshop_venue'])."'";
									}
								?>
								>
								<span id="float_right">Less then 150 character</span>
							</li>
							<br>
						</div>

						<div class="well">
							<li>
								<label for="envelope_heading">
									<span class="glyphicon glyphicon-hand-right"></span>
									<b>Club Wall Envelope Heading <span class="fa fa-asterisk"></span></b>
								</label>
								<input type="text" id='envelope_heading' name="envelope_heading" class="form-control well-blue" placeholder="Workshop on Home Automation"
								<?php if(isset($_POST['envelope_heading']) === true and empty($_POST['envelope_heading']) === false)
								{
									echo "value='".sanitize($_POST['envelope_heading'])."'";
									}
								?>
								>
								<span id="float_right">Less then 150 character</span><br>
								<span id="float_right">Visible on your club wall envelope heading</span>
							</li>
							<br>
							<li>
								<label for="envelope_title">
									<span class="glyphicon glyphicon-hand-right"></span>
									<b>Club Wall Envelope Title <span class="fa fa-asterisk"></span></b>
								</label>
								<input type="text" id='envelope_title' name="envelope_title" class="form-control well-blue" placeholder="IETE is organizing a workshop of Home Automation on xxxx-xx-xx"
								<?php if(isset($_POST['envelope_title']) === true and empty($_POST['envelope_title']) === false)
								{
									echo "value='".sanitize($_POST['envelope_title'])."'";
									}
								?>
								>
								<span id="float_right">Less then 250 character</span><br>
								<span id="float_right">Visible on your club wall envelope title</span>
							</li>
						</div>


						<div class="well">
							<li class="well-blue">
							<span class="glyphicon glyphicon-hand-right"></span>
								<b>Complete description of workshop <span class="fa fa-asterisk"></span></b><br>
								<textarea rows="10" class="form-control" placeholder="Type body of the news.." name="editor1"><?php
									if(isset($_POST['editor1']) === true and empty($_POST['editor1']) === false)
											{
												echo $_POST['editor1'];
											}
								 ?></textarea>

								<span id="float_right">Less then 1500 words</span>
							</li>
							<br>
						</div>


						<li>
							<input type="submit" name="submit" value="Add Workshop" class="btn btn-primary">
						</li>

					</ul>
				</form>
			</div>
		</div>

								<script>
							        CKEDITOR.replace( 'editor1' );
								</script>


			<?php
		}
		else
		{
?>
		<div class="well">
			<div class="well well-wb">

					<h3 class="well-blue"><i class="fa fa-tachometer"></i>
					<?php

						$workshop_hash = active_workshop_hash_of($user_data['member']);
						$workshop = workshop_details_from_hash($workshop_hash);
						echo "<a href=''>".$workshop->name."</a>";
					 ?>
					</h3>

					<div class="dropdown">
						  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Accept Payment
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
								<li>
									<a href="workshopacceptpayment.php?moderator=<?php echo password_hash($user_data['username'].$user_data['user_id'],PASSWORD_DEFAULT); ?>&moderatorid=<?php echo password_hash($user_data['email_code'],PASSWORD_DEFAULT); ?>&moderatorcode=<?php echo md5($user_data['email_code']).md5($user_data['user_id']); ?>&hspzcode=<?php echo md5($user_data['email'].$user_data['user_id']).md5($user_data['user_id'].$user_data['email']); ?>&m=<?php echo password_hash($user_data['email_code'],PASSWORD_DEFAULT); ?>">Accept Payment</a>
								</li>
						    <li><a href="closeworkshop.php">Close Workshop</a></li>
						    <li><a href="#">JavaScript</a></li>
						  </ul>
					</div>

			</div>



			<form action='wrkshparnge.php?Ad$m$nIP=<?php echo $id_hash;?>&MHpiRXtRj3^3$$NxT=<?php echo $email_hash; ?>' method="POST" autocomplete='off'>
				<div class="well-wb well well-blue">
					<label for="email"><b><i class="fa fa-search"></i> Find Student</b></label>
					<div class="input-group margin-bottom-sm">
					  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw well-blue"></i></span>
					  <input class="form-control well-blue" type="email" name='email' id='email' placeholder="ahmadzafir01@onlinehit.co.in"
					  	<?php if(isset($_POST['email']) === true and empty($_POST['email']) === false)
					  	{
					  		echo "value='".$_POST['email']."'";
					  		} ?>
					  >
					</div>
					<input type="submit" class="form-control btn btn-primary" name="submit" value="Search!">
				</div>
			</form>

			<?php
			if(isset($_POST['submit']) === true)
			{
				if(empty($_POST['email']) === false)
				{
					$email = sanitize($_POST['email']);
					$user_id = user_id_from_email($email);
					if($user_id === false)
					{
						?>
						<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'>
							</span> Sorry We can't find any user from: <b><?php echo $_POST['email']; ?></b>
						</div>
						<?php
					}
					else
					{
						find_student_from_confirm_list_for_workshop($user_id,$email,1);
					}

				}
				else
				{
					?>
					<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> Please type something in the search box.</div>
					<?php
				}
			}
			else
			{
				student_confirm_list_for_workshop($active_workshop_id);
			}

		 ?>

		</div>

<?php
		}
		include 'includes/overall/footer.php';

	}

}
else
{
	header('Location:index.php');
}


 ?>
