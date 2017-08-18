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
					<h2>Leave Setting</h2>
					<form id = "leaveTypeForm" name = "leaveTypeForm" method = "POST" action = "<?= $_SERVER['PHP_SELF'] ?>" 
						onsubmit = "return validateForm('leaveTypeForm')" >
						<div id = 'leaveType-form'>
						
							<?= 
								formInput('text', 'leaveType', 'leaveType', 'Leave Type:', 
								isset($leaveType) ? $leaveType : '', '', isset($leaveType) ? $readonly : '', 'formInput'); 
							?>
							<?= 
								formDropdown('criteria', 'criteria', 'Criteria:', $YesAndNo, 
								isset($criteria) ? $criteria : 0, null, '', 'onchange="criteriaChange()"', 'formInput'); 
							?>
							<?= 
								formDropdown('porata', 'porata', 'Porata:', $YesAndNo, isset($porata) ? $porata : 0, null, '',
								isset($criteria) ? ($criteria == 0 ? $disabled : '') : $disabled, 'formInput'); 
							?>
							<?= 
								formInput('number', 'days', 'days', 'Day(s):', isset($days) ? $days : '', isset($criteria) ? ($criteria == 1 ? $hiddenV : '') : '',
								isset($criteria) ? ($criteria == 1 ? $disabled : '') : '', 'formInput'); 
							?>
							<?=
								formDropdown('enabled', 'enabled', 'Status:', $enabledStatus, isset($enabled) ? $enabled : '1',
								'' , isset($enabled) ? '' : $hiddenV , '', 'formInput')
							?>
						</div>
						<div id = 'criteria-form' <?= isset($criteria) ? ($criteria == 0 ? $hiddenV : '') : $hiddenV ?> >
								<table id = 'criteria-table' class = "table table-striped table-bordered table-hover">
									<tr>
										<td>
										<?= 
											formInput('number', 'yearFrom', 'yearFrom', 'Year From:', '', '', isset($criteria) ? ($criteria == 0 ? $disabled : '') : '', 'criteriaInput'); 
										?>
										</td>
										<td>
										<?= 
											formInput('number', 'yearTo', 'yearTo', 'Year To:', '', '', isset($criteria) ? ($criteria == 0 ? $disabled : '') : '', 'criteriaInput'); 
										?>
										</td>
										<td>
										<?= 
											formInput('number', 'cdays', 'cdays', 'Day(s):', '', '', isset($criteria) ? ($criteria == 0 ? $disabled : '') : '', 'criteriaInput'); 
										?>
										</td>
										<td><button type = "button" onClick ="addCriteria()">Add</button></td>
									</tr>
									<?php
										if(strpos($_SERVER['PHP_SELF'] ,'update')):
											while($stmt->fetch()):
									?>
										<tr>
											<td><?= $yearFrom ?></td>
											<td><?= $yearTo ?></td>
											<td><?= $cdays ?></td>
											<td>
												<input class = "criterias" type = "hidden" name = "criterias[]" 
												value = "<?= $yearFrom . 'XXYYXX' . $yearTo . 'XXYYXX' . $cdays . 'XXYYXX' . $criteriaId?>">
												</input>
												<button type = "button" onClick = "deleteCriteria(this)">Delete</button>
											</td>
										</tr>
									<?php
											endwhile;
										endif;
									?>
									
								</table>
							<span class="error" id="errNoCriteria"></span>
						</div>
						<button type = "submit">Submit</button>
						<button type = "button" onClick="javascript:window.location = 'index.php';">Cancel</button>
						<input type = "hidden" id = "employeeCode" name = "employeeCode" value = "<?= $employeeCode ?>"></input>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>