<?php
	function delete_from_faculty_list($user_id,$email_code)
	{
		global $db;
		$user_id = (int)sanitize($user_id);
		$email_code = sanitize($email_code);
		if($update = $db->prepare("UPDATE `users` SET `faculty` = '0' WHERE `user_id` = ? AND `email_code` = ? "))
		{
			$update->bind_param('is',$user_id,$email_code);
			$update->execute();
			$update->close();
		}
		if($delete_post = $db->prepare("UPDATE `teachers_post` SET `hidden` = 1 WHERE `posted_by` = '$user_id'"))
		{
			$delete_post->execute();
			$delete_post->close();
		}
	}

	function dept_teacher_list_at_hod($department,$email_code)
	{
		global $db;
		$department = sanitize($department);
		$email_code = sanitize($email_code);
		if($result = $db->query("SELECT * FROM `users` WHERE `faculty` = '1' AND `department` = '$department' ORDER BY `first_name` ASC"))
		{
			while($row = $result->fetch_object())
			{
				?>
				<tr>
		        <td>
		        	<ul>
		        		<li class="well-blue">
		        			<a href="fpw.php?facultyID=<?php echo substr(md5($row->user_id), 3,27); ?>">
		        			<b><span class="glyphicon glyphicon-user"></span>
		        			<?php echo $row->first_name.' '.$row->last_name; ?>
		        			</b></a>
		        			
		        		</li>

		        		<li class="time">
		        				<a href="mailto:<?php echo $row->email; ?>">
		        				<span class="fa fa-envelope well-blue"></span> 
		        				<?php echo $row->email; ?></a>
		        		</li>

		        		<li class="time">
		        			<span class="fa fa-phone well-blue"></span> 983566347
		        		</li>
		        	</ul>
		        </td>

		        <td>
		        	<a href="dffl.php?hoid=<?php echo $email_code; ?>&user=<?php echo $row->user_id; ?>&usercode=<?php echo $row->email_code; ?>" class="btn btn-danger" title="Delete <?php echo $row->first_name.' '.$row->last_name; ?> from faculty list."><span class="glyphicon glyphicon-trash"></a>
		        </td>
		     </tr>
				<?php
			}
		}
	}

	function count_dept_teacher($department)
	{
		global $db;
		$department = sanitize($department);
		if($stmt = $db->prepare(" SELECT `user_id` FROM `users` WHERE `faculty` = '1' AND `department` = ?"))
		{
			$stmt->bind_param('s',$department);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows;
			$stmt->close();
		}
	}

	function upgrade_to_teacher($user_id,$email_code)
	{
		global $db;
		$user_id 	= (int)sanitize($user_id);
		$email_code = sanitize($email_code);
		if($stmt = $db->prepare(" UPDATE `users` SET `faculty` = '1' WHERE `user_id` = ? AND `email_code` = ? "))
		{
			$stmt->bind_param('is',$user_id, $email_code);
			$stmt->execute();
		}
	}

	function user_id_email_code_first_name_combo($user_id,$first_name,$email_code)
	{
		global $db;
		$user_id 	= (int)sanitize($user_id);
		$first_name = sanitize($first_name);
		$email_code = sanitize($email_code);
		$query 		= "
						SELECT `user_id` FROM 
						`users` WHERE 
						`user_id` = '$user_id' AND 
						`first_name` = '$first_name' AND 
						`email_code` = '$email_code'
						";
		$result = $db->query($query);
		$count = $result->num_rows;
		return ($count == 1) ? true : false;
	}

	function reset_user_all_ip_combo_flag($user_id)
	{
		global $db;
		$user_id = (int)sanitize($user_id);
		$db->query("
						UPDATE `user_ip_combo` 
						SET `flag` = '1' 
						WHERE `user_id` = '$user_id'

					");
	}

	function insert_user_id_ip($user_id,$user_ip)
	{
		global $db;
		$user_id = (int)$user_id;
		$user_ip = sanitize($user_ip);
		if ($stmt = $db->prepare("INSERT INTO `user_ip_combo` (`user_id`,`user_ip`) VALUES (? ,?)")) {

		    $stmt->bind_param("is", $user_id,$user_ip);
		    $stmt->execute();
		    $stmt->close();
		}
	}

	function update_user_id_ip_combo_flag_to_zero($user_id,$user_ip)
	{
		global $db;
		$user_id = (int)$user_id;
		$user_ip = sanitize($user_ip);
		if($stmt = $db->prepare("UPDATE `user_ip_combo` SET `flag` = '0' WHERE `user_id` = ? AND `user_ip` = ?"))
		{
			$stmt->bind_param("is", $user_id,$user_ip);
		    $stmt->execute();
		    $stmt->close();
		}
	}

	function get_user_id_ip_combo_flag($user_id,$user_ip)
	{
		global $db;
		if($stmt = $db->prepare("SELECT `flag` FROM `user_ip_combo` WHERE `user_id` = ? AND `user_ip` = ?"))
		{
			$stmt->bind_param("is", $user_id,$user_ip);
			$stmt->execute();
			$stmt->store_result();
		    if(($stmt->num_rows) >= 1)
		    {
		    	$stmt->bind_result($flag);
		    	$stmt->fetch();
		    	return ($flag == 0) ? true : false;
		    	$stmt->close();

		    }
		}
		
	}

	function user_id_ip_combo_exists($user_id,$user_ip)
	{
		global $db;
		$user_id = (int)$user_id;
		$user_ip = sanitize($user_ip);
		if($stmt = $db->prepare("SELECT `id` FROM `user_ip_combo` WHERE `user_id` = ? AND `user_ip` = ?"))
		{
			$stmt->bind_param("is", $user_id,$user_ip);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
			$stmt->close();
		}
	}

	function is_faculty($user_id)
	{
		global $db;
		$user_id 	= (int)$user_id;
		if($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `user_id` = ? AND `faculty` = '1'"))
		{
			$stmt->bind_param('i',$user_id);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
			$stmt->close();

		}
	}

	function is_hod($user_id)
	{
		global $db;
		$user_id 	= (int)$user_id;
		if($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `user_id` = ? AND `faculty` = '1' AND `type` = 'hod'"))
		{
			$stmt->bind_param('i',$user_id);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
			$stmt->close();

		}

	}

	function can_access($user_id,$type)
	{
		global $db;
		$user_id 	= (int)$user_id;
		$type = sanitize($type);

		if($stmt = $db->prepare(" SELECT `user_id` FROM `users` WHERE `user_id` = ? AND `type` IN ($type)"))
		{
			$stmt->bind_param('i',$user_id);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
			$stmt->close();
		}
	}

	function has_access($user_id,$type)
	{
		global $db;
		$user_id 	= (int)$user_id;
		$type 		= sanitize($type);
		if($stmt = $db->prepare(" SELECT `user_id` FROM `users` WHERE `user_id` = ? AND `type` = (?)"))
		{
			$stmt->bind_param('is',$user_id,$type);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
			$stmt->close();
		}
	}

	function recover_username($email)
	{
		$email 		= sanitize($email);
		$user_id 	= user_id_from_email($email);

		$user_data 	= user_data($user_id,'first_name','username');
		
		email($email,"Your username","Hello ".$user_data['first_name'].",\n\n your username is ".$user_data['username']."\n\n~OnlineHIT ");
		

	}

	function update_user($update_data){
		global $db;
		$update = array();
		array_walk($update_data, 'array_sanitize');
		foreach ($update_data as $field => $data) {
			$update[] = "`" . $field . "` = '".$data."'"; 
		}

		if($stmt = $db->prepare("UPDATE `users` SET ".implode(",", $update)." WHERE `user_id` = ?"))
		{
			$stmt->bind_param('i',$_SESSION['user_id']);
			$stmt->execute();
			$stmt->close();
		}
	}

	function fill_users($update_data){
		global $db;
		$update = array();
		array_walk($update_data, 'array_sanitize');
		foreach ($update_data as $field => $data) {
			$update[] = "`" . $field . "` = '".$data."'"; 
		}
		if($stmt = $db->prepare("UPDATE `users` SET ".implode(",", $update)." WHERE `user_id` = ?"))
		{
			$stmt->bind_param('i',$_SESSION['user_id']);
			$stmt->execute();
			$stmt->close();
		}
		
	}

	function filled_details($user_id)
	{
		global $db;
		$user_id = (int)sanitize($user_id);
		if($stmt = $db->prepare("SELECT `details` FROM `users` WHERE `user_id` = ?"))
		{
			$stmt->bind_param('i',$user_id);
			$stmt->execute();
			$stmt->bind_result($details);
		    $stmt->fetch();
		    
		    return ($details == 1) ? true : false;
		}
	}

	function set_detail_equals_to_one($user_id)
	{
		global $db;
		$user_id = (int)sanitize($user_id);
		if($stmt = $db->prepare("UPDATE `users` SET `details` = '1' WHERE `user_id` = ?"))
		{
			$stmt->bind_param('i',$user_id);
			$stmt->execute();
		}
	}

	function fill_faculty_basic_detail($user_id,$department)
	{
		global $db;
		$user_id = (int)sanitize($user_id);
		$department = sanitize($department);
		if($stmt = $db->prepare("UPDATE `users` SET `department` = ? WHERE `user_id` = ?"))
		{
			$stmt->bind_param('si',$department,$user_id);
			$stmt->execute();
		}
	}

	function activate($email,$email_code)
	{
		global $db;
		$email 		= sanitize($email);
		$email_code = sanitize($email_code);

		

		if ($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `email` = ? AND `email_code` = ? AND `active` = 0"))
		{

		    $stmt->bind_param("ss", $email, $email_code);
		    $stmt->execute();
		    $stmt->store_result();
		    
		    if($stmt->num_rows == 1)
		    {
		    	if ($stmt = $db->prepare("UPDATE `users` SET `active` = 1 WHERE `email` = ? AND `email_code` = ?")) 
		    	{

				    $stmt->bind_param("ss", $email, $email_code);
				    $stmt->execute();
				    $stmt->close();
				    return true;
				}
				else
				{
					return false;
					$stmt->close();
				}

		    }
		    else
		    {
		    	return false;
		    }
		    $stmt->close();
		}

		return false;
	}

	function change_password($user_id,$password)
	{
		global $db;
		$user_id = (int)$user_id;
		$password = md5(sanitize(trim($password)));
		if ($stmt = $db->prepare("UPDATE `users` SET `password` = ? WHERE `user_id` = ?")) {

		    $stmt->bind_param("si", $password, $user_id);
		    $stmt->execute();
		    $stmt->close();
		    return true;
		}
		return false;

	}

	function register_user($register_data)
	{
		global $website;
		global $db;
		array_walk($register_data, 'array_sanitize');
		$register_data['password'] = md5($register_data['password']);
		$fields = '`'.implode("`, `", array_keys($register_data)).'`';
		$data = "'".implode("', '",$register_data)."'";
		$newcode 	= md5(substr($register_data['email_code'],5,10));

		$query = "INSERT INTO `users` (".$fields.") VALUES (".$data.")";

		if($db->query($query))
		{
			email($register_data['email'],'Activate your account', "Hello ".$register_data['first_name'].",\n\nYou need to activate your account, So use the below link:\n\n http://".$website."/activate.php?email=".$register_data['email'] ."&KoDEmLIYGFFhf356=".$register_data['email_code']."&nKpoDh=".$newcode."\n\n~OnlineHIT");
		}

		
	}

	function user_data($user_id)
	{
		global $db;
		$data = array();
		$user_id = (int)$user_id;

		$func_num_args = func_num_args();
		$func_get_args = func_get_args();

		if($func_num_args > 1){
			unset($func_get_args[0]);
			$fields 	= "`".implode("`, `", $func_get_args)."`";
			if($result 	= $db->query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"))
			{
				$data 		= $result->fetch_assoc();
				return $data;
				$result->free();
			}
			
		}
	}

	function email_from_user_id($user_id)
	{
		global $db;
		$user_id = (int)$user_id;

		if ($stmt = $db->prepare("SELECT `email` FROM `users` WHERE `user_id` = ?")) {

		    $stmt->bind_param("i", $user_id);
		    $stmt->execute();
		    $stmt->store_result();
		    if(($stmt->num_rows) == 1)
		    {
		    	$stmt->bind_result($email);
		    	$stmt->fetch();
		    	return $email;
		    }
		    else
		    {
		    	return false;
		    }
		    $stmt->close();
		}
	}

	function user_exists($username)
	{
		global $db;
		$username = sanitize($username);
		if($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `username` = ?"))
		{
			$stmt->bind_param('s',$username);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
		}
	}

	function email_username_combo_exists($username,$email)
	{
		global $db;
		$username = sanitize($username);
		$email = sanitize($email);
		if($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `username` = ? AND `email` = ? "))
		{
			$stmt->bind_param('ss',$username,$email);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
		}
		return false;
	}

	function roll_exists($roll)
	{
		global $db;
		$roll = sanitize($roll);
		if($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `uni_roll` = ? "))
		{
			$stmt->bind_param('s',$roll);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
		}
	}

	function email_exists($email)
	{
		global $db;
		$email = sanitize($email);
		if($stmt = $db->prepare(" SELECT `user_id` FROM `users` WHERE `email` = ? "))
		{
			$stmt->bind_param('s',$email);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
		}
		return false;
	}

	function user_active($username)
	{
		global $db;
		$username = sanitize($username);
		if($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `username` = ? AND `active` = '1'"))
		{
			$stmt->bind_param('s',$username);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
		}
		else
		{
			return false;
		}
	}

	function user_id_from_email_code($email_code)
	{
		global $db;
		$username = sanitize($email_code);

		if ($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `email_code` = ?")) {

		    $stmt->bind_param("s", $email_code);
		    $stmt->execute();
		    $stmt->store_result();
		    if($stmt->num_rows == 1)
		    {
		    	$stmt->bind_result($user_id);
		    	$stmt->fetch();
		    	return $user_id;
		    }
		    else
		    {
		    	return false;
		    }
		    $stmt->close();
		}
		return false;
	}

	function user_id_from_username($username)
	{
		global $db;
		$username = sanitize($username);

		if ($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `username` = ?")) {

		    $stmt->bind_param("s", $username);
		    $stmt->execute();
		    $stmt->store_result();
		    if($stmt->num_rows == 1)
		    {
		    	$stmt->bind_result($user_id);
		    	$stmt->fetch();
		    	return $user_id;
		    }
		    else
		    {
		    	return false;
		    }
		    $stmt->close();
		}
		return false;
	}

	function user_id_from_email($email)
	{
		
		$email = sanitize($email);
		global $db;
		if ($stmt = $db->prepare("SELECT `user_id` FROM `users` WHERE `email` = ?")) {

		    $stmt->bind_param("s", $email);
		    $stmt->execute();
		    $stmt->store_result();
		    if($stmt->num_rows == 1)
		    {
		    	$stmt->bind_result($user_id);
		   		$stmt->fetch();
		   		return $user_id;
		    }
		    else
		    {
		    	return false;
		    }
		    $stmt->close();
		}
	}

	function login($username,$password)
	{
		global $db;
		$user_id = user_id_from_username($username);
		$username = sanitize($username);
		$password = sanitize($password);
		$password = md5($password);

		if ($stmt = $db->prepare("SELECT `user_id` FROM
		 							`users` WHERE `username` = ? AND 
		 							`password` = ?")) {

		    $stmt->bind_param("ss", $username, $password);
		    $stmt->execute();
		    $stmt->store_result();
		    if($stmt->num_rows == 1)
		    {
		    	$stmt->bind_result($user_id);
		   		$stmt->fetch();
		   		return $user_id;
		    }
		    else
		    {
		    	return false;
		    }
		    $stmt->close();
		}
		else
		{
			return false;
		}
	}

	function logged_in(){
		return (isset($_SESSION['user_id'])) ? true : false;
	}

	function full_name_from_id($id)
	{
		global $db;
		$id = (int)sanitize($id);
		$user_data = user_data($id,'first_name','last_name');
		return $user_data['first_name']." ".$user_data['last_name'];

	}

	function email_code_user_id_combo_exists($user_id,$email_code)
	{
		global $db;
		$user_id = (int)sanitize($user_id);
		$email_code = sanitize($email_code);
		if($stmt = $db->prepare(" SELECT `user_id` FROM `users` WHERE `user_id` = ? AND `email_code` = ?"))
		{
			$stmt->bind_param('is',$user_id,$email_code);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
		}
	}
 ?>