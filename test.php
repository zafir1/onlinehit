<?php 
include "core/init.php";
//protected_page();
//faculty_protected(); 

	
include "includes/overall/header.php";

$file_content = file_get_contents('http://localhost/newlrn/core/database/connect.php');

echo $file_content;



include "includes/overall/footer.php";
	

?>