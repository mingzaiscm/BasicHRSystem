<!DOCTYPE html>
<html>
<head>
<?php 
		include('../includes/_header.php');
	?>
</head>


<script>
function validateForm() {

	var username = document.forms["editUserForm"]["username"].value;
	if(username == "") {
		alert("Username is empty");
		return false;

	}

	var role = document.forms["editUserForm"]["role"].value;
	if(role == "") {
		alert("Select a role please");
		return false;

	}

	var status = document.forms["editUserForm"]["status"].value;
	if(status == "") {
		alert("Select a role please");
		return false;
	}

}
</script>
<body>
	<div id="wrapper">
 		<?php include("../includes/_menu.php"); ?>
 		<div id ="page-wrapper">
 		<h2>Edit Role</h2><br>
		<?php
			
			require("dbconnect.php");

			 // var_dump($_SESSION['user']);
			 // exit();

			if($_GET['id']) {
				$id = $_GET['id'];
				$sql = "SELECT * FROM `Employee` e join `Account` a on e.employeeCode = a.employeeCode where a.employeeCode = '$id'";
					// $sql = "SELECT * FROM $tbl_name WHERE employeeCode = '{$id}'";
					//var_dump($sql); exit();
					$result = $mysqli->query($sql);
					//var_dump($result); exit();
					$data = $result->fetch_assoc();

					$role = "SELECT * FROM Role";
					$row = $mysqli->query($role);

			}

		?>
		
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" class="table table-bordered">
<tr>
	<td align="center">
		<form name="editUserForm" method="post" action="editUserDatabase.php" onsubmit="return validateForm()">
		<table width="100%" border="0" cellspacing="1" cellpadding="3" class="table table-bordered">
			<!-- <tr>
				<td align = "center" colspan="3"><strong>Edit User</strong></td>
			</tr> -->
			<tr>
				<td width="200">Username : </td>
				<td width="400"><input name="username" type="text" id="username" value ="<?php echo $data["username"]; ?>"></td>
			</tr>

			<tr>
				<td>Role* :</td>
				<td><select name="role" type="text" id="roleId">

					<?php 
					
					while($new = $row->fetch_assoc()){
						echo '<option value ='.$new['roleId'].'';

						if ($new['roleId'] === $data['roleId']){
							echo ' selected';
						};
						echo '>'.$new['roleName'].'</option>';
					}
					?>
					</select>

				</td>
			</tr>
			<tr>
				<td>Status* :</td>
				<td><select name="status" type="text" id="status" value ="<?php echo $data['status']; ?>">
					<option value="Active"<?php if(($data['status'])=="Active") echo "selected" ?>>Active</option>
					<option value="Inactive"<?php if(($data['status'])=="Inactive") echo "selected" ?>>Inactive</option>
					</select>
				</td>
			</tr>
			
			<tr>
			</tr>
			</table>
			<button type="submit" value = "Submit"> Submit </button>	
			<button type="button"><a href="index.php"> Cancel </a></button>
				<input name="employeeCode" type="hidden" id="employeeCode" value="<?php echo $data["employeeCode"]; ?>"></td>

	</form>
	</td>
	</tr>
	</table>
	</div>
	</div>
</body>
</html> 