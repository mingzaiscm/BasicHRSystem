	<div class="col-lg-12">
		<h2><?= $year ?> Leave Entitlement</h2>
		<div class = "table-wrapper table-scroll">
			<?php
				foreach($row as $key => $value):
			?>
				<h3><?= $key?></h3>
				<?php
					if($value > 0):
				?>
					<table class = "table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Employee Code</th>
								<th>Name</th>
							<?php
								if($key == 'Annual Leave'):
							?>
								<th>CF</th>
							<?php
								endif;
							?>
								<th>Entitlement</th>
								<th>Taken</th>
								<th>Balance</th>
							<?php
								if(substr($_SERVER['SCRIPT_NAME'], -9) == 'index.php'):
							?>
								<th>Action</th>
							<?php
								endif;
							?>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($details[$key] as $detail1):
								$i = 0;
						?>
							<tr>
							<?php
								while($i < sizeof($detail1)):
							?>
								<td><?= $detail1[$i] ?></td>
							<?php
									$i++;
								endwhile;
								if(substr($_SERVER['SCRIPT_NAME'], -9) == 'index.php'):
							?>
								<td>
									<a href = "view.php?code=<?= $detail1[0] ?>&leaveType=<?= $key ?>">View</a>
								</td>
							<?php
								endif;
							?>
							</tr>
						<?php
							endforeach;
						?>
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
	</div>