<?php
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
	}
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	
	if(isset($permission)):
		if(in_array('10', $permission)):
			include('../includes/dbfunctions.php');
			include("../includes/functions.php");
			include("../includes/datadef.php");
			$db = initdb();
			
			if($_SERVER['REQUEST_METHOD'] == 'POST') :
			
				extract($_POST);
				$modifiedBy = $employeeCode;
				$createdBy = $employeeCode;
				$criteria = (int)$criteria;
				if($criteria == 0){
					$porata = 0;
					$days = (int)$days;
				}
				else {
					$porata = (int)$porata;
					$days = null;
				}	
				
				$sql = 'UPDATE LeaveType SET criteria = ?, porata = ?, days = ?, enabled = ?, modifiedBy = ?, modifiedDate = now() WHERE leaveType = ?;';
				$stmt = $db->prepare($sql);
				$stmt->bind_param('iiiiss', $criteria, $porata, $days, $enabled, $modifiedBy, $leaveType);
				
				if($stmt->execute()):	
					if($criteria == 1){
						$csql = 'INSERT INTO LeaveCriteria
								(leaveType, yearFrom, yearTo, days, enabled, createdBy, createdDate)
								VALUES(?, ?, ?, ?, ?, 1, now());';
						$stmt = $db->prepare($csql);
						$stmt->bind_param('siiis', $leaveType, $yearFrom, $yearTo, $days, $createdBy);
						
						$gsql = 'SELECT criteriaId FROM LeaveCriteria ORDER BY criteriaId DESC LIMIT 1;';
						$stmt2 = $db->prepare($gsql);
						
						
						$ids = [];
						foreach($criterias as $criteriaOne){
							$criteriaVal = explode("XXYYXX", $criteriaOne);
							$yearFrom = (int)$criteriaVal[0];
							$yearTo = (int)$criteriaVal[1];
							$days = (int)$criteriaVal[2];
							$criteriaId = $criteriaVal[3];
							
							if($criteriaId != ''){
								$criteriaId = (int)$criteriaId;
							}
							else{
								$stmt->execute();

								$stmt2->execute();
								$stmt2->store_result();
								$stmt2->bind_result($criteriaId);
								$stmt2->fetch();
							}
							array_push($ids, $criteriaId);
						}
						$idString = implode(', ', $ids);
						$dsql = 'UPDATE LeaveCriteria SET enabled = 0, modifiedBy = ?, modifiedDate = now()
								WHERE leaveType = ? AND criteriaId NOT IN (' . $idString . ');';
								
						$stmt = $db->prepare($dsql);
						$stmt->bind_param('ss', $modifiedBy, $leaveType);
						$stmt->execute();
						
					}
					else{
						$csql = 'UPDATE LeaveCriteria SET enabled = 0, modifiedBy = ?, modifiedDate = now() WHERE leaveType = ?;';
						$stmt = $db->prepare($csql);
						$stmt->bind_param('ss', $modifiedBy, $leaveType);
						$stmt->execute();
					}
					header('Location: index.php');
				else:
					header('Location: index.php');
					echo "Some error occured. Please check your input.";
				endif;
				exit;
				
			else :
				
				$sql = 'SELECT criteria, porata, days, enabled FROM LeaveType WHERE leaveType = ? ;';
				$stmt = $db->prepare($sql);
				
				$stmt->bind_param('s', $leaveType);
				
				$leaveType = $_GET['leaveType'];
				$leaveType = str_replace('%20', ' ', $leaveType);
				
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($criteria, $porata, $days, $enabled);
				$stmt->fetch();
				
				if($criteria == 1){
					$csql = 'SELECT criteriaId, yearFrom, yearTo, days FROM LeaveCriteria WHERE leaveType = ? AND enabled = 1;';
					$stmt = $db->prepare($csql);
							
					$stmt->bind_param('s', $leaveType);
						
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($criteriaId, $yearFrom, $yearTo, $cdays);
				}
				
				include('form.php');
			endif;
		else:		
			echo 'You do not have the permission to access this page';
		endif;
	endif;
?>