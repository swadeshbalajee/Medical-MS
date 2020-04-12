<?php
include('connect.php');
error_reporting(E_ERROR | E_PARSE);
$id = $_SESSION['id'];


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
								<th class="column1">Patient ID</th>
								<th class="column6">First Name</th>
								<th class="column6">Last Name</th>
								<th class="column6">Age</th>
								<th class="column6">Gender</th>
                                <th class="column3">Disease name</th>
                                <th class="column3">Last Visited</th>
                                <th class="column6">Symptom</th>
                                <th class="column1">Pincode</th>
							</tr>
						</thead>
						<tbody>
                      <?php
            
                        include('connect.php');
                        $name = $_POST['name'];
                        $pid = $_POST['pid'];
                        $pin = $_POST['pin'];
                        $age = $_POST['age'];
                        $comp = $_POST['comp'];
                        $d_name = $_POST['dname'];
                        $sex =$_POST['sex'];

                        
                        
                        if(!$age){
                            $age=0;
                             }
                        
                        if(!$pid){
                           $pid = 0;
                         }

                         if(!$pin){
                             $pin=0;
                         }

                        if( $name != " " || $pid != " " || $pin != " " || $age != " " || $comp != " " || $d_name != " " || $sex != " ")
                        {
                        $sql="create or replace view temp as select p_id,first_name,last_name,age,sex,d_name,last_visited,symptom,pincode from patient natural join summary where doc_id=$id";
                        
                        $query = oci_parse($conn,$sql);
                        $res = oci_execute($query);

                        if($name == "")
                        {
                            $sql1 = "select * from temp";
                        }
                        else{
                            $sql1 = "select * from temp where name = '$name'";
                        }

                        if($pid == 0)
                        {
                            $sql2 = "select * from temp";
                        }
                        else{
                            $sql2 = "select * from temp where p_id = $pid";
                        }
                        
                        if($sex == "A")
                        {
                            $sql3 = "select * from temp";
                        }
                        else{
                            $sql3 = "select * from temp where sex = '$sex'";
                        }
                        if($pin == 0)
                        {
                            $sql4 = "select * from temp";
                        }
                        else{
                            $sql4 = "select * from temp where pincode = $pin";
                        }
                
                        if($d_name = " ")
                        {
                            $sql5 = "select * from temp";
                        }
                        else{
                            $sql5 = "select * from temp where d_name='$d_name'";
                        }

                        if($comp == 1){
                            $sql6 = "select * from temp age < $age  ";
                        }  

                        if($comp == 2){
                            $sql6 = "select * from temp where age > $age ";
                        }  

                        if($comp == 3){
                            $sql6 = "select * from temp where age = $age ";
                        }  

                        $sql = "$sql1 intersect $sql2 intersect $sql3 intersect $sql4 intersect $sql5 intersect $sql6";

                       
                        $query = oci_parse($conn,$sql);
                        oci_execute($query);

                        while($row=oci_fetch_array($query,OCI_ASSOC)){
                            $id = $row['P_ID']; 
                             $f =  $row['FIRST_NAME']; 
                             $l =  $row['LAST_NAME']; 
                            $age = $row['AGE']; 
                            $g =  $row['SEX'];
                            $d = $row['D_NAME']; 
                            $lv = $row['LAST_VISITED']; 
                             $s = $row['SYMPTOM'];
                            $p =  $row['PINCODE']; 
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $f; ?></td>
                            <td><?php echo $l; ?></td>
                            <td><?php echo $age; ?></td>
                            <td><?php echo $g; ?></td>
                            <td><?php echo $d; ?></td>
                            <td><?php echo $lv; ?></td>
                            <td><?php echo $s; ?></td>
                            <td><?php echo $p; ?></td>
                        </tr>
                        <?php 
                        
                        }
                        
                    }
                       
                        ?>
						</tbody>
                    </table>
                    <form style="margin-top: 50px;" method="POST" action="more_details.php">
                        <div style="align-self:center">
                        <label for="id" style="color:white ; float:left;font-size:23px">Enter patient id :  </label>
                        <input type="number" name = "pid" style="float: left; border-radius:13px; padding-left:7px; height :25px; margin-left:2%;margin-top:0.5%" size="80" >
                        <button class="form-control" type="submit" class="form-control" id="cf-submit" name="submit" style = "background-color:YellowGreen;color:white;width:150px;height:40px;float:right">Submit</button>
                </div>
                    
                    </form>
                
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