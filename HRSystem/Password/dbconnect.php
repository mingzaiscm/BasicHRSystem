<?php
			$host="localhost";
			$username="firezett_admin";
			$password="hradmin";
			$db="firezett_hrsystem";
			$tbl_name="Employee";

			$mysqli = mysqli_connect($host, $username, $password, $db) or die("Unable to connect to databse");

			if($mysqli->connect_error) {
				die("EEROR: Could not connect." . $mysqli->connect_error);
			}

?>