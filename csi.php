<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php"; 
	
?>


<div class="well">
	<h1>CSI<br>
	<small>A club for computer science students at HIT</small></h1>
</div>
<?php 

	find_pages('csi'); 

?>

<?php include "includes/overall/footer.php";?>