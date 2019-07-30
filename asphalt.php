<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php"; 
	
?>


<div class="well">
	<h1>Asphalt<br>
	<small>Clubs of Mechanical Engineering students at HIT</small></h1>
</div>
<?php 

	find_pages('asphalt'); 

?>

<?php include "includes/overall/footer.php";?>