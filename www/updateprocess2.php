<?php

include_once('config.php');
$user_fun = new Userfunction();

$json = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['taskname'])&& isset($_POST['dataval'])){

		$taskname = $_POST['taskname'];
		$update_id = $_POST['dataval'];		
			if(!empty($taskname)){
			$condition['u_id'] = $update_id;
			$field_val['u_name'] = $taskname;
			$update = $user_fun->update("user", $field_val, $condition);
			if($update){
				$json['status'] = 101;
				$json['msg'] = "Data Successfully Updated";
			}

			}

			else
			{
				$json['status'] = 102;
				$json['msg'] = "Enter username";

			}
		}

		}

echo json_encode($json);

?>