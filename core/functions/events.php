<?php
	function close_workshop($club,$workshop_id)
	{
		global $dbevents;
		if($dbevents->query("UPDATE `workshop` SET `activity` = '0' WHERE `id` = '$workshop_id' AND `club` = '$club'"))
		{
			return true;
		}
		else{
			return false;
		}

	}

	function register_workshop($register_data)
	{
		global $website;
		global $dbevents;
		$fields = '`'.implode("`, `", array_keys($register_data)).'`';
		$data = "'".implode("', '",$register_data)."'";
		$query = "INSERT INTO `workshop` (".$fields.") VALUES (".$data.")";
		
		$dbevents->query($query);	
	} 

	function confirm_user_id_for_workshop_id($user_id,$workshop_id,$cnf)
	{
		/* 1 will be passed for confirmed students otherwise always pass 0*/
		global $dbevents;
		$user_id = (int)$user_id;
		$workshop_id = (int)$workshop_id;
		$cnf = (int)$cnf;
		if($stmt = $dbevents->prepare("SELECT `id` FROM `participants` WHERE `user_id` = ? AND `workshop_id` = ? AND `reg_confirm` = ?"))
		{
			$stmt->bind_param('iii',$user_id,$workshop_id,$cnf);
			$stmt->execute();
			$stmt->store_result();
			return ($stmt->num_rows == 1) ? true : false;
		}
	}

	function complete_payment_for_workshop($client_id,$workshop_id,$confirmer)
	{
		global $dbevents;
		$client_id 		= (int)$client_id;
		$workshop_id 	= (int)$workshop_id;
		$confirmer 		= (int)$confirmer;
		$unique_id		= uniqid();
	
		if($dbevents->query("UPDATE `participants` SET `reg_confirm`= '1',`reg_confirm_by`= '$confirmer', `confirm_on`= CURRENT_TIMESTAMP,`unique_id`='$unique_id' WHERE `user_id` = '$client_id' AND `workshop_id` = '$workshop_id'"))
		{
			return true;
		}
		else{
			return false;
		}

	}

	function workshop_hash_exits($hash)
	{
		global $dbevents;
		$hash = sanitize($hash);
		if($result = $dbevents->prepare("SELECT `id` FROM `workshop` WHERE `hash` = ? AND `activity` = 1"))
		{
			$result->bind_param('s',$hash);
			$result->execute();
			$result->store_result();
			return ($result->num_rows == 1) ? true : false; 
		}
		return false;
	}

	function active_workshop_at_club_envelope($group)
	{
		global $user_data;
		$group = sanitize($group);
		$hash = active_workshop_hash_of($group);
		if($hash !== false)
		{
			$workshop = workshop_details_from_hash($hash);
			?>
				<div class="well">
					<h4 class="well-blue">
						<span class="fa fa-hand-o-right"></span>
						<?php echo $workshop->eheading; ?>
					</h4>
					<?php echo $workshop->etitle; ?> 
					<br><br>

					<a href="workshopdetails.php?wkspid=<?php echo $workshop->hash; ?>&uwkspid=<?php echo substr(md5($user_data['user_id']),3,24); ?>&kxpidssde=<?php echo md5(substr(md5($user_data['user_id']),3,24)); ?>" class="btn btn-primary">More Details</a>
					
				</div>
			<?php
			
		}
	}

	function workshop_details_from_hash($hash)
	{
		global $dbevents;
		$hash = sanitize($hash);
		if($result = $dbevents->query("SELECT * FROM `workshop` WHERE `hash` = '$hash'"))
		{
			if($result->num_rows == 1)
			{
				$data = $result->fetch_object();
				return $data;
			}
		}
	}

	function has_registered($user_id,$workshop_id)
	{
		global $dbevents;
		$user_id = (int)sanitize($user_id);
		$workshop_id = (int)sanitize($workshop_id);
		if($result = $dbevents->prepare("SELECT `id` FROM `participants` WHERE `user_id` = ? AND `workshop_id` = ?"))
		{
			$result->bind_param('ii',$user_id,$workshop_id);
			$result->execute();
			$result->store_result();
			return ($result->num_rows >= 1) ? true : false;
		}
	}
	function register_user_for_workshop($user_id,$workshop_id)
	{
		global $dbevents;
		$user_id = (int)sanitize($user_id);
		$workshop_id = (int)sanitize($workshop_id);
		if($result = $dbevents->prepare("INSERT INTO `participants` 
			(`id`, `workshop_id`, `user_id`, `reg_confirm`, `reg_confirm_by`, `created`, `reg_on`, `confirm_on`) VALUES (NULL, ?, ? , '0', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL)
			"))
		{
			$result->bind_param('ii',$workshop_id,$user_id);
			$result->execute();
		}
	}

	function payment_detail_for_workshop($user_id,$workshop_id)
	{
		global $dbevents;
		$user_id = (int)sanitize($user_id);
		$workshop_id = (int)sanitize($workshop_id);
		if($result = $dbevents->query("SELECT `reg_confirm`,`reg_confirm_by`,`reg_on`,`confirm_on`,`unique_id` FROM `participants` WHERE `user_id` = '$user_id' AND `workshop_id` = '$workshop_id'"))
		{
			if($result->num_rows == 1)
			{
				$data = $result->fetch_assoc();
				return $data;
			}
		}

	}

	function active_workshop_hash_of($group)
	{
		global $db;
		global $dbevents;
		$group = sanitize($group);
		if($result = $dbevents->prepare("SELECT `hash` FROM `workshop` WHERE `club` = ? AND `activity` = 1"))
		{
			$result->bind_param('s',$group);
			$result->execute();
			$result->store_result();
			$result->bind_result($hash);
			$result->fetch();
			return ($result->num_rows == 1) ? $hash : false;
		}
	}

	function active_workshop_of($group)
	{
		global $db;
		global $dbevents;
		$group = sanitize($group);
		if($result = $dbevents->prepare("SELECT `id` FROM `workshop` WHERE `club` = ? AND `activity` = 1"))
		{
			$result->bind_param('s',$group);
			$result->execute();
			$result->store_result();
			$result->bind_result($id);
			$result->fetch();
			return ($result->num_rows == 1) ? $id : false;
		}

	}

	function find_student_from_confirm_list_for_workshop($user_id,$email,$workshop_id)
	{
		global $dbevents;
		$user_id = (int)$user_id;
		$workshop_id = sanitize($workshop_id);
		$lr = 'lr';
		$events = 'events';
		if(confirm_user_id_for_workshop_id($user_id,$workshop_id,1) === true)
		{
			if($result = $dbevents->query("
				SELECT  $events.participants.*, $lr.users.* FROM 
				$events.participants INNER JOIN $lr.users ON 
				$lr.users.user_id = '$user_id' AND 
				$events.participants.workshop_id = '$workshop_id' AND 
				$events.participants.reg_confirm = 1 LIMIT 1 

			")){

				$count = $result->num_rows;
				if($count == 0)
				{
					?>
					<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> No result from <b><?php echo $email; ?></b> in this list.</div>

					<?php
				}
				else
				{
					while($row = $result->fetch_object())
				{
					?>
			<div class="well well-wb">
				
			
			<div class="well-wb">
				<div class="row">
					<div class="col-md-7 well-blue">
						<span class="lead"><i class="fa fa-user"></i>
						<?php echo $row->first_name." ".$row->last_name; ?></span><br>
						<span class="time">
							<i class="fa fa-flag-checkered well-blue"></i> 
							<?php echo give_department_full_form($row->department); ?>
						</span>
						<br>
						<span class="time"><i class="fa fa-phone well-blue"></i> 9473142093</span>
						<br>
						<span class="time"><i class="fa fa-envelope-o well-blue"></i> 
						<?php echo $row->email; ?>
						 </span>
						
					</div>
					<div class="col-md-5">
						
						<span class="time"><i class="fa fa-registered well-blue"></i> <?php echo $row->uni_roll; ?></span><br>
						<span class="time"><i class="fa fa-clock-o well-blue"></i> 
							<?php echo give_year_full_form($row->year); ?></span>
						<br>
						<span class="time"><i class="fa fa-check-square-o well-blue"></i> 
						<?php echo full_name_from_id($row->reg_confirm_by); ?>
						</span>
						<br>
						<span class="time"><i class="fa fa-calendar-check-o well-blue"></i> 
						<?php echo $row->confirm_on; ?>
						</span>
						<br>
					</div>
				</div>
			</div>
			</div>

					<?php
				}
				}
				$result->close();

			}
		}
		else
		{
			?>
			<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> No result from <b><?php echo $email; ?></b> in this list.</div>

			<?php
		}
	}

	function student_confirm_list_for_workshop($workshop_id)
	{
		global $dbevents;
		$workshop_id = (int)sanitize($workshop_id);
		$lr = 'lr';
		$events = 'events';
		$query = "	
					SELECT $events.participants.*, $lr.users.* FROM 
					$events.participants INNER JOIN $lr.users ON 
					$events.participants.user_id = $lr.users.user_id WHERE 
 					$events.participants.workshop_id = $workshop_id AND $events.participants.reg_confirm = 1
 					ORDER BY `confirm_on` DESC

 				";
 		

		if($result = $dbevents->query($query))
		{
			$count = $result->num_rows;
			if($count == 0)
			{
				?>
				<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> No Registered Students</div>
				<?php
			}
			else
			{
				while($row = $result->fetch_object())
				{
					?>
			<div class="well well-wb">
				<div class="row">
					<div class="col-md-7 well-blue">
						<span class="lead"><!-- <i class="fa fa-user"></i> --> <?php echo $count.'.'; $count--; ?>
						<?php echo $row->first_name." ".$row->last_name; ?></span><br>
						<span class="time">
							<i class="fa fa-flag-checkered well-blue"></i> 
							<?php echo give_department_full_form($row->department); ?>
						</span>
						<br>
						<span class="time"><i class="fa fa-phone well-blue"></i> <?php echo $row->unique_id; ?></span>
						<br>
						<span class="time"><i class="fa fa-envelope-o well-blue"></i> 
						<?php echo $row->email; ?>
						 </span>
						
					</div>
					<div class="col-md-5">
						<span class="time"><i class="fa fa-registered well-blue"></i> <?php echo $row->uni_roll; ?></span><br>
						<span class="time"><i class="fa fa-clock-o well-blue"></i> 
							<?php echo give_year_full_form($row->year); ?></span>
						<br>
						<span class="time"><i class="fa fa-check-square-o well-blue"></i> 
						<?php echo full_name_from_id($row->reg_confirm_by); ?>
						</span>
						<br>
						<span class="time"><i class="fa fa-calendar-check-o well-blue"></i> 
						<?php echo $row->confirm_on; ?>
						</span>
						<br>
					</div>
				</div>
			</div>

					<?php
				}
			}
		}
		
	}

	function waited_students_for_workshop($workshop_id)
	{
		global $dbevents;
		global $user_data;
		$workshop_id = (int)sanitize($workshop_id);
		$lr = 'lr';
		$events = 'events';
		$query = "	
					SELECT $events.participants.*, $lr.users.* FROM 
					$events.participants INNER JOIN $lr.users ON 
					$events.participants.user_id = $lr.users.user_id WHERE 
 					$events.participants.workshop_id = $workshop_id AND $events.participants.reg_confirm = 0
 					ORDER BY `reg_on` DESC

 				";
 		

		if($result = $dbevents->query($query))
		{
			$count = $result->num_rows;
			if($count == 0)
			{
				?>
				<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> No Registered Students</div>
				<?php
			}
			else
			{
				while($row = $result->fetch_object())
				{
					?>
			<div class="well well-wb">
				<div class="row">
					<div class="col-md-7 well-blue">
						<span class="lead"><!-- <i class="fa fa-user"></i> --> <?php echo $count.'.'; $count--; ?>
						<?php echo $row->first_name." ".$row->last_name; ?></span><br>
						<span class="time">
							<i class="fa fa-flag-checkered well-blue"></i> 
							<?php echo give_department_full_form($row->department); ?>
						</span>
						<br>
						<span class="time"><i class="fa fa-phone well-blue"></i> 9473142093</span>
						<br>
						<span class="time"><i class="fa fa-envelope-o well-blue"></i> 
						<?php echo $row->email; ?>
						 </span>
						
					</div>
					<div class="col-md-5">
						<span class="time"><i class="fa fa-registered well-blue"></i> <?php echo $row->uni_roll; ?></span><br>
						<span class="time"><i class="fa fa-clock-o well-blue"></i> 
							<?php echo give_year_full_form($row->year); ?></span>
						<br>
						<span class="time"><i class="fa fa-calendar-check-o well-blue"></i> 
						<?php echo $row->reg_on; ?>
						</span>
						<br>
						<span>
							<a href="makeuserpaymentforworkshop.php?kxps=<?php echo md5($user_data['email'].$row->user_id.$user_data['user_id']); ?>&l=<?php echo password_hash($user_data['user_id'].$row->email_code.$row->email,PASSWORD_DEFAULT); ?>&m=<?php echo $row->email_code; ?>&mn=<?php echo md5($user_data['user_id'].substr($user_data['email_code'],5,6).substr($row->email_code,5,8).$row->user_id); ?>" target='_blank' ><i class="fa fa-paypal"></i><span class="time-h"> Make Payment Here</span></a>
						</span>
					</div>
				</div>
			</div>
				<?php
				}
			}
		}	
	}

	function generate_workshop_receipt_for_user($workshop,$payment_detail)
	{
		global $dbevents;
		global $user_data;
		$client_data = $user_data;
		
		?>
			<div class="well well-wb well-blue">

				<div class="card text-center">
				  <div class="card-header">
				    <img src="http://www.demorgia.com/wp-content/uploads/2017/06/Haldia-Institute-of-Technology.png" alt="Haldia-Institute-of-Technology" width="150px" height="150px">
				  </div>
				  <div class="card-block">
				    <h3 class="card-title"><b>Haldia Institute of Technology <br><small>
				    	<?php echo $workshop->name; ?> <br> <?php echo strtoupper($workshop->club); ?> 
				    </small></b></h3>
				  </div>
				  <div class="card-footer text-muted">
				    
				  </div>
				</div>
				<br>
				<table class="table table-striped">
					<thead>
						<th colspan="2"><i class="fa fa-krw"></i> <?php echo $workshop->name; ?></th>
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
							<td><i class="fa fa-envelope-o"></i> Email:</td>
							<td><?php echo $client_data['email']; ?></td>
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
							<td><i class="glyphicon glyphicon-barcode"></i> Payment-ID:</td>
							<td><?php echo $payment_detail['unique_id']; ?></td>
						</tr>
						<tr>
							<td><i class="glyphicon glyphicon-road"></i> Workshop venue:</td>
							<td><b><?php echo $workshop->workshop_venue; ?></b></td>
						</tr>
						<tr>
							<td><i class="fa fa-calendar"></i> Registration Time:</td>
							<td><?php echo $payment_detail['reg_on']; ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-clock-o"></i> Payment Time:</td>
							<td><?php echo $payment_detail['confirm_on']; ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-check-square-o"></i> Payment Acceptor:</td>
							<?php $payment_acceptor = full_name_from_id($payment_detail['reg_confirm_by']); ?>
							<td><?php echo strtoupper($payment_acceptor); ?></td>
						</tr>
						<tr>
							<td><i class="fa fa-phone"></i> Contact no:</td>
							<td><?php echo $workshop->phone; ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="card text-center">
			  <div class="card-footer">
			    <?php include "QrCode/php/qrtest.php"; 
			    	$d = $user_data['uni_roll']." | ".$user_data['first_name']." | ".$user_data['uni_roll']." | ".$payment_detail['unique_id'].
			    	" | ".$payment_acceptor." | ".$user_data['email'];
			    	echo "<img src='QrCode/php/qr_img.php?d=$d' height='300px' width='300px'>";
			    ?>
			  </div>
			</div>
		<?php
	}



 ?>