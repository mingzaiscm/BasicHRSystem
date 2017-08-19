	<?php
		include('../includes/dbfunctions.php');
		include("../includes/functions.php");
		include("../includes/datadef.php");
		
		$db = initdb();
		$thisYear = (int) Date('Y') ;
		
		/*
		 *  Obtain Employee who are active, not admin and join more than before the set year.
		 */
		$sql1 = 'SELECT employeeCode, name 
			FROM  Employee WHERE NOT (employeeCode = "admin" OR status = "Inactive") AND YEAR(joinDate) < ?;';
		$stmt1 = $db->prepare($sql1);
		$stmt1->bind_param('i', $year);
		
		$year = $thisYear;
		$stmt1->execute();
		$stmt1->store_result();
		$stmt1->bind_result($code, $name);
		
		/*
		 *  Obtain the Annual Leave balance from employee
		 */
		$prevYear = $thisYear - 1;
		$sql2 = 'SELECT entitlement - taken AS balance FROM LeaveEntitlement WHERE employeeCode = ? AND year = ? AND leaveType = "Annual Leave";';
		$stmt2 = $db->prepare($sql2);
		$stmt2->bind_param('si', $code, $year);
		
		/*
		 *  Obtain CF of the specified year from employee
		 */
		$sql3 = 'SELECT days FROM CFLeave WHERE employeeCode = ? AND year = ?;';
		$stmt3 = $db->prepare($sql3);
		$stmt3->bind_param('si', $code, $year);
		
	?>
	<div class="col-lg-12">
		<h2>CF Leave</h2>
	
		<div class = "table-wrapper table-scroll">
			<table class = "table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Employee Code</th>
						<th>Name</th>
						<th>Balance(<?= $prevYear ?>)</th>
						<th>CF</th>
						<?php
							if(in_array('12', $permission)):
						?>
						<th>Action</th>
						<?php
							endif;
						?>
					</tr>
				</thead>
				<tbody>
			<?php
				while($stmt1->fetch()):
					$year = $prevYear;
					$stmt2->execute();
					$stmt2->store_result();
					$stmt2->bind_result($balance);
					$stmt2->fetch();
								
					$stmt3->execute();
					$stmt3->store_result();
					$stmt3->bind_result($cf);
					if($stmt3->fetch())
						$balance = (double)$balance + (double)$cf;
					
					$year = $thisYear;
					$stmt3->execute();
					$stmt3->store_result();
					$stmt3->bind_result($cf);
					if(!$stmt3->fetch())
						$cf = 0;
					if($balance > 0):
			?>
				<tr>
					<td><?= $code ?></td>
					<td><?= $name ?></td>
					<td><?= isset($balance)? $balance : '0' ?></td>
					<td><?= $cf ?></td>
					<?php
						if(in_array('12', $permission)):
					?>
					<td><a href = "update.php?code=<?= $code ?>">Edit<a></td>
					<?php
						endif;
					?>
				</tr>
			<?php
					endif;
				endwhile;
			?>
				</tbody>
			</table>
		</div>
		<?php
			if(in_array('12', $permission)):
		?>
		<button type = "button" onClick="javascript:window.location = 'create.php';">Set All</button>
		<?php
			endif;
		?>
	</div>