<!DOCTYPE html>
<html>
<head>
	<?php 
		include('../includes/_header.php'); 
	?>
</head>

<body>
<?php
	include('../includes/dbfunctions.php');
	
	$db = initdb();
	$sql = 'SELECT criteria, porata, days FROM LeaveType WHERE leaveType = ?;';
	$stmt = $db->prepare($sql);
		
	$stmt->bind_param('s', $leaveType);
		
	$leaveType = $_GET['leaveType'];
	$leaveType = str_replace('%20', ' ', $leaveType);
		
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($criteria, $porata, $days);
	if($stmt->fetch()):
?>
	<div id="wrapper">
 		<?php include("../includes/_menu.php"); ?>
 		<div id ="page-wrapper">
			<div class="col-lg-12">
				<h2><?= $leaveType ?></h2>
				<div>
					<table class = "table table-striped table-bordered table-hover">
						<tr>
							<td>Criteria:</td>
							<td><?= $criteria == 1 ? 'True' : 'False' ?></td>
						</tr>
						<tr>
							<td>Porata:</td>
							<td><?= $porata == 1 ? 'True' : 'False' ?></td>
						</tr>
						<?php
							if($criteria == 0):
						?>
							<tr>
								<td>Days:</td>
								<td><?= $days ?></td>
							</tr>
						<?php
							endif;
						?>
					</table>
				</div>
	<?php
		else:
	?>
			<p>Invalid Leave Type</p>
	<?php
		endif;
			if($criteria == 1):
				$enabled = 1;
				$sql = 'SELECT yearFrom, yearTo, days FROM LeaveCriteria WHERE leaveType = ? AND enabled = ?;';
				$stmt = $db->prepare($sql);
				$stmt->bind_param('si', $leaveType, $enabled);
				
				$stmt->execute();
				$stmt->bind_result($yearFrom, $yearTo, $cdays);
		?>
				<div class = "table-scroll table-wrapper" style = "height:400px;">
					<table class = "table table-striped table-bordered table-hover">
						<tr>
							<th>Year From</th>
							<th>Year To</th>
							<th>Day(s)</th>
						</tr>
				<?php
					while($stmt->fetch()):
				?>
						<tr>
							<td><?= $yearFrom ?></td>
							<td><?= $yearTo ?></td>
							<td><?= $cdays ?></td>
						</tr>
				<?php
					endwhile;
				?>
					</table>
				</div>
				<?php
				endif;
				?>	
				<button type = "button" onClick="javascript:window.location = 'index.php';">Back</button>
			</div>
		</div>
	</div>
		
</body>
</html>
