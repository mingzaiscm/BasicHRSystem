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
				<button type = "button" onClick = "javascript:window.location = 'index.php';">Back</button>
			</div>
		</div>
	</div>
</body>
</html>
