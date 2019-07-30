<div class="widget" id='aside_menu'>
	<div class="inner well well-wb">
	<h2>Hello <?php echo $user_data['first_name']; ?></h2>
	<ul>
		<li><a href="logout.php">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout </a></li> 

		<li><a href="<?php echo $user_data['username']; ?>">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile</a></li>

		<li><a href="changepassword.php">
		<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> change password</a></li>

		<li><a href="settings.php">
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li>

		<?php 
			if(is_faculty($user_data['user_id']) === true and user_id_exists_in_teacher_personal_data_table($user_data['user_id']) === true)
			{
				?>
					<a href="faculty.php?facultyID=<?php echo substr(md5(substr($user_data['email_code'],10,20)),5,10); ?>"><i class="fa fa-address-card" aria-hidden="true"></i> Faculty</a>
				<?php
			}

			if($user_data['type'] == 'admin')
			{
				?>
					<a href="admin.php"><i class="fa fa-user-o"></i> Admin</a>
				<?php
			}
		 ?>
		
	</ul>
	</div>
</div>