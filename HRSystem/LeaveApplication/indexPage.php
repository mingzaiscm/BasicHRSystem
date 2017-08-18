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
				<h2>Leave Application</h2>
				<div class = "table-scroll table-wrapper">
					<?php
						foreach($row as $key => $value):
					?>
						<h3><?= $key?> Leave</h3>
						<?php
							if($value > 0):
						?>
							<table class = "table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Employee Code</th>
										<th>Name</th>
										<th>Leave Type</th>
										<th>Date From</th>
										<th>Date To</th>
										<th>Day(s)</th>
										<th colspan = '4'>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
									foreach($leaveApp[$key] as $leaveApp1):
										$i = 1;
								?>
									<tr>
									<?php
										while($i < sizeof($leaveApp1)):
											$leaveType = $leaveApp1[3];
											$employeeCode = $leaveApp1[1];
											$days = (double)$leaveApp1[6];
											$stmt1->execute();
											$stmt1 -> bind_result($entitlement, $taken, $balance);
											$stmt1 -> store_result();
											$stmt1->fetch();

											if($leaveType == 'Annual Leave'){
												$stmt2 -> execute();
												$stmt2 -> store_result();
												$stmt2 -> bind_result($CF);
												if(!$stmt2->fetch())
													$CF = 0;
												$balance = (double)$CF + (double)$entitlement - (double)$taken;
											}
									?>
										<td><?= $leaveApp1[$i] ?></td>
									<?php
											$i++;
										endwhile;
									?>
										<td>
											<button type = "button" onClick = "javascript:window.location = 'view.php?leaveId=<?= $leaveApp1[0] ?>';">View</button>
										</td>
									</tr>
								<?php
									endforeach;
								?>
									<tr>
								</tbody>
							</table>
						<?php
							else:
						?>
								<p>No entries<br><br></p>
						<?php
							endif;
						endforeach;
						?>
				</div>
				<?php
					if(in_array('4', $permission)):
				?>
				<button id ="createLeaveApplication" onClick="location.href = 'create.php';">Add New</button>
				<?php
					endif;
				?>
			</div>
		</div>
	</div>
</body>
</html>