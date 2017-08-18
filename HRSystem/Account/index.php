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
<?php

			require("dbconnect.php");

			$sql = "SELECT * FROM Account";
			if($result = $mysqli->query($sql)){
				
				if($result->num_rows > 0){
					echo "<br>";
					echo "<table width ='500' align ='center' class = 'table table-striped table-bordered table-hover'>";
					echo "<caption align ='center' style='font-weight:bold' >Account List </caption>";

					echo "<thead align='center'>";
						echo "<tr>";
							echo "<td style='font-weight:bold'>Username</td>";
		                	echo "<td style='font-weight:bold'>Action</td>";
		                echo "</tr>";
		            echo "</thead>";

		            while($row = $result->fetch_assoc()){
		            	echo "<tr>";
			                echo "<td align='center'>" . $row['username'] . "</td>";
			                echo "<td align='center'>";
			                if(in_array("21", $permission)){
			                echo "<a href='editUserForm.php?id={$row['employeeCode']}'>Edit</a>";
			               
			            }
			            	if(in_array("22", $permission)){
			            		 echo " | ";
			                echo "<a href='resetPassword.php?id={$row['employeeCode']}'>Reset</a>";
			                echo "<br>";
			                
			                echo "</td>";
			            }

	            		echo "</tr>";
	            		

		            }
		        
		            echo "</table>";

		            $result->free();

				} 
				else{

					echo "No records found";
				}

			} 
			else{

				echo "ERROR: Could not able to execute $sql." .$mysqli->error;
			}

			$mysqli->close();
		?>
		</div>
	</div>
</body>
</html> 