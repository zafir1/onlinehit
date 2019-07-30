<?php
include "core/init.php";
protected_page();
who_can_access($user_data['user_id'],"'admin','moderator'");

$workshop_hash = active_workshop_hash_of($user_data['member']);
if($workshop_hash == false)
{
	header('Location:logout.php');
	exit();
}

$workshop = workshop_details_from_hash($workshop_hash);

if(isset($_GET['applicant'],$_GET['preceiver'],$_GET['code']))
{
	$applicant 	= sanitize($_GET['applicant']);
	$preceiver 	= sanitize($_GET['preceiver']);
	$code 		= sanitize($_GET['code']);

	if(($client_id = user_id_from_email_code($preceiver))!== false)
	{
		$client_data = user_data($client_id,'user_id','username','password','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id','faculty');

		if(confirm_user_id_for_workshop_id($client_id,$workshop->id,1) === false)
		{
			header('Location:logout.php');
			exit();
		}

		if(password_verify($client_data['user_id'].$client_data['email_code'].$user_data['user_id'].$workshop->id,$applicant) && password_verify($workshop->id.$user_data['user_id'].$client_data['user_id'].$user_data['email_code'],$code))
		{
			$data = payment_detail_for_workshop($client_data['user_id'],$workshop->id);
			include 'includes/overall/header.php';
?>


		<div class="well">
			<div class="well well-wb well-blue">

				<div class="card text-center">
				  <div class="card-header">
				    <img src="http://www.demorgia.com/wp-content/uploads/2017/06/Haldia-Institute-of-Technology.png" alt="Haldia-Institute-of-Technology" width="150px" height="150px">
				  </div>
				  <div class="card-block">
				    <h3 class="card-title"><b>Haldia Institute of Technology <br><small>
				    	Home Automation <br> IETE 
				    </small></b></h3>
				  </div>
				  <div class="card-footer text-muted">
				    
				  </div>
				</div>
				<br>
				<table class="table table-striped">
					<thead>
						<th colspan="2"><i class="fa fa-krw"></i> Home Automation</th>
					</thead>
					<tbody>
						<tr>
							<td><i class="fa fa-user"></i> Name:</td>
							<td><?php echo strtoupper( $client_data['first_name'].' '.$client_data['last_name']); ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-registered"></i> Roll No:</td>
							<td><?php echo $client_data['uni_roll']; ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-ravelry"></i> University Reg:</td>
							<td><?php echo $client_data['uni_reg']; ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-cubes"></i> Workshop:</td>
							<td><?php echo $workshop->name; ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-users"></i> Organization:</td>
							<td><?php echo strtoupper($user_data['member']); ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-inr"></i> Ammount:</td>
							<td><?php echo $workshop->fee; ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-calendar"></i> Registration Time:</td>
							<td><?php echo $data['reg_on']; ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-clock-o"></i> Payment Time:</td>
							<td><?php echo $data['confirm_on']; ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-check-square-o"></i> Payment Acceptor:</td>
							<td><?php echo strtoupper(full_name_from_id($data['reg_confirm_by'])); ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-phone"></i> Contact no:</td>
							<td><?php echo $workshop->phone; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>


<?php			
			include 'includes/overall/footer.php';
		}
		else
		{
			header('Location:logout.php');
			exit();	
		}
	}
	else
	{
		header('Location:logout.php');
	}


}else{
	header('Location:logout.php');
}

?>