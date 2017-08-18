<!DOCTYPE html>
<html>
<head>
<?php 
		include('../includes/_header.php');
	?>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/datepicker.js"></script>

<script>
function validateForm() {

	var name = document.forms["editForm"]["name"].value;
	if(name == "") {
		alert("Name is empty");
		return false;

	}

	var cimbAcc = document.forms["editForm"]["cimbAcc"].value;
	if( cimbAcc == "") {
		alert("CIMB Account No. is empty");
		return false;
	}

	var icNo = document.forms["editForm"]["icNo"].value;
	if( icNo == "") {
		alert("IC No. is empty");
		return false;
	}

	var gender = document.forms["editForm"]["gender"].value;
	if( gender == "0") {
		alert("Gender is empty");
		return false;
	}

	var citizenship = document.forms["editForm"]["citizenship"].value;
	if( citizenship == "") {
		alert("Citizenship is empty");
		return false;
	}

	var dob = document.forms["editForm"]["dob"].value;
	if( dob == "") {
		alert("Date of Birth is empty");
		return false;
	}

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

	var joinDate = document.forms["editForm"]["joinDate"].value;
	if( joinDate == "") {
		alert("Join Date is empty");
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
</head>

<body>
	<div id="wrapper">
 		<?php include("../includes/_menu.php"); ?>
 		<div id ="page-wrapper">
		<?php
			
			require("dbconnect.php");

			if($_GET['employeeCode']) {
				$employeeCode = $_GET['employeeCode'];
					$sql = "SELECT * FROM $tbl_name WHERE employeeCode = '{$employeeCode}'";
					$result = $mysqli->query($sql);
					$data = $result->fetch_assoc();
			}

		?>
		
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" class="table table-bordered">
<tr>
	<td align="center">
		<form name="editForm" method="post" action="editDatabase.php" onsubmit="return validateForm()">
		<table width="100%" border="0" cellspacing="1" cellpadding="3" class="table table-bordered">
			<tr>
				<td colspan="3"><strong>Personal Particular</strong></td>
			</tr>
			<tr>
				<td width="200">Employee Code : </td>
				<td width="301"><?php echo $data["employeeCode"]; ?></td>
			</tr>
			<tr>
				<td width="200">Name* : </td>
				<td width="301"><input name="name" type="text" id="name" value ="<?php echo $data["name"]; ?>"></td>
			</tr>
			<tr>
				<td>Title* :</td>
				<td><input name="title" type="text" id="title" value ="<?php echo $data['title']; ?>"></td>
			</tr>
			<tr>
				<td>CIMB Account Number* :</td>
				<td><input name="cimbAcc" type="text" id="cimbAcc" value ="<?php echo $data['cimbAcc']; ?>"></td>
			</tr>
			<tr>
				<td>NRIC/Passport No* :</td>
				<td><input name="icNo" type="text" id="icNo" maxlength="15" value ="<?php echo $data['icNo']; ?>"></td>
			</tr>
			<tr>
				<td>Gender* :</td>
				<td><select name="gender" type="text" id="gender">
					<option value="Male" <?php if(($data['gender'])=="Male") echo "selected" ?> >Male</option>
					<option value="Female" <?php if(($data['gender'])=="Female") echo "selected" ?> >Female</option>
					</select>

				</td>
			</tr>
			<tr>
				<td>Citizenship* :</td>
				<td><input name="citizenship" type="text" id="citizenship" value ="<?php echo $data['citizenship']; ?>"></td>
			</tr>
			<tr>
				<td>EPF No :</td>
				<td><input name="epfNo" type="text" id="epfNo" maxlength="10" value ="<?php echo $data['epfNo']; ?>"></td>
			</tr>
			<tr>
				<td>Socso No :</td>
				<td><input name="socsoNo" type="text" id="socsoNo" maxlength="15" value ="<?php echo $data['socsoNo']; ?>"></td>
			</tr>
			<tr>
				<td>Income Tax No :</td>
				<td><input name="incomeTaxNo" type="text" id="incomeTaxNo" maxlength="15" value ="<?php echo $data['incomeTaxNo']; ?>"></td>
			</tr>
			<tr>
				<td>Date of Birth* :</td>
				<td><input name="dob" type="text" class="datepicker" value ="<?php echo $data['dob']; ?>"></td>
			</tr>
			<tr>
				<td>Marital Status* :</td>
				<td><select name="marital" type="text" id="marital" value ="<?php echo $data['marital']; ?>">
					<selected
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
				<td><input name="joinDate" type="text" class="datepicker" value ="<?php echo $data['joinDate']; ?>"></td>
			</tr>
			<tr>
				<td>Confirm Date* :</td>
				<td><input name="confirmDate" type="text" class="datepicker" value ="<?php echo $data['confirmDate']; ?>"></td>
			</tr>
			<tr>
				<td>Email :</td>
				<td><input name="email" type="text" id="email" value ="<?php echo $data['email']; ?>"></td>
			</tr>
			<tr>
				<td>Company Email :</td>
				<?php 
				if( $data['companyEmail'] != NULL){ 
					 echo "<td>" .($data['companyEmail']) ."</td>";
					 echo "<input name='companyEmail' type='hidden' id='companyEmail' value=".($data['companyEmail']) ."></input>";
				}
				else {
					echo 
					'<td><input name="companyEmail" type="text" id="companyEmail"></td>';
					}
				?>
			</tr>
			<tr>
				<td>Resign Date :</td>
				<td><input name="resignDate" type="text" class="datepicker" value ="<?php echo $data['resignDate']; ?>"></td>
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

				<button type="submit" value = "Submit"> Submit </button>	
				<button type="button"><a href="index.php"> Cancel </a></button>
				<input name="employeeCode" type="hidden" id="employeeCode" value="<?php echo $data["employeeCode"]; ?>"></input>
				
				</td>
		</form>
	</tr>
	</table>
	
	</div>
	</div>
</body>
</html> 