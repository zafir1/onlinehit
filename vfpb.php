<?php 
	include "core/init.php";
	protected_page();
	if(isset($_GET['postid']) === true and empty($_GET['postid']) === false)
	{
		$slug = sanitize(strtolower($_GET['postid']));
		if(faculty_post_slug_exists($slug) === true)
		{
			$id = faculty_post_id_from_slug($slug);

			$faculty_post_data = faculty_post_data($id,'posted_by','year',
													'department','batch','heading','title','body','slug',
													'created','generated','pwid','updated');


			include 'includes/overall/header.php'; 

?>


	<ul class="well">
	<div class="well well-wb">
		<li>
			<h3><a href="fpw.php?facultyID=<?php echo  substr(md5($faculty_post_data['posted_by']), 3,27); ?>"><span class="glyphicon glyphicon-user"></span>
				<?php echo full_name_from_id($faculty_post_data['posted_by']); ?></a></h3>
		</li>
		<li class="time">
			<span title="Posted on 22-7-17 3:50pm" class="glyphicon glyphicon-calendar"> 
			<?php echo $faculty_post_data['generated']; ?></span><br>
			<?php 
				if($faculty_post_data['updated'] !== NULL)
				{
					?>
						<span title="Last updated on <?php echo $faculty_post_data['updated']; ?>" class="glyphicon glyphicon-refresh"> <?php echo $faculty_post_data['updated']; ?></span>
					<?php
				}
			 ?>
			
			
		</li>
		<li class="time">
			<span title class="glyphicon glyphicon-tags"></span> 
			Year: <?php if($faculty_post_data['year'] == 9){
				echo "All students";
			}
			else{
				echo $faculty_post_data['year'];
			}

			 ?>, 
			Dept: <?php echo strtoupper($faculty_post_data['department']); ?>, 
			Batch- <?php if($faculty_post_data['batch'] == 9){
					echo 'Both batches';
				} 
				else
				{
					echo $faculty_post_data['batch'];
				} 


				?>
		</li>
	</div>


		<li>
			<h3><a href="">
				<span class="glyphicon glyphicon-globe"></span>
				<?php echo $faculty_post_data['heading']; ?> <br><br>
				<span class="glyphicon glyphicon-hand-right"></span></a>

				<small class="indent">
					<?php echo $faculty_post_data['title']; ?> 
				</small>
			</h3>
		</li>

		<li class="well well-wb">
			<p>
				<?php echo $faculty_post_data['body']; ?>
			</p>
		</li>

	</ul>
	


<?php
			include 'includes/overall/footer.php'; 
		}
		else
		{
			header("Location:index.php");
		}		
		
	}
	else
	{
		header("Location: index.php");
	}
 ?>
