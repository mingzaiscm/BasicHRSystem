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
 		<h2>Role List</h2><br>
<?php

			require("dbconnect.php");

			$sql = "SELECT * FROM Role";
			if($result = $mysqli->query($sql)){
				
				if($result->num_rows > 0){
					echo "<br>";
					echo "<table width ='500' align ='center' class = 'table table-striped table-bordered table-hover'>";
				
					echo "<thead align='center'>";
						echo "<tr>";
							echo "<td style='font-weight:bold'>Name</td>";
		                	echo "<td style='font-weight:bold'>Action</td>";
		                echo "</tr>";
		            echo "</thead>";

		            while($row = $result->fetch_assoc()){
		            	echo "<tr>";
			                echo "<td align='center'>" . $row['roleName'] . "</td>";
			                echo "<td align='center'>";
			                if(in_array("18", $permission)){
			                echo "<a href='editRoleForm.php?id={$row['roleId']}'>Edit</a>";
			            }   
			                echo "</td>";
	            		echo "</tr>";            		
		            	}
		            echo "</table>";

		            	if(in_array("17", $permission)){
		            
		            	echo "<button type='button' style= 'margin:auto; display: block'><a href ='addRoleForm.php'> Add New </a></button>";
		            	}

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