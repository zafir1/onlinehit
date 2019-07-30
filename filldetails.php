<?php 
	include 'core/init.php';
	protected_page();
	if($user_data['details'] == 1)
	{
		header("Location:index.php");
	}
	include 'includes/overall/header.php';
	 

 	$allowed_departments 		= array('bt','che','cvl','cse','it','ece','ee','ft','ice','me','pe');
 	/*'ece','cse','me','ice'*/
	$allowed_year				= array('1','2','3','4','9');
	$allowed_course_duration 	= array('12','13','14','15','16','17');
	$allowed_batch				= array('1','2');

	if(isset($_GET['studentDetail']) === true and empty($_GET['studentDetail']) === false)
	{
		/*if(sanitize($_GET['studentDetail']) === 'SuCCess')
		{
			?>
				<div class="well">
					<div class="well well-wb">
						<div class="card text-center">
						  <div class="card-header">
						    <span class="fa fa-smile-o well-blue" id='big_smile'></span>
						  </div>
						  <div class="card-block">
						    <h4 class="card-title well-blue">Thank you</h4>
						    <p class="card-text lead well-blue">Your details has been saved successfully</p>
						    <a href="index.php" class="btn btn-primary"> 
						   		<span class="fa fa-home"></span> Home Wall
						    </a>
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
			header('Location: logout.php');
		}*/
		
	}
	else if($user_data['uni_roll'] !== NULL){

	if(isset($_POST['submit']) === true)
	{

		if(empty($_POST['department']) === true)
		{
			$errors[] = "Please Select Your Department.";
		}
		if(empty($_POST['year']) === true)
		{
			$errors[] = "Please Select Your Year.";
		}
		if(empty($_POST['course_duration']) === true){

			$errors[] = "Please Select Your Course Duration.";
		}
		if(empty($_POST['batch']) === true)
		{
			$errors[] = "Please Select Your Batch.";
		}

		if(empty($errors) === false)
		{
			echo output_errors($errors);
		}
		else if(empty($errors) === true)
		{

			if(in_array($_POST['department'], $allowed_departments) === false)
			{
				$errors[] = "Manually Entered departments are not valid.";
			}
			if(in_array($_POST['year'], $allowed_year) === false)
			{
				$errors[] = "Please don't enter your current year manually.";
			}
			if(in_array($_POST['course_duration'], $allowed_course_duration) === false)
			{
				$errors[] = "Manually Entered course duration is not valid.";
			}
			if(in_array($_POST['batch'], $allowed_batch) === false)
			{
				$errors[] = "Manually Entered batch is invalid.";
			}

			if(empty($errors) === false)
			{
				echo output_errors($errors); 
			}
			else
			{
				// update users table
				$academic_details = array(
					'department' 			=> $_POST['department'],
					'year'					=> $_POST['year'],
					'course_duration'		=> $_POST['course_duration'],
					'batch'					=> $_POST['batch']

				);
				fill_users($academic_details);
				header("Location:greeting.php?UsERiD=".substr(md5($user_data['user_id']),4,24));
				exit();
			}

		}
	
	}


 	 ?>

 	 <div class="well">
 		<div class="well well-wb well-blue">
 			<h2>	
 				<i class="fa fa-id-card-o"></i> Basic details <br>
 				<small>
 					<span class="glyphicon glyphicon-paperclip"></span>
 					Please fill your basic details.
 				</small>

 			</h2>
 			
 		</div>

 		<div class="well">
	 		<form action="filldetails.php" method="POST" autocomplete="off">
	 			<ul class="well-blue">
	 				<li>

	 					<span class="glyphicon glyphicon-hand-right"></span>
	 					<label for='department'><strong>Select your Department*</strong></label><br>
						<select class="form-control well-blue" name="department" id='department'>
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
	 				</li><br>

	 				<li>
	 					<span class="glyphicon glyphicon-hand-right"></span>
	 					<strong>Select Your Year*</strong><br>
						<select class="form-control well-blue" name="year">
							<option value="">Please select your year</option>
							<option value="1">1st year</option>
							<option value="2">2nd year</option>
							<option value="3">3rd year</option>
							<option value="4">4th year</option>
							<option value="9">Passed Out</option>
						</select>
	 				</li><br>

	 				<li>
	 					<span class="glyphicon glyphicon-hand-right"></span>
	 					<strong>Select your Course duration*</strong><br>
						<select class="form-control well-blue" name="course_duration">
							<option value="">Select your course duration</option>
							<option value="12">2012-16</option>
							<option value="13">2013-17</option>
							<option value="14">2014-18</option>
							<option value="15">2015-19</option>
							<option value="16">2016-20</option>
							<option value="17">2017-21</option>
						</select>
	 				</li><br>

	 				<li>
	 					<span class="glyphicon glyphicon-hand-right"></span>
	 					<strong>Select your Batch:</strong>
						<div class="radio-inline">
						  <label><input type="radio" class="radio-inline well-blue" name="batch" value="1">Batch 1</label>
						</div>
						<div class="radio-inline">
						  <label><input type="radio" class="radio-inline well-blue" name="batch" value="2">Batch 2</label>
						</div>
	 				</li>

	 				<li>
	 					<input type="submit" name="submit" value="Submit" class="btn btn-primary">
	 				</li>
	 			</ul>
				
			</form>
		</div>
 	</div>



 <?php
 	}

 	else if(($user_data['uni_roll'] === NULL) and ($user_data['uni_reg'] === NULL) and ($user_data['college_id'] === NULL))
 	{
 		?>
 			<div class="well">
 				<div class="well well-wb well-blue">
 					<h2>
 						<span class="fa fa-handshake-o"></span>
 						Department Selection <br>
 						<small>
 							<span class="glyphicon glyphicon-paperclip"></span>
 							Select your department and move to your HOD
 						</small>
 						
 					</h2>
 				</div>
 			</div>
 			<?php 
 					if(isset($_POST['submitt']) === true)
		 			{
		 				if(empty($_POST['dept']) === true)
		 				{
		 					$errors[] = "Please select your department";
		 				}
		 				if(empty($errors) === true)
		 				{
		 					if(in_array($_POST['dept'], $allowed_departments) === false)
		 					{
		 						$errors[] = "You can't enter <b>departments manually</b>";
		 					}
		 				}
		 				if(empty($errors) === true)
		 				{
		 					$department = sanitize($_POST['dept']);
		 					fill_faculty_basic_detail($user_data['user_id'],$department);
		 					header("Location:greeting.php?UsERiD=".substr(md5($user_data['user_id']),4,24));
		 					exit();
		 				}
		 				else
		 				{
		 					echo output_errors($errors);
		 				}

		 			}

 			 ?>

 			<div class="well">
 				<div class="well well-wb well-blue">
 					<form action="filldetails.php" method="POST" autocomplete="off">
 						<ul>
 							<li>
 								<label for="dept">
		 						<i class="fa fa-cog fa-spin fa-2x fa-fw"></i>
									<span class="lead"><b>Department</b></span>
		 						</label>
		 						<select id='dept' name='dept' class="form-control well-blue">
		 							<option value="">Select Your Department</option>

		 							<option value="bt">Biotechnology</option>
		 							<option value="che">Chemical Engineering</option>
		 							<option value="cvl">Civil Engineering</option>

		 							<option value="cse">Computer Science Engineering</option>
		 							<option value="it">Information technology</option>
									<option value="ece">Electronics and communication Engineering</option>

									<option value="ee">Electrical Engineering</option>
									<option value="ft">Food Technology</option>
									<option value="ice">Instrumentation and Control Engineering</option>

									<option value="me">Mechanical Engineering</option>
									<option value="pe">Production Engineering</option>

		 						</select>
 							</li>
 							<li>
 								<input type="submit" name="submitt" value="Submit" class="btn btn-primary">
 							</li>
 						</ul>
 						
 					</form>
 					
					
 				</div>
 			</div>
 			

<?php
 	}
 include 'includes/overall/footer.php';
  ?>