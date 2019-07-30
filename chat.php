<?php 
include "core/init.php";
protected_page();

if(isset($_GET['UsPxDiMnjd'],$_GET['ApLUmnDk'],$_GET['SaltAPuId'],$_GET['ReceiverIDP']) === true)
{
	$email_code 		= sanitize($_GET['UsPxDiMnjd']);
	$to_id 				= (int)substr(sanitize($_GET['ApLUmnDk']), 6);
	$contact_verify 	= sanitize($_GET['SaltAPuId']);
	$user_verify 		= sanitize($_GET['ReceiverIDP']);
	/*ReceiverIDP is a code to veryfy user itself*/

	$UsPxDiMnjd 		= $email_code;
	$ApLUmnDk 			= $to_id;
	$SaltAPuId			= $contact_verify;
	$ReceiverIDP 		= $user_verify;

	if(email_code_user_id_combo_exists($to_id,$email_code) === true)
	{
		if(($contact_verify == md5('2:6:4:95'.$to_id)) and ($user_verify == md5('2:6::4:95'.$user_data['user_id'])))
		{
			$receiver = user_data($to_id,'user_id','first_name','last_name','email','email_code','type','department','member','year','batch','gender','details','uni_roll','uni_reg','college_id','faculty');
			include "includes/overall/header.php";

			?>
<div class="well">
	<div class="well well-crm">

		<div class="row">
			<div class="col-md-3">
				<span class="lead well-blue"><i class="fa fa-user"></i> 
				<?php echo $receiver['first_name'].' '.$receiver['last_name']; ?>
				 <br></span>
				<small class="time"><span class="glyphicon glyphicon-hand-right"></span> 
				<?php echo strtoupper($receiver['department']);
						if($receiver['faculty'] != 1 and $receiver['uni_roll'] != NULL)
						{
							echo '('.$receiver['uni_roll'].')';
						}
				 ?>
				</small>
			</div>
			<div class="col-md-7">
				<textarea id='message' class="form-control" placeholder="Type Your message...."></textarea>
			</div>
			<div id='send_btn' class="col-md-2"><a href="#" class="btn btn-primary form-control">Send</a></div>
		</div>
		<hr>

			<div class="chatlogs">
				<br>
				<div class="comments" id='chat_history'>
					
				Please wait.....

				</div>
			</div>
			
			<br>

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
else
{
	header('Location:index.php');
	exit();
}
?>

<script type="text/javascript">
	var UsPxDiMnjd = '<?php echo $email_code; ?>';
	var ApLUmnDk = '<?php echo $_GET['ApLUmnDk']; ?>';
	var SaltAPuId = '<?php echo $contact_verify; ?>';
	var ReceiverIDP = '<?php echo $user_verify; ?>';
	$(document).ready(function(){

		$('#send_btn').click(function(){
			var message = $('#message').val();
			if($.trim(message) != '')
			{
					$.ajax({
					url: 'chat/insert.php',
					type: 'POST',
					dataType: 'text',
					data: {
						UsPxDiMnjd:UsPxDiMnjd,
						ApLUmnDk:ApLUmnDk,
						SaltAPuId:SaltAPuId,
						ReceiverIDP:ReceiverIDP,
						message:message
					},
					success:function(data)
					{
						$('#from').val('');
						$('#message').val('');
					}
				});
			}
			else
			{
				alert('Please type some message');
			}

		});

		/**********************************************/
		setInterval(function(){
			$.post('chat/insert.php',{

				UsPxDiMnjd:UsPxDiMnjd,
				ApLUmnDk:ApLUmnDk,
				SaltAPuId:SaltAPuId,
				ReceiverIDP:ReceiverIDP,
				retrive:'yes'

			 }, function(data){
				$('#chat_history').html(data);
			});
		},1700);
		/***********************************************/



	});


</script>
