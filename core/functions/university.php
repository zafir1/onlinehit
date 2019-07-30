<?php 

	function university_roll_registration_id_combo_exists($roll,$reg)
	{
		$roll 			= sanitize($roll);
		$reg  			= sanitize($reg);

		/*echo $roll."<br>".$reg."<br>".$college_id;
		die();*/

		$query = "	
					SELECT COUNT(`id`) FROM  
					`student_detail_list` WHERE 
					`university_roll` = '$roll' AND 
					`university_reg` = '$reg' 

					";
		$query = mysql_query($query);
		return (mysql_result($query, 0) == 1) ? true : false;
	}

	function give_year_full_form($year)
	{
		$year = (int)sanitize($year);

		switch ($year) {
			case '1':
				return "1st Year";
				break;

			case '2':
				return "2nd Year";
				break;

			case '3':
				return "3rd Year";
				break;

			case '4':
				return "4th Year";
				break;

			default:
				break;
		}
	}

	function give_batch_full_form($batch)
	{
		$batch = (int)$batch;
		switch ($batch) {
			case '2':
				return "2nd Batch";
				break;
			
			default:
				return "1st Batch";
				break;
		}
	}

	function give_department_full_form($department)
	{
		$department = sanitize($department);

		switch ($department) {
			case 'bt':
				return "Biotechnology";
				break;

			case 'che':
				return "Chemical Engineering";
				break;

			case 'cvl':
				return "Civil Engineering";
				break;

			case 'cse':
				return "Computer Science Engineering";
				break;
			
			case 'it':
				return "Information Technology";
				break;

			case 'ece':
				return "Electronics and Communication Engineering";
				break;

			case 'ee':
				return "Electrical Engineering";
				break;

			case 'ft':
				return "Food Technology";
				break;

			case 'ice':
				return "Instrumentation & Control Engineering";
				break;

			case 'me':
				return "Mechanical Engineering";
				break;

			case 'pe':
				return "Production Engineering";
				break;

			default:
				return "Something went wrong.";
				break;
		}
	}


 ?>