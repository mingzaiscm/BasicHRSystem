<?php
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
	}
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	
	if(isset($permission)):
		if(in_array('7', $permission)):
			include('../includes/dbfunctions.php');
			include("../includes/functions.php");
			include("../includes/datadef.php");
	
			$db = initdb();
			if($_SERVER['REQUEST_METHOD'] == 'POST') :
				extract($_POST);
				$createdBy = $modifiedBy = $employeeCode;
				/*
				 *  Get All Leave Type that is active
				 */
				$leaveTypes = [];
				$sql = 'SELECT leaveType, criteria, porata, days FROM LeaveType WHERE enabled = 1';
				$stmt1 = $db->prepare($sql);
				$stmt1->execute();
				$stmt1->store_result();
				$stmt1->bind_result($leaveType, $criteria, $porata, $days);
				
				/*
				 *  Get All Criterias For LeaveType that is active
				 */
				$sql = 'SELECT yearFrom, yearTo, days FROM LeaveCriteria WHERE enabled = 1 AND leaveType = ?';
				$stmt2 = $db->prepare($sql);
				$stmt2->bind_param('s', $leaveType);
				while($stmt1->fetch()){
					$criterias = [];
					if($criteria == 1){
						$stmt2->execute();
						$stmt2->bind_result($yearFrom, $yearTo, $days);
						$stmt2->store_result();
						while($stmt2->fetch()){
							$criteriaOne = [$yearFrom, $yearTo, $days];
							array_push($criterias, $criteriaOne);
						}
					}
					$leave = [$leaveType, $criteria, $porata, $days, $criterias];
					array_push($leaveTypes, $leave);
				}
				/*
				 *  Get All Employee who is not inactive
				 */
				$sql = 'SELECT employeeCode, joinDate FROM Employee WHERE NOT (employeeCode = "admin" OR status = "Inactive");';
				$stmt3 = $db->prepare($sql);
				$stmt3->execute();
				$stmt3->store_result();
				$stmt3->bind_result($employeeCode, $joinDate);
				$employees = [];
				while($stmt3->fetch()){
					$employee = [$employeeCode, $joinDate];
					array_push($employees, $employee);
				}

				/*
				 *  Insert computed entitlement into database
				 */
				$sql = 'INSERT INTO LeaveEntitlement 
						(year, leaveType, employeeCode, entitlement, taken, createdBy, createdDate)
						VALUES (?, ?, ?, ?, ?, ?, now());';
				$stmt4 = $db->prepare($sql);
				$stmt4->bind_param('issdds', $year, $leaveType, $employeeCode, $entitlement, $taken, $createdBy);
				
				/*
				 *  Update entitlement in database
				 */
				$sql = 'UPDATE LeaveEntitlement SET entitlement = ?, modifiedBy = ?, modifiedDate = now() 
						WHERE year = ? AND leaveType = ? AND employeeCode = ?;';
				$stmt5 = $db->prepare($sql);
				$stmt5->bind_param('dsiss', $entitlement, $modifiedBy, $year, $leaveType, $employeeCode);
				 
				/*
				 *  Computation and Insertion
				 */ 
				$taken = 0;
				foreach($leaveTypes as $leave){
					$leaveType = $leave[0];
					if($leave[1] == 0){
						foreach($employees as $employee){
							$employeeCode = $employee[0];
							$entitlement = $leave[3];
							if(!$stmt4->execute())
								$stmt5->execute();
						}
					}
					else{
						$startDate = mktime(0, 0, 0, 12, 31, $year);
						if($leave[2] == 0){
							foreach($employees as $employee){
								$employeeCode = $employee[0];
								$workedYears = ($startDate - strtotime($employee[1])) / (60 * 60 * 24 * 365);
								$entitlement = 0;
								$x = 0;
								$found = false;
								while($x < sizeof($leave[4]) && !$found){
									if($workedYears >= $leave[4][$x][0] && $workedYears < $leave[4][$x][1]){
										$found = true;
										$entitlement = $leave[4][$x][2];
									}
									$x++;
								}
								if(!$found)
									$entitlement = 0;
								if(!$stmt4->execute())
									$stmt5->execute();
							}
						}
						else{
							foreach($employees as $employee){
								$employeeCode = $employee[0];
								$joinDate = explode('-', $employee[1]);
								$workedYears = $year - (int)$joinDate[0];
								$entitlement = 0;
								$x = 0;
								$found = false;
								while($x < sizeof($leave[4]) && !$found){
									if($workedYears == $leave[4][$x][0]){
										if($x != 0){
											if($workedYears == ($leave[4][$x-1][1])){
												$found=true;
												$cmonth1 = setMonth((int)$joinDate[1], (int)$joinDate[2]);
												$cmonth2 = 12 - $cmonth1;
												$entitlement = $cmonth1 / 12 * $leave[4][$x][2] + 
															$cmonth2 / 12 * $leave[4][$x-1][2];
											}
										}
										else{
											$found = true;
											$cmonth = setMonth((int)$joinDate[1], (int)$joinDate[2]);
											$workedMonth = 12 - $cmonth;
											$entitlement = $workedMonth / 12 * $leave[4][$x][2];
										}
										$decimal = $entitlement - (int)$entitlement;
										if($decimal < 0.3)
											$entitlement = (int)$entitlement;
										else if($decimal >0.7)
											$entitlement = (int)$entitlement + 1;
										else{
											$entitlement = (int)$entitlement + 0.5;
										}
									}
									else if($workedYears > $leave[4][$x][0] && $workedYears < $leave[4][$x][1]){
										$found = true;
										$entitlement = $leave[4][$x][2];
									}
									$x++;
								}
								if(!$stmt4->execute())
									$stmt5->execute();
							}
						}
					}
				}
				header('Location: index.php');
				exit;
			else :	
				include('form.php');
			endif;
		else:		
			echo 'You do not have the permission to access this page';
		endif;
	endif;
			
	function setMonth($month, $day){
		if($day <= 10)
			$month = $month - 1;
		else if ($day <=20)
			$month = $month - 0.5;
		else
			$month = $month;
		return $month;
	}
?>