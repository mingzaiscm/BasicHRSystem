<?php 
	session_start();
	if(isset($_SESSION['access'])){
		if($_SESSION['access']) :
			include('indexPage.php');
		else :
			header('Location: Login');
		endif;
	}
	else{
		header('Location: Login');
	}
?>