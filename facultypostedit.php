<?php 
include "core/init.php";
protected_page();
faculty_protected();

	if(isset($_GET['facultyID']) === true and isset($_GET['postID']) === true and empty($_GET['facultyID']) === false and empty($_GET['postID']) === false)
	{
		$slug 		= sanitize($_GET['postID']);
		$id 		= sanitize($_GET['facultyID']);

		if(faculty_post_slug_exists($slug) === true and $id === substr(md5($user_data['user_id']),5,18))
		{
			$news_id 	= faculty_post_id_from_slug($slug);

			$faculty_post_data = faculty_post_data($news_id,'year','department','batch',
													'heading','title','body','slug',
													'created','generated','updated','pwid');
			include 'includes/overall/header.php';
			ckeditor();

?>
<div class="well">
	<div class="well well-wb">
		<h2 class="well-blue">
			<span class="glyphicon glyphicon-edit"></span>
			Edit Page <br> 
				<small>
					<span class="glyphicon glyphicon-paperclip"></span> Modify your Post.
				</small>
		</h2>
	</div>
</div>
	

<?php
	if(isset($_GET['update']) === true and (($_GET['update']) === 'UpdaTed'))
	{
		?>

			<div class="well alert alert-success">
			<table class="table table-striped table-bordered">
				<thead>
				<tr><th><h4>
				<span class="glyphicon glyphicon-edit" aria-hidden="true"> Post update successfull </span>	
			
				</h4></th></tr>
				<tr>

					<th>
						<a href="index.php">
						<h5>
							<span title="Return back to Home" class="alert alert-success glyphicon glyphicon-home" aria-hidden="true"> Home</span>
						</h5></a>

						<a href="viewfacultypostlist.php?facultyID=<?php echo substr(md5($user_data['username']), 5,18);?>">
						<h5>
							<span title="Return to page list." class="alert alert-success glyphicon glyphicon-eye-open" aria-hidden="true"> Page list</span>
						</h5></a>


						<a href="addfacultypost.php?facultyID=<?php echo substr(md5($user_data['user_id']), 2,28); ?>">
						<h5>
							<span title="Delete this message completely" class="alert alert-success glyphicon glyphicon-pencil" aria-hidden="true"> Add pages / news</span>
						</h5></a>
						
					</th>
				</tr>
				</thead>
					
			</table>
		</div>


		<?php
	}
	else
	{


	$allowed_departments 		= array('ece','cse','me','ice');
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
				// Update the news
				$update_data = array(

								'department' 	=> $department,
								'batch'			=> $batch,
								'year'			=> $year,
								'heading' 		=> $heading,
								'title' 		=> $title,
								'body' 			=> $body

				);
				update_faculty_post_data($update_data,$news_id);
				header("Location: facultypostedit.php?facultyID=".$id."&postID=".$slug."&update=UpdaTed");
				
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
		<ul>
			<li>
				<h3>
					<a href='vfpb.php?postid='<?php echo $slug; ?>>
					<span class="glyphicon glyphicon-globe"></span>
					<?php echo $faculty_post_data['heading']; ?> </a><br>
					<small>
						<span class="glyphicon glyphicon-hand-right"></span>
						<?php echo $faculty_post_data['title']; ?>
					</small>
				</h3>
			</li>

			<li class="time">
				<span title="Posted on" class="glyphicon glyphicon-calendar"> <?php echo $faculty_post_data['generated']; ?></span><br>

				<?php 
					if($faculty_post_data['updated'] !== NULL)
					{
						?>
							<span title="Updated on" class="glyphicon glyphicon-refresh"> 
							<?php  echo $faculty_post_data['updated']; ?></span><br>

						<?php
					}
				 ?>
				<span title="Tagged for: " class="glyphicon glyphicon-tags"> 
				Year: <?php echo $faculty_post_data['year']; ?>, 
				Dept: <?php echo $faculty_post_data['department']; ?>, 
				Batch: <?php 
					if($faculty_post_data['batch'] == 9)
					{
						echo "Both batches";
					}
					else
					{
						echo $faculty_post_data['batch'];
					}
				 ?>
				</span><br>

			</li>
			<br>
			<li>

	<form action="" method='POST' 
		class='form-group' autocomplete='off'>
			<ul>
				<li class="well-blue">
					<span class="glyphicon glyphicon-hand-right" aria-hidden="true"> </span> 
					<b>Department</b>
					<br>
					<select class="form-control well-blue" name="department">
						<option value="">Select Department </option>
						<option value="ece">Electronics and communication Engineering</option>
						<option value="cse">Computer Science Engineering</option>
						<option value="me">Mechanical Engineering</option>
						<option value="ice">Instrumentation and Control Engineering</option>
					</select>
				</li>
				<br>
				<li class="well-blue">
					<span class="glyphicon glyphicon-hand-right" aria-hidden="true"> </span>
					
					<div class="radio-inline">
					  <label for='batch1'><input id='batch1' type="radio" class="radio-inline" name="batch" value="1" >Batch 1</label>
					</div>
					<div class="radio-inline">
					  <label for="batch2"><input id='batch2' type="radio" class="radio-inline" name="batch" value="2" >Batch 2</label>
					</div>
					<div class="radio-inline">
					  <label for="both"><input id='both' type="radio" class="radio-inline" name="batch" value="9">Both Batch</label>
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
				<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> <b>Heading</b>
				<br>
				<input type="text" name="heading" class="form-control well-blue" placeholder="Type Heading of the news" <?php 
					if(isset($_POST['heading']) === true and empty($_POST['heading']) === false)
							{
								echo "value = '".$_POST['heading']."'";
							}
						else
						{
							echo "value = '".$faculty_post_data['heading']."'";
						}
				 ?>>
				<span id="float_right">Less then 100 character</span>
			</li>
			<br>
			<li class="well-blue">
				<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> <b>Title</b>
				<br>
				<input type="text" name="title" class="form-control well-blue" placeholder="Type title of the news" <?php 
					if(isset($_POST['title']) === true and empty($_POST['title']) === false)
							{
								echo "value = '".$_POST['title']."'";
							}
							else
							{
								echo "value = '".$faculty_post_data['title']."'";
							}
				 ?>>
				<span id="float_right">Less then 200 character</span>
			</li>
			<br>
			<li class="well-blue">
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><b> Message / post
				</b><br>
				<textarea rows="10" class="form-control" placeholder="Type body of the news.." name="editor1"><?php 
					if(isset($_POST['editor1']) === true and empty($_POST['editor1']) === false)
							{
								echo $_POST['editor1'];
							}
							else
							{
								echo $faculty_post_data['body'];
							}
				 ?></textarea>
				<span id="float_right">Less then 1000 words</span>
				<br>
				<span id="float_right">Please keep your image width below 250px</span>
			</li>
			<li>
				<input type="submit" name="submit" value="Update" class="btn btn-primary">
			</li>
	</form>



			</li>


		</ul>
		
	</div>

<script>
    CKEDITOR.replace( 'editor1' );
</script>


<?php
	
	} /*This is update bracket*/


			include 'includes/overall/footer.php';
		}
		else
		{
			header('Location: logout.php');
		}

	}
	else
	{
		header('Location: index.php');
	}

?>