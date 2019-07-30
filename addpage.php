<?php 
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','ieee_head'");
include "includes/overall/header.php";
ckeditor();

	
?>

<div class="well">
	<div class="well well-wb">
		<h2 class="well-blue"><span class="glyphicon glyphicon-pencil"></span>Add page / news <br>
			<small>
			<span class="glyphicon glyphicon-paperclip"></span>
				Here you can add news for <b id='upper_case'><?php echo $user_data['member']; ?></b>
			</small>
		</h2>
		<a href="viewpagelist.php" class="btn btn-primary">
		<span class="glyphicon glyphicon-eye-open"></span> Manage Post</a>
	</div>
</div>
<?php 
		if(isset($_GET['success']) === true and empty($_GET['success']) === true)
		{
			?>
				<div class="well">
					<div class="well well-wb">
						<div class="card text-center">
						  <div class="card-header lead">
						  		<span class="fa fa-smile-o well-blue" id='big_smile'></span>
						  </div>
						  <div class="card-block">
						    <h4 class="card-title">Thank You!</h4>
						    <p class="card-text lead">Page addition successfull</p>
						    <a href="viewpagelist.php" class="btn btn-primary"><span class="glyphicon glyphicon-stats"></span> PageList</a>
						    <a href="addpage.php" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Add page</a>
						  </div>
						  <div class="card-footer text-muted">
						    OnlineHIT
						  </div>
						</div>
					</div>
					
					
				</div>
			<?php
		}
		else
		{
 ?>
<?php 
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
				add_page_in_club_news_table($heading,$title,$body);
				header("Location:addpage.php?success");

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
	


	// Useless now
				/*if(empty($errors) === true)
				{
					$heading 	= $_POST['heading'];
					$title 		= $_POST['title'];
					$body 		= $_POST['editor1'];

					$heading_length 	= strlen($heading);
					$title_length 		= strlen($title);
					$body_length		= str_word_count($body);

					echo "Heading length = ".$heading_length."<br>";
					echo "Title length = ".$title_length."<br>";
					echo "body_length = ".$body_length;

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
						echo "<br><br>";
						echo $heading."<br>".$title."<br>".$body;
					}
					if(empty($errors) === false)
					{
						echo output_errors($errors);
					}
				}
				else if(empty($errors) === false)
				{
					echo output_errors($errors);
				}*/

	

 ?>
<div class="well">
	<div class="well">
		<form action="addpage.php" method="POST" class='form-group' autocomplete="off">
			<ul>
				<li class="well-blue">
					<span class="glyphicon glyphicon-hand-right"></span>
					<b>Heading*</b>
					<br>
					<input type="text" name="heading" class="form-control" placeholder="Type Heading of the news" <?php 
						if(isset($_POST['heading']) === true and empty($_POST['heading']) === false)
								{
									echo "value = '".$_POST['heading']."'";
								}
					 ?>>
					<span id="float_right">Less then 100 character</span>
				</li>
				<br>
				<li class="well-blue">
					<span class="glyphicon glyphicon-hand-right"></span>
					<b>Title*</b><br>
					<input type="text" name="title" class="form-control" placeholder="Type title of the news" <?php 
						if(isset($_POST['title']) === true and empty($_POST['title']) === false)
								{
									echo "value = '".$_POST['title']."'";
								}
					 ?>>
					<span id="float_right">Less then 200 character</span>
				</li>
				<br>
				<li class="well-blue">
				<span class="glyphicon glyphicon-hand-right"></span>
					<b>Body*</b><br>
					<textarea rows="10" class="form-control" placeholder="Type body of the news.." name="editor1"><?php 
						if(isset($_POST['editor1']) === true and empty($_POST['editor1']) === false)
								{
									echo $_POST['editor1'];
								}
					 ?></textarea>
					<span id="float_right">Less then 1000 words</span>
				</li>
				<li>
					<input type="submit" name="submit" value="Post" class="btn btn-primary">
				</li>
			</ul>
		</form>
	</div>
</div>

		 	<script>
		        CKEDITOR.replace( 'editor1' );
			</script>

<?php 
	include "includes/add_page_form.php";

 ?>
 
<?php 
	}
include "includes/overall/footer.php";
?>