<?php
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','ieee_head'");
$workshop_hash = active_workshop_hash_of($user_data['member']);
include 'includes/overall/header.php';


if($workshop_hash ==false)
{
	header("Location:index.php");
}
$workshop = workshop_details_from_hash($workshop_hash);

if(isset($_POST['closeworkshop'])===true){
	if(close_workshop($user_data['member'],$workshop->id)==true){
		header("Location:logout.php");
	}
}

if(isset($_POST['goback'])){
	header("Location:index.php");
}

?>
<div class="well">
	<div class="well well-wb well-blue">
		<h3>
			<a href="">Close Workshop</a> <br> <small><?php echo $workshop->name; ?></small>
		</h3>
	</div>
	<div class="well well-wb">
		<h4 class="well-blue">Do you really want to close the workshop? </h4>
		<span class="time danger">
			After closing this workshop we may log you out for rearrangement.
		</span>

		<br><br>

		<form action="closeworkshop.php" method="POST">
			<button type="submit" name="closeworkshop" class="btn btn-danger" title="Please make sure that everything has completed for this workshop.">Close workshop</button> <span class="time-h">(We will delete everything related to this workshop.)</span>

			<br><br>

			<button type="submit" name="goback" class="btn btn-primary" title="Click me to go back.">Go Back</button> <span class="time-h">(If anything is left, please click me.)</span>
		</form>
		

	</div>
</div>


<?php


include 'includes/overall/footer.php';
?>