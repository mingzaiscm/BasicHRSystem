<?php

		require("dbconnect.php");

			session_start();


    	if(!empty($_POST['password']) && !empty($_POST['newPass']) && !empty($_POST['rePass'])){ 
		

			if (strlen($_POST['newPass']) < 6){
				echo '<script type="text/javascript">alert("New password must contain at least 6 characters.");
			window.location="index.php";</script>';
		}
		else 
		{

			$rePass = md5($_POST['rePass']);
			$newPass = md5($_POST['newPass']);

			$login_ok = false;


			$username = $_SESSION['username'];
			$employeeCode = $_SESSION['employeeCode']; 

			$sql = "SELECT * FROM Account where username = '$username'";

			$result = $mysqli->query($sql);

			$row = $result->fetch_assoc();

			if($row){

				$check_password = md5($_POST['password']);

				if($check_password === $row['password']){

					$login_ok = true;
				}
			}

			if($login_ok ){
				if($newPass === $rePass ){
					if($newPass === $row['password']){
						echo '<script type="text/javascript">alert("New password same as old password. Please reenter new password.");
					window.location="index.php";</script>'; 
					}
					else{
					$sql ="UPDATE Account SET password = '$newPass', modifiedBy ='$employeeCode', modifiedDate = now() where username = '$username'";
						if($mysqli->query($sql) === TRUE){
							echo '<script type="text/javascript">alert("Password Changed.");
						window.location="index.php";</script>'; 
						}
						else {
							echo "Error";
						}
					}
				}
				else{
					echo '<script type="text/javascript">alert("Mismatch Pass.");
					window.location="index.php";</script>'; 
					break;
				}
			}

			else{
				echo '<script type="text/javascript">alert("Invalid password.");
				window.location="index.php";</script>';
				
			}
		}
	}
		else{
			echo '<script type="text/javascript">alert("Please fill in required field.");
		window.location="index.php";</script>'; 
		}
		
?>