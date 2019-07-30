<?php 
include "core/init.php";
protected_page();
faculty_protected();
if(isset($_GET['facultyID']) === true and empty($_GET['facultyID']) === false)
{
	$facultyID = sanitize($_GET['facultyID']);
	if($facultyID === substr(md5(substr($user_data['email_code'],10,20)),5,10))
	{
		include "includes/overall/header.php";
		?>
		<div class="well">
			<div class="well well-wb">
				<h2 class="well-blue"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Faculty <br>
					<small><span class="glyphicon glyphicon-paperclip"></span> Congratulations you are a <b>Faculty</b> at OnlineHIT</small>
				</h2>

				<?php 
						if(is_hod($user_data['user_id']) === true)
						{
							?>
								<a href="upgradetoteacher.php" class="btn btn-primary">
									<i class="fa fa-snowflake-o fa-spin fa-1x fa-fw"></i> Manage faculty list
								</a>
							<?php
						}

				 ?>
				
			</div>

		</div>

<div class="well">
	<!-- <h4><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Add news / pages</h4> -->
	<!-- <a href="addfacultypost.php?facultyID=<?php echo substr(md5($user_data['user_id']), 2,28); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Add post</a> -->

	<div class="well well-wb">
		<ul>
			<li>
				<b><span class="glyphicon glyphicon-hand-right well-blue" aria-hidden="true"></span></b> As a Fuculty, You are the core member <b class="well-blue">HALDIA INSTITUTE OF TECHNOLOGY</b> as well as <b>OnlineHIT</b>.
			</li>
			<br>
			<li>
				<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>
				So, We give you the freedom to post <b>assignments, news, handwritten notes</b> e.t.c here and we will deliver it to the right place.
			</li>
			<br>
			<li>
				<a href="addfacultypost.php?facultyID=<?php echo substr(md5($user_data['user_id']), 2,28); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Add post</a> 
				<a href="viewfacultypostlist.php?facultyID=<?php echo substr(md5($user_data['username']), 5,18); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Manage Post</a>
			</li>

		</ul>
		
		
	</div>
	<!-- 
	
	<p class="well">
		To <b>add</b>, <b>delete</b> or <b>modify </b>any page / news 
		<a href="viewfacultypostlist.php?facultyID=<?php echo substr(md5($user_data['username']), 5,18); ?>" 
		class='btn btn-success' >Click here</a>.
	</p> -->

</div>
		<?php
		include "includes/overall/footer.php";
	}
	else
	{
		header("Location:index.php");
		exit();
	}

}
else
{
	header("Location:index.php");
	exit();
}
	
?>
