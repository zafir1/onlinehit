<?php 
include "core/init.php";
include 'includes/overall/header.php'; 
?>
<div class="well">
	<div class="well well-blue well-wb">

		<h3>
			<img src="http://www.demorgia.com/wp-content/uploads/2017/06/Haldia-Institute-of-Technology.png" alt="Haldia-Institute-of-Technology" width="50px" height="50px">
			<span class="fa fa" aria-hidden="true"></span>
				Haldia Institute of Technology
			<br>
		</h3>
		<span class="glyphicon glyphicon-flag"></span> Electronics and communication engg.
</div>
	</div>
	
	
	
	<?php

		if(logged_in() === true)
		{
			include 'core/manage_id_ip_combo.php';


			if($user_data['details'] == 0)
			{
				header("Location:filldetails.php");
				exit();
			}

			if(is_faculty($user_data['user_id']) === true)
			{
				if(user_id_exists_in_teacher_personal_data_table($user_data['user_id']) === false)
				{
					header('Location:faculty_details_form.php?facultyID='.substr(md5($user_data['user_id']), 2,28).'');
				}
			}


			if($user_data['faculty'] == 0)
			{
				user_home_wall_news_list();
			}

			if($user_data['faculty'] == 1)
			{

				faculty_home_wall_news_list();
			}

		}
		else if(logged_in() === false){
			echo "<div class='well'>";
				include "includes/home_message.php";
			echo "</div>";
		}

	 ?>
	 
	 <?php 
	 	
	  ?>
	 


<?php include "includes/overall/footer.php"; ?>