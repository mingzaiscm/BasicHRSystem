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

			$permission ;
			$sql = "SELECT * FROM  Employee";
			// $rows = mysqli_query($db, $sql);
			$rows = $mysqli->query($sql);
			$total = $rows->num_rows;
			echo "Showing " . ($total-1) ." entries";

			if($result = $mysqli->query($sql)){
				if($result->num_rows > 0){
					echo "<br>";		
					echo "<table width ='500' align ='center' class = 'table table-striped table-bordered table-hover'>";
					echo "<caption align ='center' style='font-weight:bold' >Employee List </caption>";
					echo "<thead align='center'>";
						echo "<tr>";
							echo "<td style='font-weight:bold'>Code</td>";
		                	echo "<td style='font-weight:bold'>Name</td>";
		                	echo "<td style='font-weight:bold'>Title</td>";
		                	echo "<td style='font-weight:bold'>Action</td>";
		                echo "</tr>";
		            echo "</thead>";

		            while($row = $result->fetch_assoc()){
		            	if ( $row['employeeCode'] != "admin"){
		            	echo "<tr>";
			                echo "<td align='center'>" . $row['employeeCode'] . "</td>";
			                echo "<td align='center'>" . $row['name'] . "</td>";
			                echo "<td align='center'>" . $row['title'] . "</td>";
			                echo "<td align='center'>";
			                if(in_array("3", $permission)){
			                echo "<a href='viewEmployee.php?employeeCode={$row['employeeCode']}'>View</a>";
			                
			            	}
			            	if(in_array("2", $permission)){
			            		echo " | ";
			                echo "<a href='editForm.php?employeeCode={$row['employeeCode']}'>Edit</a>";
			            	}
			                echo "<br>";
			                
			                echo "</td>";

	            		echo "</tr>";
	            		}

		            }
		            echo "</table>";

		            	if(in_array("1", $permission)){

	            			echo "<button type='button' style= 'margin:auto; display: block'><a href ='addForm.php'> Add New </a></button>";
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