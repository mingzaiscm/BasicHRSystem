<?php
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
	}
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	
	if(isset($permission)):
		if(in_array('4', $permission)):
			include('../includes/dbfunctions.php');
			include("../includes/functions.php");
			include("../includes/datadef.php");
	
			$db = initdb();
			if($_SERVER['REQUEST_METHOD'] == 'POST') :
				
				extract($_POST);
				$createdBy = $employeeCode;
				$days = (double)$days;
				$status = $appStatus[0];
				
				if($days == 0.5)
					$dateTo = $dateFrom;
				$yearOfDate = substr($dateFrom, 0, 4);
				
				$sql = 'SELECT dateFrom, dateTo FROM LeaveApplication WHERE createdBy = ? AND status IN ("Pending", "Approved") AND YEAR(dateFrom) = ?;';
				$stmt = $db->prepare($sql);
				$stmt -> bind_param('si', $createdBy, $yearOfDate);
				$stmt -> execute();
				$stmt -> store_result();
				$stmt -> bind_result($checkDateFrom, $checkDateTo);
				
				$same = false;
				while($stmt->fetch()){
					
					if(($dateFrom >= $checkDateFrom && $dateFrom >= $checkDateTo)
						|| ($dateTo >= $checkDateFrom && $dateTo >= $checkDateTo))
						$same = true;
				}
					
				if(!$same){
					$sql = 'INSERT INTO LeaveApplication (leaveType, dateFrom, dateTo, days, reason, status, createdBy, createdDate) VALUES (?, ?, ?, ?, ?, ?, ?, now());';
					$stmt = $db->prepare($sql);
					$stmt->bind_param('sssdsss', $leaveType, $dateFrom, $dateTo, $days, $reason, $status, $createdBy);

					if($stmt->execute()){
						header('Location: index.php');
					}
					else {
						echo "Some error occured. Please check your input.";
					}
					exit;
				}
				else{
					header('Location: errorApplication.php');
				}
			else :
				/*  
				 *   Obtain Leave Type that is active
				 */
				$sql = 'SELECT leaveType FROM LeaveType WHERE enabled = 1 
				ORDER BY 
					(CASE 
						WHEN leaveType = "Annual Leave" THEN "0" 
						ELSE leaveType
					END) ASC;';
				$stmt = $db->prepare($sql);
				$stmt -> execute();
				$stmt -> store_result();
				$stmt -> bind_result($leaveTypeName);
				while($stmt->fetch())
					$leaveTypes[$leaveTypeName] = $leaveTypeName;

				/*  
				 *   Obtain Entitlement, Taken, Balance
				 */
				$year = (int)date('Y');
				$lastDay = mktime(0,0,0,12,31,$year);
				$esql = 'SELECT leaveType, entitlement, taken, entitlement - taken AS balance FROM LeaveEntitlement WHERE year = ? AND employeeCode = ?;';
				$stmt = $db->prepare($esql);
				$stmt -> bind_param('is', $year, $employeeCode);
				$stmt -> execute();
				$stmt -> store_result();
				$stmt -> bind_result($leaveTypeName, $entitlement, $taken, $balance);
				while($stmt->fetch()):
					$entitlements[$leaveTypeName] = [
						'entitlement' => $entitlement,
						'taken' => $taken,
						'balance' => $balance
					];
				endwhile;
				
				/*  
				 *   Obtain CF Leave
				 */
				$leaveType = '';
				$cfsql = 'SELECT days FROM CFLeave WHERE year = ? AND employeeCode = ?;';
				$stmt = $db -> prepare($cfsql);
				$stmt -> bind_param('is', $year, $employeeCode);
				$stmt -> execute();
				$stmt -> store_result();
				$stmt -> bind_result($CF);
				if(!$stmt -> fetch())
					$CF = 0;
				$year = (int)date('Y');
				/*  
				 *   Obtain Holiday Schedule
				 */
				$hssql = 'SELECT DAY(hsDate), MONTH(hsDate), hsDesc FROM HolidaySchedule WHERE YEAR(hsDate) = ? AND enabled = 1 ORDER by hsDate;';
				$stmt = $db -> prepare($hssql);
				$stmt -> bind_param('i', $year);
				$stmt -> execute();
				$stmt -> store_result();
				$stmt -> bind_result($hDay, $hMonth, $hDesc);
				
				$holiday = [];
				$holidayDesc = [];

				while($stmt->fetch()){
					$hMonth = str_pad($hMonth, 2, "0", STR_PAD_LEFT);
					$hDay = str_pad($hDay, 2, "0", STR_PAD_LEFT);
					
					$holidayString = $year . '-' . $hMonth . '-' . $hDay;
					$holidayDesc[$holidayString] = $hDesc;

					array_push($holiday, $holidayString);
				}
				$holiday = implode('/', $holiday);
				
				include('form.php');
			endif;
		else:		
			echo 'You do not have the permission to access this page';
		endif;
	endif;
?>