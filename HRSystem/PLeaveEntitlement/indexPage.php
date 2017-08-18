<?php
	include('../includes/dbfunctions.php');
	include("../includes/datadef.php");
		
	$db = initdb();
	
	if(isset($permission)):
		$year = (int) Date('Y');

		$sql1 = 'SELECT e.employeeCode, name, leavetype, entitlement, taken, balance 
			FROM
				(SELECT employeeCode, name
				FROM Employee
				WHERE employeeCode = ?) e
			INNER JOIN
				(SELECT employeeCode, le.leaveType, entitlement, taken, entitlement - taken AS balance
				FROM (
						(SELECT employeeCode, leaveType, entitlement, taken
						FROM LeaveEntitlement
						WHERE year = ?
						) le
					INNER JOIN
						(SELECT leaveType FROM LeaveType WHERE enabled = 1) lt
					ON le.leaveType = lt.leaveType
					)
				) le 
			ON e.employeeCode = le.employeeCode;';
		$stmt1 = $db->prepare($sql1);
		$stmt1->bind_param('si', $employeeCode, $year);
		
		$stmt1->execute();
		$stmt1->bind_result($code, $name, $leaveType, $entitlement, $taken, $balance);
		$stmt1->store_result();
		
		$sql2 = 'SELECT days FROM CFLeave WHERE year = ? AND employeeCode = ?;';
		$stmt2 = $db->prepare($sql2);
		$stmt2->bind_param('is', $year, $code);
		
		$sql3 = 'SELECT distinct leaveType FROM LeaveType WHERE enabled = 1
			ORDER BY 
				(CASE 
					WHEN leaveType = "Annual Leave" THEN "0" 
					ELSE leaveType
				END) ASC';
		$stmt3 = $db->prepare($sql3);
		$stmt3->execute();
		$stmt3->bind_result($type);
		$stmt3->store_result();
		
		while($stmt3->fetch()){
			$row[$type] = 0;
		}
		while($stmt1->fetch()){
			if(!isset($row[$leaveType]))
				$row[$leaveType] = 0;
			if($leaveType == 'Annual Leave'){
				$stmt2->execute();
				$stmt2->bind_result($CF);
				$stmt2->store_result();
				if(!$stmt2->fetch())
					$CF = 0;
				else
					$balance = (double)$balance + (double)$CF;
				$details[$leaveType][$row[$leaveType]] = [$code, $name, $CF, $entitlement, $taken, $balance];
			}
			else{
				$details[$leaveType][$row[$leaveType]] = [$code, $name, $entitlement, $taken, $balance];
			}
			
			$row[$leaveType]++;
		}
		include('reportPage.php');
	else:
		echo 'Role not set. Please consult HR department';
	endif;
?>