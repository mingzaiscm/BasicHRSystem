<?php
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
	}
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	
	if(isset($permission)):
		if(in_array('9', $permission)):
			include('../includes/dbfunctions.php');
			include("../includes/functions.php");
			include("../includes/datadef.php");
			
			if($_SERVER['REQUEST_METHOD'] == 'POST') :
				$db = initdb();
				
				extract($_POST);
				$createdBy = $employeeCode;
				$criteria = (int)$criteria;
				$enabled = 1;
				if($criteria == 0){
					$porata = 0;
					$days = (int)$days;
				}
				else {
					$porata = (int)$porata;
					$days = null;
				}	

				$sql = 'INSERT INTO LeaveType (leaveType, criteria, porata, days, enabled, createdBy, createdDate) VALUES (?, ?, ?, ?, ?, ?, now());';
				$stmt = $db->prepare($sql);
				$stmt->bind_param('siiiis', $leaveType, $criteria, $porata, $days, $enabled, $createdBy);
				
				if($stmt->execute()){
					if($criteria == 1){
						$enabled = 1;
						$csql = 'INSERT INTO LeaveCriteria
								(leaveType, yearFrom, yearTo, days, enabled, createdBy, createdDate)
								VALUES(?, ?, ?, ?, ?, ?, now());';
						$stmt = $db->prepare($csql);
						$stmt->bind_param('siiiis', $leaveType, $yearFrom, $yearTo, $days, $enabled, $createdBy);
						foreach($criterias as $criteriaOne){
							$criteriaVal = explode("XXYYXX", $criteriaOne);
							$yearFrom = (int)$criteriaVal[0];
							$yearTo = (int)$criteriaVal[1];
							$days = (int)$criteriaVal[2];
							$stmt->execute();
						}
					}
					header('Location: index.php');
				}
				else {
					header('Location: index.php');
					echo "Some error occured. Please check your input.";
				}
				exit;
			else :
				include('form.php');
			endif;
		else:		
			echo 'You do not have the permission to access this page';
		endif;
	endif;
?>