<?php 
	function insert_personal_chat_message($to,$message)
	{
		global $user_data;
		global $dbchat;
		$to = (int)sanitize($to);
		$from = (int)$user_data['user_id'];
		$message = mysqli_real_escape_string($dbchat,htmlentities($message));

		if($stmt = $dbchat->prepare("INSERT INTO `message` (`from`,`to`,`message`) VALUES (?,?,?)"))
		{
			$stmt->bind_param('iis',$from,$to,$message);
			$stmt->execute();
			$stmt->close();
		}
		


	}

	function grab_personal_chat_content($user1,$user2)
	{
		global $user_data;
		global $dbchat;
		$user1 = (int)$user1; 
		$user2 = (int)$user2; 
		$query = "
						SELECT * FROM `message` WHERE (`from` = '$user1' AND `to` = '$user2') OR (`from` = '$user2' AND `to` = '$user1') ORDER BY `id` DESC LIMIT 500

					";
		if($result = $dbchat->query($query)) 
		{
			if($result->num_rows == 0)
			{
				echo 'Start A conversation';
			}
			else
			{
				while($row = $result->fetch_object())
				{
					if($row->from == $user_data['user_id'])
					{
						?>
							<div class="comment bubble_me" title="Sent on: <?php echo $row->time; ?>">
								<p>
									<?php echo $row->message; ?>
								</p>
							</div>
							<br>
						<?php
					}
					else
					{
						?>
							<div class="comment bubble_friend" title="Received at: <?php echo $row->time; ?>">
								<p>
									<?php echo $row->message; ?>
								</p>
							</div><br>
						<?php
					}
				}
			}
		}

	}

	function grab_personal_chat_list()
	{
		global $user_data;
		global $dbchat;
		$user_id = $user_data['user_id'];
		$query = "
						SELECT * FROM `message` WHERE `id` IN 
							(	SELECT MAX(`id`) FROM `message` GROUP BY 
								`to`,`from` HAVING `from` = '$user_id' OR `to`= '$user_id'
							)
						AND `fromv` = '1' ORDER BY `time` DESC LIMIT 200
				";

		if($result = $dbchat->query($query))
		{
			if($result->num_rows == 0)
			{
				echo "Sorry No Chat";
			}
			else
			{
				while($row = $result->fetch_object())
				{
					?>

						<li>
					   		<div class="chat_list_item">
					   			<span class="lead">
					   				 
										<?php 
											if($row->from != $user_id)
											{
												$contact = user_data($row->from,'user_id','username','password','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id');

												?>
						<a href="chat.php?UsPxDiMnjd=<?php echo $contact['email_code']; ?>&ApLUmnDk=23EpQZ<?php echo $contact['user_id']; ?>&SaltAPuId=<?php echo md5('2:6:4:95'.$contact['user_id']); ?>&ReceiverIDP=<?php echo md5('2:6::4:95'.$user_data['user_id']); ?>">
							<i class="fa fa-user"></i>
												<?php echo $contact['first_name'].' '.$contact['last_name']; ?>
													</a>
												<?php

											}
											else
											{
												$contact = user_data($row->to,'user_id','username','password','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id');

												?>
						<a href="chat.php?UsPxDiMnjd=<?php echo $contact['email_code']; ?>&ApLUmnDk=23EpQZ<?php echo $contact['user_id']; ?>&SaltAPuId=<?php echo md5('2:6:4:95'.$contact['user_id']); ?>&ReceiverIDP=<?php echo md5('2:6::4:95'.$user_data['user_id']); ?>">
														<i class="fa fa-user"></i>
												<?php echo $contact['first_name'].' '.$contact['last_name']; ?>
													</a>
												<?php
												
											}
										 ?>
					   				
					   			</span>
					   			<span class="time" id="float_right">ECE</span>
					   			 
					   			<br><span class="time"><i class="fa fa-calendar"></i>
					   				<?php echo $row->time; ?>
					   			</span> 
					   		</div>
					   		<div>
					   			<p><i class="fa fa-commenting"></i> 
									<span class="time-h"><?php
										if(strlen($row->message) < 30)
										{
											echo $row->message;
										}
										else
										{
											echo substr($row->message,0,25).'......';
										}

									?></span>
					   			</p>
					   		</div>
					   	</li>
						<hr>
					<?php
				}
			}
		}
		
	}
 ?>