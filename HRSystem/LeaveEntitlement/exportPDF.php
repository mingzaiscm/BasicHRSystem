<?php
	require_once("../includes/dompdf/autoload.inc.php");
			
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
			
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
		$employeeCode = $_SESSION['employeeCode'];
		$permission = $_SESSION['permission'];
	}
	
	if(isset($permission)):
		if(in_array('20', $permission)){

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();
			
			ob_start();
			include('indexPage.php');
			$html = ob_get_clean();
			
			ob_start();
			include('../includes/_header.php');
			$css = ob_get_clean();
			ob_end_clean();
			
			$html = $css . $html;
			
			$dompdf->loadHtml($html);

			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('A4', 'portrait');

			// Render the HTML as PDF
			$dompdf->render();

			$fileName = 'LeaveReport' . Date('Ymd');
			
			// Output the generated PDF to Browser
			$dompdf->stream($fileName, array("Attachment"=>0));
		}
		else{
			echo 'You do not have the permission to access this page';
		}
	endif;
?>