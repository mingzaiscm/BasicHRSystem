<?php
	define ('DB_SERVER', 'localhost');
	define ('DB_USER', 'firezett_admin');
	define ('DB_PASSWORD', 'hradmin');
	define ('DB_NAME', 'firezett_hrsystem');
		
	function initdb()
	{
		$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
		
		if ($conn -> connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}
	
?>