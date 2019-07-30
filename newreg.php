<?php 
	include "core/init.php";
	logged_in_redirect();
	include "includes/overall/header.php";

?>
	<div class="well">
		<div class="well well-wb well-blue">
			<h2>
				<span class="fa fa-user-plus"></span>	
				Registration 
				<br>
				<small>
					<span class="glyphicon glyphicon-paperclip"></span>
					Connnect yourself from HIT family
				</small>
			</h2>
		</div>
	</div>

	<div class="well well-wb">
			<div class="card text-center">
			  <div class="card-header">
			    <span class="fa fa-smile-o well-blue" id='big_smile'></span>
			  </div>
			  <div class="card-block">
			    <h4 class="card-title well-blue">Thank you.</h4>
			    <p class="card-text lead well-blue">Please check your email to activate your account.</p>
			    <a href="" class="btn btn-primary"><span class="fa fa-sign-in"></span> Login</a>
			  </div>
			  <div class="card-footer text-muted">
			    OnlineHIT
			  </div>
			</div>
		</div>

<div class="input-group margin-bottom-sm">
  <span class="input-group-addon"><i class="fa fa-user-o fa-fw" aria-hidden="true"></i></span>
  <input class="form-control" type="text" placeholder="Email address">
</div>
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
  <input class="form-control" type="password" placeholder="Password">
</div>


<?php include 'includes/overall/footer.php'; ?>