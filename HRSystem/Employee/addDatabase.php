<!DOCTYPE html>
<html>
	<head>
		<title>Insert successful</title>
	</head>

	<body>
		<?php

		$nameErr = $titleErr = $cimbAccErr = $icNoErr = $genderErr = $citizenshipErr = $dobErr = $maritalErr = $permaAddrErr = $handphoneNoErr = $joinDateErr = $emergencyNameErr = $relationshipErr = $emergencyTelErr = $emergencyAddrErr = ""; 

		$name = $title = $cimbAcc = $icNo = $gender = $citizenship = $dob = $marital = $permaAddr = $handphoneNo = $joinDate = $emergencyName = $relationship = $emergencyTel = $emergencyAddr = ""; 


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["name"])) {
				 $nameErr = "Name is required";
		  } else {
		    $name = test_input($_POST["name"]);
		  }
		  
		  if (empty($_POST["title"])) {
				 $titleErr = "Title is required";
		  } else {
		    $title = test_input($_POST["title"]);
		  }

		  if (empty($_POST["cimbAcc"])) {
				 $cimbAccErr = "Cimb Account No. is required";
		  } else {
		   $cimbAcc = test_input($_POST["cimbAcc"]);
		  }

		   if (empty($_POST["icNo"])) {
				 $icNoErr = "IC Num is required";
		  } else {
		    $icNo = test_input($_POST["icNo"]);
		  }

		   if (empty($_POST["gender"])) {
				 $genderErr = "Gender is required";
		  } else {
		    $gender = test_input($_POST["gender"]);
		  }
		   if (empty($_POST["citizenship"])) {
				 $citizenshipErr = "Citizenship is required";
		  } else {
		    $citizenship = test_input($_POST["citizenship"]);
		  }
		   if (empty($_POST["dob"])) {
				 $dobErr = "Date of Birth is required";
		  } else {
		    $dob = test_input($_POST["dob"]);
		  }
		  if (empty($_POST["marital"])) {
				 $maritalErr = "Marital Status is required";
		  } else {
		    $marital = test_input($_POST["marital"]);
		  }
		   if (empty($_POST["permaAddr"])) {
				 $permaAddrErr = "Permanent Addr is required";
		  } else {
		    $permaAddr = test_input($_POST["permaAddr"]);
		  }
		  if (empty($_POST["handphoneNo"])) {
				 $handphoneNoErr = "HandphoneNo is required";
		  } else {
		    $handphoneNo = test_input($_POST["handphoneNo"]);
		  }
		  if (empty($_POST["joinDate"])) {
				 $joinDateErr = "Join Date is required";
		  } else {
		    $joinDate = test_input($_POST["joinDate"]);
		  }
		  if (empty($_POST["emergencyName"])) {
				 $emergencyNameErr = "Emergency Name is required";
		  } else {
		    $emergencyName = test_input($_POST["emergencyName"]);
		  }
		  if (empty($_POST["relationship"])) {
				 $relationshipErr = "Relationship is required";
		  } else {
		    $relationship = test_input($_POST["relationship"]);
		  }
		   if (empty($_POST["emergencyTel"])) {
				 $emergencyTelErr = "Emergency Tel is required";
		  } else {
		    $emergencyTel = test_input($_POST["emergencyTel"]);
		  }
		   if (empty($_POST["emergencyAddr"])) {
				 $emergencyAddrErr = "Emergency Addr is required";
		  } else {
		    $emergencyAddr = test_input($_POST["emergencyAddr"]);
		  }

		 }

		  function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

		if(
			!empty($_POST["name"])
			&&!empty($_POST["title"])
			&&!empty($_POST["cimbAcc"])
				&&!empty($_POST["icNo"])
				&&!empty($_POST["gender"])
				&&!empty($_POST["citizenship"])
				&&!empty($_POST["dob"])
				&&!empty($_POST["marital"])
				&&!empty($_POST["permaAddr"])
				&&!empty($_POST["handphoneNo"])
				&&!empty($_POST["joinDate"])
				&&!empty($_POST["emergencyName"])
				&&!empty($_POST["relationship"])
				&&!empty($_POST["emergencyTel"])
				&&!empty($_POST["emergencyAddr"])){

			
			require("dbconnect.php");


			function getTotalEmployees() {

			$host="localhost";
			$username="firezett_admin";
			$password="hradmin";
			$db="firezett_hrsystem";

			$mysqli = mysqli_connect($host, $username, $password, $db) or die("Unable to connect to databse");

			if($mysqli->connect_error) {
				die("EEROR: Could not connect." . $mysqli->connect_error);
			}

				$sql = "SELECT * FROM Employee" ;
				$rows = $mysqli->query($sql);
				$total = $rows->num_rows;
			    $num = $total ;
			   
			    $num; // add 1;
			
			   $len = strlen($num);
			     for($i=$len; $i< 5; ++$i) {
			         $num = '0'.$num;
			    }
			   		return $num;
    
			}

			$number = getTotalEmployees();

			$id = 'FZ'.$number;

			$user = $_SESSION['employeeCode'];
			$createdBy = $user;

			$name=$_POST['name'];

			$employeeCode = $id;
			$title=$_POST['title'];
			$cimbAcc=$_POST['cimbAcc'];
			$icNo=$_POST['icNo'];
			$gender=$_POST['gender'];
			$citizenship=$_POST['citizenship'];

			if ($_POST['epfNo']){
				$epfNo=$_POST['epfNo'];
			}

			if($_POST['socsoNo']){
				$socsoNo=$_POST['socsoNo'];
			}

			if($_POST['incomeTaxNo']){
				$incomeTaxNo=$_POST['incomeTaxNo'];
			}

			$dob=$_POST['dob'];
			$marital=$_POST['marital'];
			$permaAddr=$_POST['permaAddr'];

			if ($_POST['residentialAddr']){
				$residentialAddr=$_POST['residentialAddr'];
			}

			if ($_POST['telNo']){	
				$telNo=$_POST['telNo'];
			}

			$handphoneNo=$_POST['handphoneNo'];
			$joinDate=$_POST['joinDate'];

			if($_POST['confirmDate']){
				$confirmDate=$_POST['confirmDate'];			
			}

			if($_POST['email']){
				$email=$_POST['email'];			
			}	

			if ($_POST['resignDate']){ 
				$resignDate=$_POST['resignDate']; 
			}

			if ($_POST['emergencyName']){
				$emergencyName=$_POST['emergencyName'];
			}

			if ($_POST['relationship']){
				$relationship=$_POST['relationship'];
			}

			if ($_POST['emergencyTel']){
			$emergencyTel=$_POST['emergencyTel'];
			}

			if ($_POST['emergencyAddr']){
			$emergencyAddr=$_POST['emergencyAddr'];
			}

			$insertSql = "INSERT INTO Employee(employeeCode, name, title, cimbAcc, icNo, gender, citizenship";

			$value ="VALUES('$employeeCode', '$name', '$title', '$cimbAcc', '$icNo', '$gender', '$citizenship'";

			if($_POST['epfNo']){
				$insertSql .= ",epfNo";

				$value .= ",'$epfNo'";
			}

			if($_POST['socsoNo']){
				$insertSql .= ",socsoNo";

				$value .= ",'$socsoNo'";
			}

			if($_POST['incomeTaxNo']){
				$insertSql .= ",incomeTaxNo";

				$value .= ",'$incomeTaxNo'";
			}

			$insertSql .= ",dob, marital, permaAddr";

			$value .= ",'$dob', '$marital', '$permaAddr'";

			if($_POST['residentialAddr']){
				$insertSql .= ",residentialAddr";

				$value .= ",'$residentialAddr'";
			}

			if($_POST['telNo']){
				$insertSql .= ",telNo";

				$value .= ",'$telNo'";
			}

			$insertSql .= ",handphoneNo, joinDate";

			$value .= ",'$handphoneNo', '$joinDate'" ;

			if($_POST['confirmDate']){

				$insertSql .= ",confirmDate";

				$value .= ",'$confirmDate'";
			}

			if($_POST['email']){
				$insertSql .= ",email";

				$value .= ",'$email'";
			}

			if($_POST['resignDate']){

				$insertSql .= ",resignDate";

				$value .= ",'$resignDate'";
			}

			if($_POST['emergencyName']){

				$insertSql .= ",emergencyName";

				$value .= ",'$emergencyName'";
			}

			if($_POST['relationship']){

				$insertSql .= ",relationship";

				$value .= ",'$relationship'";
			}

			if($_POST['emergencyTel']){

				$insertSql .= ",emergencyTel";

				$value .= ",'$emergencyTel'";
			}

			if($_POST['emergencyAddr']){

				$insertSql .= ",emergencyAddr";

				$value .= ",'$emergencyAddr'";
			}

			$insertSql .= ",status, createdBy, createdDate";

			$value .= ",'Active', '$createdBy', now()" ;

			$insertSql .= ")";
			$value .= ")";

			$sql = $insertSql . $value;

			if($mysqli->query($sql) === TRUE){

				// if($_POST['companyEmail']){

				// 	$sql = "INSERT INTO account(username, password, roleId, employeeCode, createdBy, createdDate)
				// 	VALUES('$companyEmail', '95ccfc1881d57d6f503e52744dd4b919', 2, '$employeeCode', '$createdBy', now())";

				// 	if($mysqli->query($sql) === TRUE){
				// 		echo '<script type="text/javascript">alert("Registration Successful!");
				// 	window.location="index.php";</script>';
				// 	}

				// 	else {
				// 		echo "Error";
				// 		var_dump($sql);
				// 	}
				// }
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