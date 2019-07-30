<div class="widgets well well-wb">
	<form action="login.php" method="POST" autocomplete="off">
		<ul>
			<li class="well-blue"><h3 id=aside_header><i class="fa fa-sign-in"></i> Login/Register</h3></li>
			<li class="well-blue">
			<label for="username">
				<strong><i class="fa fa-"></i> username:</strong> <br>
			</label>
			
			<div class="input-group margin-bottom-sm">
			
			  <span class="input-group-addon"><i class="fa fa-user-o fa-fw"></i></span>
			  <input type="text" id='username' name="username" placeholder="Enter username..." class="form-control well-blue">
			</div>


			<!-- <strong><i class="fa fa-user"></i> username:</strong> <br> <input type="text" name="username" placeholder="Enter username..." class="form-control well-blue"> -->
			</li>
			<li class="well-blue">
			<label for="password">
				<strong><i class="fa fa"></i> Password:</strong> <br>
			</label>
			
			<div class="input-group margin-bottom-sm">

			  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
			  <input type="password" id="password" class="form-control well-blue" name="password" placeholder="Enter Password..." >
			  
			</div>


			<!-- <strong><i class="fa fa-key"></i> Password:</strong> <br> <input type="password" class="form-control" name="password" placeholder="Enter Password..." > -->
			</li>
			<li>
				<input type="submit" name="submit" value="Login" class="btn btn-primary" >
			</li>
			<li>
				<h4><a href="register.php"><span class="glyphicon glyphicon-registration-mark" aria-hidden="true"></span> Register</a></h4>
			</li>
			<li>
				<h4><a href="activateuser.php"><span class="glyphicon glyphicon-registration-mark" aria-hidden="true"></span> Activate Account</a></h4>
			</li>
			<li>
				<h5>Forget <a href="forgousrname.php">username</a> or <a href="forgopasswrd.php">password</a></h5>
			</li>
			
		</ul>
	</form>
</div>