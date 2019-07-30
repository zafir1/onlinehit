<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php"; 
	
?>


<div class="well">
	<h1>NEEDS<br>
	<small>Every Life is worthy</small></h1>

</div>
<?php 

	find_pages('needs');

?>

<?php include "includes/overall/footer.php";?>