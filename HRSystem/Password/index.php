<!DOCTYPE html>
<html>
<head>
	<?php 
		include('../includes/_header.php');
	?>
</head>
<script>


</script>
<body>
	<div id="wrapper">
 		<?php include("../includes/_menu.php"); ?>
 		<div id ="page-wrapper">
		<?php
			
			require("dbconnect.php");

					$id = $employeeCode;

					$sql = "SELECT * FROM $tbl_name WHERE employeeCode = '{$id}'";
					$result = $mysqli->query($sql);
					$data = $result->fetch_assoc();					

		?>
		
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" class="table table-bordered">
<tr>
	<td align="center">
		<form name="changePassForm" method="post" action="changePass.php" onsubmit="return validateForm()">
		<table width="100%" border="0" cellspacing="1" cellpadding="3" class="table table-bordered">
			<tr>
				<td colspan="3"><strong>Change Password</strong></td>
			</tr>
			<tr>
				<td width="200">Current Password* : </td>
				<td width="301"><input name="password" type="password" id="password"></td>
			</tr>
			<tr>
				<td>New Password : </td>
				<td><input name="newPass" type="password" id="newPass"></td>
			</tr>
			<tr>
				<td>Retype Password :</td>
				<td><input name="rePass" type="password" id="rePass"></td>
			</tr>
		</table>
		<button type="submit" value = "Submit"> Submit </button>
		<button type="button"><a href="../index.php"> Cancel </a></button>
	</form>
	</td>
	</tr>
	</table>
	</div>
	</div>
</body>
</html> 