<?php 
	include "core/init.php";
	protected_page();
	if(isset($_GET['facultyID']) === true and empty($_GET['facultyID']) === false)
	{
		$faculty_pwid = sanitize($_GET['facultyID']);
		if(pwid_exists($faculty_pwid) === true)
		{
			$faculty_user_id = faculty_id_from_pwid($faculty_pwid);
			$faculty = user_data($faculty_user_id,'first_name','last_name','email','email_code','department');

			include "includes/overall/header.php";

			get_faculty_list_for_facultywall_page($faculty_user_id,$faculty['first_name'],$faculty['last_name'],$faculty['email'],$faculty['email_code'],$faculty['department']);
			echo "<div class='well'>";
			faculty_post_list_from_fpwid($faculty_pwid,$faculty['first_name'],$faculty['last_name']);
			echo "</div>";

			include "includes/overall/footer.php";
		}
		else
		{
			header("Location: index.php");
		}
		
	}
 ?>