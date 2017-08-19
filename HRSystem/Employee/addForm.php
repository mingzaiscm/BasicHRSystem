<!DOCTYPE html>
<html>
<head>
	<?php 
		include('../includes/_header.php');
	?>
<style>
.error {color: #FF0000;}
</style>
<?php include('addDatabase.php');?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/datepicker.js"></script>

<script>
function validateForm() {

	var name = document.forms["addForm"]["name"].value;
	if(name == "") {
		alert("Name is empty");
		return false;

	}

	var cimbAcc = document.forms["addForm"]["cimbAcc"].value;
	if( cimbAcc == "") {
		alert("CIMB Account No. is empty");
		return false;
	}

	var icNo = document.forms["addForm"]["icNo"].value;
	if( icNo == "") {
		alert("IC No. is empty");
		return false;
	}

	var gender = document.forms["addForm"]["gender"].value;
	if( gender == "0") {
		alert("Gender is empty");
		return false;
	}

	var citizenship = document.forms["addForm"]["citizenship"].value;
	if( citizenship == "") {
		alert("Citizenship is empty");
		return false;
	}

	var dob = document.forms["addForm"]["dob"].value;
	if( dob == "") {
		alert("Date of Birth is empty");
		return false;
	}

	var marital = document.forms["addForm"]["marital"].value;
	if( marital == "0") {
		alert("Marital Status is empty");
		return false;
	}

	var permaAddr = document.forms["addForm"]["permaAddr"].value;
	if( permaAddr == "") {
		alert("Permanent Address is empty");
		return false;
	}

	var handphoneNo = document.forms["addForm"]["handphoneNo"].value;
	if( handphoneNo == "") {
		alert("Handphone No is empty");
		return false;
	}

	var joinDate = document.forms["addForm"]["joinDate"].value;
	if( joinDate == "") {
		alert("Join Date is empty");
		return false;
	}

	var emergencyName = document.forms["addForm"]["emergencyName"].value;
	if(emergencyName == "") {
		alert("Emergency Name is empty");
		return false;

	}

	var relationship = document.forms["addForm"]["relationship"].value;
	if(relationship == "") {
		alert("Relationship is empty");
		return false;

	}

	var emergencyTel = document.forms["addForm"]["emergencyTel"].value;
	if(emergencyTel == "") {
		alert("Emergency Tel No. is empty");
		return false;

	}

	var emergencyAddr = document.forms["addForm"]["emergencyAddr"].value;
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
 		<h2>Add Employee</h2><br>

<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" class="table table-bordered">
<tr>
	<td align="center">
		<form name="addForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm()">
		<table width="100%" border="0" cellspacing="1" cellpadding="3" class="table table-bordered">
			<tr>
				<td colspan="3"><strong>Personal Particular</strong></td>
			</tr>
			<tr>
				<td width="200">Name* : </td>
				<td width="301"><input name="name" type="text" id="name"><span class="error"><?php echo $nameErr;?></span></td>
			</tr>
			<tr>
				<td>Title* : </td>
				<td width="301"><input name="title" type="text" id="title"><span class="error"><?php echo $titleErr;?></span></td>
			</tr>
			<tr>
				<td>CIMB Account Number* :</td>
				<td><input name="cimbAcc" type="text" id="cimbAcc"><span class="error"><?php echo $cimbAccErr;?></span></td>

			</tr>
			<tr>
				<td>NRIC/Passport No* :</td>
				<td><input name="icNo" type="text" id="icNo" maxlength="15"><?php echo $icNoErr;?></span></td>
			</tr>
			<tr>
				<td>Gender* :</td>
				<td><select name="gender" type="text" id="gender" class="required">
					<option selected disabled value="0">Choose a Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					</select>
					<span class="error"><?php echo $genderErr;?></span>
				</td>
			</tr>
			<tr>
				<td>Citizenship* :</td>
				<td><input name="citizenship" type="text" id="citizenship"><span class="error"><?php echo $citizenshipErr;?></span></td>
			</tr>
			<tr>
				<td>EPF No :</td>
				<td><input name="epfNo" type="text" id="epfNo" maxlength="10"></td>
			</tr>
			<tr>
				<td>Socso No :</td>
				<td><input name="socsoNo" type="text" id="socsoNo" maxlength="15"></td>
			</tr>
			<tr>
				<td>Income Tax No :</td>
				<td><input name="incomeTaxNo" type="text" id="incomeTaxNo" maxlength="15"></td>
			</tr>
			<tr>
				<td>Date of Birth* :</td>
				<td><input name ="dob" type="text" class="datepicker"><span class="error"><?php echo $dobErr;?></span></td>
			</tr>
			<tr>
				<td>Marital Status* :</td>
				<td><select name="marital" type="text" id="marital" class="required">
				<option selected disabled value="0">Choose a Status</option>
					<option value="Single">Single</option>
					<option value="Married">Married</option>
					<option value="Divorced">Divorced</option>
					<option value="Windowed">Windowed</option>
					</select>
					<span class="error"><?php echo $maritalErr;?></span>
				</td>
			</tr>
			<tr>
				<td>Permanent Address* :</td>
				<td><textarea class="form-control", style="resize: none" rows ="4" column="50" name="permaAddr"  id="permaAddr"></textarea><span class="error"><?php echo $permaAddrErr;?></span></td>
			</tr>
			<tr>
				<td>Residential Address :</td>
				<td><textarea class="form-control", style="resize: none" rows ="4" column="50" name="residentialAddr"  id="residentialAddr"></textarea></td>
			</tr>
			<tr>
				<td>Tel No. (House) :</td>
				<td><input name="telNo" type="text" id="telNo"></td>
			</tr>
			<tr>
				<td>Handphone No* :</td>
				<td><input name="handphoneNo" type="text" id="handphoneNo"><span class="error"><?php echo $handphoneNoErr;?></span></td>
			</tr>
			<tr>
				<td>Join Date* :</td>
				<td><input name="joinDate" type="text" class="datepicker"><span class="error"><?php echo $joinDateErr;?></span></td>
			</tr>
			<tr>
				<td>Confirmation Date :</td>
				<td><input name="confirmDate" type="text" class="datepicker"></td>
			</tr>
			<tr>
				<td>Email :</td>
				<td><input name="email" type="text" id="email"></td>
			</tr>
			
			<tr>
				<td>Resign Date :</td>
				<td><input name="resignDate" type="text" class="datepicker"></td>
			</tr>
			<tr>
				<td colspan="3"><strong>Incase of Emergency, Notify:</strong></td>
			</tr>
			<tr>
				<td>Name* : </td>
				<td><input name="emergencyName" type="text" id="emergencyName"><span class="error"><?php echo $nameErr;?></span></td>
			</tr>
			<tr>
				<td>Relationship* : </td>
				<td><input name="relationship" type="text" id="relationship"><span class="error"><?php echo $relationshipErr;?></span></td>

			</tr>
			<tr>
				<td>Tel No* : </td>
				<td><input name="emergencyTel" type="text" id="emergencyTel"><span class="error"><?php echo $emergencyTelErr;?></span></td>
			</tr>
			<tr>
				<td>Address* : </td>
				<td><textarea class="form-control", style="resize: none" rows ="4" column="50" name="emergencyAddr"  id="emergencyAddr"></textarea><span class="error"><?php echo $emergencyAddrErr;?></span></td>
			</tr>
		</table>

		<button type="submit" value = "Submit"> Submit </button>	
		<button type="button"><a href="index.php"> Cancel </a></button>
		</td>
	</form>
	</tr>
	</table>

	</div>
	</div>
</body>
</html> 