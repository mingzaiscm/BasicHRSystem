<?php
	include('includes/dbfunctions.php');
	include("includes/functions.php");
	
	//session_start(); //Session declared in index.php
	$currentmonth = date('m');
	$currentyear = date('Y');

	//sets initial value of SESSION variables to current month and year
	if(!isset($_SESSION['month'])){
		$_SESSION['month'] = $currentmonth;
	}
	if(!isset($_SESSION['year'])){
		$_SESSION['year'] = $currentyear;
	}

	//increments or decrements year based on user input
	if(isset($_POST['LastMonth'])){
		if($_SESSION['month']-1 == 0){ 
			--$_SESSION['year'];
		}
		$_SESSION['month'] = ($_SESSION['month']-1 > 0) ? --$_SESSION['month'] : 12;

	}

	if(isset($_POST['NextMonth'])){
		if ($_SESSION['month']+1 == 13){
			++$_SESSION['year'];
		}
		$_SESSION['month'] = ($_SESSION['month']+1 < 13) ? ++$_SESSION['month'] : 1;
	}

	if(isset($_POST['Today'])){
		$_SESSION['year'] = $currentyear;
		$_SESSION['month'] = $currentmonth;
	}

	//print calendar based on SESSION variables
	echo draw_calendar($_SESSION['month'],$_SESSION['year']);

?>