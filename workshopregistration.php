<?php 
include "core/init.php";
protected_page();

if(isset($_GET['wkspid'],$_GET['uwkspid'],$_GET['kxpidssde']) === true)
{
	$workshop_hash 		= sanitize($_GET['wkspid']);
	$user_id 			= sanitize($_GET['uwkspid']);
	$user_vid 			= sanitize($_GET['kxpidssde']);

	if(workshop_hash_exits($workshop_hash) === false)
	{
		header('Location:index.php');
	}
	else if($user_id != substr(md5($user_data['user_id']),8,10))
	{
		header('Location:index.php');
	}
	else if($user_vid != md5(substr(md5($user_data['user_id']),8,10)))
	{
		header('Location:index.php');
	}

	else
	{
		include 'includes/overall/header.php';
		$workshop = workshop_details_from_hash($workshop_hash);
		$workshop_id = $workshop->id;

?>
	<div class="well">
		<?php $payment_left = confirm_user_id_for_workshop_id($user_data['user_id'],$workshop->id,0);

			if($payment_left && has_registered($user_data['user_id'],$workshop->id)){
				?>
					<div class="well well-wb">
						<h3 class="well-blue">
							<span class="fa fa-users"></span>
							IETE Workshop / Event
						</h3>
					</div>

				<?php
			}

		?>

		
		<?php 
			if(isset($_POST['submit']) === true and empty($_POST['password']) === false)
			{
				if(md5(sanitize($_POST['password'])) !== $user_data['password'])
				{
					?>
						<div class="alert alert-warning lead">
							<b><i class="fa fa-frown-o"></i>  Sorry! Incorrect password</b>
						</div>
					<?php
				}
				else
				{
					register_user_for_workshop($user_data['user_id'],$workshop_id);
					$link = "workshopregistration.php?wkspid=$workshop_hash&uwkspid=$user_id&kxpidssde=$user_vid&Registration=Success";
					header('Location: '.$link);
				}
			}
		 ?>
		<div class="well well-wb">

			<?php 
				if($payment_left)
				{
					?>
						<div class="card text-center">
						  <div class="card-header well-blue">
						    <h3><?php echo strtoupper($workshop->name); ?></h3>
						    
						  </div>
						</div>
					<?php
				}
			 ?>
			
			
			<?php 

				if(has_registered($user_data['user_id'],$workshop_id) === false)
				{
					?>
					<div class=" card text-center">
						<span class="time"> Comfirm your registration just by typing your password again</span>
					</div>
				
					<form action="workshopregistration.php?wkspid=<?php echo $workshop_hash; ?>&uwkspid=<?php echo $user_id; ?>&kxpidssde=<?php echo $user_vid; ?>" method='POST' autocomplete="off">
						<ul>
							<li class="well-blue">
								<span class="fa fa-hand-o-right"></span> 
								<b>Enter password</b>
								<div class="input-group">
								  <span class="input-group-addon well-blue"><i class="fa fa-key fa-fw"></i></span>
								  <input class="form-control well-blue" name='password' type="password" placeholder="Password">
								</div>
							</li>
							<li>
								<input type="submit" name="submit" value="confirm registration" class="form-control btn btn-success">
							</li>
						</ul>

					</form>
					

					<?php
				}
				else
				{
					$payment_detail = payment_detail_for_workshop($user_data['user_id'],$workshop_id);
					?>
           			
					  	<?php 
					  		if($payment_detail['reg_confirm'] == 0)
				    		{
				    			?>
				    			<div class="card text-center">
									  <div class="card-header lead">
									  	<i class="fa fa-smile-o well-blue" id='big_smile'></i>
									    
									  </div>
									  <div class="card-block">
										<h4 class="card-title well-blue"><b>Registration Successfull</b></h4>
										<span class='time'>Please make payment 
										<?php echo $workshop->payment_venue; ?>
										<br>
											<i class="fa fa-phone"></i>
											<?php echo $workshop->phone; ?>
										<br><br>
											</span>

										<p class="card-text">
											<a class="btn btn-primary">Please make payment</a>
										</p>
										<div class="card-footer text-muted">
										    OnlineHIT
										</div>
									</div>
								</div>
				    			<?php
				    		}
				    		else if($payment_detail['reg_confirm'] == 1)
				    		{
				    			?>
				    			<div class="">
									<?php generate_workshop_receipt_for_user($workshop,$payment_detail); ?>
								</div>

				    			<?php
				    		}
				    		else
				    		{
				    			header('Location:logout.php');
				    		}

					  	 ?>
					   
					  
					<?php
				}
			 ?>
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