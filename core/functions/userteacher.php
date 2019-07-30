<?php
	function faculty_email_mobile_combo($email,$mob)
	{
		$email = sanitize($email);
		$number = sanitize($mob);
		$query = mysql_query("
					SELECT COUNT(`id`) FROM 
					`faculty_detail_list` WHERE 
					`email` = '$email' AND `mobile` = '$number'
			");
		return ((mysql_result($query, 0)) == 1) ? true : false;

	}

	function filling_faculty_personal_data_details($user_id)
	{
		global $db;
		if($stmt = $db->prepare("SELECT `details_filled` FROM `teacher_personal_data` WHERE `user_id` = ?"))
		{
			$stmt->bind_param("i", $user_id);
			$stmt->execute();
			$stmt->store_result();
		    if(($stmt->num_rows) >= 1)
		    {
		    	$stmt->bind_result($details_filled);
		    	if($stmt->num_rows)
		    	{
		    		$stmt->fetch();
		    		return ($details_filled == 1) ? true : false;
		    	}
		    }
		}
	}

	function update_faculty_address($update_data){
		global $db;
		$update = array();
		array_walk($update_data, 'array_sanitize');
		foreach ($update_data as $field => $data) {
			$update[] = "`" . $field . "` = '".$data."'"; 
		}
		if($stmt = $db->prepare("UPDATE `teacher_personal_data` SET ".implode(",", $update)." WHERE `user_id` = ?"))
		{
			$stmt->bind_param('i',$_SESSION['user_id']);
			$stmt->execute();
			$stmt->close();
		}
	}

	function user_id_exists_in_teacher_personal_data_table($user_id)
	{
		global $db;
		$user_id = (int)$user_id;
		if($stmt = $db->prepare("SELECT `id` FROM `teacher_personal_data` WHERE `user_id` = ?"))
		{
			$stmt->bind_param("i", $user_id);
			$stmt->execute();
			$stmt->store_result();
			return ($stmt->num_rows == 1) ? true : false;
		}
	}

	function teacher_personal_data_id_from_user_id($user_id)
	{

		$user_id = (int)$user_id;
		global $db;
		if($stmt = $db->prepare("SELECT `id` FROM `teacher_personal_data` WHERE `user_id` = ?" ))
		{
			$stmt->bind_param('i',$user_id);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows == 1)
			{
				$stmt->bind_result($id);
				$stmt->fetch();
				return $id;
			}
		}
	}


	function fill_faculty_personal_details($faculty_personal_data)
	{
		global $db;
		array_walk($faculty_personal_data, 'array_sanitize');
		$fields = '`'.implode("`, `", array_keys($faculty_personal_data)).'`';
		$data = "'".implode("', '",$faculty_personal_data)."'";
		$db->query("INSERT INTO `teacher_personal_data` (".$fields.",`details_filled`,time) VALUES (".$data.",'1',CURRENT_TIMESTAMP)");
	}

	function update_faculty_post_data($update_data,$news_id)
	{
		global $db;
		$news_id = sanitize($news_id);
		foreach ($update_data as $field => $data) {
			$update[] = "`" . $field . "` = '".$data."'"; 
		}
		$db->query("UPDATE `teachers_post` SET ".implode(', ', $update). ", `updated` = CURRENT_TIMESTAMP , `created` = CURRENT_TIMESTAMP WHERE `id` = '$news_id'");
	}

	function delete_faculty_post($slug,$user_id)
	{
		$slug = sanitize($slug);
		global $db;
		$db->query("
						UPDATE `teachers_post` SET `hidden` = '1', 
						`deleted_by` = '$user_id', `deleted` = CURRENT_TIMESTAMP
						WHERE `slug` = '$slug'
					");
	}


	/*For grabing faculty personal data we are using user_id instead of id*/
	function faculty_personal_data($faculty_id)
	{
		$data 		= array();
		$faculty_id = (int)$faculty_id;

		$func_num_args = func_num_args();
		$func_get_args = func_get_args();

		if($func_num_args > 1){
			unset($func_get_args[0]);
			$fields = "`".implode("`, `", $func_get_args)."`";
			$data =  mysql_fetch_assoc(mysql_query("SELECT $fields FROM `teacher_personal_data` WHERE `user_id` = '$faculty_id'"));
		}
		return $data;
	}

	function faculty_address_detail($user_id)
	{
		$user_id = (int)sanitize($user_id);
		global $db;
		global $user_data;
		$query = "SELECT 
					teacher_personal_data.user_id,
					teacher_personal_data.office_address,
					teacher_personal_data.contact_number,
					teacher_personal_data.designation,
					users.first_name,
					users.last_name,
					users.email,
					users.email_code,
					users.department
					FROM teacher_personal_data INNER JOIN users ON 
					(teacher_personal_data.user_id = users.user_id
					AND users.faculty = 1 AND users.user_id = '$user_id')
					
					

		";

		if($result = $db->query($query))
		{
			$row = $result->fetch_object();
			return $row;
		}

		return false;
	}

	function department_faculty_list($department)
	{
		$department = sanitize($department);
		global $db;
		global $user_data;

		$query = "SELECT 
					teacher_personal_data.user_id,
					teacher_personal_data.office_address,
					teacher_personal_data.contact_number,
					teacher_personal_data.designation,
					users.first_name,
					users.last_name,
					users.email,
					users.email_code,
					users.department
					FROM teacher_personal_data INNER JOIN users ON 
					(teacher_personal_data.user_id = users.user_id
					AND users.faculty = 1 AND users.department = '$department')
					ORDER BY users.first_name
					LIMIT 40

		";

		if($result = $db->query($query))
		{
			

			if($result->num_rows)
			{
				while($row = $result->fetch_object())
				{
					
					?>
<div class="well">
	<ul class="well well-wb">

		<li>
			

			<span id="float_right"><a href="chat.php?UsPxDiMnjd=<?php echo $row->email_code; ?>&ApLUmnDk=23EpQZ<?php echo $row->user_id; ?>&SaltAPuId=<?php echo md5('2:6:4:95'.$row->user_id); ?>&ReceiverIDP=<?php echo md5('2:6::4:95'.$user_data['user_id']); ?>" class="btn btn-primary"><i class="fa fa-commenting-o"></i></a></span>
			<h3>

				<a href="fpw.php?facultyID=<?php echo substr(md5($row->user_id), 3,27); ?>">
					<span class="glyphicon glyphicon-user"></span>	
					<?php echo $row->first_name.' '.$row->last_name; ?>
				</a><br>

					<small>
						<span class="glyphicon glyphicon-paperclip"></span> 
						<?php echo $row->designation; ?>
					</small>
			</h3>

		</li>

		<li class="time-h" title="department">
			<span class="glyphicon glyphicon-flag well-blue"> </span> 
			<?php echo give_department_full_form($row->department); ?>
		</li>

		<li class="time-h" title="Office address">
			<span class="glyphicon glyphicon-road well-blue"></span> 
			<?php echo $row->office_address; ?>
		</li>

		<li class="time-h" title="Email-ID">
			<span class="glyphicon glyphicon-envelope well-blue"></span> 
			<?php echo $row->email; ?>
		</li>

		<li class="time-h" title="Contact number">
			<span class="glyphicon glyphicon-phone-alt well-blue"></span>
			<?php echo $row->contact_number; ?>
		</li>

	</ul>
</div>

					<?php
				}
			}
			else
			{
				?>
				<div class="alert alert-warning lead" >
					<i class="fa fa-frown-o" id='no_result_found' aria-hidden="true"></i>
						None of your faculty is our member yet. So, Please suggest them for connecting with us.
				</div>
				<?php
			}
		}		
	}

	

	function search_faculty_on_faculty_wall_page($name)
	{
		
		$name = sanitize($name);

		$query = mysql_query("
								SELECT `user_id`,`email_code`,`first_name`,`last_name`,`email`,`department` FROM
								`users` WHERE 
								`faculty` = 1 AND
								(`first_name` LIKE '%$name%' OR 
								`last_name` LIKE '%$name%' OR 
								`department` LIKE '%$name%' OR 
								`member` LIKE '%$name%') 
								ORDER BY `first_name` ASC
								 LIMIT 30

							");

		if(mysql_num_rows($query) == 0)
		{
			?><div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> Sorry, No result found.</div><?php
		}
		else
		{
			?><div class="alert alert-success lead" role='alert'>
				<span class="glyphicon glyphicon-hand-right"></span> 
				<?php echo $num = mysql_num_rows($query); 
						if($num == 1)
						{
							echo " result found";
						}
						else
						{
							echo " results found";
						}
				 ?>
			</div>
			<?php
			while(($row = mysql_fetch_assoc($query)) !== false)
			{
				get_faculty_list_for_facultywall_page(
						$row['user_id'],$row['first_name'],
						$row['last_name'],$row['email'],
						$row['email_code'],$row['department']

					);
			}
		}
	}



	function get_faculty_list_for_facultywall_page($id,$first_name,$last_name,$email,$email_code,$department)
	{
		global $user_data;
		$user_id = $id;
		$faculty_personal_data = faculty_personal_data($id,'id','user_id','department','office_address','contact_number','designation');
	
?>

<div class="well">
	<ul class="well well-wb">
		<li>
			<span id="float_right"><a href="chat.php?UsPxDiMnjd=<?php echo $email_code; ?>&ApLUmnDk=23EpQZ<?php echo $user_id; ?>&SaltAPuId=<?php echo md5('2:6:4:95'.$user_id); ?>&ReceiverIDP=<?php echo md5('2:6::4:95'.$user_data['user_id']); ?>" class="btn btn-primary"><i class="fa fa-commenting-o"></i></a></span>


			<h3>
				<a href="fpw.php?facultyID=<?php echo substr(md5($id), 3,27); ?>">
					<span class="glyphicon glyphicon-user"></span>	
					<?php echo $first_name.' '.$last_name; ?>
				</a><br>

					<small>
						<span class="glyphicon glyphicon-paperclip"></span> 
						<?php echo $faculty_personal_data['designation']; ?>
					</small>
			</h3>
		</li>

		<li class="time-h" title="department">
			<span class="glyphicon glyphicon-flag well-blue"> </span> 
			<?php echo give_department_full_form($department); ?>
		</li>

		<li class="time-h" title="Office address">
			<span class="glyphicon glyphicon-road well-blue"></span> 
			<?php echo $faculty_personal_data['office_address']; ?>
		</li>

		<li class="time-h" title="Email-ID">
			<span class="glyphicon glyphicon-envelope well-blue"></span> 
			<?php echo $email; ?>
		</li>

		<li class="time-h" title="Contact number">
			<span class="glyphicon glyphicon-phone-alt well-blue"></span>
			<?php echo $faculty_personal_data['contact_number']; ?>
		</li>

	</ul>
</div>


<?php
	}

	function teacher_post_list_on_fpw($pwid)
	{
		$pwid 			= sanitize($pwid);
		$query = mysql_query("
								SELECT `id` FROM 
								`teachers_post` WHERE 
								`posted_by` = '$faculty_id' AND 
								`hidden` = '0'
								ORDER BY 
								`created` DESC LIMIT 70

							");

		if(mysql_num_rows($query) == 0)
		{
			echo "No pages at this moment";
		}
		else
		{
			echo "<div class = 'well'>";
			while(($row = mysql_fetch_assoc($query)) !== false)
			{
				fpw_page_block($row['id']);
			}
			echo "</div>";
		}

	}

	function fpw_page_block($post_id)
	{
		$faculty_post_data = faculty_post_data($post_id,'posted_by','year','department','batch',
													'heading','title','body','slug',
													'created','generated','updated',
													'deleted','hidden','pwid');
		

?>

	<ul class="well well-wb">
		<li>
				<h3><a href="fpw.php?facultyID=<?php echo substr(md5($faculty_post_data['posted_by']), 3,27); ?>"><span class="glyphicon glyphicon-user"></span>
					<?php echo full_name_from_id($faculty_post_data['posted_by']); ?></a></h3>
			</li>

			<li class="time">
				<span title="Posted on <?php echo $faculty_post_data['generated']; ?>" class="glyphicon glyphicon-calendar"> <?php 
				echo $faculty_post_data['generated']; ?> </span><br>

				<?php 
					if($faculty_post_data['updated'] !== NULL)
					{
						?>
					<span title="Updated on <?php echo $faculty_post_data['updated']; ?>" class="glyphicon glyphicon-refresh"> <?php 
							echo $faculty_post_data['updated']; ?> </span>

						<?php
					}
				 ?>
				

				
				
			</li>


			<li class="time">
				<span title class="glyphicon glyphicon-tags">
					Year: <?php if($faculty_post_data['year'] == 9){
								echo "All students";
							}
							else{
								echo $faculty_post_data['year'];
							}

							?>,
					Dept: <?php echo strtoupper($faculty_post_data['department']); ?>,
					Batch: <?php if($faculty_post_data['batch'] == 9){
								echo 'Both batches';
							} 
							else
							{
								echo $faculty_post_data['batch'];
							} 


							?>
				</span>
			</li>
			<li>
				<h3><a href="vfpb.php?postid=<?php echo strtoupper($faculty_post_data['slug']); ?>">
					<span class="glyphicon glyphicon-globe"></span>
					<?php echo $faculty_post_data['heading']; ?> 
					<br><br>
					<span class="glyphicon glyphicon-envelope"></span></a>

					<small class="indent">
						<?php echo $faculty_post_data['title']; ?> 
					</small>
				</h3>
			</li>
	</ul>	


<?php
	}

	function faculty_post_list_from_fpwid($pwid,$first_name,$last_name)
	{
		global $user_data;
		global $db;
		$pwid = sanitize($pwid);


		$query = "
						SELECT * FROM 
						`teachers_post` WHERE 
						`pwid` = '$pwid' AND 
						`hidden` = '0'
						ORDER BY 
						`created` DESC LIMIT 70

				";
		if($result = $db->query($query))
		{
			$count = $result->num_rows;
			if($count == 0)
			{
				?>
				<div class="alert alert-warning lead">
					<b><span class="fa fa-frown-o" id='no_result_found'></span> Sorry, No page at this moment.</b>
				</div>
				<?php
			}
			else
			{
				while($row = $result->fetch_object())
				{
					?>
				
				<ul class="well well-wb">
					<li>
						<h3><a href="fpw.php?facultyID=<?php echo substr(md5($faculty_id),3,27); ?>"><span class="glyphicon glyphicon-user"></span>
							<?php echo $first_name.' '.$last_name; ?></a></h3>
					</li>

					<li class="time">
						<span title="Posted on : <?php echo $row->generated; ?>" class="glyphicon glyphicon-calendar"> <?php 
						echo $row->generated; ?> </span><br>

						<?php 
							if($row->updated !== NULL)
							{
								?>
							<span title="Updated on <?php echo $row->updated; ?>" class="glyphicon glyphicon-refresh"> <?php 
									echo $row->updated; ?> </span>

								<?php
							}
						 ?>
					</li>

					<li class="time">
						<span title class="glyphicon glyphicon-tags">
							Year: <?php if($row->year == 9){
										echo "All students";
									}
									else{
										echo $row->year;
									}

									?>,
							Dept: <?php echo strtoupper($row->department); ?>,
							Batch: <?php if($row->batch == 9){
										echo 'Both batches';
									} 
									else
									{
										echo $row->batch;
									} 


									?>
						</span>
					</li>

					<li>
						<h3><a href="vfpb.php?postid=<?php echo strtoupper($row->slug); ?>">
							<span class="glyphicon glyphicon-globe"></span>
							<?php echo $row->heading; ?> 
							<br><br>
							<span class="glyphicon glyphicon-envelope"></span></a>

							<small class="indent">
								<?php echo $row->title; ?> 
							</small>
						</h3>
					</li>
				</ul>
				


					<?php
				}
			}
		}

	}

	function faculty_id_from_pwid($pwid)
	{
		return mysql_result(mysql_query("SELECT `posted_by` FROM `teachers_post` WHERE `pwid` = '$pwid'"),0);
	}

	function pwid_exists($pwid)
	{
		global $db;
		$pwid = sanitize($pwid);
		if($stmt = $db->prepare("SELECT `posted_by` FROM `teachers_post` WHERE `pwid` = ? "))
		{
			$stmt->bind_param('s',$pwid);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) >= 1) ? true : false;
		}
	}

	function faculty_post_slug_exists($slug)
	{	
		global $db;
		$slug = sanitize($slug);
		if($stmt = $db->prepare("SELECT `id` FROM `teachers_post` WHERE `slug` = ?"))
		{
			$stmt->bind_param('s',$slug);
			$stmt->execute();
			$stmt->store_result();
			return (($stmt->num_rows) == 1) ? true : false;
		}

	}

	function faculty_post_id_from_slug($slug)
	{
		global $db;
		$slug = sanitize($slug);
		if($stmt = $db->prepare("SELECT `id` FROM `teachers_post` WHERE `slug` = ?"))
		{
			$stmt->bind_param('s',$slug);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows == 1)
			{
				$stmt->bind_result($id);
				$stmt->fetch();
				return $id;
			}
			
		}
	}

	/*function user_home_wall_news_list()
	{
		global $user_data;
		$year = sanitize($user_data['year']);
		$department = sanitize($user_data['department']);
		$batch = sanitize($user_data['batch']);
		
		$query = mysql_query("
					SELECT `id`,`posted_by` FROM 
					`teachers_post` WHERE 
					`year` IN ('".$year."','9') AND 
					`department` IN ('".$department."','all','every') AND
					`batch` IN ('".$batch."','9') AND 
					`hidden` = '0'
					ORDER BY `created` DESC LIMIT 60
				");
		if(mysql_num_rows($query) == 0)
		{
			echo "No results Found";
		}
		else
		{
			while(($row = mysql_fetch_assoc($query)) !== false)
			{
				user_home_wall_news_list_block($row['id'],$row['posted_by']);
			}
		}
	}*/

	function user_home_wall_news_list()
	{
		global $user_data;
		global $db;
		$year = sanitize($user_data['year']);
		$department = sanitize($user_data['department']);
		$batch = sanitize($user_data['batch']);

		if($result = $db->query("
					SELECT `id`,`posted_by`,`year`,`department`,`batch`,`heading`,
					`title`,`body`,`slug`,`created`,`generated`,`updated`,`pwid`
					 FROM 
					`teachers_post` WHERE 
					`year` IN ('".$year."','9') AND 
					`department` IN ('".$department."','all','every') AND
					`batch` IN ('".$batch."','9') AND 
					`hidden` = '0'
					ORDER BY `created` DESC LIMIT 60
				"))
		{
			if($result->num_rows)
			{
				while($faculty_post_data = $result->fetch_object())
				{
					?>

	<div class="well">
		<ul class="well well-wb">
			<li>
				<h3><a href="fpw.php?facultyID=<?php echo substr(md5($faculty_post_data->posted_by), 3,27); ?>"><span class="glyphicon glyphicon-user"></span>
					<?php echo full_name_from_id($faculty_post_data->posted_by); ?></a></h3>
			</li>

			<li class="time"  title="Posted on <?php echo $faculty_post_data->generated; ?>">
				<span class="fa fa-calendar-check-o"> </span> <?php 
				echo $faculty_post_data->generated; ?> <br>
				
				
			</li>

			<?php 
				if($faculty_post_data->updated !== NULL)
				{
					?>
						<li class="time"  title="Updated on <?php echo $faculty_post_data->updated; ?>">
							<span title="Posted on <?php echo $faculty_post_data->updated; ?>" class="fa fa-refresh fa-spin fa-1x fa-fw"> </span> <?php echo $faculty_post_data->updated; ?> <br>
						</li>
					<?php
				}
			 ?>

			


			<li class="time" title="Tagged for: <?php echo strtoupper($faculty_post_data->department); ?>">
				<span class="fa fa-tags"> |</span>
				<?php 
					if($faculty_post_data->year == 9)
					{
						echo " All students of ".strtoupper($faculty_post_data->department);
					}
					else
					{
						?>
							Year: <?php echo $faculty_post_data->year; ?>,
							<?php echo strtoupper($faculty_post_data->department); ?>,
							<?php 
								if($faculty_post_data->batch == 9)
								{
									echo "Both batches";
								}
								else
								{
									echo 'Batch: '.$faculty_post_data->batch;
								}
							 ?>

						<?php
					}
				 ?>
				
			</li>
			<li>
				<h3><a href="vfpb.php?postid=<?php echo strtoupper($faculty_post_data->slug); ?>">
					<span class="glyphicon glyphicon-globe"></span>
					<?php echo $faculty_post_data->heading; ?> 
					<br><br>
					<span class="glyphicon glyphicon-envelope"></span></a>

					<small class="indent">
						<?php echo $faculty_post_data->title; ?> 
					</small>
				</h3>
			</li>
		</ul>
	</div>


					<?php

				}
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
						    <p class="card-text time-h"> This time we are having no post for you. <br> As soon as your faculties will post any thing for you we will show you here.</p>
						    
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

	function faculty_home_wall_news_list()
	{
		global $user_data;
		global $db;
		$year = sanitize($user_data['year']);
		$department = sanitize($user_data['department']);
		$batch = sanitize($user_data['batch']);

		if($result = $db->query("
					SELECT `id`,`posted_by`,`year`,`department`,`batch`,`heading`,
					`title`,`body`,`slug`,`created`,`generated`,`updated`,`pwid`
					 FROM 
					`teachers_post` WHERE  
					`department` IN ('".$department."','all','every') AND 
					`hidden` = '0'
					ORDER BY `created` DESC LIMIT 60
				"))
		{
			if($result->num_rows)
			{
				while($faculty_post_data = $result->fetch_object())
				{
					?>

	<div class="well">
		<ul class="well well-wb">
			<li>
				<h3><a href="fpw.php?facultyID=<?php echo substr(md5($faculty_post_data->posted_by), 3,27); ?>"><span class="glyphicon glyphicon-user"></span>
					<?php echo full_name_from_id($faculty_post_data->posted_by); ?></a></h3>
			</li>

			<li class="time"  title="Posted on <?php echo $faculty_post_data->generated; ?>">
				<span class="fa fa-calendar-check-o"> </span> <?php 
				echo $faculty_post_data->generated; ?> <br>
				
				
			</li>

			<?php 
				if($faculty_post_data->updated !== NULL)
				{
					?>
						<li class="time"  title="Updated on <?php echo $faculty_post_data->updated; ?>">
							<span title="Posted on <?php echo $faculty_post_data->updated; ?>" class="fa fa-refresh fa-spin fa-1x fa-fw"> </span> <?php echo $faculty_post_data->updated; ?> <br>
						</li>
					<?php
				}
			 ?>

			


			<li class="time" title="Tagged for: <?php echo strtoupper($faculty_post_data->department); ?>">
				<span class="fa fa-tags"> |</span>
				<?php 
					if($faculty_post_data->year == 9)
					{
						echo " All students of ".strtoupper($faculty_post_data->department);
					}
					else
					{
						?>
							Year: <?php echo $faculty_post_data->year; ?>,
							<?php echo strtoupper($faculty_post_data->department); ?>,
							<?php 
								if($faculty_post_data->batch == 9)
								{
									echo "Both batches";
								}
								else
								{
									echo 'Batch: '.$faculty_post_data->batch;
								}
							 ?>

						<?php
					}
				 ?>
				
			</li>
			<li>
				<h3><a href="vfpb.php?postid=<?php echo strtoupper($faculty_post_data->slug); ?>">
					<span class="glyphicon glyphicon-globe"></span>
					<?php echo $faculty_post_data->heading; ?> 
					<br><br>
					<span class="glyphicon glyphicon-envelope"></span></a>

					<small class="indent">
						<?php echo $faculty_post_data->title; ?> 
					</small>
				</h3>
			</li>
		</ul>
	</div>


					<?php

				}
			}
			else
			{
				echo "No Post at this moment";
			}
		}
	}

 ?>
