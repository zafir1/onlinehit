<?php 
	function search_books($search)
	{
		global $db;
		$search  = mysqli_real_escape_string($db,$search);
		/*echo $search;
		die();*/
		$search  = sanitize($search);

		$query = "SELECT  `book_id`,`book_name`,`author`,`subject_code`,`publisher`,`semester` ,`department`, `quantity`, `total_rating`, `raters`, `avg_rating`, `shelf_number`, `rack_number` FROM `book_list` WHERE `book_name` LIKE '%".$search."%' OR `author` LIKE '%".$search."%' OR `subject_code` LIKE '%".$search."%' OR `publisher` LIKE '%".$search."%' ORDER BY `book_name` ASC LIMIT 60";
		if($result = $db->query($query))
		{
			$count = $result->num_rows;
			if($count == 0)
			{
				?>
				<div class="alert alert-warning lead">
					<b><span class="fa fa-frown-o" id='no_result_found'></span> Sorry, No results Found.</b>
				</div>

			<?php
			}
			else
			{
				?>
				<!-- <div class="alert alert-success">
					<b class="lead"> <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> <?php echo $count; ?> results found for <?php echo" '". $search."' "; ?></b>
				</div> -->

				<div class="well">
					<div class="well well-blue well-wb">
						<b class="lead"> <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> <?php echo $count; ?> results found for <?php echo" '". $search."' "; ?></b>
					</div>
					
				</div>

				<?php



				while($row = $result->fetch_object())
				{
					?>
				<div class="well">
				  <h3 class="well-blue">
				  <span class="glyphicon glyphicon-book" aria-hidden="true"></span> <?php echo $row->book_name; ?>
				  </h3>
				  <br>
				  <table class="table table-striped table-bordered">
				    <tr>
				      <th class="well-blue">Author</th>
				      <td><?php  echo $row->author; ?></td>
				    </tr>
				    <?php 
				    	if(empty($row->subject) === false)
				    	{
				    		?>
				    <tr>
				      <th class="well-blue">Subject</th>
				      <td><?php echo $row->subject; ?></td>
				    </tr>
				    		<?php
				    	}
				     ?>

				     <?php 
				    	if(empty($row->subject_code) === false)
				    	{
				    		?>
				    <tr>
				      <th class="well-blue">Subject Code</th>
				      <td><?php echo $row->subject_code; ?></td>
				    </tr>
				    		<?php
				    	}
				     ?>

				     <?php 
				    	if(empty($row->publisher) === false)
				    	{
				    		?>
				    <tr>
				      <th class="well-blue">Publisher</th>
				      <td><?php echo $row->publisher; ?></td>
				    </tr>
				    		<?php
				    	}
				     ?>
				    
				    
				    <tr>
				      <th class="well-blue">Average Rating</th>
				      <td><?php echo $row->avg_rating; ?></td>
				    </tr>

				    <tr>
				      <th class="well-blue">Shelf number</th>
				      <td><b><?php echo $row->shelf_number; ?>/ <?php echo $row->rack_number; ?></b></td>
				    </tr>

				  </table>
				</div>

					<?php
				}
			}
		}

	}

	function total_titles_of_boosks()
	{
		global $db;
		if($stmt = $db->prepare("SELECT  COUNT(`book_id`) FROM `book_list`"))
		{
			$stmt->execute();
			$stmt->store_result();
		    if(($stmt->num_rows) >= 1)
		    {
		    	$stmt->bind_result($count);
		    	$stmt->fetch();
		    	return $count;
		    	$stmt->close();

		    }
		}
	}


?>
