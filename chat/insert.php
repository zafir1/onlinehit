<?php 
include "../core/init.php";
protected_page();

	if(isset($_POST['UsPxDiMnjd'],$_POST['ApLUmnDk'],$_POST['SaltAPuId'],$_POST['ReceiverIDP'],$_POST['message']) === true )
	{
		$email_code 		= sanitize($_POST['UsPxDiMnjd']);
		$to_id 				= (int)substr(sanitize($_POST['ApLUmnDk']), 6);
		$contact_verify 	= sanitize($_POST['SaltAPuId']);
		$user_verify 		= sanitize($_POST['ReceiverIDP']);
		$message 			= mysqli_real_escape_string($dbchat,htmlentities($_POST['message']));

		if(email_code_user_id_combo_exists($to_id,$email_code) === true and (($contact_verify == md5('2:6:4:95'.$to_id)) and ($user_verify == md5('2:6::4:95'.$user_data['user_id']))))
		{
			insert_personal_chat_message($to_id,$message);
		}
	}
	else if(isset($_POST['UsPxDiMnjd'],$_POST['ApLUmnDk'],$_POST['SaltAPuId'],$_POST['ReceiverIDP'],$_POST['retrive']) === true)
	{
		$email_code 		= sanitize($_POST['UsPxDiMnjd']);
		$to_id 				= (int)substr(sanitize($_POST['ApLUmnDk']), 6);
		$contact_verify 	= sanitize($_POST['SaltAPuId']);
		$user_verify 		= sanitize($_POST['ReceiverIDP']);
		$retrive 			= sanitize($_POST['retrive']);
		if(($contact_verify == md5('2:6:4:95'.$to_id)) and ($retrive == 'yes') and ($user_verify == md5('2:6::4:95'.$user_data['user_id'])))
			{
				grab_personal_chat_content($user_data['user_id'],$to_id);
			}

	}
	else
	{
		header('Location:../logout.php');
	}

 ?>