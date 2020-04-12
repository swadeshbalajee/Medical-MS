<script type="text/javascript">
function myfunc($var)
{
     alert($var);
}
</script>
<?php

error_reporting(E_ERROR | E_PARSE);
/*if(!($id = $_SESSION['id']))
{
	 header('location:doctors.php');
}*/
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
								<th class="column1">Disease</th>
								<th class="column2">Symptom</th>
								<th class="column">Med_name</th>
								<th class="column">Gender</th>
								<th class="column">Age</th>
								<th class="column">Lab_investigation</th>
							</tr>
						</thead>
						<tbody>
						<?php
							include('connect.php');
							$dname = $_POST['disease'];
							$med = $_POST['med']; 
							$symp = $_POST['symp'];

							$sql = "create or replace view med  as select * from (select * from disease natural join remedy) natural join symptom";
							$query = oci_parse($conn,$sql);
							$a1 = oci_execute($query,OCI_NO_AUTO_COMMIT);

							if($dname && !$med && !$symp){
								$sql = "select d_name,symptom,med_name,gender,age,lab_investigation from med where d_name = '$dname' "	;
								$query = oci_parse($conn,$sql);
								$a2 = oci_execute($query,OCI_NO_AUTO_COMMIT);

							
							$count = 0;
							while($row=oci_fetch_array($query,OCI_ASSOC)){
								$g = $row['GENDER'];
								$a = $row['AGE'];
								$l = $row['LAB_INVESTIGATION'];
								$d = $row['D_NAME'];
								$m = $row['MED_NAME'];$_SESSION['med'] = $row['MED_NAME'];
								$sym[$count] = $row['SYMPTOM'];
								$count++;
							}
							$symp = implode(",",$sym);
							}
							
							if(!$dname && $med && !$symp){
								$_SESSION['med']=$med;
								header('location:more_details1.php');
								die();
							}
							if(!$dname && !$med && $symp){
								$_SESSION['symp'] = $symp;
								header('location:more_details2.php');
								die();

							}

							?>
							<tr>
								<td><?php echo $d; ?></td>
								<td><?php echo $symp; ?></td>
								<td><?php echo $m; ?></td>
								<td><?php echo $g; ?></td>
								<td><?php echo $a; ?></td>
								<td><?php echo $l; ?></td>
							</tr>
						
						</tbody>
					</table>
					<form style="margin-top: 50px;" method="POST" action="more_details1.php">
                        <div style="align-self:center">
                        
                        <button class="form-control" type="submit" class="form-control" id="cf-submit" name="submit" style = "background-color:YellowGreen;color:white;width:150px;height:40px;float:right">More Details</button>
                </div>
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