<?php

include_once('config.php');
$user_fun = new Userfunction();

$json = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	
	if(isset($_POST['taskname'])){

		$taskname = $_POST['taskname'];
		
			if (!empty($taskname)) {
				
			
			$field_val['u_name'] = $taskname;
			$insert = $user_fun->insert("user", $field_val);
			if($insert){
				$json['status'] = 101;
				$json['msg'] = "Data Successfully Inserted";
			}
			else{
				$json['status'] = 102;
				$json['msg'] = "Data Not Inserted";
			}
		}

		else{
			$json['status'] = 103;
				$json['msg'] = "Please Enter taskname";
		}

		}

	}
	


echo json_encode($json);

?>