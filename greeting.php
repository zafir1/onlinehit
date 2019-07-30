<?php 
	include 'core/init.php';
	protected_page();
	if($user_data['details'] == 1)
	{
		header("Location:index.php");
	}

if(isset($_GET['UsERiD']) === true and empty($_GET['UsERiD']) === false)
{
	$user = sanitize($_GET['UsERiD']);
	if($_GET['UsERiD'] === substr(md5($user_data['user_id']),4,24))
	{
include "includes/overall/header.php";

	if(($user_data['uni_roll'] === NULL) and ($user_data['uni_reg'] === NULL) and ($user_data['college_id'] === NULL))
	{		set_detail_equals_to_one($user_data['user_id']);
		?>
			<div class="well">

 					<div class="well well-wb well-blue">
	 					<h2>
	 						<span class="fa fa-handshake-o"></span>
	 						Department Selection <br>
	 						<small>
	 							<span class="glyphicon glyphicon-paperclip"></span>
	 							Department selection successful
	 						</small>
	 						
	 					</h2>
	 				</div>

	 					<div class="well well-wb">
		 					<div class="card text-center well-blue">
							  <div class="card-header">
							   	<span class="fa fa-smile-o" id='big_smile'></span>
							    
							  </div>
							  <div class="card-block">
							    <h4 class="card-title">Thank you!</h4>
							    <p class="card-text lead">
							    	Meet your HOD for account upgradation
							    </p>
							    <a href="index.php" class="btn btn-primary">
							    	<span class="fa fa-home"> Home</span>
							    </a>
							  </div>
							  <div class="card-footer text-muted">
							    <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>nlineHIT
							  </div>
							</div>
	 					</div>

 					</div>


		<?php
	}
	else
	{
		set_detail_equals_to_one($user_data['user_id']);
		?>

				<div class="well">
					<div class="well well-wb">
						<div class="card text-center">
						  <div class="card-header">
						    <span class="fa fa-smile-o well-blue" id='big_smile'></span>
						  </div>
						  <div class="card-block">
						    <h4 class="card-title well-blue">Thank you</h4>
						    <p class="card-text lead well-blue">Your details has been saved successfully</p>
						    <a href="index.php" class="btn btn-primary"> 
						   		<span class="fa fa-home"></span> Home Wall
						    </a>
						  </div>
						  <div class="card-footer text-muted">
						    OnlineHIT
						  </div>
						</div>
					</div>
				</div>

		<?php
	}




include "includes/overall/footer.php";
	}
	else
	{
		
		header("Location:index.php");
	}
}
else
{
	header('Location:index.php');
}

 ?>