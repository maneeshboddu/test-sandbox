<?php

include_once('config.php');
$user_fun = new Userfunction();
$json = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['checkid']) && $_GET['checkid'] > 0){

		$update_ch_id = $_GET['checkid'];
		
		$condition0['u_id'] = $update_ch_id;
		$select_pre = $user_fun->select_assoc("user", $condition0);

		if($select_pre){

			$json['status'] = 0;
			$json['taskname'] = $select_pre['u_name'];
			$json['msg'] = "Success";
		}
		else{

			$json['status'] = 1;
			$json['taskname'] = "NULL";
			$json['msg'] = "Fail";

		}
	}
}

echo json_encode($json);

?>