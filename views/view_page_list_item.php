<tr>
	<!-- <td>
		<?php echo $news_id; ?>
	</td> -->
	<td>

	<a href="viewpage.php?slug=<?php echo $club_news_data['slug']; ?>"><?php echo $club_news_data['heading']; ?></a>
	<br><br>
	<span class="time">
		<span title="created on: <?php echo $club_news_data['generated']; ?>">
			<i class="fa fa-calendar"> </i> <?php echo $club_news_data['generated']; ?> <br>
		</span>

		<span title="Posted By: <?php echo full_name_from_id($club_news_data['posted_by']); ?> ">
			<i class="fa fa-user"> </i> <?php echo full_name_from_id($club_news_data['posted_by']); ?>
		</span>
		
		
	</span>
	</td>
	<td><?php echo $club_news_data['title']; ?>
	<br><br>
		<?php 
			if($club_news_data['updated'] !== NULL)
			{
				?>
					<span class="time" title="Updated on: <?php echo $club_news_data['updated']; ?>">
						<i class="fa fa-refresh"></i> <?php echo $club_news_data['updated']; ?>
					</span>
					<br>
					<span class="time" title='Updated By: <?php echo full_name_from_id($club_news_data['updated_by']); ?>'>
						<i class="fa fa-user"></i> <?php echo full_name_from_id($club_news_data['updated_by']); ?>
					</span>
				<?php
			}
		 ?>
		
	</td>
	<td>
		<!-- <a href="viewpage.php?slug=<?php echo $club_news_data['slug']; ?>".>Go</a><br> -->
		
		<a href="editclubnewspage.php?id=<?php echo md5($user_data['user_id']);?>&slug=<?php 
			echo $club_news_data['slug']?>">
			<span title ="Edit" class="alert alert-success glyphicon glyphicon-edit" aria-hidden="true"></span></a>

		<a href="deleteclubnews.php?id=<?php echo md5($user_data['username']); ?>&slug=<?php echo $club_news_data['slug']; ?>"> 
		<span title="Delete" class="alert alert-danger glyphicon glyphicon-trash" aria-hidden="true"></span></a> 

	</td>
</tr>