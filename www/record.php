<?php

include_once('config.php');
$user_fun = new Userfunction();
$counter = 1;

$select = $user_fun->select("user");
?>

				<table class="table" style="vertical-align: middle; text-align: center;">
				  
					<tr>
					  	<th>#</th>
					  	<th>Name</th>
						<th>Action</th>
					</tr>
				 
				  <tbody>
				  	<?php if($select){ foreach($select as $se_data){ ?>
					<tr>
					  <th scope="row"><?php echo $counter; $counter++; ?></th>
					  	<td><?php echo $se_data['u_name']; ?></td>
			
						<td>
							<button type="button" class="editdata" data-dataid="<?php echo $se_data['u_id']; ?>">Update</button>
							<button type="button" class="deletedata" id="deleterec" data-dataid="<?php echo $se_data['u_id']; ?>">Delete</button>
						</td>
					</tr>
					<?php }}else{ echo "<tr><td colspan='7'><h2>No Result Found</h2></td></tr>"; } ?>
				  </tbody>
				</table>	


