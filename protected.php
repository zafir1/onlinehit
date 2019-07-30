<?php
    include "core/init.php";
	include "includes/overall/header.php";
?>

<div class="well">
	<div class="well well-wb well-blue">
		<h3>
			<i class="fa fa-lock"></i> Protected Page
			<br>
			<small><i class="fa fa-exclamation-circle"></i> Authentication Failed</small>
		</h3>
	</div>

	<div class="well well-blue well-wb">
		<div class="card text-center">
		  <div class="card-header">
		    <i class="fa fa-frown-o" id='big_smile'></i>
		  </div>
		  <div class="card-block">
		    <h4 class="card-title lead">Sorry!</h4>
		    <p class="card-text time-h"> We are unable to identify you. <br> Please login.</p>
		    <a href="register.php" class="btn btn-primary">Register</a>
		  </div>
		  <div class="card-footer text-muted">
		    OnlineHIT
		  </div>
		</div>
	</div>
</div>


<?php 
	if(logged_in() === true)
	{
		echo "Successfully logged in!";
	}
	
 ?>





<?php include "includes/overall/footer.php";?>