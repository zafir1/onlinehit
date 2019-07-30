<?php 
include "core/init.php";
protected_page();
faculty_protected(); 


if(isset($_GET['facultyID']) === true and empty($_GET['facultyID']) === false)
{
	$facultyID = sanitize($_GET['facultyID']);
	if($_GET['facultyID'] === substr(md5($user_data['user_id']), 2,28))
	{
include "includes/overall/header.php";


		if(isset($_GET['detailsfilled']) === true and empty($_GET['detailsfilled']) === false)
		{
			if($_GET['detailsfilled'] === 'SuccEss')
			{
				?>

			<div class="card text-center well alert alert-success lead">
				<div class="well">
					<div class="card-header">
				  		<h1>OnlineHIT</h1>
					    <i class="fa fa-smile-o" aria-hidden="true" id='big_smile'></i>
					</div>

					  <div class="card-block">
					    <h4 class="card-title">Thank you for connecting with us.</h4>
					    <p class="card-text">
						    We have successfully saved your personal data. <br>
						    Now as a faculty you are the core member of OnlineHIT.
					    </p>
					    <a href="addfacultypost.php?facultyID=<?php echo substr(md5($user_data['user_id']), 2,28); ?>" class="btn btn-primary" >
					    	<span class="glyphicon glyphicon-pencil"></span> Add post 
					    </a>
					  </div>

					  <div class="card-footer text-muted">
					    OnlineHIT
					  </div>
				</div>
			</div>

				<?php
			}
		}
		else
		{

				if(isset($_POST['submit']) === true)
				{
					$required_fields = array('designation','department','office_address','contact');
					foreach ($_POST as $key => $value) {
					if(empty($value) and in_array($key, $required_fields) === true){
						$errors[] = "Fields mark with an asterisk is required!";
						break 1;
						}
					}

					if(empty($errors) === true)
					{
						$designation 	= sanitize($_POST['designation']);
						$department 	= sanitize($_POST['department']);
						$office_address = sanitize($_POST['office_address']);
						$contact 		= sanitize($_POST['contact']);
						
						if(strlen($designation) > 100)
						{
							$errors[] = "Designation must be less then 100 character";
						}

						if(strlen($department) > 100)
						{
							$errors[] = "Department must be less then 100 character";
						}

						if(strlen($office_address) > 250)
						{
							$errors[] = "Office address must be less then 100 character";
						}

						if(strlen($contact) != 10)
						{
							$errors[] = "Contact number must be of 10 character";
						}

						if(empty($errors) === true)
						{
							$faculty_personal_data = array(

												'user_id'			=> $user_data['user_id'],
												'department'		=> $department,
												'office_address'	=> $office_address,
												'contact_number'	=> $contact,
												'designation' 		=> $designation

									);

							 fill_faculty_personal_details($faculty_personal_data);
							 header('Location:faculty_details_form.php?facultyID='.substr(md5($user_data['user_id']), 2,28).'&detailsfilled=SuccEss');
							 exit();
						}
						else
						{
							echo output_errors($errors);
						}

					}
					else
					{
						echo output_errors($errors);
					}
				}

			 ?>
			 <div class="well">
			 	<div class="well well-wb well-blue">
					<h2>
						<i class="fa fa-address-card-o" aria-hidden="true"></i>
						Personal online card
					<br>
					<small>
						<i class="fa fa-television" aria-hidden="true"></i>
						We will display it as your personal card
						</small>
					</h2>
					<span id="float_right">A demo is given below</span>

				</div>
			 </div>
			 

			<div class="well">
				<form action="" method="POST" autocomplete="off" class="form-group well">
					<ul class="well-blue">
						<li title="Type your designation in the Designation">
							<label for="designation">
							<b><span class="glyphicon glyphicon-hand-right"></span>
							Designation <span class="glyphicon glyphicon-asterisk"></span></b></label><br>
							<input type="text" id='designation' name="designation" class="form-control well-blue"
							 placeholder="Type your designation in the department" <?php 
							if(isset($_POST['designation']) === true and empty($_POST['designation']) === false)
									{
										echo "value = '".$_POST['designation']."'";
									}
						 ?>>
							 <span id="float_right">Less then 100 character</span>
						</li>
						<br>
						<li title="Type your full department name like 'Electronics and communication engineering'">
							<label for="department">
							<b><span class="glyphicon glyphicon-hand-right"></span>
							Department <span class="glyphicon glyphicon-asterisk"></span></b></label><br>
							<input type="text" id='department' name="department" class="form-control well-blue" title="Type your full department name 
							like 'Electronics and communication engineering' "
							 placeholder="Type your full department name..." <?php 
							if(isset($_POST['department']) === true and empty($_POST['department']) === false)
									{
										echo "value = '".$_POST['department']."'";
									}
						 ?>>
							 <span id="float_right">Less then 100 character</span>
						</li>
						<br>
						<li title="Type your office address here in short.">
							<label for="office_address">
							<b><span class="glyphicon glyphicon-hand-right"></span>
							Office address <span class="glyphicon glyphicon-asterisk"></span></b></label><br>
							<input type="text" id='office_address' name="office_address" class="form-control well-blue" 
							 placeholder="Type your office address" <?php 
							if(isset($_POST['office_address']) === true and empty($_POST['office_address']) === false)
									{
										echo "value = '".$_POST['office_address']."'";
									}
						 ?>>
							 <span id="float_right">Less then 250 character</span>
						</li>
						<br>
						<li  title="Contact number">
							<label for="contact">
							<b><span class="glyphicon glyphicon-hand-right"></span>
							Contact no <span class="glyphicon glyphicon-asterisk"></span></b></label><br>
							<input type="number" id='contact' name="contact" class="form-control well-blue" 
							 placeholder="9473142093" <?php 
							if(isset($_POST['contact']) === true and empty($_POST['contact']) === false)
									{
										echo "value = '".$_POST['contact']."'";
									}
						 ?>>
							 <span id="float_right">Only 10 character</span>
						</li>
						<br>
						<!-- <li  title="If you are having a profile link on the official site of 'HIT' then please paste that link otherwise leave this..">
							<label for="dlink">
							<b>Detail Link</b></label><br>
							<input type="text" id='dlink' name="detail_link" class="form-control" placeholder="If available then plese give your HIT profile Link..." <?php 
							if(isset($_POST['detail_link']) === true and empty($_POST['detail_link']) === false)
									{
										echo "value = '".$_POST['detail_link']."'";
									}
						 ?>>
							<span id="float_right">Please Enter accurate web link</span>
						</li>
						<br> -->
						<li>
							<input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</li>

					</ul>
				</form>
			</div>

			<div class="well">
			<ul class="well">
				<span id="float_right"><span class="glyphicon glyphicon-hand-right"></span> This is the demo version</span>
				<li>
					<h2>
						<a href="">
							<span class="glyphicon glyphicon-user"></span>	
							Tilak Mukherjee
						</a><br>

							<small>
								<span class="glyphicon glyphicon-paperclip"></span> Assistant Professor
							</small>
					</h2>
				</li>

				<li class="time-h" title="department">
					<span class="glyphicon glyphicon-flag"> Electronics And Communication Engg.</span>
				</li>

				<li class="time-h" title="Office address">
					<span class="glyphicon glyphicon-road"> First floor, ECE department, Room number-9</span>
				</li>

				<li class="time-h" title="Email-ID">
					<span class="glyphicon glyphicon-envelope"> mukherjeetilak@gmail.com</span>
				</li>

				<li class="time-h" title="Contact number">
					<span class="glyphicon glyphicon-phone-alt"> 9835660347</span>
				</li>

			</ul>
		</div>






<?php
}
include "includes/overall/footer.php";
	}
	else
	{
		
		header("Location:logout.php");
	}
}
else
{
	header('Location:logout.php');
}
?>