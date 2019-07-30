<?php 
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','ieee_head'");
include "includes/overall/header.php"; 
	
?>

<div class="well">
	<div class="well well-wb well-blue">
	<h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Post statistics<br> 
		<small>
		<span class="glyphicon glyphicon-blackboard"></span>
			Here you can control your posts, posted on the wall of <?php echo strtoupper($user_data['member']); ?>
		</small><br>

	</h2>
	<a href="addpage.php" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Add post</a>
	</div>
</div>

<!-- <div class="well">
	<h1>Page List<br>
	<small>This is the view page</small></h1>
	<h3 title="Click to add a page or news"><small><a href="addpage.php">Add page 
	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></small></h3>
</div> -->

<?php view_page_list($user_data['member']); ?>
		



<?php include "includes/overall/footer.php";?>