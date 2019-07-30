<?php  
	include "core/init.php";
	logged_in_redirect();
	include "includes/overall/header.php";
	
?>
	<div class="well">
    	<div class="well well-blue well-wb">
    		<h3><i class="fa fa-universal-access"></i> User verification <br>
    			<small>
    				<i class="glyphicon glyphicon-paperclip"></i> Validate email 
    			</small>
    		</h3>
    
    	</div>
    </div>

<?php 
	if(isset($_GET['email'],$_GET['KoDEmLIYGFFhf356'],$_GET['nKpoDh']) === true)
	{
		$email = sanitize($_GET['email']);
		$email_code = sanitize($_GET['KoDEmLIYGFFhf356']);
		$new_code = sanitize($_GET['nKpoDh']);


		if(email_exists($email) === true and has_activated($email) === true)
		{
	?>
			<div class="well well-blue well-wb">
				<div class="card text-center">
				  <div class="card-header">
				    <i class="fa fa-smile-o" id='big_smile'></i>
				  </div>
				  <div class="card-block">
				    <h4 class="card-title lead">Thank you!</h4>
				    <p class="card-text time-h"> The account associated with the email <?php echo $email; ?> is already activated. <br> Please login.</p>
				    <a href="register.php" class="btn btn-primary">Register</a>
				  </div>
				  <div class="card-footer text-muted">
				    OnlineHIT
				  </div>
				</div>
			</div>
	<?php
		}
		else if(email_exists($email) === false)
		{
	?>
			<div class="well well-blue well-wb">
				<div class="card text-center">
				  <div class="card-header">
				    <i class="fa fa-frown-o" id='big_smile'></i>
				  </div>
				  <div class="card-block">
				    <h4 class="card-title lead">Sorry!</h4>
				    <p class="card-text time-h"> We are unable to identify you. <br>Please Register.</p>
				    <a href="register.php" class="btn btn-primary">Register</a>
				  </div>
				  <div class="card-footer text-muted">
				    OnlineHIT
				  </div>
				</div>
			</div>
	<?php
		}
		else
		{
			if($new_code != md5(substr($email_code,5,10)))
			{
				$errors[] = "codes_doesnot match";
			}
			else
			{
				$flag = activate($email,$email_code);
			}

			if(empty($errors) === true and $flag === true)
			{
				?>
				<div class="well">
		    		<div class="well well-blue well-wb">
		        		<div class="card text-center">
		        		  <div class="card-header">
		        		    <i class="fa fa-smile-o" id='big_smile'></i>
		        		  </div>
		        		  <div class="card-block">
		        		    <h4 class="card-title lead">Thank you!</h4>
		        		    <p class="card-text time-h"> We are glad to see you here. <br> Your email verification was successful. Now feel free to login.</p>
		        		    <a href="register.php" class="btn btn-primary">Register</a>
		        		  </div>
		        		  <div class="card-footer text-muted">
		        		    OnlineHIT
		        		  </div>
		        		</div>
		    	    </div>
			    </div>
			<?php
			}
			else
			{
		?>
				<div class="well well-blue well-wb">
					<div class="card text-center">
					  <div class="card-header">
					    <i class="fa fa-frown-o" id='big_smile'></i>
					  </div>
					  <div class="card-block">
					    <h4 class="card-title lead">Sorry!</h4>
					    <p class="card-text time-h"> An error occured. We couldn't verify your email. 
					    	<br> Either link is missing something or you have provided the old link.
					    </p>
					    <a href="activateuser.php" class="btn btn-primary">Activate Account</a>
					  </div>
					  <div class="card-footer text-muted">
					    OnlineHIT
					  </div>
					</div>
				</div>
		<?php
			}


		}

		
	}
	else
	{
		header('location:index.php');
	}

	include "includes/overall/footer.php";
?>

