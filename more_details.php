<?php
include('connect.php');
error_reporting(E_ERROR | E_PARSE);
if(!($id = $_SESSION['id']))
{
     header('location:doctors.php');
}

if(isset($_POST['submit']))
{
    $pid = $_POST['pid'];
}
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
								<th class="column1">Disease Name</th>
								<th class="column6">Symptom</th>
								<th class="column6">Do's</th>
								<th class="column6">Dont's</th>
                                <th class="column6">Diet</th>
                                <th class="column6">Medicine</th>
                                <th class="column6">Potency</th>
                               
							</tr>
						</thead>
						<tbody>
                      <?php

                        $sql="create or replace view temp1 as  select p_id,d_name,symptom,dos,donts,diet from summary natural join advice where doc_id=$id and p_id=$pid";
                        
                        $query = oci_parse($conn,$sql);
                        $res = oci_execute($query);

                        $sql = "select * from temp1 natural join summary_med_sugg ";
                        $query = oci_parse($conn,$sql);
                        $res = oci_execute($query);

                        while($row=oci_fetch_array($query,OCI_ASSOC)){
                            $id = $row['D_NAME']; 
                             $f =  $row['SYMPTOM']; 
                             $l =  $row['DOS']; 
                            $age = $row['DONTS']; 
                            $g =  $row['DIET'];
                            $a = $row['MED_SUGG'];
                            $p = $row['POTENCY'];
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $f; ?></td>
                            <td><?php echo $l; ?></td>
                            <td><?php echo $age; ?></td>
                            <td><?php echo $g; ?></td>
                            <td><?php echo $a; ?></td>
                            <td><?php echo $p; ?></td>
                        
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