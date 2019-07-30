<div class="well">
	<div class="well well-wb">
		
			<a href="<?php echo $club_news_data['group_name'].'.php'; ?>">
				<h2><i class="fa fa-users" aria-hidden="true"></i> 
				<?php echo strtoupper($club_news_data['group_name']); ?> 
				</h2>
			</a>

		<ul>
			<li class="time" title="Posted on ">
				<i class="fa fa-calendar" aria-hidden="true"></i> 
				<?php echo $club_news_data['generated']; ?>
			</li>

			<?php 
				if($club_news_data['updated'] !== NULL)
				{
					?>
					<li class="time" title="Updated on ">
						<i class="fa fa-refresh" aria-hidden="true"></i> <?php echo $club_news_data['updated']; ?>
					</li>
					<?php
				}
			 ?>
		</ul>	

	</div>

		<h3>
			<a href="">
				<span class="glyphicon glyphicon-globe"></span>
				<?php echo $club_news_data['heading']; ?> 
			</a>

			 <br><br>
			<span class="glyphicon glyphicon-hand-right well-blue"></span>
			<small> <?php echo $club_news_data['title']; ?></small>
		</h3>

	<div class="well well-wb">
		<?php echo $club_news_data['body']; ?>
	</div>
	
</div>