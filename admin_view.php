<script type="text/javascript">
function myfunc($var)
{
     alert($var);
}
</script>

<?php
include ('connect.php');



if(isset($_POST['remove']))
    {
		$name1 = $_POST['name1'];
		$id1 = $_POST['id1'];
		
		$sql2 = "delete from doctor where doc_id = $id1 ";
		$query2 = oci_parse($conn,$sql2);
		
		$sql3 = "delete from login where doc_id = $id1";
		$que3 = oci_parse($conn,$sql2);
        oci_execute($query2);oci_execute($que3);
        
        if(oci_num_rows($query2) == 0)
        {
             echo '<script type="text/javascript">','myfunc("Error while updating");','</script>';
            
        }
        else{
            echo '<script type="text/javascript">','myfunc("Success);','</script>';
       
        }
       
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
			<div class="wrap-table190">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column2" colspan = 1>Doctor ID</th>
								<th class="column2" colspan = 2>First Name</th>
								<th class="column2" colspan = 2>Last Name</th>
								<th class="column2">Age</th>
								<th class="column2">Sex</th>
								<th class="column2">Qualification</th>
                                <th class="column6">Address</th>
                                
							</tr>
						</thead>
						<tbody>
                      <?php
            				if(isset($_POST['view']))
            				{
                        
                        $name1 = $_POST['name1'];
                        $id1 = $_POST['id1'];
                        

                        
                       
                        
                        if(!$id1){
                           $pid = 0;
                         }

                         if(!$name1){
                             $name1=0;
                         }

                        if( $name1 != " " || $id1 != " " )
                        {
                        $sql="create or replace view temp as select doc_id,first_name,last_name,age,sex,qualification,address from doctor where doc_id=$id1";
                        
                        $query = oci_parse($conn,$sql);
                        $res = oci_execute($query);

                        if($name1 == "")
                        {
                            $sql1 = "select * from temp";
                        }
                        else{
                            $sql1 = "select * from temp where name = '$name1'";
                        }

                        if($id1 == 0)
                        {
                            $sql2 = "select * from temp";
                        }
                        else{
                            $sql2 = "select * from temp where doc_id = $id1";
                        }
                        
                          

                        $sql = "$sql1 intersect $sql2 ";

                       
                        $query = oci_parse($conn,$sql);
                        oci_execute($query);

                        while($row=oci_fetch_array($query,OCI_ASSOC)){
                            $id = $row['DOC_ID']; 
                             $f =  $row['FIRST_NAME']; 
                             $l =  $row['LAST_NAME']; 
                            $age = $row['AGE']; 
                            $g =  $row['SEX'];
                            $q = $row['QUALIFICATION']; 
                            $addr = $row['ADDRESS']; 
                            }
                             
                        ?>
                        <tr>
                            <td colspan = 1><?php echo $id ; ?></td>
                            <td colspan = 2><?php echo $f; ?></td>
                            <td colspan = 2><?php echo $l; ?></td>
                            <td><?php echo $age; ?></td>
                            <td><?php echo $g; ?></td>
                            <td><?php echo $q; ?></td>
                            <td><?php echo $addr; ?></td>
                            
                        </tr>
                        <?php 
                        
                        }
                        
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