<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php";
?>
<div class="well chatlist">
	<div class="well well-wb">
					<ul class="nav nav-tabs">
					  <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-comments-o"></i> Personal</a></li>
					  <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
					  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
					</ul>

						<div class="tab-content">

						  <div id="home" class="tab-pane fade in active well-blue personal_chat_list">
						    <h3><i class="fa fa-comments-o"></i> Personal Chatist</h3>
						    <hr>
						   <ul>
						   		<?php grab_personal_chat_list(); ?>
						   </ul>

						  </div>


						  <div id="menu1" class="tab-pane fade">
						    <h3>Menu 1</h3>
						    <p>Some content in menu 1.</p>
						  </div>
						  <div id="menu2" class="tab-pane fade">
						    <h3>Menu 2</h3>
						    <p>Some content in menu 2.</p>
						  </div>
						</div>
	</div>
</div>


<?php
include "includes/overall/footer.php";
?>