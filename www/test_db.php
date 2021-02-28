<?php 

class Userfunction{
	private $DBHOST='mysql';
	private $DBUSER='root';
	private $DBPASS='tiger';
	private $DBNAME='testDB';
	public $con;

	public function __construct(){
		$this->con = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
		if(!$this->con){
			return false;
		}
	}


	public function insert($tblname, $filed_data){

		$query_data = "";

		foreach ($filed_data as $q_key => $q_value) {
			$query_data = $query_data."$q_key='$q_value',";
		}
		$query_data = rtrim($query_data,",");

		$query = "INSERT INTO $tblname SET $query_data";
		$insert_fire = mysqli_query($this->con, $query);
		if($insert_fire){
			return $insert_fire;
		}
		else{
			return false;
		}

	}

	public function select_assoc($tblname, $condition, $op='AND'){

		$field_op = "";
		foreach ($condition as $q_key => $q_value) {
			$field_op = $field_op."$q_key='$q_value' $op ";
		}
		$field_op = rtrim($field_op,"$op ");

		$select_assoc = "SELECT * FROM $tblname WHERE $field_op";
		$select_assoc_query = mysqli_query($this->con, $select_assoc);
		if(mysqli_num_rows($select_assoc_query) > 0){
			if(mysqli_num_rows($select_assoc_query) == 1)
			{
				$select_assoc_fire = mysqli_fetch_assoc($select_assoc_query);
				if($select_assoc_fire){
					return $select_assoc_fire;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		else{	
			return false;
		}

	}

	public function select($tblname){

		$select = "SELECT * FROM $tblname";
		$select_fire = mysqli_query($this->con, $select);
		if(mysqli_num_rows($select_fire) > 0){
			$select_fetch = mysqli_fetch_all($select_fire, MYSQLI_ASSOC);
			if($select_fetch){
				return $select_fetch;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	public function update($tblname, $field_data, $condition, $op='AND'){

		$field_row = "";
		
		foreach ($field_data as $q_key => $q_value) {
			$field_row = $field_row."$q_key='$q_value',";
			print $field_row;

		}
		$field_row = rtrim($field_row,",");

		$field_op = "";

		foreach ($condition as $q_key => $q_value) {
			$field_op = $field_op."$q_key='$q_value' $op ";
			print $field_op;
		}
		$field_op = rtrim($field_op,"$op ");

		$update = "UPDATE $tblname SET $field_row WHERE $field_op";
		$update_fire = mysqli_query($this->con, $update);
		if($update_fire){
			return $update_fire;
		}
		else{
			return false;
		}

	}	

	public function delete($tblname, $condition, $op='AND'){

		$delete_data = "";

		foreach ($condition as $q_key => $q_value) {
			$delete_data = $delete_data."$q_key='$q_value' $op ";
		}

		$delete_data = rtrim($delete_data,"$op ");		
		$delete = "DELETE FROM $tblname WHERE $delete_data";
		$delete_fire = mysqli_query($this->con, $delete);
		if($delete_fire){
			return $delete_fire;
		}
		else{
			return false;
		}

	}

}

?>
