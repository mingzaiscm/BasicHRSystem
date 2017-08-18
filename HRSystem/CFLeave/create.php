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
				
				foreach($cf as $code => $days){
					if(!$stmt1->execute()){
						$stmt2->execute();
					}
				}
				
				header('Location: index.php');
				exit;
			else :
				/*
				 *  Obtain Employee who are active, not admin and join more than before the set year.
				 */
				$thisYear = (int) Date('Y');
				$sql1 = 'SELECT employeeCode, name 
					FROM  Employee WHERE NOT (employeeCode = "admin" OR status = "Inactive") AND YEAR(joinDate) < ?;';
				$stmt1 = $db->prepare($sql1);
				$stmt1->bind_param('i', $year);
				
				$year = $thisYear;
				$stmt1->execute();
				$stmt1->store_result();
				$stmt1->bind_result($code, $name);
				
				/*
				 *  Obtain the Annual Leave balance from employee
				 */
				$prevYear = $thisYear - 1;
				$sql2 = 'SELECT entitlement - taken AS balance FROM LeaveEntitlement WHERE employeeCode = ? AND year = ? AND leaveType = "Annual Leave";';
				$stmt2 = $db->prepare($sql2);
				$stmt2->bind_param('si', $code, $year);
				
				/*
				 *  Obtain CF of the specified year from employee
				 */
				$sql3 = 'SELECT days FROM CFLeave WHERE employeeCode = ? AND year = ?;';
				$stmt3 = $db->prepare($sql3);
				$stmt3->bind_param('si', $code, $year);
				
				$array = [];
				while($stmt1->fetch()){
					$year = $prevYear;
					$stmt2->execute();
					$stmt2->store_result();
					$stmt2->bind_result($balance);
					$stmt2->fetch();
								
					$stmt3->execute();
					$stmt3->store_result();
					$stmt3->bind_result($cf);
					if($stmt3->fetch())
						$balance = (double)$balance + (double)$cf;
					
					$employee = [
						'code' => $code,
						'name' => $name,
						'balance' => $balance,
						];
						
					$year = $thisYear;
					$stmt3->execute();
					$stmt3->store_result();
					$stmt3->bind_result($cf);
					if($stmt3->fetch())
						$employee['cfSet'] = $cf;
					
					array_push($array, $employee);
				}
				include('form.php');
			endif;
		else:		
			echo 'You do not have the permission to access this page';
		endif;
	endif;
?>