<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php"; 
	
?>


<div class="well">
	<h1><a href="ieee.php"> <span class="glyphicon glyphicon-tree-conifer" aria-hidden="true"></span> IEEE </a><br>
	<small>The Institution of Electronics and telecommunication Engineering</small></h1>
</div>
<?php 

	find_pages('ieee'); 

?>

<?php include "includes/overall/footer.php";?>