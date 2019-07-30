<?php 
include "core/init.php";
protected_page();
faculty_protected();

	if(isset($_GET['facultyID']) === true and isset($_GET['postID']) === true and empty($_GET['facultyID']) === false and empty($_GET['postID']) === false)
	{
		$slug 	= sanitize($_GET['postID']);
		$id 	= sanitize($_GET['facultyID']);
		if(faculty_post_slug_exists($slug) === true and $id === substr(md5($user_data['user_id']),5,18))
		{
			include 'includes/overall/header.php';
			if(isset($_GET['deleteID']) === true and empty($_GET['deleteID']) === false)
			{
				if($_GET['deleteID'] === substr(md5($slug), 2,28))
				{

					delete_faculty_post($slug,$user_data['user_id']);
					?>

		<div class="well alert alert-success">

			<table class="table table-striped table-bordered">
				<thead>
				<tr><th><h4>
				<span class="glyphicon glyphicon-trash" aria-hidden="true"> NEWS DELETION SUCCESSFULL </span>	
			
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
					echo "I think you have modified link.";
				}
			}
			else
			{
				$faculty_post_id = faculty_post_id_from_slug($slug);
				$faculty_post_data = faculty_post_data($faculty_post_id,'year','department','batch',
													'heading','title','body',
													'generated','updated'
													);

?>				<div class="well">
				<div  class="well alert alert-danger">
					
					<ul>
						<li>

							<h3><span class="glyphicon glyphicon-globe"></span>
							<?php echo $faculty_post_data['heading']; ?><br><br>
							<span class="glyphicon glyphicon-hand-right"></span>
							<small><?php echo $faculty_post_data['title']; ?></small>
							</h3>
						</li>
						<li>
							<span title="Posted on <?php echo $faculty_post_data['generated'];?>" class="glyphicon glyphicon-calendar">
								<?php echo $faculty_post_data['generated']; ?>
							</span>
							<br>
							<?php 
								if($faculty_post_data['updated'] !== NULL)
								{
									?>

										<span title="Last update on <?php echo $faculty_post_data['updated'];?>" class="glyphicon glyphicon-refresh">
								<?php echo $faculty_post_data['updated']; ?>
							</span>

									<?php
								}

							 ?>
						</li>
						<li>
							<span title='Tagged For' class="glyphicon glyphicon-tags">
								Year: <?php if($faculty_post_data['year'] == 9)
								{
									echo 'All students.';
								}
								else
								{
									echo $faculty_post_data['year'];
									} ?>,

								Dept: <?php echo strtoupper($faculty_post_data['department']); ?>,

								Batch: <?php if($faculty_post_data['batch'] == 9)
								{
									echo 'Both Batch';
									}else{
										echo $faculty_post_data['batch'];
										} ?>

							</span>
						</li>

					</ul>
					</div>
				</div>
				<div class="well alert alert-danger">
					<table class="table table-striped table-bordered">
						<thead>
						<tr><th><h3>Do you really want to delete this POST?</h3></th></tr>
						<tr>
							<th><a href="facultypostdelete.php?facultyID=<?php echo $id; ?>&postID=<?php echo $slug; ?>&deleteID=<?php echo substr(md5($slug), 2,28); ?>">
								<h4>
									<span title="Delete this message completely" class="alert alert-danger glyphicon glyphicon-ok" aria-hidden="true"> Yes, I want to delete this message.</span>
								</h4></a>
								<a href="viewfacultypostlist.php?facultyID=<?php echo substr(md5($user_data['username']), 5,18);?>">
								<h4>
									<span title="No, I don't want to delete this message" class="alert alert-success glyphicon glyphicon-remove" aria-hidden="true"> No, I don't want to delete.</span>
								</h4></a>
								<a href="facultypostedit.php?facultyID=<?php echo $id; ?>&postID=<?php echo $slug; ?>">
								<h4>
									<span title="Edit this message" class="alert alert-info glyphicon glyphicon-edit" aria-hidden="true"> I want to edit this message.</span>
									
								</h4></a>
							</th>
						</tr>
						</thead>
							
					</table>
				</div>


<?php
			}

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