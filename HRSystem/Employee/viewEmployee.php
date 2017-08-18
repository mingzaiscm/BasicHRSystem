<!DOCTYPE html>
<html>
<head>
<?php 
		include('../includes/_header.php');
	?>
</head>


<script>
function validateForm() {

}	
</script>
<body>
	<div id="wrapper">
 		<?php include("../includes/_menu.php"); ?>
 		<div id ="page-wrapper">

		<?php
			
			require("dbconnect.php");

			if($_GET['employeeCode']) {
				$employeeCode = $_GET['employeeCode'];
					$sql = "SELECT * FROM Employee WHERE employeeCode = '{$employeeCode}'";
					$result = $mysqli->query($sql);
					$data = $result->fetch_assoc();
			}

		?>
		<table width="100%" border="0" cellspacing="1" cellpadding="3" class="table table-striped table-bordered table-hover">
			<tr>
				<td colspan="3"><strong>Personal Particular</strong></td>
			</tr>
			<tr>
				<td width="200">Name : </td>
				<td width="300"><?php echo $data["name"]; ?></td>
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
								<td><?php echo $data["marital"]; ?></td>

			</tr>
			<tr>
				<td>Permanent Address* :</td>
								<td><?php echo $data["permaAddr"]; ?></td>

			</tr>
			<tr>
				<td>Residential Address :</td>
								<td><?php echo $data["residentialAddr"]; ?></td>

			</tr>
			<tr>
				<td>Tel No. (House) :</td>
								<td><?php echo $data["telNo"]; ?></td>

			</tr>
			<tr>
				<td>Handphone No* :</td>
								<td><?php echo $data["handphoneNo"]; ?></td>

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
								<td><?php echo $data["email"]; ?></td>

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
				<td>Name : </td>
								<td><?php echo $data["emergencyName"]; ?></td>

			</tr>
			<tr>
				<td>Relationship : </td>
				<td><?php echo $data["relationship"]; ?></td>

			</tr>
			<tr>
				<td>Tel No : </td>
				<td><?php echo $data["emergencyTel"]; ?></td>

			</tr>
			<tr>
				<td>Address : </td>
					<td><?php echo $data["emergencyAddr"]; ?></td>

			</tr>
		</table>
		<button type="button" style=" margin:auto; display: block"><a href="index.php"> Cancel </a></button>
	</div>
	</div>
</body>
</html> 