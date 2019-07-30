 <ul class="nav navbar-nav">
	
</ul>

<ul class="nav navbar-nav navbar-right">
		<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
		<li><a href="facultywalls.php"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Faculty-Walls</a></li>
		<li><a href="library.php"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Library</a></li>
		<li><a href="clubs.php"><span class="fa fa-users" aria-hidden="true"></span> Clubs</a></li>
		<li><a href="downloads.php"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Downloads</a></li>
		<li><a href="chatlist.php"><span class="fa fa-comments-o"></span> Chat</a></li>
		<?php 
			if(logged_in() === true)
			{
		?>
		<li id="top_menu"><a href="<?php echo $user_data['username']; ?>">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile</a></li>
		<li id="top_menu"><a href="changepassword.php">
		<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> change password</a></li>
		<?php 
			if(is_faculty($user_data['user_id']) === true and user_id_exists_in_teacher_personal_data_table($user_data['user_id']) === true)
			{
				?>
		<li id="top_menu"><a href="faculty.php?facultyID=<?php echo substr(md5(substr($user_data['email_code'],10,20)),5,10); ?>">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Faculty Action</a></li>
				<?php
			}
			if(has_access($user_data['user_id'],'admin') === true)
			{
				?>
		<li id="top_menu"><a href="admin.php">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Admin</a></li>
				<?php
			}
		 ?>

		<li id="top_menu"><a href="settings.php">
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li>
		<li id="top_menu"><a href="logout.php">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout </a></li>

		<?php
			}

		 ?>
		<li><a href="contact.php"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contact us</a></li>
		
	
</ul>