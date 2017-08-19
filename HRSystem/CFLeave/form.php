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
					<form id = "CFLeaveForm" name = "CFLeaveForm" method = "POST" action = "<?= $_SERVER['PHP_SELF'] ?>" onsubmit = "return validateForm('CFLeaveForm')" >
						<div id = 'cfleave-form' class = "table-wrapper table-scroll">
							<table class = "table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Employee Code</th>
										<th>Name</th>
										<th>Balance(<?= $prevYear ?>)</th>
										<th>CF Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
									
									foreach($array as $one):
								?>
									<tr>
										<td><?= $one['code'] ?></td>
										<td><?= $one['name'] ?></td>
										<td><?= isset($one['balance']) ? $one['balance'] : '0' ?></td>
										<td>
											<?= 
												formInput('number', "cf[$one[code]]", "cf[$one[code]]", '', 
												!isset($one['cfSet']) ? ( $one['balance'] >= 5 ? 5 : $one['balance'] ) : $one['cfSet'], 
												'', "max = '$one[balance]'",'formInput')
											?>
										</td>
										<td><button type = "button" id ="cf[<?= $one['code'] ?>]" class = "Set1CF">Save</button></td>
									</tr>
								<?php
									endforeach;
								?>
								</tbody>
							</table>
						</div>
						<button type = "submit">Save All</button>
						<button type = "button" onClick="javascript:window.location = 'index.php';">Cancel</button>
						<input type = "hidden" id = "year" name = "year" value = "<?= $year ?>"></input>
						<input type = "hidden" id = "employeeCode" name = "employeeCode" value = "<?= $employeeCode ?>"></input>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>