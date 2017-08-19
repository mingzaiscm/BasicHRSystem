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
				<table class = "table table-striped table-bordered table-hover">
					<tbody>
					<?php
						foreach($leaveApp as $key => $val):
					?>
						<tr>
							<td><?=$key?>:</td>
							<td><?=$val?></td>
						</tr>
					<?php
						endforeach;
					?>
					</tbody>
				</table>
				<?php
					if(in_array('6', $permission)):
						if($status == $appStatus[0]):
							if($days <= $balance):
				?>
						<button type = "button" onClick = "javascript:window.location = 'update.php?status=1&leaveId=<?= $leaveApp['Leave Id'] ?>';">Approve</button>
					<?php
							endif;
					?>
						<button type = "button" onClick = "javascript:window.location = 'update.php?status=2&leaveId=<?= $leaveApp['Leave Id'] ?>';">Disapprove</button>
				<?php
						endif;
						if($status != $appStatus[3] && $status != $appStatus[2] && $leaveApp["Date From"] > $today):
				?>
					<button type = "button" onClick = "javascript:window.location = 'update.php?status=3&leaveId=<?= $leaveApp['Leave Id'] ?>';">Cancel</button>
				<?php
						endif;
					endif;
				?>
				<button type = "button" onClick = "javascript:window.location = 'index.php';">Back</button>
			</div>
		</div>
	</div>
</body>
</html>
