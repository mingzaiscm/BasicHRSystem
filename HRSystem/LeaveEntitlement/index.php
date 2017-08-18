<html>
<head>
	<?php 
		include('../includes/_header.php'); 
	?>
</head>

<body>
	<div id="wrapper">
 		<?php include("../includes/_menu.php"); ?>
 		<div id ="page-wrapper">
			<?php 
				include('indexPage.php');
			?>
			<div id = "ignorePDF">
				<?php
					if(in_array('7', $permission)):
				?>
				<button id ='createLeaveEntitlement' onClick="location.href = 'create.php';">Compute Entitlement</button>
				<?php
					endif;
				?>
				<?php
					if(in_array('20', $permission)):
				?>
				<button id ='exportPDF' onClick = "javascript: window.open('exportPDF.php');">Export to PDF</button>
				<button id = 'exportExcel' onClick = "javascript: window.open('exportExcel.php');">Export to Excel</button>
				<?php
					endif;
				?>
			</div>
 		</div>
	</div>
</body>
</html>