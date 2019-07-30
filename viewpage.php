<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php"; 
	 
	if(isset($_GET['slug']) === true and empty($_GET['slug']) === false)
	{
		$slug = $_GET['slug'];
		if(slug_exists($slug) === true)
		{
			
			club_news_block(club_news_id_from_slug($slug));
		}
		else
		{
			header("Location:index.php");
		}
	}
	else{
		header("Location:index.php");
	}
	 
 include "includes/overall/footer.php";

 ?>