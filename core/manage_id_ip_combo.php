<?php 
		$uid = $user_data['user_id'];
		$uip = $_SERVER['REMOTE_ADDR'];

		$uid = (int)$uid;
		$uip = sanitize($uip);

		if(user_id_ip_combo_exists($uid,$uip) === true)
		{
			
			if(get_user_id_ip_combo_flag($uid,$uip) === false)
			{
				// update user id ip table
				update_user_id_ip_combo_flag_to_zero($uid,$uip);
				header('Location: logout.php');
			}
			
		}

		else if(user_id_ip_combo_exists($uid,$uip) === false)
		{
			$uid = (int)$uid;
			$uip = sanitize($uip);
			// Insert user id ip.
			insert_user_id_ip($uid,$uip);
			// Send a security email to the user.
			mail_user_about_security($user_data['email'],$user_data['first_name']);
		}

 ?>