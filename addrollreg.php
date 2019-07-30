<?php 
include "core/init.php";
protected_page();
include "includes/overall/header.php";

echo "Roll\tReg<br>";

generate_roll_reg_combo(10300314,001,125,141030110,188);



include "includes/overall/footer.php";
?>