	<!DOCTYPE html>
<html>
	<head>
		<title>Insert successful</title>
	</head>
	<body>
		<?php

		$nameErr = $descriptionErr = $permissionErr =""; 
		$name = $description = $permissionX =""; 

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["name"])) {
				 $nameErr = "Name is required";
		  } else {
		    $name = test_input($_POST["name"]);
		  }
		  
		  if (empty($_POST["description"])) {
				 $descriptionErr = "Description is required";
		  } else {
		    $description = test_input($_POST["description"]);
		  }

		  if (empty($_POST["permission"])) {
				 $permissionErr = "Permission is required";
		  } else {
		    $permissionX = $_POST["permission"];
		  }

		 }

		  function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

		if(!empty($_POST["name"])&&!empty($_POST["description"])){
	
			require("dbconnect.php");

			$name=$_POST['name'];
			$description=$_POST['description'];
			$createdBy = $_POST['employeeCode'] ;
			$right= implode("-", $_POST['permission']);
			

			$sql = "INSERT INTO Role(roleName, roleDesc, permission, createdBy, createdDate)

			VALUES('$name', '$description', '$right', '$createdBy', now())";

			if($mysqli->query($sql) === TRUE){
				echo '<script type="text/javascript">alert("Registration Successful!");
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