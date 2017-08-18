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
					<h2>CF Leave</h2>
					<form id = "CFLeaveForm" name = "CFLeaveForm" method = "POST" action = "<?= $_SERVER['PHP_SELF'] ?>" 
						onsubmit = "return validateForm('CFLeaveForm')" >
						<div id = 'cfleave-form'>
							<?=
								formInput('text', 'code', 'code', 'Employee Code:', isset($code) ? $code : '', '',
									'readonly', 'formInput');
							?>
							<?=
								formInput('text', 'name', 'name', 'Name:', isset($name) ? $name : '', '',
									'readonly', 'formInput');
							?>
							<?=
								formInput('text', 'balance', 'balance', 'Balance:', isset($balance) ? $balance : '', '',
									'readonly', 'formInput');
							?>
							<?=
								formInput('number', 'days', 'days', 'Day(s):', isset($CF) ? $CF : ($balance <= 5 ? $balance : 5), '',
									"max = $balance", 'formInput');
							?>
						</div>
						<button type = "submit">Save</button>
						<button type = "button" onClick="javascript:window.location = 'index.php';">Cancel</button>
						<input type = "hidden" id = "year" name = "year" value = "<?= $year ?>"></input>
						<input type = "hidden" id = "employeeCode" name = "employeeCode" value = "<?= $employeeCode ?>"></input>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>