<?php 
	include "core/init.php";
	protected_page();
	if(is_faculty($user_data['user_id']) === true)
	{
		header('Location: index.php');
	}
	include "includes/overall/header.php";

	if(isset($_GET['pRoFle']) === true and empty($_GET['pRoFle']) === false)
	{
		if($_GET['pRoFle'] === 'UpDAtED32558THYTRE')
		{
			?>
				<div class="well">
	<div class='well well-wb'>
		<h2 class="well-blue"><span class="fa fa-cogs" aria-hidden="true"></span> Academic Settings <br>
			<small>
				<span class="glyphicon glyphicon-paperclip"></span> Successfully updated
			</small>
		</h2>
	</div>
		<div class="well well-wb">
			<div class="card text-center">
			  <div class="card-header">
			    <span class="fa fa-smile-o well-blue" id='big_smile'></span>
			  </div>
			  <div class="card-block">
			    <h4 class="card-title well-blue">Thank you.</h4>
			    <p class="card-text lead well-blue">We have successfully updated your academic details.</p>
			    <a href="<?php echo $user_data['username']; ?>" class="btn btn-primary"><span class="fa fa-user-o"></span> Profile</a>
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
			header('Location: index.php');
		}
	}
	else
	{
	
?>
<div class="well">
	<div class='well well-wb'>
		<h2 class="well-blue"><span class="fa fa-cogs" aria-hidden="true"></span> Academic Settings <br>
			<small>
				<span class="glyphicon glyphicon-paperclip"></span> Update your profile
			</small>
		</h2>
	</div>
<?php

	$allowed_departments 		= array('bt','che','cvl','cse','it','ece','ee','ft','ice','me','pe');
	$allowed_year				= array('1','2','3','4');
	$allowed_batch				= array('1','2');

	if(isset($_POST['submit']) === true)
	{
		$required_fields = array('department','year','batch');
		foreach ($_POST as $key => $value) {
		if(empty($value) and in_array($key, $required_fields) === true){
			$errors[] = "Fields mark with an asterisk is required!";
			break 1;
			}
		}
		if(empty($errors) === true)
		{
			if(in_array($_POST['department'], $allowed_departments) === false)
			{
				$errors[] = "Manually entered departments are not valid.";
			}
			if(in_array($_POST['year'], $allowed_year) === false)
			{
				$errors[] = "Please don't enter your current year manually.";
			}
			if(in_array($_POST['batch'], $allowed_batch) === false)
			{
				$errors[] = "Manually Entered batch is invalid.";
			}
		}

		if(empty($errors) === true)
		{
			$department 	= sanitize($_POST['department']);
			$year 			= (int)sanitize($_POST['year']);
			$batch 			= (int)sanitize($_POST['batch']);
			$update_data = array(
					'department' 	=> $department,
					'year'			=> $year,
					'batch' 		=> $batch
				);
			update_user($update_data);
			header('Location:settmre.php?pRoFle=UpDAtED32558THYTRE');
			exit();
		}
		else
		{
			echo output_errors($errors);
		}

	}

 ?>
	<div class="well">
		<form action="settmre.php" method="POST" autocomplete="off">
			<ul class="well-blue">
				<li>
					<label for="department">
						<b><span class="glyphicon glyphicon-hand-right"></span> Department 
						<span class="fa fa-asterisk"></span>
						</b>
					</label>
					
					<div class="input-group margin-bottom-xl">
						<span class="input-group-addon well-blue">
						<i class="fa fa-flag-checkered fa-fw"></i></span>

							<select class="form-control well-blue" id='department' name="department" >
								<option value="">Select Your Department</option>
								<option value="ece">Electronics and communication Engineering</option>
	 							<option value="che">Chemical Engineering</option>
	 							<option value="cvl">Civil Engineering</option>

	 							<option value="cse">Computer Science Engineering</option>
	 							<option value="it">Information technology</option>
								<option value="bt">Biotechnology</option>

								<option value="ee">Electrical Engineering</option>
								<option value="ft">Food Technology</option>
								<option value="ice">Instrumentation and Control Engineering</option>

								<option value="me">Mechanical Engineering</option>
								<option value="pe">Production Engineering</option>
							</select>
					</div>
				</li>
				<br>
				<li>
					<label for="year">
						<b><span class="glyphicon glyphicon-hand-right"></span> Year 
						<span class="fa fa-asterisk"></span>
						</b>
					</label>
					
					<div class="input-group margin-bottom-xl">
						<span class="input-group-addon well-blue">
						<i class="fa fa-clock-o fa-fw"></i></span>

							<select class="form-control well-blue" name='year' id='year'>
								<option value="">Select your current year</option>
								<option value="1">1st year</option>
								<option value="2">2nd year</option>
								<option value="3">3rd year</option>
								<option value="4">4th year</option>
							</select>
					</div>
				</li>

				<br>
				<li>
					<label for="batch">
						<b><span class="glyphicon glyphicon-hand-right"></span> Batch 
						<span class="fa fa-asterisk"></span>
						</b>
					</label>
					
					<div class="input-group margin-bottom-xl">
						<span class="input-group-addon well-blue">
						<i class="fa fa-flag-o fa-fw"></i></span>

							<select class="form-control well-blue" name='batch' id='batch'>
								<option value="">Select your Batch</option>
								<option value="1">1st Batch</option>
								<option value="2">2nd Batch</option>
							</select>
					</div>
				</li>

				<br>

				<input type="submit" name="submit" value="update academic details" class="btn btn-primary">

			</ul>
		</form>

	</div>
</div>


<?php 
}
include 'includes/overall/footer.php'; ?>