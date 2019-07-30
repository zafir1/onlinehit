<?php
	function delete_club_news_page($slug,$update_data)
	{
		global $db;
		$slug 	= sanitize($slug);
		if(slug_exists($slug) === true)
		{
			$id 	= club_news_id_from_slug($slug);

			$update = array();
			foreach ($update_data as $field => $data) {
				$update[] = "`" . $field . "` = ".$data.""; 
			}

			$query = "UPDATE `club_news` SET ".implode(",", $update)." WHERE `id` = ".$id."";
			$db->query($query);
		}
		
	}

	function update_club_news_table($update_data,$news_id,$slug){
		global $user_data;
		global $db;
		$update = array();
		
		foreach ($update_data as $field => $data) {
			$update[] = "`" . $field . "` = '".$data."'"; 
		}

		$query = "UPDATE `club_news` SET ".implode(",", $update).",`updated` = CURRENT_TIMESTAMP,`updated_by`= ".$user_data['user_id']."
		
		 WHERE `id` = '".$news_id."'";
		$db->query($query);
		/* Check here to deprecate the updating functionality */
		header("Location: viewpage.php?slug=$slug");
		exit();

	}

	function add_page_in_club_news_table($heading,$title,$body)
	{
		global $user_data;
		global $db;
		$heading = sanitize($heading);
		$title = sanitize($title);
		$slug = md5(microtime()+time());
		$query = "INSERT INTO 
					`club_news` 
					(`id`, `posted_by`, `group_name`,
					 `heading`, `title`,`body`, `slug`,
					  `created`,`generated`, `updated`, `hidden`) 
					 VALUES 
					 (NULL, '".$user_data['user_id']."', '".$user_data['member']."', 
					 '".$heading."', '".$title."', '".$body."', 
					 '".$slug."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, '0') ";

			$db->query($query);
		
	}


	function view_page_list($group)
	{
		global $db;
		global $user_data;
		$group = sanitize($group);
		$query = "SELECT `id`,`posted_by`,`group_name`,`heading`,`title`,`body`,`slug`,`generated`,`created`,`updated`,`updated_by`  FROM `club_news` WHERE `hidden` = 0 AND `group_name` = '$group' ORDER BY `created` DESC LIMIT 50";
		if($result = $db->query($query))
		{	
			if(($result->num_rows) == 0)
			{
				echo "No page at this moment.";
			}
			else
			{
				?>
				<div class="well">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Heading</th>
								<th>Title</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
				<?php

					while($row = $result->fetch_object())
					{
						$generator = full_name_from_id($row->posted_by);
?>
<tr>
	<td>
	<span class="fa fa-hand-o-right well-blue"></span>
	<a href="viewpage.php?slug=<?php echo $row->slug; ?>"><b><?php echo $row->heading; ?></b></a>
	<br><br>
	<span class="time">
		<span title="created on: <?php echo $row->generated; ?>">
			<i class="fa fa-calendar"> </i> <?php echo $row->generated; ?> <br>
		</span>

		<span title="Posted By: <?php echo $generator; ?> ">
			<i class="fa fa-user"> </i> <?php echo $generator; ?>
		</span>
		
		
	</span>
	</td>
	<td>
	<span class="fa fa-hand-o-right well-blue"></span>
	<?php echo $row->title; ?>
	<br><br>
		<?php 
			if($row->updated !== NULL)
			{
				$updater = full_name_from_id($row->updated_by);
				
				?>
					<span class="time" title="Updated on: <?php echo $row->updated; ?>">
						<i class="fa fa-refresh"></i> <?php echo $row->updated;
						 ?>
					</span>
					<br>
					<span class="time" title='Updated By: <?php echo $updater; ?>'>
						<i class="fa fa-user"></i> <?php echo $updater; ?>
					</span>
				<?php
			}
		 ?>
		
	</td>
	<td>
		<a href="editclubnewspage.php?id=<?php echo md5($user_data['user_id']);?>&slug=<?php 
			echo $row->slug; ?>">
			<span title ="Edit" class="alert alert-success glyphicon glyphicon-edit" aria-hidden="true"></span></a>

		<a href="deleteclubnews.php?id=<?php echo md5($user_data['username']); ?>&slug=<?php echo $row->slug; ?>"> 
		<span title="Delete" class="alert alert-danger glyphicon glyphicon-trash" aria-hidden="true"></span></a> 

	</td>
</tr>
<?php
					}

				?>
					</tbody>
				</table>
					</div>

				<?php
			}
		}
	}

	/*function view_page_list_item($news_id){
		$club_news_data = club_news_data($news_id,'id','posted_by','group_name','heading','title','body','slug','generated','created','updated','updated_by');
		global $user_data;
		include "views/view_page_list_item.php";
	}*/

	function slug_exists($slug)
	{
		global $db;
		$slug = sanitize($slug);
		if($stmt = $db->prepare("SELECT `id` FROM `club_news` WHERE `hidden` = 0 AND `slug` = ? "))
		{
			$stmt->bind_param('s',$slug);
			$stmt->execute();
			$stmt->store_result();
			return ($stmt->num_rows == 1) ? true : false;
		}
		/*$query = mysql_query("SELECT COUNT(`id`) FROM `club_news` WHERE `slug` = '$slug' AND `hidden` = 0");
		return (mysql_result($query, 0) == 1)? true : false;*/
	}

	function club_news_id_from_slug($slug)
	{
		global $db;
		$slug = sanitize($slug);
		if($query = $db->prepare("SELECT `id` FROM `club_news` WHERE `slug` = ?"))
		{
			$query->bind_param('s',$slug);
			$query->execute();
			$query->store_result();
			if($query->num_rows)
			{
				$query->bind_result($id);
				$query->fetch();
				return $id;
			}
			else
			{
				return false;
			}
		}

		/*$query = "SELECT `id` FROM `club_news` WHERE `slug` = '$slug'";
		return mysql_result(mysql_query($query), 0, "id");*/
	}

	function find_pages($group)
	{
		global $db;
		$group = sanitize($group);
		if($result = $db->query("SELECT * FROM `club_news` WHERE `hidden` = 0 AND `group_name` = '$group' ORDER BY `created` DESC LIMIT 50"))
		{
			while($row = $result->fetch_object())
			{
				?>
			<div class="well">
				<div class="well well-wb">
					<h3><a href="<?php echo $row->group_name.'.php'; ?>">
						<span class="fa fa-users" aria-hidden="true"></span> <?php echo strtoupper($row->group_name); ?></a>
					</h3>
					<ul>
						<li title="Posted on" class="time">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
							<?php echo $row->generated; ?>
						</li>

						<?php 
							if($row->updated !== NULL)
							{
								?>
						<li class="time"  title="Updated on">
							<span class="fa fa-refresh" aria-hidden="true"></span> <?php echo $row->updated; ?>
						</li>

								<?php
							}
						 ?>

						

						<li>
							<h3><a href="viewpage.php?slug=<?php echo $row->slug; ?>">
								<span class="glyphicon glyphicon-globe"></span> 
									<?php echo $row->heading; ?> 
								</a>
								<br>
								
								<small>
								<span class="glyphicon glyphicon-envelope well-blue"></span> 
									<?php echo $row->title; ?>
								</small>
							</h3>
						</li>
					</ul>
					
				</div>	
			</div>

				<?php
			}
		}
	}


	function club_news_data($news_id)
	{
		global $db;
		$data = array();
		$news_id = (int)$news_id;
		
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();
		
		if($func_get_args > 1)
		{
			unset($func_get_args[0]);
			$fields = "`".implode('`,`', $func_get_args)."`";
			if($result 	= $db->query("SELECT $fields FROM `club_news` WHERE `id` = $news_id"))
			{
				$data 		= $result->fetch_assoc();
				return $data;
				$result->free();
			}
		}
		
	}

	/*function club_news_block_heading_list($news_id)
	{
		$club_news_data = club_news_data($news_id,'posted_by','group_name','heading','title','slug','updated','generated');
		?>
			<div class="well">
				<div class="well well-wb">
					<h2><a href="<?php echo $club_news_data['group_name'].'.php'; ?>">
						<span class="fa fa-users" aria-hidden="true"></span><?php echo strtoupper($club_news_data['group_name']); ?></a>
					</h2>
					<ul>
						<li title="Posted on" class="time">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
							<?php echo $club_news_data['generated']; ?>
						</li>

						<?php 
							if($club_news_data['updated'] !== NULL)
							{
								?>
						<li class="time"  title="Updated on">
							<span class="fa fa-refresh" aria-hidden="true"></span> <?php echo $club_news_data['updated']; ?>
						</li>

								<?php
							}
						 ?>

						

						<li>
							<h2><a href="viewpage.php?slug=<?php echo $club_news_data['slug']; ?>">
								<span class="glyphicon glyphicon-globe"></span> 
									<?php echo $club_news_data['heading']; ?> 
								</a>
								<br>
								
								<small>
								<span class="glyphicon glyphicon-envelope well-blue"></span> 
									<?php echo $club_news_data['title']; ?>
								</small>
							</h2>
						</li>
					</ul>
					
				</div>	
			</div>


		<?php
		
	}*/


	function club_news_block($news_id)
	{
		global $db;
		$news_id = (int)sanitize($news_id);
		$query = "SELECT `posted_by`,`group_name`,`heading`,`title`,`body`,`slug`,`created`,`updated`,`hidden`,`generated` FROM `club_news` WHERE `id` = '$news_id'";
		$result = $db->query($query);
		$club_news_data = $result->fetch_object();
		?>

		<div class="well">
			<div class="well well-wb">
				
					<a href="<?php echo $club_news_data->group_name.'.php'; ?>">
						<h2><i class="fa fa-users" aria-hidden="true"></i> 
						<?php echo strtoupper($club_news_data->group_name); ?> 
						</h2>
					</a>

				<ul>
					<li class="time" title="Posted on ">
						<i class="fa fa-calendar" aria-hidden="true"></i> 
						<?php echo $club_news_data->generated; ?>
					</li>

					<?php 
						if($club_news_data->updated !== NULL)
						{
							?>
							<li class="time" title="Updated on ">
								<i class="fa fa-refresh" aria-hidden="true"></i> 
								<?php echo $club_news_data->updated; ?>
							</li>
							<?php
						}
					 ?>
				</ul>	

			</div>

				<h3>
					<a href="">
						<span class="glyphicon glyphicon-globe"></span>
						<?php echo $club_news_data->heading; ?> 
					</a>

					 <br><br>
					<span class="glyphicon glyphicon-hand-right well-blue"></span>
					<small> <?php echo $club_news_data->title; ?></small>
				</h3>

			<div class="well well-wb">
				<?php echo $club_news_data->body; ?>
			</div>
			
		</div>


		<?php
	}

	function make_club_card($name,$title,$office,$head,$email,$contact)
	{
					?>

		<div class="well">
			<div class="well well-wb">
				<h2><a href="iete.php"><span class="fa fa-users" aria-hidden="true"></span> <?php echo $name; ?> </a><br>
					<small>
					<span class="fa fa-flag-checkered well-blue" aria-hidden="true"></span>
						<?php echo $title; ?>
					</small>
				</h2>
				<ul>
					<li class="time-h" title='Office address'>
						<span class="fa fa-building-o well-blue" aria-hidden="true"></span> 
							<?php echo $office; ?>
					</li>

					<li class="time-h" title="Head of the organisation">
						<span class="fa fa-user-o well-blue" aria-hidden="true"></span> 
							<?php echo $head; ?>
					</li>

					<li class="time-h" title="Email: <?php echo $email; ?>">
						<span class="fa fa-envelope-o well-blue" aria-hidden="true"></span> 
							<?php echo $email; ?>
					</li>

					<li class="time-h" title="Contact no: <?php echo $contact; ?>">
						<span class="fa fa-phone well-blue" aria-hidden="true"></span> 
							<?php echo $contact; ?>
					</li>
				</ul>
			</div>
		</div>

		<?php
	}


 ?>