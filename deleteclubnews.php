<?php 
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','ieee_head'");
include "includes/overall/header.php";

?>
				<div class="well alert alert-danger">
					<h2><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete Page<br></h2>
				</div>

<?php 
	if(isset($_GET['id']) === true and isset($_GET['slug']) === true and empty($_GET['id']) === false and empty($_GET['slug']) === false)
	{
		$id 	= sanitize($_GET['id']);
		$slug 	= sanitize($_GET['slug']);

		if(isset($_GET['delete']) === true and empty($_GET['delete']) === false)
		{
			$delete = $_GET['delete'];
			if(sanitize($_GET['delete']) !== md5(sanitize($_GET['slug'].$_GET['id'])) ){
				?>
					<div class="alert alert-danger">
						<b><h4><span class="glyphicon glyphicon-scissors alert alert-danger" aria-hidden="true"></span> Please don't try to cut, modify or enter links manually.</h4></b>
					</div>
				<?php
			}
			else{
				
				// delete news
				$delete_club_news_data = array(
					'created' 		=> CURRENT_TIME,
					'deleted'		=> CURRENT_TIME,
					'hidden'		=> '1',
					'deleted_by'	=> $user_data['user_id']
				);

				delete_club_news_page($slug,$delete_club_news_data);
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

						<a href="viewpagelist.php">
						<h5>
							<span title="Return to page list." class="alert alert-success glyphicon glyphicon-eye-open" aria-hidden="true"> Page list</span>
						</h5></a>


						<a href="addpage.php">
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
			
		}
		else
		{
			
			if(slug_exists($slug) === true and $id === md5($user_data['username']))
			{
				$news_id = club_news_id_from_slug($slug);
				$club_news_data = club_news_data($news_id,'posted_by','heading','title','group_name');



 ?>



				<div class="well alert alert-danger">
					<ul>
						<li>
							<h3><?php echo $club_news_data['heading']; ?> <br>
							<small><?php echo $club_news_data['title'] ?></small>
							</h3>
						</li>
						<li><b>Posted For:</b> 
						<span id='upper_case'><?php echo $club_news_data['group_name']; ?></span>
						</li>

					</ul>
				</div>

		<div class="well alert alert-danger">
			<table class="table table-striped table-bordered">
				<thead>
				<tr><th><h3>Do you really want to delete this message?</h3></th></tr>
				<tr>
					<th><a href="deleteclubnews.php?id=<?php 
					echo md5($user_data['username'])?>&slug=<?php echo $slug;?>&delete=<?php echo md5($slug.$id); ?>">
						<h4>
							<span title="Delete this message completely" class="alert alert-danger glyphicon glyphicon-ok" aria-hidden="true"> Yes, I want to delete this message.</span>
						</h4></a>
						<a href="viewpagelist.php">
						<h4>
							<span title="No, I don't want to delete this message" class="alert alert-success glyphicon glyphicon-remove" aria-hidden="true"> No, I don't want to delete.</span>
						</h4></a>
						<a href="editclubnewspage.php?id=<?php echo md5($user_data['user_id']);?>&slug=<?php echo $slug; ?>">
						<h4>
							<span title="Edit this message" class="alert alert-info glyphicon glyphicon-edit" aria-hidden="true"> I want to edit this message.</span>
							
						</h4></a>
					</th>
				</tr>
				</thead>
					
			</table>
		</div>

				<!-- <div class="alert alert-danger" role="alert">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Successfully Deleted
				</div>

				<tr><th>Do you really want to delete?</th></tr>
					
					<thead><tr><th>
					<h3><span title="Delete" class="alert alert-danger glyphicon glyphicon-ok" aria-hidden="true"></span></h3></th></tr>
					<tr><th>
					<h3><span title ="Edit" class="alert alert-success glyphicon glyphicon-remove" aria-hidden="true"></span></h3>
								</th></tr>
				</thead>

				<div class='alert alert-primary'>
					<a href=""><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> undo</a>
				</div> -->

				

<?php
			}
			else
			{
				header("Location: index.php");
			}
		}

	}
	else
	{
		header("Location:index.php");
	}
?>

<?php
include "includes/overall/footer.php";
?>