<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php
			
			require("dbconnect.php");
			session_start();

			$modifiedby = $_SESSION['employeeCode'];
			
			$id=$_GET['id'];
			
			//insert data into mysql
			$sql="UPDATE Account SET
			password = '95ccfc1881d57d6f503e52744dd4b919',
			loginFailure = 0,
			modifiedby = '$modifiedby',
			modifiedDate = now() 
			WHERE employeeCode = '$id'";

			if($mysqli->query($sql) === TRUE){
			echo '<script type="text/javascript">alert("Password reseted!");
					window.location="index.php";</script>';
			}

			else {
				echo "error";
				var_dump($sql);
			}
		?>
	</body>
</html>