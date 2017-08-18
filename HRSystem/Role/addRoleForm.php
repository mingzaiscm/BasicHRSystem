<!DOCTYPE html>
<html>
<head>
	<?php 
		include('../includes/_header.php');
	?>
<style>
.error {color: #FF0000;}
</style>
<?php include('addRoleDatabase.php');?>
</head>

<script>

function validateForm() {

	var name = document.forms["addRoleForm"]["name"].value;
	if(name == "") {
		alert("Role Name is empty");
		return false;

	}

	var description = document.forms["addRoleForm"]["description"].value;
	if(description == "") {
		alert("Description is empty");
		return false;

	}

	// var chks = document.getElementsByName('permission[]');
	// 	var checkCount = 0;
	// 	for (var i = 0; i < chks.length; i++) {
	// 		if (chks[i].checked) {
	// 			checkCount++;
	// 		}
	// 	}
	// 	if (checkCount < 1) {
	// 		alert("Please check at least one permission.");
	// 		return false;
	// 	}
	// 	return true;	

}		
</script>
<body>
	<div id="wrapper">
 		<?php include("../includes/_menu.php"); ?>
 		<div id ="page-wrapper">
		<form name="addRoleForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm()">
			
				<h2>Add New Role</h2><br>

				<label> Name : </label> 
				<input name="name" type="text" id="name"><span class="error"> <?php echo $nameErr;?></span><br>
			
			
				<label> Description : </label> 
				<input name="description" type="text" id="description"><span class="error"> <?php echo $descriptionErr;?></span><br>
			
			
				<label>Rights : </label><span class="error"> <?php echo $permissionErr;?></span><br>

				<table class="table table-bordered">
					<thead>
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
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="1"> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="2"> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="3"> </input>
						</td>
						<td>
						</td>
					
					</tr>
					<tr>
						<td> Leave Application </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="4"> </input>
						</td>
						<td>
							
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="5"> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="6"> </input>
						</td>
						
					</tr>
					<tr>
						<td> Leave Entitlement </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="7"> </input>
						</td>
						<td>
						
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="8"> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Leave Types </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="9"> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="10"> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="11"> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> CF Leave </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="12"> </input>
						</td>
						<td>
							
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="13"> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Holiday Schedule </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="14"> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="15"> </input>
						</td>
						<td>
							
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Role Management </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="17"> </input>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="18"> </input>
						</td>
						<td>
						<input class = "checkbox" type = "checkbox" name = "permission[]" value ="19"> </input>
						</td>
						<td>
						</td>
						
					</tr>
						<tr>
						<td> Account Management </td>
						<td>
						</td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="21"> </input>
						</td>
						<td>
						<input class = "checkbox" type = "checkbox" name = "permission[]" value ="23"> </input>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td> Report </td>
						<td>
							<input class = "checkbox" type = "checkbox" name = "permission[]" value ="20"> </input>
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
						<input class = "checkbox" type = "checkbox" name = "permission[]" value ="22"> </input>
						</td>
						<td>
						</td>
						<td>
						</td>
						
					</tr>
				</tbody>
			</table>

		<input type ="hidden" id = "employeeCode" name = "employeeCode" value = "<?=$employeeCode?>" > </input>
		<button type="submit" value = "Submit"> Submit </button>	
		<button type="button"><a href="index.php"> Cancel </a></button>		
	</form>
	</div>
	</div>
	
</body>
</html> 