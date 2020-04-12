<?php
include('connect.php');
error_reporting(E_ERROR | E_PARSE);
if(!($id = $_SESSION['id']))
{
     header('location:doctors.php');
}

$sym = $_SESSION['symp'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column3">Disease Name</th>
                                <th class="column2">Gender</th>
                                <th class="column3">Age</th>
                                <th class="column2">Lab Examination</th>
								
								
                            </tr>
						</thead>
						<tbody>
                      <?php

                        $sql = "select * from symptom natural join disease where symptom = '$sym' ";
                        $query = oci_parse($conn,$sql);
                        $res = oci_execute($query);

                        while($row=oci_fetch_array($query,OCI_ASSOC)){
                            $id = $row['D_NAME']; 
                             $f =  $row['GENDER']; 
                             $age = $row['AGE']; 
                             $l =  $row['LAB_INVESTIGATION']; 
                           
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $f; ?></td>
                            <td><?php echo $age; ?></td>
                            <td><?php echo $l; ?></td>
                            
                        
                        </tr>
                        <?php 
                        
                        }
                        
                                           
                        ?>
						</tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>


	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>