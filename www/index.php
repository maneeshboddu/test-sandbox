<?php

?>

<!doctype html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	
	<form method="POST" id="ins_rec">
		<div>

			<label><b>Task</b></label>
			<input type="text" name="taskname" placeholder="taskname">

			<button type="submit" >Add Task</button>

		</div>
	</form>
	<div  id="tbl_rec"> </div>	

	
	<div id="hide" style="display: none">

		<h3>Update Record</h3>
		<form method="POST" id="updata">     	

			<div class="form-group">
				<label><b>Task</b></label>
				<input type="text" name="taskname" id="upd_1" placeholder="taskname">

			</div>
			<div >
				<input type="hidden" name="dataval" id="upd_7">
			</div>

			<div>
				<button type="button" class="closedata">Cancel</button>
				<button type="submit">Update Task</button>
			</div>
		</form>
	</div>
	<script type="text/javascript">

		$(document).ready(function (){
			$('#tbl_rec').load('record.php');


			



	//insert Record

	$('#ins_rec').on("submit", function(e){
		$.ajax({

			type:'POST',
			url:'insprocess.php',
			data:$(this).serialize(),
			success:function(vardata){

				var json = JSON.parse(vardata);

				if(json.status == 0){
					window.alert(json.msg);
					$('#tbl_rec').load('record.php');
				}
				else{
					window.alert(json.msg);
				}

			}

		});

	});

	//select data

	$(document).on("click", "button.editdata", function(){
		var check_id = $(this).data('dataid');
		var v = document.getElementById("hide");
		if (v.style.display === "none") {
			v.style.display = "block";
		} else {
			v.style.display = "none";
		}

		$.getJSON("updateprocess.php", {checkid : check_id}, function(json){
			if(json.status == 0){
				$('#upd_1').val(json.taskname);
				$('#upd_7').val(check_id);

			}
			else{
				window.alert(json.msg);
			}
		});
	});

	
$(document).on("click", "button.closedata", function(){
		var check_id = $(this).data('dataid');
		var v = document.getElementById("hide");
		if (v.style.display === "none") {
			v.style.display = "block";
		} else {
			v.style.display = "none";
		}
	});
	//Update Record
	$('#updata').on("submit", function(e){

		$.ajax({

			type:'POST',
			url:'updateprocess2.php',
			data:$(this).serialize(),
			success:function(vardata){

				var json = JSON.parse(vardata);

				if(json.status == 101){
					
					$('#tbl_rec').load('record.php');
					
					window.alert(json.msg);
				}
				else{
					window.alert(json.msg);
				}

			}

		});

	});

	//delete record

	var deleteid;

	$(document).on("click", "button.deletedata", function(){
		deleteid = $(this).data("dataid");
	});

	$(document).on("click", "button.deletedata", function(){
		$.ajax({
			type:'POST',
			url:'deleteprocess.php',
			data:{delete_id : deleteid},
			success:function(data){
				var json = JSON.parse(data);
				if(json.status == 0){
					$('#tbl_rec').load('record.php');
					window.alert(json.msg);
				}
				else{
					window.alert(json.msg);
				}
			}
		});
	});



	
});


</script>

</body>
</html>
