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
				<div class = "col-lg-7">
					<h2>Leave Application</h2>	
					<form id = "leaveAppForm" name = "leaveAppForm" method = "POST" 
						action = "<?= $_SERVER['PHP_SELF'] ?>" onsubmit = "return validateForm('leaveAppForm')" >
						<div id = 'leaveApp-form'>
							<?=
								formDropdown('daysAmount', 'daysAmount', 'Leave Amount:', $leaveDays,
								isset($days) ? $days : '0.5', null, '', 'onClick = "daysAmountChange(this)"', 'formInput', '<br>');
							?>
							<?= 
								formDropdown('leaveType', 'leaveType', 'Leave Type:', $leaveTypes, 
								isset($leaveType) ? $leaveType : '', '--Select Leave--', '', 'onchange="leaveTypeChange()"', 'formInput', '<br>'); 
							?>
							<?= 
								formInput('text', 'dateFrom', 'dateFrom', isset($days) ? ( $days == 0.5 ? 'Date:' : 'Date From:') : 'Date:', 
								isset($dateFrom) ? $dateFrom : $today, '', "min = '$today' max = '$lastDay' onchange = 'dateChange()'", 'formInput datePicker'
								, '<br>'); 
							?>
							<?= 
								formInput('text', 'dateTo', 'dateTo', 'Date To:', isset($dateTo) ? $dateTo : $today,
								isset($days) ? ($days == 0.5 ? $hiddenV : '') : $hiddenV, 
								"min = '$today' max = '$lastDay' onchange = 'dateChange()' " . 
								(isset($days) ? ($days == 0.5 ? $disabled : '') : $disabled ), 'formInput datePicker', '<br>'); 
							?>
							<?= 
								formInput('text', 'days', 'days', 'Day(s):', 
								isset($days) ? $days : '0.5', '', $readonly, 'formInput'); 
							?>
							<div>
								<label id ="lreason" for="reason">Reason:</label>
								<textarea rows="4" cols="60" class = "formInput form-control" style = "resize:none" id = "reason" name = "reason">
									<?= isset($reason) ? $reason : '' ?>
								</textarea>
								<span class="error" id="errreason"><br></span>
							</div>
						</div>
						<div class = 'leaveEntitlement' id = 'leaveEntitlement'>
							<table class = "table table-striped table-bordered table-hover">
								<tr <?= isset($leaveType) ? ($leaveType == 'Annual Leave' ?  '' : $hiddenV ) : $hiddenV ?>>
									<td>CF:</td>
									<td id = 'CF'><?= isset($CF)? $CF : '0'?></td>
								</tr>
								<tr>
									<td>Entitlement:</td>
									<td id = 'entitlement'><?= isset($entitlement[$leaveType]['entitlement'])? $entitlement[$leaveType]['entitlement'] : '0'?></td>
								</tr>
								<tr>
									<td>Taken:</td>
									<td id = 'taken'><?= isset($entitlement[$leaveType]['taken'])? $$entitlement[$leaveType]['taken'] : '0'?></td>
								</tr>
								<tr>
									<td>Balance:</td>
									<td id = 'balance'><?= isset($entitlement[$leaveType]['balance'])? $entitlement[$leaveType]['balance'] : '0'?></td>
								</tr>
								<?php
									if(isset($entitlements)):
										foreach($entitlements as $key => $val):
											if($key == 'Annual Leave'){
												$val['balance'] = (double)$CF + (double)$val['entitlement'] - (double)$val['taken'];
											}
								?>
									<input type = "hidden" id = '<?= $key ?>' name = "entitlements[<?=$key ?>]" 
										value = "<?= $val['entitlement'] . 'XXYYXX'
										. $val['taken'] . 'XXYYXX'
										. $val['balance'] ?>"></input>
								<?php
										endforeach;
									endif;
								?>
							</table>
						</div>
						<div>
							<button type = "submit">Submit</button>
							<button type = "button" onClick="javascript:window.location = 'index.php';">Cancel</button>
							<input type = "hidden" id = "employeeCode" name = "employeeCode" value = "<?= $employeeCode ?>"></input>
							<input type = "hidden" id = "holiday" name = "holiday" value = "<?= $holiday ?>"></input>
						</div>
					</form>
				</div>
				<div class = "col-lg-5">
					<h2>Holiday Schedule <?= $year ?></h2>	
					<div class = "table-wrapper table-scroll">
						<table class = "table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Date</th>
									<th>Desc</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($holidayDesc as $key => $val):
								?>
									<tr>
										<td><?= $key ?></td>
										<td><?= $val ?></td>
									</tr>
								<?php
									endforeach;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>