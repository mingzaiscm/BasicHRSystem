<?php
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
	}
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	
	if(isset($permission)):
		if(in_array('12', $permission)):
			include('../includes/dbfunctions.php');
			include("../includes/functions.php");
			include("../includes/datadef.php");
	
			$db = initdb();
			
			if($_SERVER['REQUEST_METHOD'] == 'POST') :
				extract($_POST);
				$createdBy = $modifiedBy = $employeeCode;
				
				$sql1 = 'INSERT INTO CFLeave (year, employeeCode, days, createdBy, createdDate) VALUES (?, ?, ?, ?, now());';
				$stmt1 = $db->prepare($sql1);
				$stmt1->bind_param('isds', $year, $code, $days, $createdBy);
				
				$sql2 = 'UPDATE CFLeave SET days = ?, modifiedBy = ?, modifiedDate = now() WHERE year = ? AND employeeCode = ?;';
				$stmt2 = $db->prepare($sql2);
				$stmt2->bind_param('dsis', $days, $modifiedBy, $year, $code);
				
				if(!$stmt1->execute()){
					$stmt2->execute();
				}
				header('Location: index');
				exit;
			else :
				$code = $_GET['code'];
				
				/*
				 *  Obtain Employee's name and Annual Leave balance
				 */
				$thisYear = (int) Date('Y');
				$prevYear = $thisYear - 1;
				
				$sql1 = 'SELECT name, balance 
					FROM 
						(SELECT employeeCode, name 
						FROM Employee 
						WHERE employeeCode = ?) e
					INNER JOIN
						(SELECT employeeCode, entitlement - taken AS balance 
						FROM LeaveEntitlement
						WHERE employeeCode = ? AND year = ? AND leaveType = "Annual Leave") le
					ON
						e.employeeCode = le.employeeCode;';
				$stmt1 = $db->prepare($sql1);
				$stmt1->bind_param('ssi', $code, $code, $year);
				
				$year = $prevYear;
				$stmt1->execute();
				$stmt1->store_result();
				$stmt1->bind_result($name, $balance);
				$stmt1->fetch();
				
				/*
				 *  Obtain CF of the specified year from employee
				 */
				$sql2 = 'SELECT days FROM CFLeave WHERE employeeCode = ? AND year = ?;';
				$stmt2 = $db->prepare($sql2);
				$stmt2->bind_param('si', $code, $year);
				$stmt2->execute();
				$stmt2->store_result();
				$stmt2->bind_result($CF);
				if($stmt2->fetch())
					$balance = (double)$balance + (double)$CF;
				else
					$balance = (double)$balance;
				
				$year = $thisYear;
				$stmt2->execute();
				$stmt2->bind_result($CF);
				if(!$stmt2->fetch())
					$CF = null;
				
				include('updateForm.php');
			endif;
		else:		
			echo 'You do not have the permission to access this page';
		endif;
	endif;
?>