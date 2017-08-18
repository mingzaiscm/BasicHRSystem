<?php
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
	}
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	
	if(isset($permission)):
		if(in_array('6', $permission)):
			include('../includes/dbfunctions.php');
			include("../includes/functions.php");
			include("../includes/datadef.php");
			
			$db = initdb();
			
			$status = (int)$_GET['status'];
			$status = $appStatus[$status];
			$leaveId = (int)$_GET['leaveId'];
			$modifiedBy = 'admin';
			
			if($status == $appStatus[1] || $status == $appStatus[3]){
				/*
				 *  Obtain leave detail
				 */
				$sql = 'SELECT leaveType, days, status, createdBy FROM LeaveApplication WHERE leaveId = ?;';
				$stmt = $db->prepare($sql);
				$stmt->bind_param('i', $leaveId);
				$stmt->execute();
				$stmt->bind_result($leaveType, $days, $prevStatus, $employeeCode);
				$stmt->store_result();
				$stmt->fetch();
			}

			$sql = 'UPDATE LeaveApplication SET status = ?, modifiedBy = ?, modifiedDate = now() WHERE leaveId = ?;';
			$stmt = $db->prepare($sql);
			$stmt->bind_param('ssi', $status, $modifiedBy, $leaveId);
			
			if($stmt->execute()){
				if($status == $appStatus[1] || 
					($status == $appStatus[3] && $prevStatus == $appStatus[1])
					){
					$year = (int)date('Y');
					 
					/*
					 *  Obtain leave taken
					 */
					$sql = 'SELECT taken FROM LeaveEntitlement WHERE year = ? AND leaveType = ? AND employeeCode = ?;';
					$stmt = $db->prepare($sql);
					$stmt->bind_param('iss', $year, $leaveType, $employeeCode);
					$stmt->execute();
					$stmt->bind_result($taken);
					$stmt->store_result();
					$stmt->fetch();
					
					/*
					 *  Calculate new Leave Taken
					 */
					if($status == $appStatus[1])
						$taken = (double)$taken + $days;
					else
						$taken = (double)$taken - $days;
					
					/*
					 *  Update Leave Entitlement
					 */
					$sql = 'UPDATE LeaveEntitlement SET taken = ?, modifiedBy = ?, modifiedDate = now() WHERE year = ? AND leaveType = ? AND employeeCode = ?;';
					$stmt = $db->prepare($sql);
					$stmt->bind_param('dsiss', $taken, $modifiedBy, $year, $leaveType, $employeeCode);
					$stmt->execute();
				}
				header('Location: index.php');
				
			}
			else{
				echo "sth wrong";
			}
		else:		
			echo 'You do not have the permission to access this page';
		endif;
	endif;
?>