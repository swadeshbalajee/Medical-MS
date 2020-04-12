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

          $sql ="select login_id.nextval from dual";
          $query = oci_parse($conn,$sql);
          oci_execute($query,OCI_NO_AUTO_COMMIT);
          $row=oci_fetch_array($query,OCI_ASSOC);

          $login = $row['NEXTVAL'];

          $sql ="select doc_id.nextval from dual";
          $query = oci_parse($conn,$sql);
          oci_execute($query,OCI_NO_AUTO_COMMIT);
          $row=oci_fetch_array($query,OCI_ASSOC);

          $d_id = $row['NEXTVAL'];

		    
		     $first = $_POST['fname'];
		     $last = $_POST['lname'];
		     $age = $_POST['age'];
		     $quali = $_POST['qual'];
		     $g = $_POST['sex'];
		     $email = $_POST['mail'];
		     $sess = $_POST['sess'];
		     $addr = $_POST['address'];
		     $psd = $_POST['psd'];
		     
		     $res3 = "insert into login(login_id,doc_id,password) values($login,$d_id,'$psd')";
		     $que = oci_parse($conn,$res3);
		     
		     $a2 = oci_execute($que,OCI_NO_AUTO_COMMIT);
		     $res = "insert into doctor (doc_id,first_name,last_name,age,qualification,sex,email_id,sessions,address) values($d_id,'$first','$last',$age,'$quali','$g','$email','$sess','$addr')" ;
		     $query = oci_parse($conn,$res);
  
               $a1 = oci_execute($query,OCI_NO_AUTO_COMMIT);
               
          if($a1 && $a2)
          {
               oci_commit($conn);
               oci_commit($conn);
               echo '<script type="text/javascript">','myfunc("Inserted successfully");','</script>';
          }
          else{
               echo '<script type="text/javascript">','myfunc("Insertion failed");','</script>';
          }
        
    }
    if(isset($_POST['update']))
    {
			$d_id = $_POST['id'];
			$arr[0] = $_POST['fname'];
		     $arr[1] = $_POST['lname'];
		     $arr[2] = $_POST['age'];
		     $arr[3] = $_POST['qual'];
		     $arr[4] = $_POST['sex'];
		     $arr[5] = $_POST['mail'];
		     $arr[6] = $_POST['sess'];
		     $arr[7] = $_POST['address'];
		     $arr[8] = $_POST['psd'];
		    
		    $arr1 = array("first_name","last_name","age","qualification","sex","email_id","sessions","address","password");
		    $flag = 1;
		     for($i=8;$i>=0;$i--){
		     if(!empty($arr[$i])){
                    if($i == 8)
                    {
                         $sql1 = "update login set $arr1[$i] = '$arr[$i]' where doc_id = $d_id"; 
                         $query1 = oci_parse($conn,$sql1);
                    } 
               else{    
		     $sql1 = "update doctor set $arr1[$i] = '$arr[$i]' where doc_id = $d_id"; 
		     $query1 = oci_parse($conn,$sql1);
               }
               oci_execute($query1);
               
               if(oci_num_rows($query1) == 0)
               {
                    echo '<script type="text/javascript">','myfunc("Error while updating");','</script>';
                    $flag = 0;
                    break;
               }
                   
          }
            
     }
     if($flag == 1)
     {
          echo '<script type="text/javascript">','myfunc("Updation successful");','</script>';
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
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- HEADER -->
     


     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ealth Center</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="#top" class="smoothScroll">Home</a></li>
                         <li><a href="#refer" class="smoothScroll">Insert/update Doctor details</a></li>
                         <li><a href="#details" class="smoothScroll">View/Delete Doctor details </a></li>
                         
                         <li class="appointment-btn"><a href="#appointment">update/insert disease</a></li>
                    </ul>
               </div>

          </div>
     </section>


     <!-- HOME -->
     <section id="home" class="slider" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                         <div class="owl-carousel owl-theme">
                              <div class="item item-first">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h1>Information is wealth</h1>
                                             
                                             <a href="#refer" class="section-btn btn btn-default smoothScroll">Insert/update Doctor details</a>
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-second">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h1>Entry for progress</h1>
                                           
                                             <a href="#appointment" class="section-btn btn btn-default btn-gray smoothScroll">Insert/Update disease</a>
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-third">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h1>We care for your health</h1>
                                            
                                             <a href="#details" class="section-btn btn btn-default btn-blue smoothScroll">View/Delete doctor details</a>
                                        </div>
                                   </div>
                              </div>
                         </div>

               </div>
          </div>
     </section>


     <!-- ABOUT -->
     


     <!-- TEAM --> <body style="height:30%">
     <section id="refer" data-stellar-background-ratio="5">
          <div class="container">
               <div class="row">

                  

                    <div class="col-md-6 col-sm-6" style="margin-left:290px">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="admn.php" >
										
                              <!-- SECTION TITLE -->
                              <div style="text-align:center">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 style="margin-top:100px">Insert/Update doctor details</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s" >
                              <div class="col-md-6 col-sm-6">
                                        <label for="name" style="margin-top:10px">Doctor ID</label>
                                        <input  type="number" class="form-control" name="id" placeholder="Doctor ID">
                                   </div>
                                                                      
                              <div class="col-md-6 col-sm-6">
                                        <label for="name" style="margin-top:10px">First name</label>
                                        <input  type="text" class="form-control" id="name" name="fname" placeholder="first name">
                                   </div>
                             
                              <div class="col-md-6 col-sm-6"  >
                                        <label for="pid" style="margin-top:10px">Last name</label>
                                        <input type="text" class="form-control" id="phone" name="lname" placeholder="last name">
                                        
                                   </div>
                               <div class="col-md-6 col-sm-6" >
                                        <label for="id">Password</label>
                                        <input  type="password" class="form-control" id="name" name="psd" placeholder="password" >
                                   </div>
                                                                     
                              <div class="col-md-6 col-sm-6">
                                        <label for="age" style="margin-top:3px">Age</label>
                                        <input  type="number" class="form-control" id="name" name="age" >
                                   </div>
                                   
                              <div class="col-md-6 col-sm-6"  >
                                        <label for="qual" style="margin-top:10px">Qualification</label>
                                        <input type="text" class="form-control" id="phone" name="qual" >
                                        
                                   </div>
                                   
                              <div class="col-md-6 col-sm-6"  >
                                        <label for="sex" style="margin-top:10px">Sex</label>
                                        <input type="text" class="form-control" id="phone" name="sex" >
                                        
                                   </div>
                                   
                              <div class="col-md-6 col-sm-6"  >
                                        <label for="email" style="margin-top:10px">Email</label>
                                        <input type="email" class="form-control" id="phone" name="mail" placeholder="Your email id" >
                                        
                                   </div>
                                   
                              <div class="col-md-6 col-sm-6"  >
                                        <label for="session" style="margin-top:10px">Session</label>
                                        <input type="text" class="form-control" id="phone" name="sess"  >
                                        
                                   </div>
                                   
                              <div class="col-md-6 col-sm-6" style="margin-left:150px; margin-bottom:20px " >
                                        <label for="Message">Address</label>
                                        <textarea class="form-control" rows="5" id="message" name="address"></textarea>
                                   </div>
                                  
								                                
                              <button type="submit" style = "width:150px;height:50px;float: left;background-color:YellowGreen;color:white;"class="form-control" id="cf-submit" name="ins">Insert</button>
                              <button  type="submit" class="form-control" id="cf-submit" name="update" style = "width:150px;height:50px;background-color:YellowGreen;color:white;float:right">Update</button>
					
                              
                        </form>
                    </div>

               </div>
          </div>
     </section>
     
     </body>
     


     <!-- NEWS -->
     <section id="details" data-stellar-background-ratio="5" >
          <div class="container">
               <div class="row">

                   

                    <div class="col-md-6 col-sm-6" style="margin-left:290px" >
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="admin_view.php" >
										
                              <!-- SECTION TITLE -->
                              <div style="text-align:center">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 style="margin-top:90px">View details</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s"  >
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Name</label>
                                        <input  type="text" class="form-control" id="name" name="name1" placeholder="Name">
                                   </div>

                                   

                                   <div class="col-md-6 col-sm-6">
                                        <label for="pid">Enter doctor id</label>
                                        <input  type="number" class="form-control" id="phone" name="id1" placeholder="id">
                                        
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6" >
                                   
                                   
                                       <button  type="submit" class="form-control" id="cf-submit" name="view" style = "width:150px;height:50px;margin-top:40px;margin-bottom:30px;float: left;background-color:YellowGreen;color:white">View</button>
												</div> 
												
												<div class="col-md-6 col-sm-6" >                                      
                                        <button type="submit" style = "width:150px;height:50px;margin-top:40px;margin-bottom:30px;margin-left:50px;float: right;background-color:YellowGreen;color:white"class="form-control" id="cf-submit" name="remove">Remove</button>
                             
	                           </div>	
                              </div>
                              </div>
                              
                              
                        </form>
                    </div>

               </div>
          </div>
     </section>
     


     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    

                    <div class="col-md-6 col-sm-6" style="margin-left:290px">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="disease.php">

                              <!-- SECTION TITLE -->
                              <div style="text-align:center">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 style="margin-top:10px">Update here</h2>
                              </div>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-6 col-sm-6">
                                   <button type="submit" style = "width:120px;height:50px;float:left"class="form-control" id="cf-submit" name="disa">Disease</button>
                                   
                                   </form></div>
                                 <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <form id="appointment-form" role="form" method="post" action="remedy.php">
                                   <button  type="submit" class="form-control" id="cf-submit" name="upda" style = "width:120px;height:50px;float:right">Remedy</button>
											</div>                                   
                        </form>
                    </div>

               </div>
          </div>
     </section>


     <!-- GOOGLE MAP -->
              


     <!-- FOOTER -->
     

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>