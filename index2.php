<?php 
include "core/init.php";
include 'includes/overall/header.php';

/*if(workshop_hash_exits('e10adc3949ba59abbe56e057f20f883e') === true)
{
	echo "<br> aslkdfjklsjfd<br>";
}
else
{
	echo "Not ";
}

find_student_from_confirm_list_for_workshop('someone@gmail.com',2);

if(has_registered(20,1) === true)
{
	echo "<br>This user has registered";
}

if(($id = active_workshop_of('iete')) !== false)
{
	student_confirm_list_for_workshop($id);
}*/

echo $hash = active_workshop_at_club_envelope('iete');
echo "<br><br>";
if(email_code_user_id_combo_exists(20,'27a7f90341f3e05a85c495219f17edbd') === true)
{
  echo "This combo exists";
}
echo "<br>";
/*echo faculty_id_from_pwid('d8ab4f4c10bf22aa353e2787913');*/

faculty_post_list_from_fpwid('d8ab4f4c10bf22aa353e2787913');


?>
<p>
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Link with href
  </a>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Button with data-target
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div>

<?php

if(confirm_user_id_for_workshop_id(20,1,1) === true)
{
	echo "Yes";
}




$result = $db->query("SELECT * FROM `users`");
echo "<br> Total users = ".$result->num_rows;

?>