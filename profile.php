<?php
    include "core/init.php";
    protected_page();
	include "includes/overall/header.php";
	if(isset($_GET['username']) === true and empty($_GET['username']) === false)
	{
		$username = sanitize($_GET['username']);
		if(user_exists($username) === true)
		{
			$user_id = user_id_from_username($username);
			$profile_data = user_data($user_id,'first_name','last_name','email','username','member','uni_roll','uni_reg','year','batch','department','college_id');

?>
	<div class="well">
		<div class="well well-wb well-blue" title=" <?php echo $profile_data['first_name'] ?>'s Profile ">
			<h3>
				<span class="fa fa-institution"> |</span>
				<span class="lead">HALDIA INSTITUTE OF TECHNOLOGY </span>
				<br>

				<small>
				<span class="fa fa-mortar-board"> |</span>
				<?php echo give_department_full_form($profile_data['department']); ?></small>
			</h3>
		</div>
		
	</div>
	<div class="well">
		<div class="well well-blue well-wb">
			<ul>
				<li title="<?php echo $profile_data['first_name']; ?>'s Profile">
					<h3 class="lead">
						<span class="fa fa-user-circle-o"> |</span> <?php echo $profile_data['first_name'].' '.$profile_data['last_name']; ?>
					</h3>
				</li>

				<li title="email: <?php echo $profile_data['email']; ?> ">
					<span class="fa fa-envelope-o"> |</span> <b><?php echo $profile_data['email']; ?></b>
				</li>
				<?php 
					if($user_id == $user_data['user_id'])
					{
				?>
						<li title="username: <?php echo $profile_data['username']; ?> ">
							<span class="fa fa-user"> |</span> <b><?php echo $profile_data['username']; ?></b>
						</li>

				<?php
					}

				if(is_faculty($user_id) === false)
				{
					?>
				<li title="Unversity Roll Number: <?php echo $profile_data['uni_roll']; ?> ">
					<span class="fa fa-registered"> |</span> <b>Roll: <?php echo $profile_data['uni_roll']; ?></b>
				</li>

				<li title="Unversity Registration number: <?php echo $profile_data['uni_reg']; ?> ">
					<span class="fa fa-registered"> |</span> <b>Reg: <?php echo $profile_data['uni_reg']; ?></b>
				</li>

				<li title='Current Year: <?php echo $profile_data['year']; ?>'>
					<span class="fa fa-clock-o"> |</span> <b><?php echo give_year_full_form($profile_data['year']); ?></b>
				</li>

				<li title='Batch: <?php echo $profile_data['batch']; ?>'>
					<span class="fa fa-object-group"> |</span> <b><?php echo give_batch_full_form($profile_data['batch']); ?></b>
				</li>

					<?php
				}
				else
				{
					
				}

				  ?>

				<li>
					<h3>
						<small>~ OnlineHIT</small>
					</h3>
				</li>
				
			</ul>
			
			
		</div>
		
	</div>

<?php
		}
		else
		{
			echo "Sorry this username doesnot exist in our database.";
		}
	}
	else
	{
		header("Location:index.php");
	}

?>



<?php include "includes/overall/footer.php";?>