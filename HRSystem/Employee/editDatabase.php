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
			$createdBy = $user;
			$modifiedBy = $user;

			$check = true;
			$employeeCode=$_POST['employeeCode'];

			$sql = "SELECT companyEmail from Employee where employeeCode = '$employeeCode'";
			$result = $mysqli->query($sql);
			$data = $result->fetch_assoc();

			$name=$_POST['name'];
			$title=$_POST['title'];
			$cimbAcc=$_POST['cimbAcc'];
			$icNo=$_POST['icNo'];
			$gender=$_POST['gender'];
			$citizenship=$_POST['citizenship'];
			$epfNo=$_POST['epfNo'];
			$socsoNo=$_POST['socsoNo'];
			$incomeTaxNo=$_POST['incomeTaxNo'];
			$dob=$_POST['dob'];
			$marital=$_POST['marital'];
			$permaAddr=$_POST['permaAddr'];
			$residentialAddr=$_POST['residentialAddr'];
			if ($_POST['telNo']){ 
				$telNo=$_POST['telNo']; 
			}
			$handphoneNo=$_POST['handphoneNo'];
			$joinDate=$_POST['joinDate'];

			if ($_POST['confirmDate']){ 
				$confirmDate=$_POST['confirmDate']; 
			}
			$email=$_POST['email'];

			if ($_POST['companyEmail']){ 
				$companyEmail=$_POST['companyEmail'];

				if($companyEmail === $data['companyEmail']) 
				$check = false;
			}
				
			if ($_POST['resignDate']){ 
				$resignDate=$_POST['resignDate']; 
			}
			
			$emergencyName=$_POST['emergencyName'];
			$relationship=$_POST['relationship'];
			$emergencyTel=$_POST['emergencyTel'];
			$emergencyAddr=$_POST['emergencyAddr'];


			//insert data into mysql
			$sql="UPDATE $tbl_name SET
			name ='$name',
			title = '$title', 
			cimbAcc = '$cimbAcc', 
			icNo = '$icNo', 
			gender = '$gender',
			citizenship = '$citizenship',
			epfNo = '$epfNo', 
			socsoNo = '$socsoNo',
			incomeTaxNo = '$incomeTaxNo',
			dob = '$dob', 
			marital = '$marital',
			permaAddr = '$permaAddr', 
			residentialAddr = '$residentialAddr',"; 
			if($_POST['telNo']){

				$sql .= "telNo = '$telNo', ";

			}
			$sql.= "handphoneNo = '$handphoneNo', 
			joinDate = '$joinDate',";

			if($_POST['confirmDate']){

				$sql .= "confirmDate = '$confirmDate',";

			}

			$sql.= "email = '$email',";

			if($_POST['companyEmail']){

				$sql .= "companyEmail = '$companyEmail', ";

			}

			if($_POST['resignDate']){

				$sql .= "resignDate = '$resignDate', ";

			}
			
			$sql.= "emergencyName = '$emergencyName',
			 relationship = '$relationship',
			  emergencyTel = '$emergencyTel',
			   emergencyAddr = '$emergencyAddr',
			     modifiedBy = '$modifiedBy',
			      modifiedDate = now() 
			      WHERE employeeCode = '$employeeCode' ";
									
			if($mysqli->query($sql) === TRUE){

					if($_POST['companyEmail'] && $check === true){

					$sql = "INSERT INTO account(username, password, roleId, employeeCode, createdBy, createdDate)
					VALUES('$companyEmail', '95ccfc1881d57d6f503e52744dd4b919', 2, '$employeeCode', '$createdBy', now())";

					if($mysqli->query($sql) === TRUE){
						echo '<script type="text/javascript">alert("Account Created & Edited.");
			window.location="index.php";</script>';
					}

					else {
						var_dump($sql);
						exit();
							echo '<script type="text/javascript">alert("Account a with that Name exist.Please try again.");
			window.location="index.php";</script>';
					}
				}
				echo '<script type="text/javascript">alert("Edited.");
			window.location="index.php";</script>';

			}

			else {
				echo '<script type="text/javascript">alert("Account with that Name exist.Please try again.");
			window.location="index.php";</script>';
			}
		
		?>
	</body>
</html>