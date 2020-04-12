<script type="text/javascript">
function myfunc($var)
{
     alert($var);
}
</script>


<?php

include('connect.php');
error_reporting(E_ERROR| E_PARSE);

if(isset($_POST['insert'])){
	
	$dname = $_POST['dname'];
	$age = $_POST['age'];
	$sex = $_POST['sex'];
	$lab = $_POST['lab'];
	$symp = $_POST['symp'];
	
	$res = "insert into disease(d_name,age,gender,lab_investigation) values('$dname',$age,'$sex','$lab')";
	$query = oci_parse($conn,$res);
	
	$a1 = oci_execute($query);
		
        $arr = explode(",",$symp);
        
        for($i = 0;!empty($arr[$i]);$i++){
        	$sql = "insert into symptom(s_id,d_name,symptom) values(sid.nextval,'$dname','$arr[$i]')";
        	$res1 = oci_parse($conn,$sql);
          $a2 = oci_execute($res1);
        }

        if($a1 && $a2){
          echo '<script type="text/javascript">','myfunc("Insertion succesfull");','</script>';
        }
        else{
          echo '<script type="text/javascript">','myfunc("Error while inserting or Invalid Doctor_id");','</script>';
        }
	}
	
	if(isset($_POST['update'])){
		$dname = $_POST['dname'];
		$arr[0] = $_POST['age'];
		$arr[1] = $_POST['sex'];
		$arr[2] = $_POST['lab'];
		$symp = $_POST['symp'];$flag =1;
		
		$arr1 = array("age","gender","lab_investigation");
		for($i =2;$i>=0;$i--){
			if(!empty($arr[$i])){
				$sql = "update disease set $arr1[$i] = '$arr[$i]' where d_name = '$dname'"	;
				$que = oci_parse($conn,$sql);	
                    oci_execute($que);
               if(oci_num_rows($que) == 0)
               { 
                    echo '<script type="text/javascript">','myfunc("Error while updating");','</script>';
                    $flag = 0;
                    break;
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

     <title>Health - Medical Website Template</title>

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
                         <form id="appointment-form" role="form" method="post" action="disease.php" >
										
                              <!-- SECTION TITLE -->
                              <div style="text-align:center">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 style="margin-top:90px">Insert disease</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s"  >
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Disease name</label>
                                        <input  type="text" class="form-control" id="name" name="dname" placeholder="Name" required>
                                   </div>
                                   
                                   

                                   

                                    <div class="col-md-6 col-sm-6">
                                        <label for="select">Sex</label>
                                        <select class="form-control" name="sex">
                                             <option value="M">M</option>
                                             <option value="F">F</option>
                                             <option value="Both">Both</option>
                                        </select>
                                   </div>
                                   
                                   
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Age</label>
                                        <input  type="number" class="form-control" id="name" name="age" placeholder="Age">
                                   </div>
                                   
                                  
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Lab invsetigation</label>
                                        <input  type="text" class="form-control" id="name" name="lab">
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6"  style="margin-left:150px; margin-bottom:20px ">
                                   <label for="Message">Symptom</label>
                                        <textarea class="form-control" rows="5" id="message" name="symp" placeholder="Symptom"></textarea>  
                                   </div>
                                   
                                   <button  type="submit" class="form-control" id="cf-submit" name="insert" style = "width:150px;height:50px;float:right;background-color:YellowGreen;color:white">Insert</button>
									                                     
                                    <button type="submit" style = "width:150px;height:50px;float: left; background-color:YellowGreen;color:white"class="form-control" id="cf-submit" name="update">Update</button>
                    
                              </div>
                              
                              
                        </form>
                    </div>

               </div>
          </div>
     </section>
                                   </body>
                                   </html>