<!DOCTYPE html>
<html>
	<head>
		<title>Update successful</title>
	</head>

	<body>
		<?php

		if(!empty($_POST["name"])&&!empty($_POST["description"])){
			
			require("dbconnect.php");

			$id = $_POST['id'];
			$name=$_POST['name'];
			$description=$_POST['description'];
			$modifiedBy= $_POST['employeeCode'] ;
			$right= implode("-", $_POST['permission']);
			

			$sql = "UPDATE Role set rolename = '$name', roleDesc='$description', permission='$right', modifiedBy ='$modifiedBy', modifiedDate = now() WHERE roleId  ='$id'";


			if($mysqli->query($sql) === TRUE){
			echo '<script type="text/javascript">alert("Edit Successful!");
					window.location="index.php";</script>';
			}

			else {
				echo "Error";
				var_dump($sql);
			}
		}
		?>
	</body>
</html>  


