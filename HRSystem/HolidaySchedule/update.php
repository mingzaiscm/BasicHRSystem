<?php
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
	}
	$employeeCode = $_SESSION['employeeCode'];
	$permission = $_SESSION['permission'];
	
	if(isset($permission)):
		if(in_array('15', $permission)):
			include('../includes/dbfunctions.php');
			include("../includes/functions.php");
			include("../includes/datadef.php");
	
			$db = initdb();
			
			if($_SERVER['REQUEST_METHOD'] == 'POST') :
			
				extract($_POST);
				$modifiedBy = $employeeCode;
				
				$sql = 'UPDATE HolidaySchedule SET hsDate =?, hsDesc = ?, enabled = ?, modifiedBy = ?, modifiedDate = now() WHERE hsId = ?;';
				$stmt = $db->prepare($sql);
				$stmt->bind_param('ssisi', $hsDate, $hsDesc, $enabled, $modifiedBy, $hsId);
				
				if($stmt->execute()):
					header('Location: index.php');
				else:
					echo "Some error occured. Please check your input.";
				endif;
				exit;
				
			else :
				$sql = 'SELECT hsDate, hsDesc, enabled FROM HolidaySchedule WHERE hsId = ? ;';
				$stmt = $db->prepare($sql);
				
				$stmt->bind_param('i', $hsId);
				
				$hsId = $_GET['hsId'];
				
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($hsDate, $hsDesc, $enabled);
				$stmt->fetch();
				
				$year = (int) Date('Y');
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
				while($stmt->fetch()){
					$hMonth = str_pad($hMonth, 2, "0", STR_PAD_LEFT);
					$hDay = str_pad($hDay, 2, "0", STR_PAD_LEFT);
					
					$holidayString = $year . '-' . $hMonth . '-' . $hDay;

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