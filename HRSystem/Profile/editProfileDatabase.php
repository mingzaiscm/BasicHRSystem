<!DOCTYPE html>
<html>
	<head>
		<title>Insert successful</title>
	</head>

	<body>
		<?php
			
			require("dbconnect.php");
			session_start();

			$user = $_SESSION['employeeCode'];
			$modifiedBy = $user;

			
			$employeeCode=$_POST['employeeCode'];	
			$marital=$_POST['marital'];
			$permaAddr=$_POST['permaAddr'];
			$residentialAddr=$_POST['residentialAddr'];

			if ($_POST['telNo']){ 
				$telNo=$_POST['telNo']; 
			}
			$handphoneNo=$_POST['handphoneNo'];
			$email=$_POST['email'];			
			$emergencyName=$_POST['emergencyName'];
			$relationship=$_POST['relationship'];
			$emergencyTel=$_POST['emergencyTel'];
			$emergencyAddr=$_POST['emergencyAddr'];

			//insert data into mysql
			$sql="UPDATE $tbl_name SET
			
			marital = '$marital',
			permaAddr = '$permaAddr', 
			residentialAddr = '$residentialAddr',"; 
			if($_POST['telNo']){

				$sql .= "telNo = '$telNo', ";

			}

			if($_POST['handphoneNo']){

				$sql .= "handphoneNo = '$handphoneNo', ";

			}

			$sql.= "email = '$email',";

			
			$sql.= "emergencyName = '$emergencyName', relationship = '$relationship', emergencyTel = '$emergencyTel', emergencyAddr = '$emergencyAddr',  modifiedBy = '$modifiedBy',
			      modifiedDate = now() 
			       WHERE employeeCode = '$employeeCode'";

			if($mysqli->query($sql) === TRUE){
				echo '<script type="text/javascript">alert("Edit Successful!");
					window.location="../index.php";</script>';
			}

			else {
				echo "error";
				var_dump($sql);
			}
		?>
	</body>
</html>