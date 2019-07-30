<?php 
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','ieee_head'");
include "includes/overall/header.php";
ckeditor();
?>



<?php

	if(isset($_GET['id']) === true and isset($_GET['slug']) === true and empty($_GET['id']) === false and empty($_GET['slug']) === false)
	{
		// user_id matching
		$id 	= sanitize($_GET['id']);
		$slug 	= sanitize($_GET['slug']);

		if(md5($user_data['user_id']) === $id and slug_exists($slug) === true)
		{
			$news_id = club_news_id_from_slug($slug);
			$club_news_data = club_news_data($news_id,'posted_by','group_name','heading','title','body','slug','created','generated','updated','updated_by','hidden');

			?>
				<div class="well">
					<div class="well well-wb">
						<h2 class="well-blue">
						<span class="fa fa-pencil-square-o"></span>
						Edit page
						<br>
						<small> 
							<span class="glyphicon glyphicon-paperclip"></span>
							Update your posted page
						</small>
						</h2>
					</div>
					
				</div>
				<div class="well">
				<div class="well well-wb well-blue">
					<h3>
					<span class="glyphicon glyphicon-globe"></span>
					<a href="viewpage.php?slug=<?php echo $club_news_data['slug']; ?>"><?php echo $club_news_data['heading']; ?></a><br>
					<small>
					<span class="glyphicon glyphicon-hand-right well-blue"></span>
					<?php echo $club_news_data['title']; ?></small></h3>
					<span class="time">
					<span class="glyphicon glyphicon-calendar"></span>
					 <?php echo $club_news_data['generated']; ?> by <?php full_name_from_id($club_news_data['posted_by']); ?><br>
					<?php 
						if(empty($club_news_data['updated']) === false)
						{
							?>
								<span class="glyphicon glyphicon-refresh"></span> <?php echo $club_news_data['updated']; ?> by <?php echo full_name_from_id($club_news_data['updated_by']); ?>
							<?php
						}
					?></span><br>
				</div></div>

			<?php

			/*Form validation start*/
			if(isset($_POST['submit']) === true)
			{
				if(empty($_POST['heading']) === true)
				{
					$errors[] = "Heading can't be empty.";
				}
				if(empty($_POST['title']) === true)
				{
					$errors[] = "There must be a title for this POST";
				}
				if(empty($_POST['editor1']) === true)
				{
					$errors[] = "OppS! You can't leave your body empty.";
				}
				if(empty($errors) === true)
				{
					$heading 	= sanitize($_POST['heading']);
					$title 		= sanitize($_POST['title']);
					$body 		= $_POST['editor1'];

					$heading_length 	= strlen($heading);
					$title_length 		= strlen($title);
					$body_length		= str_word_count($body);

					if($heading_length > 100)
					{
						$errors[] = "Heading must be less then <b>100</b> character and You have entered <b>".$heading_length."</b> characters.";
					}
					if($title_length > 200)
					{
						$errors[] = "Title of the POST must be less then <b>200</b> character and You have entered <b>".$title_length."</b> characters.";
					}
					if(empty($errors) === true)
						{
							$update_data = array(
									'heading' 	=> $_POST['heading'],
									'title' 	=> $_POST['title'],
									'body' 		=> $_POST['editor1'],
								);
							update_club_news_table($update_data,$news_id,$slug);
							

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
			/*Form validation end*/

			?>


			<div class="well">
				<form action="editclubnewspage.php?id=<?php echo $id;?>&slug=<?php echo $slug;?>" method="POST" class='form-group' autocomplete="off">
					<ul>
						<li class="well-blue">
							<b><span class="glyphicon glyphicon-hand-right"></span> Heading*</b><br>
							<input type="text" name="heading" class="form-control well-blue" placeholder="Type Heading of the news" <?php 
								if(isset($_POST['heading']) === true and empty($_POST['heading']) === false)
										{
											echo "value = '".$_POST['heading']."'";
										}
								else
								{
									echo "value = '".$club_news_data['heading']."'";
								}
							 ?>>
							<span id="float_right">Less then 100 character</span>
						</li>
						<br>
						<li class="well-blue">
							<b><span class="glyphicon glyphicon-hand-right"></span> Title*</b><br>
							<input type="text" name="title" class="form-control well-blue" placeholder="Type title of the news" <?php 
								if(isset($_POST['title']) === true and empty($_POST['title']) === false)
										{
											echo "value = '".$_POST['title']."'";
										}
								else
								{
									echo "value = '".$club_news_data['title']."'";
								}
							 ?>>
							<span id="float_right">Less then 200 character</span>
						</li>
						<br>
						<li class="well-blue">
							<b><span class="glyphicon glyphicon-hand-right"></span> Body*</b><br>
							<textarea rows="10" class="form-control" placeholder="Type body of the news.." name="editor1"><?php 
								if(isset($_POST['editor1']) === true and empty($_POST['editor1']) === false)
										{
											echo $_POST['editor1'];
										}
								else
								{
									echo $club_news_data['body'];
								}
							 ?></textarea>
							<span id="float_right">Less then 1000 words</span>
						</li>
						<li>
							<input type="submit" name="submit" value="Update" class="btn btn-primary">
						</li>
					</ul>
				</form>
			</div>

			<?php
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
<script>
    CKEDITOR.replace( 'editor1' );
</script>
 
<?php
include "includes/overall/footer.php";
?>