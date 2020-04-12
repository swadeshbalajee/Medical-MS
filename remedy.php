<script type="text/javascript">
function myfunc($var)
{
     alert($var);
}
</script>


<?php

include('connect.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if(isset($_POST['ins'])){
	error_reporting(E_ERROR| E_PARSE);
	$medname = $_POST['medname'];
	$rub = $_POST['rubrix'];
	$ex = $_POST['extr'];
	$dname = $_POST['dname'];
	$factor = $_POST['factor'];
	
	$res = "insert into remedy (med_name,d_name,factor,rubrix,extracted_from) values('$medname','$dname','$factor','$rub','$ex')";
	$query = oci_parse($conn,$res);
	
	if(oci_execute($query)){
		
          echo '<script type="text/javascript">','myfunc("Inserted successfully");','</script>';
        }
        else{
          echo '<script type="text/javascript">','myfunc("Error while inserting.");','</script>';
        }	
        
        
	}
	
	if(isset($_POST['upd'])){
          error_reporting(E_ERROR | E_WARNING | E_PARSE);
		$medname = $_POST['medname'];
		$dname = $_POST['dname'];
		$arr[0] = $_POST['extr'];
		$arr[1] = $_POST['factor'];
		$arr[2] = $_POST['rubrix'];$flag =1;
		
		$arr1 = array("extracted_from","factor","rubrix");
		for($i =2;$i>=0;$i--){
			if(!empty($arr[$i])){
				$sql = "update remedy set $arr1[$i] = '$arr[$i]' where d_name = '$dname' and med_name = '$medname'"	;
				$que = oci_parse($conn,$sql);	
				     
               oci_execute($que);
               if(oci_num_rows($que) == 0)
               { 
                    echo '<script type="text/javascript">','myfunc("Error while updating");','</script>';
                    
                    $flag = 0;break;
                    //header('location:disease.php');
               }    
          }
     }
          if($flag ==1)
          {
               echo '<script type="text/javascript">','myfunc("Updation succesfull");','</script>'; 
          }
		
		
	}	
	
	?>


<!DOCTYPE html>
<html lang="en">
<head>


     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="svjk0" >
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>
<body>
<section id="details" data-stellar-background-ratio="5" >
          <div class="container">
               <div class="row">

                   

                    <div class="col-md-6 col-sm-6" style="margin-left:290px" >
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="remedy.php" >
										
                              <!-- SECTION TITLE -->
                              <div style="text-align:center">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 style="margin-top:90px">Insert remedy</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s"  >
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Medicine name</label>
                                        <input  type="text" class="form-control" id="name" name="medname" placeholder="Name" required>
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Disease name</label>
                                        <input  type="text" class="form-control" id="name" name="dname" placeholder="Name" required>
                                   </div>
                                   
                                   

                                   

                       
                                   
                                   
                                  
                                   
                                  
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name" style="margin-top:20px">Extracted from</label>
                                        <input  type="text" class="form-control" id="name" name="extr">
                                   </div>
                                   
                                    <div class="col-md-6 col-sm-6">
                                        <label for="name" style="margin-top:20px">Rubrix</label>
                                        <input  type="text" class="form-control" id="name" name="rubrix">
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6" style="margin-left:150px; margin-bottom:20px ">
                                   <label for="Message" style = "float:top;margin-top:20px	">Factor</label>
                                        <textarea style="float:top" class="form-control" rows="5" id="message" name="factor" placeholder="Factor"></textarea>
                                   </div>
                                   
                                   
                                   
                                       <button  type="submit" class="form-control" id="cf-submit" name="ins" style = "width:150px;height:50px;float:right;background-color:YellowGreen;color:white">Insert</button>
												                                    
                                        <button type="submit" style = "width:150px;height:50px;float: left;background-color:YellowGreen;color:white"class="form-control" id="cf-submit" name="upd">Update</button>
                             
	                          
                              
                              </div>
                              
                              
                        </form>
                    </div>

               </div>
          </div>
     </section>
                                   </body>
                                   </html>