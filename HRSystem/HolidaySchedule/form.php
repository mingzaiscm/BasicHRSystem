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
					<h2>Holiday Schedule</h2>
					<form id = "holidayScheduleForm" name = "holidayScheduleForm" method = "POST" action = "<?= $_SERVER['PHP_SELF'] ?>" onsubmit = "return validateForm('holidayScheduleForm')" >
						<div id = 'holidaySchedule-form'>
							<?= 
								formInput('text', 'hsDate', 'hsDate', 'Date:', 
								isset($hsDate) ? $hsDate : $today, '', "min = '$today' onchange = 'dateChange()'", 'formInput datePicker'); 
							?>
							<?= 
								formInput('text', 'hsDesc', 'hsDesc', 'Description:', 
								isset($hsDesc) ? $hsDesc : '', '', '', 'formInput'); 
							?>
							<?=
								formDropdown('enabled', 'enabled', 'Status:', $enabledStatus, isset($enabled) ? $enabled : '1',
								'' , isset($enabled) ? '' : $hiddenV , '', 'formInput')
							?>
						</div>
						<button type = "submit">Submit</button>
						<button type = "button" onClick="javascript:window.location = 'index.php';">Cancel</button>
						<input type = "hidden" id = "hsId" name = "hsId" value = <?= isset($hsId) ? $hsId : '' ?>></input>
						<input type = "hidden" id = "employeeCode" name = "employeeCode" value = "<?= $employeeCode ?>"></input>
						<input type = "hidden" id = "holiday" name = "holiday" value = "<?= $holiday ?>"></input>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>