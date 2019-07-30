<?php 
include "core/init.php";
protected_page();

if(isset($_GET['UsPxDiMnjd'],$_GET['ApLUmnDk'],$_GET['SaltAPuId'],$_GET['ReceiverIDP']) === true)
{
	$email_code 		= sanitize($_GET['UsPxDiMnjd']);
	$to_id 				= (int)substr(sanitize($_GET['ApLUmnDk']), 6);
	$contact_verify 	= sanitize($_GET['SaltAPuId']);
	$user_verify 		= sanitize($_GET['ReceiverIDP']);

	/*echo $email_code."<br>".$to_id."<br>".$contact_verify.'<br>'.md5('2:6:4:95'.$to_id).'<br>'.$user_verify.'<br>'.md5('2:6:4:95'.$user_data['user_id']);*/
	if(email_code_user_id_combo_exists($to_id,$email_code) === true)
	{
		if(($contact_verify == md5('2:6:4:95'.$to_id)) and ($user_verify = md5('2:6:4:95'.$user_data['user_id'])))
		{
			include "includes/overall/header.php";

			?>
<div class="well">
	<div class="well well-wbr">

		<div class="row">
			<div class="col-md-3">
				<span class="lead well-blue"><i class="fa fa-user"></i> Nasir Ahmad <br></span>
				<small class="time"><span class="glyphicon glyphicon-hand-right"></span> ME(10300315126)</small>
			</div>
			<div class="col-md-7">
				<textarea class="form-control">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam illo, rem atque, doloremque iure asperiores sint animi corrupti, non minus at odio! Architecto, tenetur! Voluptates.</textarea>
			</div>
			<div class="col-md-2"><a href="#" class="btn btn-primary form-control">Send</a></div>
		</div>
		<hr>

		<div class="chatbox">
			<div class="chatlogs">
				<br>
				<div class="comments ">
					<div class="comment bubble_me" title="me">
						<p>This is a paragraph of text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, incidunt. Rerum quia omnis pariatur repellat. Nihil culpa blanditiis minima. Dolor cum, ex inventore impedit perspiciatis accusantium autem nihil fugiat iusto.</p>
					</div>

					<div class="comment bubble_friend">
						<p>This is a paragraph of text.</p>
					</div>
					
					<div class="comment bubble_me">
						<p>This is a paragraph of text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, incidunt. Rerum quia omnis pariatur repellat. Nihil culpa blanditiis minima. Dolor cum, ex inventore impedit perspiciatis accusantium autem nihil fugiat iusto.</p>
					</div>

					<div class="comment bubble_friend">
						<p>This is a paragraph of text.</p>
					</div>
					<div class="comment bubble_me">
						<p>This is a paragraph of text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, incidunt. Rerum quia omnis pariatur repellat. Nihil culpa blanditiis minima. Dolor cum, ex inventore impedit perspiciatis accusantium autem nihil fugiat iusto.</p>
					</div>

					<div class="comment bubble_friend">
						<p>This is a paragraph of text.</p>
					</div>
					<div class="comment bubble_me">
						<p>This is a paragraph of text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, incidunt. Rerum quia omnis pariatur repellat. Nihil culpa blanditiis minima. Dolor cum, ex inventore impedit perspiciatis accusantium autem nihil fugiat iusto.</p>
					</div>

					<div class="comment bubble_friend">
						<p>This is a paragraph of text.</p>
					</div>

				</div>

				

			</div>
			
			<br><br><br>


		</div>
	</div>
</div>




			<?php

include "includes/overall/footer.php";

		}
		else
		{
			header('Location:index.php');
			exit();
		}
	}
	else
	{
		header('Location:index.php');
		exit();
	}
	
}
?>
