	<div class="col-lg-12">
		<h2>Leave Settings</h2>
		<div class = "table-scroll table-wrapper">
			<table class = "table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Leave Type</th>
						<th>Status</th>
						<?php
							if(in_array('10', $permission)
								|| in_array('11', $permission)):
						?>
						<th colspan = '2'>Action</th>
						<?php
							endif;
						?>
					</tr>
				</thead>
				<tbody>
			<?php
			include('../includes/dbfunctions.php');
			
			$db = initdb();
			$sql = 'SELECT leaveType, enabled FROM LeaveType
			ORDER BY enabled DESC,
				(CASE 
					WHEN leaveType = "Annual Leave" THEN "0" 
					ELSE leaveType
				END) ASC;';
			$stmt = $db->prepare($sql);
			
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($leaveType, $enabled);
			
			while($stmt->fetch()) :
			?>
				<tr class = "<?= $leaveType ?>">
					<td><?= $leaveType ?></td>
					<td><?= $enabled == 1 ? 'Active' : 'Inactive' ?></td>
					<?php
						if(in_array('11', $permission)):
					?>
					<td><a href = "view.php?leaveType=<?= $leaveType ?>">View</td>
					<?php
						endif;
						if(in_array('10', $permission)):
					?>
					<td><a href = "update.php?leaveType=<?= $leaveType ?>">Edit</td>
					<?php
						endif;
					?>
				</tr>
			<?php
				endwhile;	
			?>
			</tbody>
			</table>
		</div>
		<?php
			if(in_array('9', $permission)):
		?>
		<button id ="createLeaveType" onClick="location.href = 'create.php';">Add New</button>
		<?php
			endif;
		?>
	</div>