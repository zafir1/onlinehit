<?php 
include "core/init.php";
protected_page();
faculty_protected();
hod_protect();
include 'includes/overall/header.php';
?>
	<div class="well">
		<div class="well well-wb">
			<h2 class="well-blue">
				<i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>
				Manage faculty list
				<br>

				<small>
					<span class="glyphicon glyphicon-paperclip"></span>
					 Dear sir, Here you can manage your faculty list
				</small>
			</h2>
			<a href="addfacultypost.php?facultyID=<?php echo substr(md5($user_data['user_id']), 2,28); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Add post</a>
		</div>	
	</div>

	<?php


		if(isset($_GET['hiopxqlmd']) === true and isset($_GET['fstnme']) === true and isset($_GET['umeIsnDaer']) === true and isset($_GET['uemxaidlo']) === true)
		{
			if(empty($_GET['hiopxqlmd']) === false and empty($_GET['fstnme']) === false and empty($_GET['umeIsnDaer']) === false and empty($_GET['uemxaidlo']) === false )
			{
				$hod_email_code 	= sanitize($_GET['hiopxqlmd']);
				$user_id 			= sanitize($_GET['umeIsnDaer']);
				$first_name 		= sanitize($_GET['fstnme']);
				$user_email_code 	= sanitize($_GET['uemxaidlo']);

				if(user_id_email_code_first_name_combo($user_id,$first_name,$user_email_code) === true)
				{
					// Just upgrade here.
					upgrade_to_teacher($user_id,$user_email_code);
			?>

			<div class="card text-center well">
			<div class="well well-wb ">
			  <div class="card-header">
			    <i class="fa fa-smile-o" id='big_smile'></i>
			  </div>
			  <div class="card-block">
			    <h4 class="card-title"><mark><?php echo $first_name; ?></mark></h4>
			    <p class="card-text">This user has been successfully upgraded to faculty post</p>
			    <a href="upgradetoteacher.php" class="btn btn-primary">Faculty list</a>
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
					echo "Something went wrong";
				}

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
		<div class="well-wb well-blue">
			<b><label for='email'><span class="fa fa-user-plus"></span> Find email-id</label></b><br>
				
			<form class="form" method="POST" action='' autocomplete="off">
				
				 <div class="input-group margin-bottom-sm">
				  <span class="input-group-addon"><i class="fa fa-envelope-o well-blue fa-fw"></i></span>
				  <input id='email' name='email' class="form-control well-blue" type="email" placeholder="Find user from your department and upgrade to faculty..."
				  <?php if(isset($_POST['email'])=== true and empty($_POST['email']) === false)
					{
						echo "value= '".$_POST['email']."'";
					}
					  ?>
				  >
				</div>
				<!-- <br>

				<input type="email" name="email" class="form-control" id='email' placeholder="Find user from your department and upgrade to faculty..."
				<?php if(isset($_POST['email'])=== true and empty($_POST['email']) === false)
				{
					echo "value= '".$_POST['email']."'";
				}
				  ?>
				 > -->

				<input type="submit" name="submit" value="submit" class="btn btn-primary">
			</form>
		</div>
	</div>

	<?php 
		if(isset($_POST['submit']) === true)
		{
			if(empty($_POST['email']) === false)
			{
				$email = sanitize($_POST['email']);
				if(email_exists($email) === true)
				{
					$user_id = user_id_from_email($email);
					$searched_user_data = user_data($user_id,'user_id','username','first_name','last_name','email','email_code','department','member','gender');
					?>
					<div class="well">
						<div class="well well-wb">
							<ul>
								<li class="well-blue" title="Name: <?php echo $searched_user_data['first_name'].' '.$searched_user_data['last_name']; ?>">
								<b class="lead">
									<span class="glyphicon glyphicon-user"></span> 
										<?php 
											echo $searched_user_data['first_name'].' '.$searched_user_data['last_name'];
										 ?>
									</b>
								</li>

								<li class="time-h">
									<i class="fa fa-users well-blue"></i> <?php echo strtoupper($searched_user_data['department']); ?>
								</li>

								<li class="time-h" title="username: <?php echo $searched_user_data['username']; ?>">
									<i class="fa fa-id-card well-blue" aria-hidden="true"></i> 
									<?php echo $searched_user_data['username']; ?>
								</li>
								<li class="time-h" title="email: <?php echo $searched_user_data['email']; ?>">
									<i class="fa fa-envelope well-blue" aria-hidden="true"></i>
									<?php echo $searched_user_data['email']; ?>
								</li>
								<br>
								<li>
						<?php 
							if(is_faculty($searched_user_data['user_id']) === true)
							{
								?>
									<a href="" class="btn btn-primary  disabled" role="button" aria-disabled="true">Already in the faculty list</a>
									
								<?php
							}
							if($user_data['department'] != $searched_user_data['department'])
							{
								?>
									<a href="" class="btn btn-primary  disabled" role="button" aria-disabled="true">This user is not from your dept.</a>
									
								<?php
							}

							else if($user_data['department'] == $searched_user_data['department'] and is_faculty($searched_user_data['user_id']) === false)
							{
						?>

							<a href="upgradetoteacher.php?hiopxqlmd=<?php echo $user_data['email_code']; ?>&fstnme=<?php echo $searched_user_data['first_name']; ?>&umeIsnDaer=<?php echo $searched_user_data['user_id']; ?>&uemxaidlo=<?php echo $searched_user_data['email_code']; ?>">
							<span class="btn btn-success">Upgrade</span></a>

						<?php
							}
						?>
		
								</li>
							</ul>
							
							
						</div>
						
					</div>


					<?php
				}
				else
				{
					?>
						<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> Sorry, No result found.</div>
					<?php
				}
			}
			else
			{
				?>
					<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> Please type something in the search box.</div>
				<?php
			}
		}

	 ?>

	<div class="well lead">
		<div class="well well-wb well-blue">
			<span class="glyphicon glyphicon-hand-right"></span> Your department is having <?php 
			echo count_dept_teacher($user_data['department']); ?> faculties
		</div>
		
	</div>

	<div class="well">
		<div class="well well-wb">
			<table class="table table-bordered table-striped">
				<thead>
			      <tr>
			        <th>Faculty Details</th>
			        <th>Action</th>
			      </tr>
			    </thead>
    <tbody>
      <?php dept_teacher_list_at_hod($user_data['department'],$user_data['email_code']); ?>
    </tbody>
			</table>
		</div>
		
	</div>



<?php
	}
include 'includes/overall/footer.php';
?>