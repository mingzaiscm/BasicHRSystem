	<div class="col-lg-12">
		<h2>Holiday List</h2>
		<div class = "table-wrapper table-scroll">
			<table class = "table table-striped table-bordered table-hover">
					<thead>
					<tr>
						<th>Date</th>
						<th>Description</th>
						<th>Status</th>
						<?php
							if(in_array('15', $permission)):
						?>
						<th>Action</th>
						<?php
							endif;
						?>
					</tr>
				</thead>
				<tbody>
			<?php
				include('../includes/dbfunctions.php');
				include("../includes/datadef.php");
				
				$year = (int) Date('Y');
				$db = initdb();
				$sql = 'SELECT hsId, hsDate, hsDesc, enabled FROM HolidaySchedule WHERE YEAR(hsDate) = ?
				ORDER BY  enabled DESC, hsDate ASC;';
				if($stmt = $db->prepare($sql))
					$stmt->bind_param('i', $year);
				else
					die("error : " . $db->error);
				
				$stmt->execute();
				$stmt->bind_result($hsId, $hsDate, $hsDesc, $enabled);
				while($stmt->fetch()):
			?>
					<tr>
						<td><?= $hsDate ?></td>
						<td><?= $hsDesc ?></td>
						<td><?= $enabled == '1' ? 'Active' : 'Inactive' ?></td>
						<?php
							if(in_array('15', $permission)):
						?>
						<td><a href = "update.php?hsId=<?= $hsId ?>">Edit</a></td>
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
			if(in_array('14', $permission)):
		?>
			<button id ="createHolidaySchedule" onClick="location.href = 'create.php';">Add New</button>
		<?php
			endif;
		?>
	</div>