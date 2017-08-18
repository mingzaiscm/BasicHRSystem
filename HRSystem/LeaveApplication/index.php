<?php
	include('../includes/dbfunctions.php');
	include("../includes/datadef.php");
	
	session_start();
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	/*
	 *  Get All current year LeaveApplication 
	 */
	$db = initdb();
	$year = (int) Date('Y');
	if(isset($permission)):
		$sql = 'SELECT leaveId, employeeCode, name, leaveType, dateFrom, dateTo, days, status
		FROM
			(SELECT leaveId, leaveType, dateFrom, dateTo, days, status, createdBy 
			FROM LeaveApplication
			WHERE YEAR(dateFrom) = ? AND createdBy = ?) la
		INNER JOIN
			(SELECT employeeCode, name 
			FROM Employee
			WHERE NOT (employeeCode = "admin" OR status = "Inactive") 
			) e
		ON e.employeeCode = la.createdBy
		ORDER BY 
			(CASE 
				WHEN status = "Pending" THEN "0" 
				WHEN status = "Approved" THEN "1"
				WHEN status = "Disapproved" THEN "2"
				WHEN status = "Cancelled" THEN "3"
			END), dateFrom ASC;';
		if($stmt = $db->prepare($sql))
			$stmt->bind_param('is', $year, $employeeCode);
		else
			die("error : " . $db->error);
		
		$stmt->execute();
		$stmt->bind_result($leaveId, $employeeCode, $name, $leaveType, $dateFrom, $dateTo, $days, $status);
		
		foreach($appStatus as $stat)
			$row[$stat] = 0;
			
		while($stmt->fetch()) {
			$leaveApp[$status][$row[$status]] = [$leaveId, $employeeCode, $name, $leaveType, $dateFrom, $dateTo, $days];
			$row[$status]++;
		}
		
		/*  
		 *   Obtain Entitlement, Taken, Balance
		 */
		$year = (int)date('Y');
		$esql = 'SELECT entitlement, taken, entitlement - taken AS balance 
			FROM LeaveEntitlement 
			WHERE year = ? AND employeeCode = ? AND leaveType = ?;';
		$stmt1 = $db->prepare($esql);
		$stmt1 -> bind_param('iss', $year, $employeeCode, $leaveType);
		
		
		/*  
		 *   Obtain CF Leave
		 */
		$cfsql = 'SELECT days FROM CFLeave WHERE year = ? AND employeeCode = ?;';
		$stmt2 = $db -> prepare($cfsql);
		$stmt2 -> bind_param('is', $year, $employeeCode);
		include('indexPage.php');
	else:
		echo 'Role not set. Please consult the HR department';
	endif;
?>
