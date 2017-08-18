<?php
	include('../includes/dbfunctions.php');
	include("../includes/datadef.php");
	
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
	}
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	
	$db = initdb();

	$sql = 'SELECT leaveId, employeeCode, name, leaveType, dateFrom, dateTo, days, reason, status
		FROM
			(SELECT leaveId, leaveType, dateFrom, dateTo, days, status, createdBy, reason
			FROM LeaveApplication
			WHERE leaveId = ?) la
		INNER JOIN
			(SELECT employeeCode, name FROM Employee) e
		ON e.employeeCode = la.createdBy;';
	$stmt = $db->prepare($sql);
		
	$stmt->bind_param('i', $leaveId);
		
	$leaveId = (int)$_GET['leaveId'];
		
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($leaveId, $employeeCode, $name, $leaveType, $dateFrom, $dateTo, $days, $reason, $status);
	$stmt->fetch();
	
	/*  
	 *   Obtain Entitlement, Taken, Balance
	 */
	$year = (int)date('Y');
	
	$esql = 'SELECT entitlement, taken, entitlement - taken AS balance FROM LeaveEntitlement WHERE year = ? AND employeeCode = ? AND leaveType = ?;';
	$stmt = $db->prepare($esql);
	$stmt -> bind_param('iss', $year, $employeeCode, $leaveType);
	$stmt -> execute();
	$stmt -> store_result();
	$stmt -> bind_result($entitlement, $taken, $balance);
	$stmt -> fetch();
	$leaveApp = [
		'Leave Id' => $leaveId,
		'Employee Code' => $employeeCode,
		'Employee Name' => $name,
		'Leave Type' => $leaveType,
		'Date From' => $dateFrom,
		'Date To' => $dateTo,
		'days' => $days,
		'Reason' => $reason,
		'Status' => $status,
		'Entitlement' => $entitlement,
		'Taken' => $taken,
		'Balance' => $balance
	];
	if($leaveType == 'Annual Leave'){
		$cfsql = 'SELECT days FROM CFLeave WHERE year = ? AND employeeCode = ?;';
		$stmt = $db -> prepare($cfsql);
		$stmt -> bind_param('is', $year, $employeeCode);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> bind_result($CF);
		$stmt -> fetch();
		if(!isset($CF))
			$CF = 0;
		$leaveApp['CF'] = $CF;
		$leaveApp['Balance'] = (double)$balance + (double)$CF;
	}
	
	include('viewPage.php');
?>