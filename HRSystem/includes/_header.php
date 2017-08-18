    <?php
		if (session_status() == PHP_SESSION_NONE) { //if there's no session_start yet...
			session_start(); 
		}
		
		$permission = $_SESSION['permission'];
		$employeeCode = $_SESSION['employeeCode'];
	
		$PROTOCOL = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
		$DOC_ROOT = $PROTOCOL.'://'.$_SERVER['SERVER_NAME'];
		
		$projectRoot = dirname($DOC_ROOT.$_SERVER['SCRIPT_NAME']).'/';
		while(substr($projectRoot, -9) != 'HRSystem/'){
			$projectRoot = dirname($projectRoot).'/';
		}
	?>
	
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Firezetta HR System</title>

    <link href="<?= $projectRoot ?>includes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $projectRoot ?>includes/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= $projectRoot ?>includes/dist/css/sb-admin-2.css" rel="stylesheet">

    
    <!-- DataTables CSS -->
    <link href="<?= $projectRoot ?>includes/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?= $projectRoot ?>includes/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Morris Charts CSS 
    <link href="css/morris.css" rel="stylesheet">-->

    <!-- Custom Fonts -->
    <link href="<?= $projectRoot ?>includes/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="<?= $projectRoot ?>includes/js/jquery.min.js"></script>
    <script src="<?= $projectRoot ?>includes/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= $projectRoot ?>includes/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript 
    <script src="js/raphael.min.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="<?= $projectRoot ?>includes/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?= $projectRoot ?>includes/js/jquery.dataTables.min.js"></script>
    <script src="<?= $projectRoot ?>includes/js/dataTables.bootstrap.min.js"></script>
	
	<!-- Custom Jquery UI -->
	<link rel="stylesheet" href="<?= $projectRoot ?>includes/javascript/jquery/jquery-ui-1.12.1/jquery-ui.css">
	<script type = "text/javascript" src = "<?= $projectRoot ?>includes/javascript/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
	
	<!-- Custom style -->
	<link href="<?= $projectRoot ?>includes/style/style.css" rel="stylesheet" type="text/css">
	
	<!-- Custom javascript -->
	<script type = "text/javascript" src = "<?= $projectRoot ?>includes/javascript/jquery/jqueryfunctions.js"></script>
	<script type = "text/javascript" src = "<?= $projectRoot ?>includes/javascript/functions.js"></script>
	
	
		