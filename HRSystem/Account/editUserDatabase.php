<!DOCTYPE html>
<html>
	<head>
		<title>Insert successful</title>
	</head>

	<body>
		<?php
			
			require("dbconnect.php");

			session_start();

			$id = $_SESSION['employeeCode'];
			
			$employeeId=$_POST['employeeCode'];
			$username=$_POST['username'];			
			$roleId = $_POST['role'];
			$status = $_POST['status'];

			//insert data into mysql
			$sql="UPDATE Account SET
			username = '$username', 
			roleId = $roleId,
			modifiedBy = '$id',
			modifiedDate = now()
			WHERE employeeCode = '$employeeId' "; 

			// $sql .=" UPDATE employee SET 
			// status = '$status'
			// WHERE employeeCode = '$employeeCode';";

			if($mysqli->query($sql) === TRUE){
				
				$sql ="UPDATE Employee SET 
				status = '$status'
				WHERE employeeCode = '$employeeId';";

				if($mysqli->query($sql) === TRUE){
					echo '<script type="text/javascript">alert("Edit Successful!");
					window.location="index.php";</script>';
				}

				else {
					echo "Error";
					var_dump($sql);
				}

			}

			else {
				echo "Error";
				var_dump($sql);
			}

			
		?>
	</body>
</html>