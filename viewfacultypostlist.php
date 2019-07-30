<?php 
include "core/init.php";
protected_page();
faculty_protected();

	if(isset($_GET['facultyID']) === true and empty($_GET['facultyID']) === false)
	{
		if(sanitize($_GET['facultyID']) === substr(md5($user_data['username']), 5,18))
		{
			if(user_id_exists_in_teacher_personal_data_table($user_data['user_id']) === false)
				{
					header('Location:faculty_details_form.php?facultyID='.substr(md5($user_data['user_id']), 2,28).'');
				}
			include "includes/overall/header.php";
?>
				<div class="well">
					<div class="well well-wb well-blue">
					<h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Post statistics<br> 
						<small>
						<span class="glyphicon glyphicon-blackboard"></span>
							Here you can control your posts, posted for students
						</small><br>

					</h2>
					<a href="addfacultypost.php?facultyID=<?php echo substr(md5($user_data['user_id']), 2,28); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Add post</a>
					</div>
				</div>

				<div class="well">
					
					<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Heading</th>
							<th>Title</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>	
						<?php  echo_faculty_post_list($user_data['user_id']); ?>
					</tbody>
				</table>
				
				</div>



<?php
			include "includes/overall/footer.php";
		}
		else
		{
			header("Location: index.php");
		}
	}
	else
	{
		header("Location: index.php");
	}
?>