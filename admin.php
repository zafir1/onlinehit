<?php 
include "core/init.php";
protected_page();
admin_protect();
include "includes/overall/header.php"; 
	
?>
<div class="well">
	<div class="well well-wb">
		<h2 class="well-blue"><span class="fa fa-unlock"></span> Admin <br>
			<small><span class="glyphicon glyphicon-paperclip"></span> Congratulations you are an <b>admin</b> at OnlineHIT</small>
		</h2>

		<a href="viewpagelist.php" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Manage post</a>
		
	</div>

</div>

<div class="well">
<div class="well well-wb">
	<ul>
		<li>
			<span class="glyphicon glyphicon-hand-right well-blue"></span> As a core member of IETE we give you freedom to post news / info here.
		</li>
		<br>
		<li>
			<a href="addpage.php" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Add page</a>

			<a href="viewpagelist.php" class="btn btn-primary"><span class="fa fa-eye"></span> Manage post</a>

			<a href="wrkshparnge.php?Ad$m$nIP=<?php echo md5(substr(md5($user_data['user_id']),3,20)); ?>&MHpiRXtRj3^3$$NxT=<?php echo substr(md5($user_data['email_code']),0,28); ?>" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Arrange Workshop</a>

		</li>
		
	</ul>

	</div>
</div>


 
<?php include "includes/overall/footer.php";?>