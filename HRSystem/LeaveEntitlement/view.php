<!DOCTYPE html>
<html>
<head>
	<?php 
		include('../includes/_header.php'); 
	?>
</head>

<body>
	<div id="wrapper">
		<?php include("../includes/_menu.php"); ?>
		<div id ="page-wrapper">
			<div class="col-lg-12">
<?php
	include('../includes/dbfunctions.php');
	include("../includes/datadef.php");
	
	$db = initdb();
	$leaveType = $_GET['leaveType'];
	$leaveType = str_replace('%20', ' ', $leaveType);
	$employeeCode = $_GET['code'];
	$year = (int) Date('Y');
	
	$sql1 = 'SELECT name, entitlement, taken, balance 
		FROM
			(SELECT employeeCode, name
			FROM Employee
			WHERE employeeCode = ?) e 
		INNER JOIN
			(SELECT employeeCode, entitlement, taken, entitlement - taken AS balance
			FROM LeaveEntitlement
			WHERE year = ? AND employeeCode = ? AND leaveType = ?) le 
		ON e.employeeCode = le.employeeCode;';
	$stmt1 = $db->prepare($sql1);
	$stmt1->bind_param('siss', $employeeCode, $year, $employeeCode, $leaveType);
	$stmt1->execute();
	$stmt1->bind_result($name, $entitlement, $taken, $balance);
	$stmt1->store_result();
	$stmt1->fetch();
	
	
	
	if($leaveType == 'Annual Leave'){
		$sql2 = 'SELECT days FROM CFLeave WHERE year = ? AND employeeCode = ?;';
		$stmt2 = $db->prepare($sql2);
		$stmt2->bind_param('is', $year, $code);
		$stmt2->execute();
		$stmt2->bind_result($CF);
		$stmt2->store_result();
		if($stmt2->fetch())
			$balance = (double)$balance + (double)$CF;
		else
			$CF = 0;
		$detail = [
			'Employee Code' => $employeeCode,
			'Employee Name' => $name,
			'CF' => $CF,
			'Entitlement' => $entitlement,
			'Taken' => $taken, 
			'Balance' => $balance
		];
	}
	else{
		$detail = [
			'Employee Code' => $employeeCode,
			'Employee Name' => $name,
			'Entitlement' => $entitlement,
			'Taken' => $taken, 
			'Balance' => $balance
		];
	}
?>
			<button type = "button" onClick = "javascript:window.location = 'index.php';">Back</button>
			<h3><?= $leaveType ?> Details</h3>
			<table class = "table table-striped table-bordered table-hover">
				<tbody>
				<?php
					foreach($detail as $key => $val):
				?>
					<tr>
						<td><?=$key?></td>
						<td><?=$val?></td>
					</tr>
				<?php
					endforeach;
				?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</body>
</html>
