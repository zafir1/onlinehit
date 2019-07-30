<?php 
	

	function echo_faculty_post_list($faculty_id)
	{

		$faculty_id = (int)sanitize($faculty_id);
		$query = "SELECT `id` FROM `teachers_post` WHERE `posted_by` = $faculty_id AND `hidden` = 0 ORDER BY `created` DESC LIMIT 60";
		$query = mysql_query($query);
		while (($row = mysql_fetch_assoc($query)) !== false )
		{
			faculty_post_list_block($row['id']);	
		}
	}
	
	function faculty_post_list_block($id)
	{
		$faculty_post_data = faculty_post_data($id,'posted_by','year',
			'department','batch','heading','title','body','slug',
				'created','generated', 'updated');
?>
	
	<tr>
		
		<td>
		<a href="vfpb.php?postid=<?php echo $faculty_post_data['slug']?>">
			<?php echo $faculty_post_data['heading'] ?>
		</a>
		<br><br>
			<small class="time">
				<b>Year</b>: <?php 
							if($faculty_post_data['year'] == 9)
							{
								echo 'All students.';
							}
							else
							{
								echo $faculty_post_data['year'];
							}
				 ?><br>
				<b>Dept</b>: <?php echo $faculty_post_data['department']; ?> <br>
			</small>
		</td>

		<td>
			
			<?php echo $faculty_post_data['title']; ?>
			<br><br>

			<small class="time">
				<span title="created on: <?php echo $faculty_post_data['generated']; ?>" class="glyphicon glyphicon-calendar">
				 </span> <?php echo $faculty_post_data['generated']; ?><br>

				 <?php 
				 	if($faculty_post_data['updated'] !== NULL)
				 	{
				 		?>
							<span title="updated on: <?php echo $faculty_post_data['updated']; ?>" class="glyphicon glyphicon-refresh"> 
								
							</span> <?php echo $faculty_post_data['updated']; ?>
				 		<?php
				 	}
				  ?>
				
			</small>
			
		</td>

		<td>
			<a href="facultypostedit.php?facultyID=<?php echo substr(md5($faculty_post_data['posted_by']),5,18); ?>&postID=<?php echo $faculty_post_data['slug']; ?>">
			<span title ="Edit" class="alert alert-success glyphicon glyphicon-edit" aria-hidden="true"></span>
			</a>


			<a href="facultypostdelete.php?facultyID=<?php echo substr(md5($faculty_post_data['posted_by']),5,18); ?>&postID=<?php echo $faculty_post_data['slug']; ?>">
			<span title ="Edit" class="alert alert-danger glyphicon glyphicon-trash" aria-hidden="true"></span><br>
			</a>


			<b title="Posted for batch: <?php echo $faculty_post_data['batch']; ?>" class="time">B: <?php 
				if($faculty_post_data['batch'] == 9)
				{
					echo 'Both batches';
				}
				else
				{
					echo $faculty_post_data['batch'];
				}
			 ?></b>	
		</td>
	</tr>
		

<?php

	}

	function add_faculty_post($register_data)
	{
		$fields = '`'.implode("`, `", array_keys($register_data)).'`,`created`,`generated`';
		$data = "'".implode("', '",$register_data)."',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP";
		mysql_query("INSERT INTO `teachers_post` (".$fields.") VALUES (".$data.")  ");
	}
	
	function faculty_post_data($post_id)
	{
		$data = array();
		$post_id = (int)$post_id;
		
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();
		
		if($func_get_args > 1)
		{
			unset($func_get_args[0]);
			$fields = "`".implode('`,`', $func_get_args)."`";
			$query = "SELECT ".$fields. " FROM `teachers_post` WHERE `id` = ".$post_id;
			$data = mysql_fetch_assoc(mysql_query($query));
			return $data;
		}
		
	}

	/*$faculty_post_data = faculty_post_data($id,'posted_by','year','department','batch',
	'heading','title','body','slug','created','generated','deleted','hidden');*/
	function count_teachers_post()
	{
		return mysql_result(mysql_query("SELECT COUNT(`id`) FROM `teachers_post`"), 0);
	}

 ?>