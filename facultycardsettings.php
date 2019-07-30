<?php 
	include "core/init.php";
	protected_page();
	if($user_data['faculty'] != 1)
	{
		header('Location:index.php');
		exit();
	}
	if(!user_id_exists_in_teacher_personal_data_table($user_data['user_id']))
	{
		header('Location:index.php');
		exit();
	}
	$address_detail = faculty_address_detail($user_data['user_id']);
	if($address_detail == false)
	{
		header('Location:index.php');
		exit();
	}
	include "includes/overall/header.php";

	if(empty($_POST) === false)
	{
		$required_fields = array('designation','contact_number','office_address');
		foreach ($_POST as $key => $value)
			if(empty($value) and in_array($key, $required_fields) === true){
				$errors[] = "Fields mark with an asterisk is required!";
				break 1;
			}

	}

	if(isset($_POST['submit']) and empty($errors)===true){
		$len = strlen(sanitize($_POST['contact_number']));
		if($len!=10)
		{
			$errors[] = "This contact number is not valid";
		}
	}
	
?>
	
	<div class="well">
		<div class="well well-wb well-blue">
			<h3><i class="fa fa-id-card"></i> Card Update <br> 
			<small> <i class="glyphicon glyphicon-paperclip"></i> Update your personal card settings</small>
			</h3>
		</div>
		<?php 
			if(empty($_POST) === false and empty($errors) === true)
			{
				//update users
				$update_data = array(
						'designation' 		=> $_POST['designation'],
						'office_address'	=> $_POST['office_address'],
						'contact_number' 	=> $_POST['contact_number']
					);
				update_faculty_address($update_data);
				header("Location: facultycardsettings.php?update=Updated");
			}
			else if(empty($_POST) === false and empty($errors) === false)
			{
				
				echo output_errors($errors);
				
			}
		 ?>

		 <?php 
		 	if(isset($_GET['update'])===true and (sanitize($_GET['update']) === "Updated")){
		 ?>
		 	
		 		<div class="well well-wb well-blue">
		 			<div class="card text-center">
					  <div class="card-header">
					    <i class="fa fa-smile-o" id='big_smile'></i>
					  </div>
					  <div class="card-block">
					    <h4 class="card-title">Thank you! </h4>
					    <p class="card-text">We have successfully updated your card details.</p>
					    <a href="index.php" class="btn btn-primary"><i class="fa fa-home"></i> Home</a>
					  </div>
					  <div class="card-footer text-muted">
					    OnlineHIT
					  </div>
					</div>
		 		</div>
		 	


		 <?php
		 	}else{

		  ?>
		 <form action="facultycardsettings.php" method="POST" autocomplete="off">
		 	<ul class="well-blue">
		 		<li>
		 			<label for="designation">
						<b><span class="glyphicon glyphicon-hand-right"></span> Designation 
						<span class="fa fa-asterisk"></span>
						</b>
					</label>
					<input id="designation" type="text" name="designation" class="form-control well-blue" placeholder="Designation" value="<?php 
						if(isset($_POST['designation'])===true)
						{
							echo $_POST['designation'];
						}
						else{
							echo $address_detail->designation;
						}
					 ?>">
		 		</li>
		 		<br>
		 		<li>
		 			<label for="office_address">
						<b><span class="glyphicon glyphicon-hand-right"></span> Office Address 
						<span class="fa fa-asterisk"></span>
						</b>
					</label>
					<input id="office_address" type="text" name="office_address" class="form-control well-blue" placeholder="Office Address" value="<?php 
						if(isset($_POST['office_address'])===true)
						{
							echo $_POST['office_address'];
						}
						else{
							echo $address_detail->office_address;
						}
					 ?>">
		 		</li>

		 		<br>
		 		<li>
		 			<label for="contact_number">
						<b><span class="glyphicon glyphicon-hand-right"></span> Contact number 
						<span class="fa fa-asterisk"></span>
						</b>
					</label>
					<input id="contact_number" type="number" name="contact_number" class="form-control well-blue" placeholder="Contact number" value="<?php 
						if(isset($_POST['contact_number'])===true)
						{
							echo $_POST['contact_number'];
						}
						else{
							echo $address_detail->contact_number;
						}
					 ?>">
		 		</li>
		 		<br>

				<li>
					
					<input type="submit" name="submit" value="Update Details" class="btn btn-primary">
				</li>
		 	</ul>
		 </form>
		 <?php } ?>
	</div>


<?php
	
	include "includes/overall/footer.php";	
?>