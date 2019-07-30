<?php 
include "core/init.php";
protected_page();
faculty_protected();
if(isset($_GET['facultyID']) === true and empty($_GET['facultyID']) === false)
{
	if(sanitize($_GET['facultyID']) === substr(md5($user_data['user_id']), 2,28))
	{
		if(user_id_exists_in_teacher_personal_data_table($user_data['user_id']) === false)
			{
				header('Location:faculty_details_form.php?facultyID='.substr(md5($user_data['user_id']), 2,28).'');
			}

		$facultyID = sanitize($_GET['facultyID']);
		include "includes/overall/header.php";
		ckeditor();

?>	
	<div class="well">
		<div class="well well-wb well-blue">
			<h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Add News / Post <br> 
				<small>
				<span class="glyphicon glyphicon-blackboard"></span>
					You can add post for students on this page
				</small>
			</h2>
			<a href="viewfacultypostlist.php?facultyID=<?php echo substr(md5($user_data['username']), 5,18); ?>" class="btn btn-primary"><span class="fa fa-eye"></span> Manage Post</a>
		</div>
			
	</div>

<?php 
		if(isset($_GET['post']) === true and empty($_GET['post']) === false 
			and sanitize($_GET['post']) === 'posted')
		{
?>


<div class="well">
	<div class="well well-wb well-blue">
		<div class="card text-center">
		  <div class="card-header">
		    <i class="fa fa-smile-o" id='big_smile'></i>
		  </div>
		  <div class="card-block">
		    <h4 class="card-title lead">Thank you!</h4>
		    <p class="card-text time-h">We have successfully added your post.</p>
		    <a href="viewfacultypostlist.php?facultyID=<?php echo 
					substr(md5($user_data['username']), 5,18);
	?>" class="btn btn-primary"><i class="fa fa-bar-chart-o"></i> Post status.</a>
		  </div>
		  <div class="card-footer text-muted">
		    OnlineHIT
		  </div>
		</div>
	</div>
	
</div>


<!-- <div class="well alert alert-success">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>
					<h3>
						<span title="Delete this message completely" class="glyphicon glyphicon-envelope" 
						aria-hidden="true"></span> 
						Your message was posted successfully.
					</h3>
				</th>
			</tr>
			<tr>
			<th>
				<ul>
					<li>
						<h4>
						<span title="Click here to View this Post" class="alert alert-success glyphicon glyphicon-eye-open" aria-hidden="true"> View this Post</span>
						</h4>
					</li>

					<li>
						<h4>
						<span title="Click here to Edit this Post" class="alert alert-success glyphicon glyphicon-edit" aria-hidden="true"> Edit this Post.</span>
						
						</h4>
					</li>

					<li>
						<h4><a href="addfacultypost.php?facultyID=<?php echo $facultyID;?>">
						<span title="Add a new post" class="alert alert-success glyphicon glyphicon-pencil" aria-hidden="true"> Add  new Post</span>
						</a>
						</h4>
					</li>

					<li>
						<h4>
						<a href="">
						<span title="Click me to delete this Post." class="alert alert-danger glyphicon glyphicon-trash" aria-hidden="true"> Delete This Post</span>
						</a>
						</h4>
					</li>

				</ul>

			</th>
		</tr>
	</thead>
			
	</table>
</div> -->


<?php


		}
		else if(isset($_GET['post']) === true and empty($_GET['post']) === false 
			and sanitize($_GET['post']) !== 'posted')
		{
			?>
				<div class="alert alert-danger">
					<h4><span class="glyphicon glyphicon-alert"></span> Please don't modify links.</h4>
				</div>

			<?php
		}
		else
		{

	$allowed_departments 		= array('bt','che','cvl','cse','it','ece','ee','ft','ice','me','pe');
	$allowed_year				= array('1','2','3','4','9');
	$allowed_batch				= array('1','2','9');
	if(isset($_POST['submit']) === true)
	{

		if(empty($_POST['department']) === true)
		{
			$errors[] = "You must select a department.";
		}

		if(empty($_POST['batch']) === true)
		{
			$errors[] = "You can't leave batch empty.";
		}

		if(empty($_POST['year']) === true)
		{
			$errors[] = "Please Select Year of the students.";
		}

		if(empty($_POST['heading']) === true)
		{
			$errors[] = "Please give some proper heading to your post.";
		}

		if(empty($_POST['title']) === true)
		{
			$errors[] = "Your post must have a title.";
		}

		if(empty($_POST['editor1']) === true)
		{
			$errors[] = "Main body of the message can't be empty.";
		}

		if(empty($errors) === true)
		{
			$department 	= sanitize($_POST['department']);
			$batch 			= sanitize($_POST['batch']);
			$year 			= sanitize($_POST['year']);
			$heading 	 	= sanitize($_POST['heading']);
			$title 	 		= sanitize($_POST['title']);
			$body 			= $_POST['editor1'];

			if(in_array($_POST['department'], $allowed_departments) === false)
			{
				$errors[] = "Manually Entered departments are not valid.";
			}

			if(in_array($_POST['year'], $allowed_year) === false)
			{
				$errors[] = "Please don't enter your current year manually.";
			}

			if(in_array($_POST['batch'], $allowed_batch) === false)
			{
				$errors[] = "Manually Entered batch is invalid.";
			}

			if(strlen($heading) > 100)
			{
				$errors[] = "Heading must be less then 100 character. You have typed ".strlen($heading)." characters.";
			}

			if(strlen($title) > 200)
			{
				$errors[] = "Title must be less then 200 character You have typed ".strlen($title)." characters.";
			}

			if(empty($errors) === true)
			{
				$register_data = array(
					'posted_by'			=> $user_data['user_id'],
					'year'				=> $year,
					'department'		=> $department,
					'batch'				=> $batch,
					'heading'			=> $heading,
					'title'				=> $title,
					'body'				=> $body,
					'slug'				=> md5(time()+microtime()+$user_data['user_id']),
					'pwid' 				=> substr(md5($user_data['user_id']), 3,27)
				);
				add_faculty_post($register_data);
				header("Location: addfacultypost.php?facultyID=".$facultyID."&post=posted");
				exit();
				
			}

			else if(empty($errors) === false)
			{
				echo output_errors($errors);
			}

		}
		else if(empty($errors) === false)
		{
			echo output_errors($errors);
		}
	}


?>

	<div class="well">
		<div class="well">
		<form action="addfacultypost.php?facultyID=<?php echo $facultyID?>" method='POST' 
		class='form-group' autocomplete='off'>
			<ul>
				<li class="well-blue">
					<label for='department'>
						<span class="glyphicon glyphicon-hand-right" aria-hidden="true"> </span> 
						<b>Department</b>
					</label>
					<br>
					<select class="form-control well-blue" name="department" id='department'>
							<option value="">Select Department </option>

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
				</li>
				<br>
				<li class="well-blue">
					<span class="glyphicon glyphicon-hand-right" aria-hidden="true"> </span>
					
					<div class="radio-inline">
					  <label for='batch1'><input type="radio" class="radio-inline" name="batch" value="1" id='batch1' >Batch 1</label>
					</div>
					<div class="radio-inline">
					  <label for='batch2'><input type="radio" class="radio-inline" name="batch" value="2" id='batch2'>Batch 2</label>
					</div>
					<div class="radio-inline">
					  <label for='both_batch'><input type="radio" class="radio-inline" name="batch" value="9" id='both_batch' >Both Batch</label>
					</div>
				</li>
				<br>
				<li class="well-blue">
					<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> <strong>Year</strong> 
					<br>
					<select class="form-control well-blue" name="year">
						<option value="">Please select year</option>
						<option value="1">1st year</option>
						<option value="2">2nd year</option>
						<option value="3">3rd year</option>
						<option value="4">4th year</option>
						<option value="9">All student of the selected department</option>
					</select>
				</li>
				<br>
			
			<li class="well-blue">
				<label for="heading">
					<span class="glyphicon glyphicon-hand-right well-blue" aria-hidden="true"></span> <b>Heading</b>
				</label>
				<br>
				<input id='heading' type="text" name="heading" class="form-control well-blue" placeholder="Type Heading of the news" <?php 
					if(isset($_POST['heading']) === true and empty($_POST['heading']) === false)
							{
								echo "value = '".$_POST['heading']."'";
							}
				 ?>>
				<span id="float_right">Less then 100 character</span>
			</li>
			<br>
			<li class="well-blue">
				<label for="title">
					<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> <b>Title</b>
				</label>
				
				<br>
				<input id='title' type="text" name="title" class="form-control well-blue" placeholder="Type title of the news" <?php 
					if(isset($_POST['title']) === true and empty($_POST['title']) === false)
							{
								echo "value = '".$_POST['title']."'";
							}
				 ?>>
				<span id="float_right">Less then 200 character</span>
			</li>
			<br>
			<li>
				<label for="body">
					<span class="glyphicon glyphicon-envelope well-blue" aria-hidden="true"></span><b>
					<span class="well-blue"> Message / post</span> 
				</label>
				
				</b><br>
				<textarea rows="10" id='body' class="form-control" placeholder="Type body of the news.." name="editor1"><?php 
					if(isset($_POST['editor1']) === true and empty($_POST['editor1']) === false)
							{
								echo $_POST['editor1'];
							}
				 ?></textarea>
				
				<span id="float_right">Less then 1000 words</span>
				<br>
				<span id="float_right">Please keep your image width below 250px</span>
			</li>
			<li>
				<input type="submit" name="submit" value="Post" class="btn btn-primary">
			</li>
	</form>
	</div>
</div>

<script>
    CKEDITOR.replace( 'editor1' );
</script>


<?php

} //This *

	include "includes/overall/footer.php";
	}

	else
	{
		
		header("Location:index.php");
	}
}
else
{
	header('Location:index.php');
}


?>