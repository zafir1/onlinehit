<?php 
include "core/init.php";
protected_page();

if(isset($_GET['wkspid'],$_GET['uwkspid'],$_GET['kxpidssde']) === true)
{
	$workshop_id 		= sanitize($_GET['wkspid']);
	$user_id 			= sanitize($_GET['uwkspid']);
	$user_vid 			= sanitize($_GET['kxpidssde']);

	if(workshop_hash_exits($workshop_id) === false)
	{
		header('Location:index.php');
	}
	else if($user_id != substr(md5($user_data['user_id']),3,24))
	{
		header('Location:index.php');
	}
	else if($user_vid != md5(substr(md5($user_data['user_id']),3,24)))
	{
		header('Location:index.php');
	}

	else
	{
		include 'includes/overall/header.php';
		$workshop = workshop_details_from_hash($workshop_id);

?>
	<div class="well">
		<div class="well well-wb">
			<h3 class="well-blue">
				<span class="fa fa-users"></span>
				<?php echo strtoupper($workshop->club); ?> Workshop / event
			</h3>
		</div>

		<div class="well well-wb">
			<div class="card text-center">
			  <div class="card-header well-blue">
			    <h4><?php echo strtoupper($workshop->name); ?></h4>
			  </div>
			</div>
			<p>
				
				<?php echo $workshop->description; ?>
				 <br><br>

				<span class="fa fa-hand-o-right well-blue"></span> Fee: <?php echo $workshop->fee ?>.00
			</p>
			<p>
				<div class="card text-center">
				    <a href="workshopregistration.php?wkspid=<?php echo $workshop->hash; ?>&uwkspid=<?php echo substr(md5($user_data['user_id']),8,10); ?>&kxpidssde=<?php echo md5(substr(md5($user_data['user_id']),8,10)); ?>" class="btn btn-success">Register</a>
				  
				  <div class="card-footer text-muted">
				    OnlineHIT
				  </div>
				</div>
				
			</p>
		</div>
	</div>

<?php

		include 'includes/overall/footer.php';
	}
}
else
{
	header('Location:index.php');
}

?>