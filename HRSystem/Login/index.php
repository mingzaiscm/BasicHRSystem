<?php 
	include('../includes/dbfunctions.php');
	include("../includes/functions.php");
	include("../includes/datadef.php");
	$errorMessage = '';
	if($_SERVER['REQUEST_METHOD'] == 'POST') :
		extract($_POST);
		$db = initdb();
		$sql = 'SELECT password, locked, employeeCode FROM Account WHERE username = ?;';
		$stmt = $db->prepare($sql);
		$stmt ->bind_param('s', $username);
		$stmt -> execute();
		$stmt -> bind_result($checkPassword, $checkLocked, $employeeCode);
		$stmt -> store_result();
		if($stmt -> fetch()){
			$sql = 'SELECT status FROM Employee WHERE employeeCode = ?;';
			$stmt = $db->prepare($sql);
			$stmt -> bind_param('s', $employeeCode);
			$stmt -> execute();
			$stmt -> bind_result($status);
			$stmt -> store_result();
			$stmt->fetch();
			if($status == 'Active'){
				if($checkLocked == 0){
					if(md5($password) == $checkPassword){
						$sql = 'SELECT permission 
							FROM 
								(SELECT roleId FROM Account WHERE username = ?) a 
							INNER JOIN
								(SELECT roleId, permission FROM Role) r 
							ON
								a.roleId = r.roleId;
							;';
						$stmt = $db->prepare($sql);
						$stmt ->bind_param('s', $username);
						$stmt -> execute();
						$stmt -> bind_result($permission);
						$stmt -> store_result();
						if(!$stmt -> fetch())
							$permission = [];
							
						session_start();
						$_SESSION['username'] = $username;
						$_SESSION['access'] = true;
						$_SESSION['employeeCode'] = $employeeCode;
						$permission = preg_replace('/\s+/', '', $permission);
						$_SESSION['permission'] = explode('-', $permission);
						
						$sql = 'UPDATE Account SET loginFailure = 0 WHERE username = ?';
						$stmt = $db->prepare($sql);
						$stmt ->bind_param('s', $username);
						$stmt -> execute();
						
						header('Location: ../index.php');
						exit;
					}
					else{
						$sql = 'SELECT loginFailure FROM Account WHERE username = ?';
						$stmt = $db->prepare($sql);
						$stmt -> bind_param('s', $username);
						$stmt -> execute();
						$stmt -> bind_result($failure);
						$stmt -> store_result();
						$stmt -> fetch();
						
						$failure++;
						
						if($failure <=3){
							if($failure < 3){
								$sql = 'UPDATE Account SET loginFailure = ? WHERE username = ?';
							}
							else {
								$sql = 'UPDATE Account SET loginFailure = ?, locked = 1 WHERE username = ?';
							}
							$stmt = $db->prepare($sql);
							$stmt -> bind_param('is', $failure, $username);
							$stmt -> execute();
						}
						
						$errorMessage = 'Incorrect Password';
						include('loginPage.php');
					}
				}
				else{
					$errorMessage = 'Account has been locked';
					include('loginPage.php');
					
				}
			}
			else{
				$errorMessage = 'Inactive Account';
				include('loginPage.php');
			}
		}
		else{
			$errorMessage = 'Invalid Username';
			include('loginPage.php');
		}
	else :
		include('loginPage.php');
	endif;
?>