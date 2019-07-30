<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php"; 
	
?>
<div class="well">
	<div class="well well-wb">
		<h2><a href="facultywalls.php"><span class="glyphicon glyphicon-education" aria-hidden="true"></span>
		 Faculty wall</a> <br>
		  <small><span class="glyphicon glyphicon-paperclip"></span> Here you can find your faculties</small>
		 </h2>
		
	</div>
</div>

<div class="well">
	<div class="well well-wb">
	<form action="facultywalls.php" method="POST" autocomplete="off" class="form">
		<ul>
			<li>
				<label for='faculty_search'><strong class="well-blue"><i class="fa fa-search"></i> Search your faculty</strong></label>
				<input type="text" id='faculty_search' name="search" class="form-control" title = "Type faculty name or Department code"

					<?php 
						if(isset($_POST['search']) === true and empty($_POST['search']) === false)
						{
							echo "value = ".sanitize($_POST['search']);
						}  
					?> 

				 placeholder="Search your faculty...">
				 <span id="float_right" title="For security purpose this time we are not reading any spaces. Very soon this problem will be resolved.">Please don't include any space</span>
			</li>
			
			<li>
				<input type="submit" name="submit" value="Search" class="btn btn-primary">
			</li>
		</ul>
		
	</form>
	</div>
</div>

<?php 
	if(isset($_POST['submit']) === true)
	{
		if(empty($_POST['search']) === true)
		{
			?>
				<div class="alert alert-warning lead"><span class="fa fa-frown-o" id='no_result_found'></span> Please type something in the search box.</div>
			<?php
		}

		else
		{
			search_faculty_on_faculty_wall_page($_POST['search']);
		}
	}

	else
	{
		department_faculty_list($user_data['department']);
	}
	

 ?>




<?php include "includes/overall/footer.php";?>