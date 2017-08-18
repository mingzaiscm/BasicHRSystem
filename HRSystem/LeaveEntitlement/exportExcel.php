<?php
	if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
		session_start(); 
		$employeeCode = $_SESSION['employeeCode'];
		$permission = $_SESSION['permission'];
	}
	
	if(isset($permission)):
		if(in_array('20', $permission)):
		
			$file = 'LeaveReport' . Date('Ymd') . '.xls';
			
			ob_start();
			include('indexPage.php');
			$html = ob_get_clean();
			$html = '<html><body>' . $html;
			$html .= '</body></html>';
				
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
			
			echo $html;
		else:		
			echo 'You do not have the permission to access this page';
		endif;
	endif;
?>