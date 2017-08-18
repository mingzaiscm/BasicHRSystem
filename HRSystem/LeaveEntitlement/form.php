<!DOCTYPE html>
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
				<div class="col-lg-12">
					<h2>Leave Entitlement</h2>
					<form id = "leaveEntitlementForm" name = "leaveEntitlementForm" method = "POST" action = "<?= $_SERVER['PHP_SELF'] ?>" onsubmit = "return validateForm('yearForm')" >
						<div id = 'leaveEntitlement-form'>
							<?= 
								formInput('text', 'year', 'year', 'Year:', 
								'', '', "", 'formInput'); 
							?>
						</div>
						<button type = "submit">Compute</button>
						<button type = "button" onClick="javascript:window.location = 'index.php';">Cancel</button>
						<input type = "hidden" id = "employeeCode" name = "employeeCode" value = "<?= $employeeCode ?>"></input>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>