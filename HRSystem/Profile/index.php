<!DOCTYPE html>
<html>
<head>
<title> View Employee </title>
</head>
<?php 
		include('../includes/_header.php');
	?>



<script>	
function validateForm() {

	var marital = document.forms["editForm"]["marital"].value;
	if( marital == "0") {
		alert("Marital Status is empty");
		return false;
	}	

	var permaAddr = document.forms["editForm"]["permaAddr"].value;
	if( permaAddr == "") {
		alert("Permanent Address is empty");
		return false;
	}	

	var handphoneNo = document.forms["editForm"]["handphoneNo"].value;
	if( handphoneNo == "") {
		alert("Handphone No is empty");
		return false;
	}

	var emergencyName = document.forms["editForm"]["emergencyName"].value;
	if(emergencyName == "") {
		alert("Emergency Name is empty");
		return false;

	}

	var relationship = document.forms["editForm"]["relationship"].value;
	if(relationship == "") {
		alert("Relationship is empty");
		return false;

	}

	var emergencyTel = document.forms["editForm"]["emergencyTel"].value;
	if(emergencyTel == "") {
		alert("Emergency Tel No. is empty");
		return false;

	}

	var emergencyAddr = document.forms["editForm"]["emergencyAddr"].value;
	if(emergencyAddr == "") {
		alert("Emergency Address is empty");
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

					$id = $_SESSION['employeeCode'];

					$sql = "SELECT * FROM $tbl_name WHERE employeeCode = '{$id}'";
					$result = $mysqli->query($sql);
					$data = $result->fetch_assoc();					

		?>
		
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" class="table table-bordered">
<tr>
	<td align = "center">
	<form name="editForm" method="post" action="editProfileDatabase.php" onsubmit="return validateForm()">
		<table width="100%" border="0" cellspacing="1" cellpadding="3" class="table table-bordered">
			<tr>
				<td colspan="3"><strong>Personal Particular</strong></td>
			</tr>
			<tr>
				<td width="200">Name : </td>
				<td width="301"><?php echo $data["name"]; ?></td>
			</tr>
			<tr>
				<td>Title : </td>
				<td><?php echo $data["title"]; ?></td>
			</tr>
			<tr>
				<td>CIMB Account Number :</td>
				<td><?php echo $data["cimbAcc"]; ?></td>
			</tr>
			<tr>
				<td>NRIC/Passport No :</td>
				<td><?php echo $data["icNo"]; ?></td>
			</tr>
			<tr>
				<td>Gender :</td>
				<td><?php echo $data["gender"]; ?></td>
			</tr>
			<tr>
				<td>Citizenship :</td>
				<td><?php echo $data["citizenship"]; ?></td>
			</tr>
			<tr>
				<td>EPF No :</td>
				<td><?php echo $data["epfNo"]; ?></td>

			</tr>
			<tr>
				<td>Socso No :</td>
				<td><?php echo $data["socsoNo"]; ?></td>
			</tr>
			<tr>
				<td>Income Tax No :</td>
				<td><?php echo $data["incomeTaxNo"]; ?></td>
			</tr>
			<tr>
				<td>Date of Birth* :</td>
								<td><?php echo $data["dob"]; ?></td>

			</tr>
			<tr>
				<td>Marital Status* :</td>
				<td><select name="marital" type="text" id="marital" value ="<?php echo $data['marital']; ?>">
					<selected>
					<option value="Single" <?php if(($data['marital'])=="Single") echo "selected" ?> >Single</option>
					<option value="Married" <?php if(($data['marital'])=="Married") echo "selected" ?> >Married</option>
					<option value="Divorced"<?php if(($data['marital'])=="Divorced") echo "selected" ?>>Divorced</option>
					<option value="Windowed"<?php if(($data['marital'])=="Windowed") echo "selected" ?>>Windowed</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Permanent Address* :</td>
				<td><textarea rows ="4" column="50" name="permaAddr" id="permaAddr" ><?php echo $data['permaAddr']; ?></textarea></td>
			</tr>
			<tr>
				<td>Residential Address :</td>
				<td><textarea rows ="4" column="50" name="residentialAddr"  id="residentialAddr"><?php echo $data['residentialAddr']; ?></textarea></td>
			</tr>
			<tr>
				<td>Tel No. (House) :</td>
				<td><input name="telNo" type="text" id="telNo" value ="<?php echo $data['telNo']; ?>"></td>
			</tr>
			<tr>
				<td>Handphone No* :</td>
				<td><input name="handphoneNo" type="text" id="handphoneNo" value ="<?php echo $data['handphoneNo']; ?>"></td>
			</tr>
			<tr>
				<td>Join Date* :</td>
								<td><?php echo $data["joinDate"]; ?></td>

			</tr>
			<tr>
				<td>Confirm Date* :</td>
								<td><?php echo $data["confirmDate"]; ?></td>

			</tr>
			<tr>
				<td>Email :</td>
				<td><input name="email" type="text" id="email" value ="<?php echo $data['email']; ?>"></td>
			</tr>
			<tr>
				<td>Company Email :</td>
								<td><?php echo $data["companyEmail"]; ?></td>

			</tr>
			<tr>
				<td>Resign Date :</td>
								<td><?php echo $data["resignDate"]; ?></td>

			</tr>
			<tr>
				<td colspan="3"><strong>Incase of Emergency, Notify:</strong></td>
			</tr>
				<tr>
				<td>Name *: </td>
				<td><input name="emergencyName" type="text" id="emergencyName" value ="<?php echo $data['emergencyName']; ?>"></td>
			</tr>
			<tr>
				<td>Relationship *: </td>
				<td><input name="relationship" type="text" id="relationship" value ="<?php echo $data['relationship']; ?>"></td>
			</tr>
			<tr>
				<td>Tel No *: </td>
				<td><input name="emergencyTel" type="text" id="emergencyTel" value ="<?php echo $data['emergencyTel']; ?>"></td>
			</tr>
			<tr>
				<td>Address : </td>
				<td><textarea rows ="4" column="50" name="emergencyAddr" id="emergencyAddr" ><?php echo $data['emergencyAddr']; ?></textarea></td>
			</tr>
			</table>
				<input name="employeeCode" type="hidden" id="employeeCode" value="<?php echo $data["employeeCode"]; ?>">

				<button type="submit" value = "Submit"> Submit </button>	
				<button type="button"><a href="../index.php"> Cancel </a></button>
				</td>
			</form>
	</tr>
	</table>

	</div>
	</div>

</body>
</html> 