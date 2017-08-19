<!DOCTYPE html>
<html>
<head>
<?php 
		include('../includes/_header.php');
	?>
<style>
</style>
</head>

<?php include('editRoleDatabase.php');?>

<script>
function validateForm() {

	var name = document.forms["editRoleForm"]["name"].value;
	if(name == "") {
		alert("Role Name is empty");
		return false;

	}

	var description = document.forms["editRoleForm"]["description"].value;
	if(description == "") {
		alert("Description is empty");
		return false;

	}



}		
</script>
<body>
	<div id="wrapper">
 		<?php include("../includes/_menu.php"); ?>
 		<div id ="page-wrapper">
		<?php
			
			require("dbconnect.php");


			if($_GET['id']) {
				$id = $_GET['id'];
					$sql = "SELECT * FROM Role WHERE roleId = '{$id}'";
					$result = $mysqli->query($sql);
					$data = $result->fetch_assoc();

					$right = explode("-", $data['permission']);

			}

		?>


		<form name="editRoleForm" method="post" action="editRoleDatabase.php" onsubmit="return validateForm()">
			
				<H2>Edit Role</H2><br>
			
				<label> Name : </label>  
				<input name="name" type="text" id="name" value="<?php echo $data["roleName"]; ?>"><br>
			
			
				<label> Description : </label> 
				<input name="description" type="text" id="description" value="<?php echo $data["roleDesc"]; ?>"><br>
			
				<label>Rights : </label>
				<table class="table table-bordered">
					<thead >
						<tr>
							<th><label id = 'lpermission' for = 'permission'> Permission </label></th>
							<th width = '70'> Create </th>
							<th width = '70'> Edit </th>
							<th width = '70'> View </th>
							<th width = '70'> Approval </th>
						</tr>
					</thead>
				<tbody>
					<tr>
						<td> Employee Management </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="1" <?php if(in_array("1", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="2" <?php if(in_array("2", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="3" <?php if(in_array("3", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
						</td>
					</tr>

					<tr>
						<td> Leave Application </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="4" <?php if(in_array("4", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="5" <?php if(in_array("5", $right))echo 'checked=checked"'; ?>> </input>	
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="6" <?php if(in_array("6", $right))echo 'checked=checked"'; ?>> </input>
						</td>
					</tr>
					<tr>
						<td> Leave Entitlement </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="7" <?php if(in_array("7", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="8" <?php if(in_array("8", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Leave Types </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="9" <?php if(in_array("9", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="10" <?php if(in_array("10", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="11" <?php if(in_array("11", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> CF Leave </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="12" <?php if(in_array("12", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="13" <?php if(in_array("13", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Holiday Schedule </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="14" <?php if(in_array("14", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="15" <?php if(in_array("15", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Role Management </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="17" <?php if(in_array("17", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="18" <?php if(in_array("18", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="19" <?php if(in_array("19", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Account Management </td>
						<td>
						
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="21" <?php if(in_array("21", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="23" <?php if(in_array("23", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Report </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="20" <?php if(in_array("20", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Password Reset </td>
						<td>
						</td>
						<td>
						<input class = "checkbox" type = "checkbox" name = "permission[]" value ="22" <?php if(in_array("22", $right))echo 'checked=checked"'; ?>> </input>
						</td>
						<td>
						</td>
						<td>
						</td>
						
					</tr>
				</tbody>
			</table>

		<input type ="hidden" id = "employeeCode" name = "employeeCode" value = "<?php echo $employeeCode ?>" > </input>

			<input name="id" type="hidden" id = "id" value = "<?php echo $data["roleId"];?>"> </input>
					
		<button type="submit" value = "Submit"> Submit </button>	
		<button type="button"><a href="index.php"> Cancel </a></button>		
			
		
	</form>
	</div>
	</div>
</body>
</html> 