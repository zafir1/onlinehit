<?php 
	$id =  uniqid();

	echo $id."<br><br>";

	echo substr($id, 3)."<br><br>";

	$workshop_id = 10;
	$client_roll = 10300315126;
	$name = "Zafir";
	$acceptor = "Nasir";

	$d = " -> ".$client_roll." ->  ".$name." ->  ".$acceptor;
	//echo $d."<br><br>";

	echo "<img src='qr_img.php?d=$d' height='300px' width='300px'>";
	
 ?>